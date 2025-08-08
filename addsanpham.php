<?php
// Hiển thị tất cả lỗi để dễ dàng gỡ lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * =================================================================
 * CẤU HÌNH KẾT NỐI CƠ SỞ DỮ LIỆU
 * =================================================================
 */
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "baogia_db";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Lỗi kết nối CSDL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

echo "<h1>Bắt đầu quá trình thêm sản phẩm (Phiên bản Hoàn Chỉnh V4 - Sửa lỗi)</h1>";
echo "<p><b>Logic:</b> Sản phẩm gốc 'Cây vuông' sẽ thuộc nhóm 'Bán thành phẩm'.</p>";
echo "<hr>";

$ban_thanh_pham_group_id = null;
$cay_vuong_product_id = null;

try {
    // BƯỚC 1: TÌM HOẶC TẠO NHÓM SẢN PHẨM
    $group_name = 'Bán thành phẩm';
    
    $stmt_find_group = $conn->prepare("SELECT group_id FROM product_groups WHERE name = ?");
    $stmt_find_group->bind_param("s", $group_name);
    $stmt_find_group->execute();
    $result_group = $stmt_find_group->get_result();

    if ($result_group->num_rows > 0) {
        $row_group = $result_group->fetch_assoc();
        $ban_thanh_pham_group_id = $row_group['group_id'];
        echo "<p style='color:blue;'>✔️ Đã tìm thấy nhóm sản phẩm '$group_name' với ID: <strong>$ban_thanh_pham_group_id</strong></p>";
    } else {
        echo "<p style='color:orange;'>⚠️ Không tìm thấy nhóm '$group_name'. Đang tạo mới...</p>";
        $stmt_create_group = $conn->prepare("INSERT INTO product_groups (name) VALUES (?)");
        $stmt_create_group->bind_param("s", $group_name);
        $stmt_create_group->execute();
        $ban_thanh_pham_group_id = $conn->insert_id;
        if ($ban_thanh_pham_group_id > 0) {
            echo "<p style='color:green;'>✔️ Đã tạo thành công nhóm '$group_name' với ID: <strong>$ban_thanh_pham_group_id</strong></p>";
        } else {
            throw new Exception("Không thể tạo nhóm sản phẩm '$group_name'.");
        }
        $stmt_create_group->close();
    }
    $stmt_find_group->close();
    
    // BƯỚC 2: TÌM HOẶC TẠO SẢN PHẨM GỐC
    $base_product_name = 'Cây vuông';
    $base_product_sku = 'CV-BASE';

    $stmt_find_base = $conn->prepare("SELECT product_id FROM products WHERE name = ?");
    $stmt_find_base->bind_param("s", $base_product_name);
    $stmt_find_base->execute();
    $result_base = $stmt_find_base->get_result();

    if ($result_base->num_rows > 0) {
        $row_base = $result_base->fetch_assoc();
        $cay_vuong_product_id = $row_base['product_id'];
        echo "<p style='color:blue;'>✔️ Đã tìm thấy sản phẩm gốc '$base_product_name' với ID: <strong>$cay_vuong_product_id</strong></p>";
    } else {
        echo "<p style='color:orange;'>⚠️ Không tìm thấy sản phẩm gốc '$base_product_name'. Đang tạo mới...</p>";
        $stmt_create_base = $conn->prepare("INSERT INTO products (name, base_sku, sku_prefix, name_prefix, group_id) VALUES (?, ?, 'CV', 'CV', ?)");
        $stmt_create_base->bind_param("ssi", $base_product_name, $base_product_sku, $ban_thanh_pham_group_id);
        $stmt_create_base->execute();
        $cay_vuong_product_id = $conn->insert_id;

        if ($cay_vuong_product_id > 0) {
            echo "<p style='color:green;'>✔️ Đã tạo thành công sản phẩm gốc '$base_product_name' với ID: <strong>$cay_vuong_product_id</strong> và gán vào nhóm '$group_name'.</p>";
        } else {
            throw new Exception("Không thể tạo sản phẩm gốc '$base_product_name'.");
        }
        $stmt_create_base->close();
    }
    $stmt_find_base->close();
    echo "<hr>";

    // BƯỚC 3: QUÉT VÀ TẠO CÁC BIẾN THỂ "CV"
    $source_products_sql = "SELECT variant_sku, LoaiID FROM variants WHERE variant_sku LIKE 'PUR-S %'";
    $result = $conn->query($source_products_sql);

    if ($result->num_rows > 0) {
        echo "Tìm thấy " . $result->num_rows . " sản phẩm gốc 'PUR-S' để xử lý.<br><br>";

        while ($row = $result->fetch_assoc()) {
            $source_sku = $row['variant_sku'];
            $source_loai_id = $row['LoaiID'];

            echo "<strong>Đang xử lý sản phẩm gốc:</strong> " . htmlspecialchars($source_sku) . "<br>";

            if (preg_match('/PUR-S\s*(\d+)\s*x\s*(\d+)\s*x\s*\d+(-(TQ))?/i', $source_sku, $matches)) {
                $part1 = $matches[1];
                $part2 = $matches[2];
                $suffix = isset($matches[4]) ? ' ' . $matches[4] : '';
                $new_sku = "CV " . $part1 . "x" . $part2 . $suffix;
                $new_name = $new_sku;

                // Kiểm tra trùng lặp
                $check_sql = "SELECT variant_id FROM variants WHERE variant_sku = ?";
                $stmt_check = $conn->prepare($check_sql);
                $stmt_check->bind_param("s", $new_sku);
                $stmt_check->execute();
                $stmt_check->store_result();
                if ($stmt_check->num_rows > 0) {
                    echo "<span style='color: orange;'>- Bỏ qua. Sản phẩm '" . htmlspecialchars($new_sku) . "' đã tồn tại.</span><br><br>";
                    $stmt_check->close();
                    continue;
                }
                $stmt_check->close();

                // Bắt đầu giao dịch cho mỗi biến thể
                $conn->begin_transaction();
                try {
                    // Tạo biến thể
                    $insert_variant_sql = "INSERT INTO variants (product_id, variant_sku, variant_name, price, LoaiID) VALUES (?, ?, ?, ?, ?)";
                    $stmt_insert_variant = $conn->prepare($insert_variant_sql);
                    $price = 0;
                    $stmt_insert_variant->bind_param("issdi", $cay_vuong_product_id, $new_sku, $new_name, $price, $source_loai_id);
                    $stmt_insert_variant->execute();
                    $new_variant_id = $conn->insert_id;
                    if ($new_variant_id == 0) throw new Exception("Không thể tạo sản phẩm trong 'variants'.");
                    echo "<span style='color: green;'>- Đã tạo biến thể mới: '" . htmlspecialchars($new_sku) . "'.</span><br>";
                    $stmt_insert_variant->close();

                    // Thêm tồn kho - ĐÃ SỬA LỖI
                    $insert_inventory_sql = "INSERT INTO variant_inventory (variant_id, unit_id, quantity) VALUES (?, ?, ?)";
                    $stmt_insert_inventory = $conn->prepare($insert_inventory_sql);
                    $unit_id = 1;
                    $quantity = 100;
                    $stmt_insert_inventory->bind_param("iii", $new_variant_id, $unit_id, $quantity);
                    $stmt_insert_inventory->execute();
                    echo "<span style='color: blue;'>- Đã thêm tồn kho: 100.</span><br>";
                    $stmt_insert_inventory->close();

                    // Gán thuộc tính
                    $attributes_to_copy = ['Đường kính trong' => $part1, 'Độ dày' => $part2];
                    foreach ($attributes_to_copy as $attr_name => $attr_value) {
                        $stmt_attr = $conn->prepare("SELECT attribute_id FROM attributes WHERE name = ?");
                        $stmt_attr->bind_param("s", $attr_name);
                        $stmt_attr->execute();
                        $result_attr = $stmt_attr->get_result();
                        if ($result_attr->num_rows > 0) {
                            $attribute_id = $result_attr->fetch_assoc()['attribute_id'];
                            $stmt_opt = $conn->prepare("SELECT option_id FROM attribute_options WHERE attribute_id = ? AND value = ?");
                            $stmt_opt->bind_param("is", $attribute_id, $attr_value);
                            $stmt_opt->execute();
                            $result_opt = $stmt_opt->get_result();
                            if ($result_opt->num_rows > 0) {
                                $option_id = $result_opt->fetch_assoc()['option_id'];
                            } else {
                                $stmt_insert_opt = $conn->prepare("INSERT INTO attribute_options (attribute_id, value) VALUES (?, ?)");
                                $stmt_insert_opt->bind_param("is", $attribute_id, $attr_value);
                                $stmt_insert_opt->execute();
                                $option_id = $conn->insert_id;
                                $stmt_insert_opt->close();
                            }
                            $stmt_opt->close();
                            if ($option_id) {
                                $stmt_link = $conn->prepare("INSERT INTO variant_attributes (variant_id, option_id) VALUES (?, ?)");
                                $stmt_link->bind_param("ii", $new_variant_id, $option_id);
                                $stmt_link->execute();
                                $stmt_link->close();
                                echo "<span style='color: #6a0dad;'>- Đã gán thuộc tính: '" . htmlspecialchars($attr_name) . "' = '" . htmlspecialchars($attr_value) . "'.</span><br>";
                            }
                        } else {
                             echo "<span style='color: orange;'>- Cảnh báo: Không tìm thấy thuộc tính '" . htmlspecialchars($attr_name) . "'.</span><br>";
                        }
                        $stmt_attr->close();
                    }
                    
                    $conn->commit();
                    echo "<span style='color: green;'><strong>=> HOÀN TẤT.</strong></span><br><br>";
                } catch (Exception $e) {
                    $conn->rollback();
                    echo "<span style='color: red;'><strong>LỖI GIAO DỊCH:</strong> " . $e->getMessage() . ". Đã hoàn tác.</span><br><br>";
                }
            } else {
                echo "<span style='color: red;'>- Lỗi phân tích cú pháp SKU: '" . htmlspecialchars($source_sku) . "'.</span><br><br>";
            }
        }
    } else {
        echo "Không tìm thấy sản phẩm nào có mã bắt đầu bằng 'PUR-S'.";
    }
} catch (Exception $e) {
    echo "<h2 style='color: red;'>Đã xảy ra lỗi nghiêm trọng!</h2><p>" . $e->getMessage() . "</p>";
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}

echo "<hr>";
echo "<h3>Quá trình kết thúc.</h3>";
?>