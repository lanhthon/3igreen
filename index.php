<?php
session_start();

if (!isset($_SESSION['user_id'])) { header('Location: pages/login.php'); exit;}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3i-Fix | Phần Mềm Quản lý</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .menu {
        background-color: #343a40;
        position: fixed;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: #4caf50;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #45a049;
    }

    .sidebar-item.active,
    .sidebar-item:hover {
        background-color: #4caf50;
    }

    #sidebar-menu {
        overflow-y: auto;
        max-height: calc(80vh - 120px);
    }

    .sidebar-item {
        transition: background-color 0.3s;
    }

    footer.fixed {
        z-index: 1000;
    }

    @media print {
        aside.no-print {
            display: none !important;
        }

        body,
        .flex.h-screen.w-full {
            overflow: visible !important;
            height: auto !important;
            display: block !important;
        }

        #main-content-container {
            overflow-y: visible !important;
            height: auto !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    }
    </style>
</head>

<body class="bg-slate-100">
    <!-- Thông báo sửa giao diện -->
    <div class="w-full bg-yellow-300 text-center text-black py-2 font-semibold shadow-md z-50"><h1>DEV Mode</h1>
       Lưu ý: PUR: Giữ nguyên quy trình sản xuất 2 cấp: Cần Bán thành phẩm (BTP) là "cây", sau đó mới cắt ra Thành phẩm là "bộ".

ULA: Đơn giản hóa thành quy trình 1 cấp: Sản xuất thẳng ra Thành phẩm ULA, không có khái niệm Bán thành phẩm cho ULA nữa.(Người thực hiện thondl deadline:7h 08/08/2025)<br>
Quy trình tạo phiếu xuất kho.(Người thực hiện kietnq deadline:7h 08/08/2025)
    </div>

    <div class="flex h-screen w-full">
        <aside class="w-64 bg-gray-800 text-white flex flex-col flex-shrink-0 no-print">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-xl font-bold text-center">3I GREEN</h1>
                <div class="mt-4 text-center">
                    <i class="fas fa-user-circle text-4xl text-blue-300"></i>
                    <p id="user-fullname" class="font-semibold mt-2">Dev Mode</p>
                    <p id="user-role" class="text-xs text-blue-300 uppercase">ADMIN</p>
                </div>
            </div>

            <nav id="sidebar-menu" class="flex-1 p-2 space-y-1">
                <div class="text-center p-4 text-sm text-gray-400">
                    <i class="fas fa-spinner fa-spin mr-2"></i>Đang tải menu...
                </div>
            </nav>

            <div class="p-2 border-t border-gray-700">
                <a href="api/logout.php"
                    class="sidebar-item flex items-center p-3 rounded-md text-red-300 hover:bg-red-600 hover:text-white transition-colors duration-200">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    <span class="ml-3">Đăng Xuất</span>
                </a>
            </div>
        </aside>

        <main id="main-content-container" class="flex-1 p-4 lg:p-6 overflow-y-auto">
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function openNewWindow(url, windowName = '_blank', features = 'width=900,height=700,resizable=yes,scrollbars=yes') {
        window.open(url, windowName, features);
    }
    </script>
    <script src="assets/js/kho.js"></script>
    <script src="assets/js/report_low_stock.js"></script>
    <script src="assets/js/xuatkho.js"></script>
    <script src="assets/js/chuanbi_hang_edit.js"></script>
    <script src="assets/js/xuatkho_module.js"></script>
    <script src="assets/js/donhang_management.js"></script>
    <script src="assets/js/baogia_management.js"></script>
    <script src="assets/js/nhapkho.js"></script>
    <script src="assets/js/permissions.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="assets/js/production_management.js"></script>
    <script src="assets/js/reports.js"></script>
    <script src="assets/js/sanxuat_view.js"></script>
    <script src="assets/js/quote_list.js"></script>
    <script src="assets/js/xuatkho_create_init.js"></script>
    <script src="assets/js/xuatkho_general_create_init.js"></script>
    <script src="assets/js/xuatkho_issued_list_init.js"></script>
    <script src="assets/js/nhapkho_module.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/quanlysanpham.js"></script>
    <script src="assets/js/giaohang_module.js"></script>
    <script src="assets/js/project_management.js"></script>
    <script src="assets/js/chuanbi_hang_list.js"></script>
    <script src="assets/js/label_management.js"></script>
    <script src="assets/js/customer_management_module.js"></script>
    <script src="assets/js/nhapkho_btp_module.js"></script>
     <script src="assets/js/nhapkho_vattu_module.js"></script>
      <script src="assets/js/nhapkho_tp_module.js"></script>
      <script src="assets/js/xuatkho_btp_module.js"></script>
    <script src="https://unpkg.com/tabulator-tables@5.6.1/dist/js/tabulator.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/0yfj2gur79vvlp9qku8q0dmwf5hy0oigecypgdeyh4jrw208/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
</body>

</html>
