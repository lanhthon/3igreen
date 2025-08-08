<?php
/**
 * api.php - Backend API Version 3.0
 *
 * Được thiết kế để hoạt động với cấu trúc cơ sở dữ liệu đã chuẩn hóa.
 * Xử lý tìm kiếm sản phẩm với giá động, lưu/cập nhật báo giá, và chốt đơn.
 */

// Thiết lập header để trả về JSON và hỗ trợ UTF-8
header('Content-Type: application/json; charset=utf-8');

// --- Cấu hình kết nối cơ sở dữ liệu ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baogia_db"; // Tên CSDL đã được cập nhật

// Tạo và kiểm tra kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Lỗi kết nối CSDL: ' . $conn->connect_error]);
    exit();
}
$conn->set_charset("utf8");

// Lấy hành động từ yêu cầu
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

// Xử lý các hành động
switch ($action) {
    case 'search_products':
        searchProducts($conn);
        break;
    case 'save_quote':
        saveQuote($conn);
        break;
    case 'confirm_quote':
        confirmQuote($conn);
        break;
    // Thêm các case khác ở đây nếu cần (get_quote, get_customers,...)
    default:
        echo json_encode(['success' => false, 'message' => 'Hành động không hợp lệ.']);
        break;
}

$conn->close();

/**
 * Tìm kiếm sản phẩm và tính toán giá dựa trên tất cả các cơ chế giá.
 */
function searchProducts($conn) {
    $term = isset($_GET['term']) ? $_GET['term'] : '';
    $response = [];

    if (strlen($term) < 2) {
        echo json_encode($response);
        return;
    }
    
    // 1. Lấy tất cả các cơ chế giá và % chiết khấu
    $schemas_result = $conn->query("SELECT schema_code, discount_percentage FROM price_schemas");
    $discounts = [];
    while ($schema_row = $schemas_result->fetch_assoc()) {
        $discounts[$schema_row['schema_code']] = (float)$schema_row['discount_percentage'];
    }

    // 2. Tìm kiếm sản phẩm
    $searchTerm = "%" . $conn->real_escape_string($term) . "%";
    $sql = "SELECT p.*, pt.base_description 
            FROM products p 
            JOIN product_types pt ON p.product_type_id = pt.id 
            WHERE p.product_code LIKE ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // 3. Xử lý kết quả và tính toán giá
    while($row = $result->fetch_assoc()) {
        $base_price = (float)$row['base_price'];
        $calculated_prices = [];
        
        // Tính giá cho mỗi cơ chế
        foreach ($discounts as $code => $percent) {
            $calculated_prices[strtolower($code)] = $base_price * (1 - $percent / 100);
        }
        
        $row['price'] = $calculated_prices;
        
        // Tạo tên sản phẩm đầy đủ để hiển thị
        $row['full_description'] = $row['base_description'] . ' ' . $row['product_id_str'] . 'x' . $row['thickness'] . 'x' . $row['width'];

        $response[] = $row;
    }
    
    $stmt->close();
    echo json_encode($response);
}

/**
 * Lưu hoặc cập nhật một báo giá.
 */
