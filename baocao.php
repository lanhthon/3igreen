<?php
require_once 'config/database.php'; // Kết nối CSDL

// Hàm hiển thị báo cáo tồn kho sản phẩm
function displayProductInventory($conn) {
    echo "<h2>Báo cáo Tồn kho sản phẩm</h2>";
    $sql = "
        SELECT
            v.variant_sku,
            v.variant_name,
            u.name AS unit_name,
            vi.quantity,
            vi.minimum_stock_level
        FROM
            variants v
        JOIN
            variant_inventory vi ON v.variant_id = vi.variant_id
        JOIN
            units u ON vi.unit_id = u.unit_id
        ORDER BY
            v.variant_name;
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
        echo "<thead><tr><th>Mã SKU</th><th>Tên sản phẩm</th><th>Đơn vị</th><th>Số lượng tồn</th><th>Mức tồn tối thiểu</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["variant_sku"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["variant_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["unit_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["minimum_stock_level"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Không có dữ liệu tồn kho sản phẩm.</p>";
    }
}

// Hàm hiển thị báo cáo doanh số báo giá
function displayQuoteSales($conn) {
    echo "<h2>Báo cáo Doanh số báo giá</h2>";

    // Tổng tiền các báo giá
    $sql_total = "
        SELECT
            SUM(TongTienSauThue) AS TotalSales
        FROM
            baogia;
    ";
    $result_total = $conn->query($sql_total);
    if ($row_total = $result_total->fetch_assoc()) {
        echo "<p><strong>Tổng doanh số báo giá (sau thuế): </strong> " . number_format($row_total["TotalSales"], 2) . " VND</p>";
    } else {
        echo "<p>Không có dữ liệu tổng doanh số báo giá.</p>";
    }

    // Chi tiết từng báo giá
    echo "<h3>Chi tiết từng báo giá</h3>";
    $sql_details = "
        SELECT
            bg.SoBaoGia,
            bg.NgayBaoGia,
            bg.TenCongTy,
            bg.TongTienSauThue,
            bg.TrangThai,
            nd.HoTen AS NguoiTao
        FROM
            baogia bg
        LEFT JOIN
            nguoidung nd ON bg.NguoiTao = nd.UserID
        ORDER BY
            bg.NgayBaoGia DESC;
    ";
    $result_details = $conn->query($sql_details);

    if ($result_details->num_rows > 0) {
        echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
        echo "<thead><tr><th>Số báo giá</th><th>Ngày báo giá</th><th>Tên công ty</th><th>Tổng tiền (Sau thuế)</th><th>Trạng thái</th><th>Người tạo</th></tr></thead>";
        echo "<tbody>";
        while($row = $result_details->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["SoBaoGia"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["NgayBaoGia"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["TenCongTy"]) . "</td>";
            echo "<td>" . number_format($row["TongTienSauThue"], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row["TrangThai"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["NguoiTao"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Không có chi tiết báo giá nào.</p>";
    }
}

// Hàm hiển thị báo cáo tình hình sản xuất
function displayProductionStatus($conn) {
    echo "<h2>Báo cáo Tình hình sản xuất</h2>";
    $sql = "
        SELECT
            lsx.SoLenhSX,
            lsx.NgayTao,
            lsx.NgayHoanThanhUocTinh,
            lsx.TrangThai,
            dh.SoYCSX,
            dh.TenCongTy,
            dh.TenDuAn
        FROM
            lenh_san_xuat lsx
        JOIN
            donhang dh ON lsx.YCSX_ID = dh.YCSX_ID
        ORDER BY
            lsx.NgayTao DESC;
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
        echo "<thead><tr><th>Số lệnh SX</th><th>Ngày tạo</th><th>Hoàn thành ước tính</th><th>Trạng thái</th><th>Số YCSX</th><th>Công ty</th><th>Dự án</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["SoLenhSX"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["NgayTao"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["NgayHoanThanhUocTinh"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["TrangThai"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["SoYCSX"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["TenCongTy"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["TenDuAn"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Không có dữ liệu tình hình sản xuất.</p>";
    }
}

// Hàm hiển thị báo cáo lịch sử nhập xuất kho
function displayInventoryMovementHistory($conn) {
    echo "<h2>Báo cáo Lịch sử nhập xuất kho</h2>";
    $sql = "
        SELECT
            l.NgayGiaoDich,
            l.LoaiGiaoDich,
            v.variant_sku,
            v.variant_name,
            l.SoLuongThayDoi,
            l.SoLuongSauGiaoDich,
            l.MaThamChieu,
            l.DonGia,
            l.GhiChu
        FROM
            lichsunhapxuat l
        LEFT JOIN
            variants v ON l.SanPhamID = v.variant_id
        ORDER BY
            l.NgayGiaoDich DESC;
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
        echo "<thead><tr><th>Ngày giao dịch</th><th>Loại giao dịch</th><th>Mã SKU</th><th>Tên sản phẩm</th><th>Số lượng thay đổi</th><th>Tồn kho sau GD</th><th>Mã tham chiếu</th><th>Đơn giá</th><th>Ghi chú</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["NgayGiaoDich"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["LoaiGiaoDich"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["variant_sku"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["variant_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["SoLuongThayDoi"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["SoLuongSauGiaoDich"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["MaThamChieu"]) . "</td>";
            echo "<td>" . number_format($row["DonGia"], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row["GhiChu"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Không có dữ liệu lịch sử nhập xuất kho.</p>";
    }
}

// Hàm hiển thị thông tin khách hàng/công ty và doanh số đơn hàng
function displayCustomerCompanySales($conn) {
    echo "<h2>Thông tin Khách hàng / Công ty và Doanh số đơn hàng</h2>";
    $sql = "
        SELECT
            c.TenCongTy,
            c.DiaChi,
            c.SoDienThoaiChinh,
            c.MaSoThue,
            SUM(bg.TongTienSauThue) AS TotalQuoteSales,
            COUNT(DISTINCT bg.BaoGiaID) AS NumberOfQuotes
        FROM
            congty c
        LEFT JOIN
            baogia bg ON c.CongTyID = bg.CongTyID
        GROUP BY
            c.CongTyID
        ORDER BY
            TotalQuoteSales DESC;
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
        echo "<thead><tr><th>Tên Công ty</th><th>Địa chỉ</th><th>Số điện thoại</th><th>Mã số thuế</th><th>Tổng doanh số báo giá</th><th>Số lượng báo giá</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["TenCongTy"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["DiaChi"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["SoDienThoaiChinh"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["MaSoThue"]) . "</td>";
            echo "<td>" . number_format($row["TotalQuoteSales"], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row["NumberOfQuotes"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Không có dữ liệu khách hàng/công ty.</p>";
    }
}

// Hàm hiển thị báo cáo doanh số đơn hàng
function displayOrderSales($conn) {
    echo "<h2>Báo cáo Đơn hàng & Doanh số đơn hàng</h2>";

    // Tổng doanh số đơn hàng (từ báo giá gốc)
    $sql_total_order_sales = "
        SELECT
            SUM(bg.TongTienSauThue) AS TotalOrderSales
        FROM
            donhang dh
        JOIN
            baogia bg ON dh.BaoGiaID = bg.BaoGiaID;
    ";
    $result_total_order_sales = $conn->query($sql_total_order_sales);
    if ($row_total_order_sales = $result_total_order_sales->fetch_assoc()) {
        echo "<p><strong>Tổng doanh số đơn hàng (từ báo giá gốc, sau thuế): </strong> " . number_format($row_total_order_sales["TotalOrderSales"], 2) . " VND</p>";
    } else {
        echo "<p>Không có dữ liệu tổng doanh số đơn hàng.</p>";
    }

    // Chi tiết từng đơn hàng
    echo "<h3>Chi tiết từng đơn hàng</h3>";
    $sql_order_details = "
        SELECT
            dh.SoYCSX,
            dh.NgayTao,
            dh.NgayGiaoDuKien,
            dh.TenCongTy,
            dh.TenDuAn,
            dh.TrangThai,
            bg.TongTienSauThue AS GiaTriBaoGiaGoc,
            nd.HoTen AS NguoiTaoBaoGia
        FROM
            donhang dh
        LEFT JOIN
            baogia bg ON dh.BaoGiaID = bg.BaoGiaID
        LEFT JOIN
            nguoidung nd ON bg.NguoiTao = nd.UserID
        ORDER BY
            dh.NgayTao DESC;
    ";
    $result_order_details = $conn->query($sql_order_details);

    if ($result_order_details->num_rows > 0) {
        echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
        echo "<thead><tr><th>Số YCSX</th><th>Ngày tạo</th><th>Ngày giao dự kiến</th><th>Tên công ty</th><th>Dự án</th><th>Trạng thái</th><th>Giá trị báo giá gốc</th><th>Người tạo báo giá</th></tr></thead>";
        echo "<tbody>";
        while($row = $result_order_details->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["SoYCSX"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["NgayTao"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["NgayGiaoDuKien"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["TenCongTy"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["TenDuAn"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["TrangThai"]) . "</td>";
            echo "<td>" . number_format($row["GiaTriBaoGiaGoc"], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row["NguoiTaoBaoGia"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Không có dữ liệu đơn hàng nào.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo tổng quan</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
        color: #333;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2,
    h3 {
        color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .report-section {
        margin-bottom: 40px;
        padding: 20px;
        border: 1px solid #eee;
        border-radius: 5px;
        background-color: #fafafa;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Báo cáo tổng quan hệ thống</h1>
        <hr>

        <div class="report-section">
            <?php displayOrderSales($conn); ?>
        </div>
        <hr>

        <div class="report-section">
            <?php displayProductInventory($conn); ?>
        </div>
        <hr>

        <div class="report-section">
            <?php displayQuoteSales($conn); ?>
        </div>
        <hr>

        <div class="report-section">
            <?php displayProductionStatus($conn); ?>
        </div>
        <hr>

        <div class="report-section">
            <?php displayInventoryMovementHistory($conn); ?>
        </div>
        <hr>

        <div class="report-section">
            <?php displayCustomerCompanySales($conn); ?>
        </div>
    </div>

    <?php
    $conn->close(); // Đóng kết nối CSDL sau khi hoàn thành
    ?>
</body>

</html>