function saveQuote($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $quoteId = isset($data['quote_id']) ? (int)$data['quote_id'] : 0;
    $status = 'draft'; // Mặc định là 'đã lưu' (bản nháp)

    $conn->begin_transaction();

    try {
        // Xử lý khách hàng (tạo mới nếu chưa có)
        $customerId = isset($data['customer']['id']) ? (int)$data['customer']['id'] : 0;
        if ($customerId == 0 && !empty($data['customer']['name'])) {
            $stmt = $conn->prepare("INSERT INTO customers (name, address, tel, fax, email, contact_person, default_price_schema_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $data['customer']['name'], $data['customer']['address'], $data['customer']['tel'], $data['customer']['fax'], $data['customer']['email'], $data['customer']['contact_person'], $data['quote_info']['price_schema_code']);
            $stmt->execute();
            $customerId = $conn->insert_id;
            $stmt->close();
        }

        // Tạo hoặc cập nhật báo giá
        if ($quoteId > 0) {
            $sql = "UPDATE quotes SET customer_id=?, user_id=?, project_name=?, category=?, quote_date=?, price_schema_code=?, status=?, notes=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $userId = 1; // Tạm thời
            $notes = json_encode($data['notes']);
            $stmt->bind_param("iissssssi", $customerId, $userId, $data['quote_info']['project_name'], $data['quote_info']['category'], $data['quote_info']['quote_date'], $data['quote_info']['price_schema_code'], $status, $notes, $quoteId);
            $stmt->execute();
            $stmt->close();

            // Xóa các item cũ để thêm lại
            $stmt = $conn->prepare("DELETE FROM quote_items WHERE quote_id = ?");
            $stmt->bind_param("i", $quoteId);
            $stmt->execute();
            $stmt->close();
        } else {
            $sql = "INSERT INTO quotes (quote_number, customer_id, user_id, project_name, category, quote_date, price_schema_code, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $userId = 1; // Tạm thời
            $notes = json_encode($data['notes']);
            $stmt->bind_param("siissssss", $data['quote_info']['quote_number'], $customerId, $userId, $data['quote_info']['project_name'], $data['quote_info']['category'], $data['quote_info']['quote_date'], $data['quote_info']['price_schema_code'], $status, $notes);
            $stmt->execute();
            $quoteId = $conn->insert_id;
            $stmt->close();
        }
        
        // Chèn các dòng sản phẩm vào quote_items
        $stmt = $conn->prepare("INSERT INTO quote_items (quote_id, product_id, quantity, item_note, display_order) VALUES (?, ?, ?, ?, ?)");
        foreach ($data['items'] as $item) {
            $stmt->bind_param("iidss", $quoteId, $item['product_db_id'], $item['quantity'], $item['note'], $item['order']);
            $stmt->execute();
        }
        $stmt->close();

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Đã lưu báo giá thành công!', 'quote_id' => $quoteId, 'status' => 'draft']);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Lỗi khi lưu báo giá: ' . $e->getMessage()]);
    }
}

/**
 * Chốt đơn: Cập nhật trạng thái báo giá và tạo đơn hàng.
 */
function confirmQuote($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $quoteId = isset($data['quote_id']) ? (int)$data['quote_id'] : 0;

    if ($quoteId <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID báo giá không hợp lệ.']);
        return;
    }
    
    // Đầu tiên, lưu lại báo giá để đảm bảo dữ liệu là mới nhất
    // Hàm saveQuote có thể được gọi lại từ đây, hoặc frontend đảm bảo đã lưu trước khi chốt.
    // Giả định frontend đã lưu.

    $conn->begin_transaction();
    try {
        // 1. Cập nhật trạng thái báo giá thành 'confirmed'
        $stmt = $conn->prepare("UPDATE quotes SET status = 'confirmed' WHERE id = ?");
        $stmt->bind_param("i", $quoteId);
        $stmt->execute();

        if($stmt->affected_rows == 0){
             throw new Exception("Không tìm thấy báo giá để chốt đơn.");
        }
        $stmt->close();

        // 2. Tạo một bản ghi trong bảng orders (nếu chưa có)
        $stmt_check = $conn->prepare("SELECT id FROM orders WHERE quote_id = ?");
        $stmt_check->bind_param("i", $quoteId);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        if($result->num_rows == 0) {
             $stmt_insert = $conn->prepare("INSERT INTO orders (quote_id, order_date, status) VALUES (?, CURDATE(), 'pending')");
             $stmt_insert->bind_param("i", $quoteId);
             $stmt_insert->execute();
             $stmt_insert->close();
        }
        $stmt_check->close();

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Đã chốt đơn thành công!']);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Lỗi khi chốt đơn: ' . $e->getMessage()]);
    }
}