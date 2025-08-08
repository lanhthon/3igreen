<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển Báo Cáo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }

        /* Custom colors for Tailwind CSS */
        :root {
            --color-primary-50: #f8fceb;
            --color-primary-100: #f1f8d8;
            --color-primary-200: #e2f0b1;
            --color-primary-300: #c9e685;
            --color-primary-400: #afda5a;
            --color-primary-500: #8ec14a;
            /* Main theme color */
            --color-primary-600: #7eb042;
            --color-primary-700: #6a9538;
            --color-primary-800: #577a2e;
            --color-primary-900: #4a6327;
            --color-primary-950: #23350e;
        }

        .bg-primary-50 {
            background-color: var(--color-primary-50);
        }

        .bg-primary-100 {
            background-color: var(--color-primary-100);
        }

        .bg-primary-200 {
            background-color: var(--color-primary-200);
        }

        .bg-primary-300 {
            background-color: var(--color-primary-300);
        }

        .bg-primary-400 {
            background-color: var(--color-primary-400);
        }

        .bg-primary-500 {
            background-color: var(--color-primary-500);
        }

        .bg-primary-600 {
            background-color: var(--color-primary-600);
        }

        .bg-primary-700 {
            background-color: var(--color-primary-700);
        }

        .bg-primary-800 {
            background-color: var(--color-primary-800);
        }

        .bg-primary-900 {
            background-color: var(--color-primary-900);
        }

        .bg-primary-950 {
            background-color: var(--color-primary-950);
        }

        .text-primary-500 {
            color: var(--color-primary-500);
        }

        .text-primary-600 {
            color: var(--color-primary-600);
        }

        .kpi-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        /* Spinner for loading state */
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--color-primary-500);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            display: none; /* Hide loader by default */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Active navigation link */
        .nav-link.active {
            background-color: var(--color-primary-700);
            color: white;
        }

        /* Table styles for smaller appearance */
        .data-table th,
        .data-table td {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            padding-top: 0.4rem;
            padding-bottom: 0.4rem;
            font-size: 0.8125rem;
        }

        .data-table thead {
            font-size: 0.6875rem;
        }

        .data-table .loader {
            width: 18px !important;
            height: 18px !important;
            border-width: 3px !important;
        }

        /* Smaller font for currency values in KPI cards */
        .kpi-currency-value {
            font-size: 1.25rem; /* text-lg */
            line-height: 1.75rem; /* leading-7 */
            white-space: normal; /* Allow text to wrap */
            overflow: visible; /* Do not hide overflow */
            text-overflow: clip; /* Do not add ellipsis */
            word-break: break-all; /* Break words if necessary to prevent overflow */
        }

        /* Adjusted ml-4 to ml-2 for more space for number */
        .kpi-card .ml-4 {
            margin-left: 0.5rem; /* Equivalent to ml-2 in Tailwind CSS */
            flex-grow: 1; /* Allow content to grow and take available space */
            min-width: 0; /* Important for flex items to prevent overflow */
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f8fceb',
                            100: '#f1f8d8',
                            200: '#e2f0b1',
                            300: '#c9e685',
                            400: '#afda5a',
                            500: '#8ec14a',
                            /* Main theme color */
                            600: '#7eb042',
                            700: '#6a9538',
                            800: '#577a2e',
                            900: '#4a6327',
                            950: '#23350e',
                        },
                    }
                }
            }
        }
    </script>
</head>

<body class="antialiased text-gray-800">

    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-md sticky top-0 z-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-3">
                        <i class="ph-bold ph-chart-bar text-2xl text-primary-600"></i>
                        <h1 class="text-xl font-bold text-gray-900">3IGREEN</h1>
                    </div>
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full object-cover"
                            src="logo.png" alt="Avatar">
                    </div>
                </div>
            </div>
        </header>

        <nav class="bg-primary-600 shadow-lg sticky top-16 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-12">
                    <div class="flex space-x-4">
                        <a href="#" class="nav-link active px-3 py-2 rounded-md text-sm font-medium text-white"
                            data-target="dashboard-section">
                            <i class="ph-bold ph-gauge-circle mr-2"></i>Tổng quan
                        </a>
                        <a href="#"
                            class="nav-link px-3 py-2 rounded-md text-sm font-medium text-primary-100 hover:bg-primary-700 hover:text-white"
                            data-target="quotes-section">
                            <i class="ph-bold ph-files mr-2"></i>Báo giá
                        </a>
                        <a href="#"
                            class="nav-link px-3 py-2 rounded-md text-sm font-medium text-primary-100 hover:bg-primary-700 hover:text-white"
                            data-target="orders-section">
                            <i class="ph-bold ph-package mr-2"></i>Đơn hàng
                        </a>
                        <a href="#"
                            class="nav-link px-3 py-2 rounded-md text-sm font-medium text-primary-100 hover:bg-primary-700 hover:text-white"
                            data-target="inventory-section">
                            <i class="ph-bold ph-warehouse mr-2"></i>Kho hàng
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            <div class="max-w-7xl mx-auto">

                <section id="dashboard-section" class="content-section">
                    <div id="kpi-grid" class="grid grid-cols-2 md:grid-cols-5 gap-4 sm:gap-6">
                        <div class="kpi-card bg-white p-4 rounded-xl shadow">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary-100 rounded-lg p-3"><i
                                        class="ph-bold ph-money text-2xl text-primary-600"></i></div>
                                <div class="ml-2 flex-grow min-w-0">
                                    <p class="text-sm font-medium text-gray-500 truncate">Doanh thu tháng</p>
                                    <p id="monthly-revenue" class="kpi-currency-value font-bold"></p>
                                </div>
                            </div>
                        </div>
                        <div class="kpi-card bg-white p-4 rounded-xl shadow">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3"><i
                                        class="ph-bold ph-files text-2xl text-blue-600"></i></div>
                                <div class="ml-2 flex-grow min-w-0">
                                    <p class="text-sm font-medium text-gray-500 truncate">Báo giá mới</p>
                                    <p id="new-quotes" class="text-xl font-bold"></p>
                                </div>
                            </div>
                        </div>
                        <div class="kpi-card bg-white p-4 rounded-xl shadow">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-100 rounded-lg p-3"><i
                                        class="ph-bold ph-package text-2xl text-yellow-600"></i></div>
                                <div class="ml-2 flex-grow min-w-0">
                                    <p class="text-sm font-medium text-gray-500 truncate">Đơn hàng mới</p>
                                    <p id="new-orders" class="text-xl font-bold"></p>
                                </div>
                            </div>
                        </div>
                        <div class="kpi-card bg-white p-4 rounded-xl shadow">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-red-100 rounded-lg p-3"><i
                                        class="ph-bold ph-truck text-2xl text-red-600"></i></div>
                                <div class="ml-2 flex-grow min-w-0">
                                    <p class="text-sm font-medium text-gray-500 truncate">Chờ giao hàng</p>
                                    <p id="pending-delivery" class="text-xl font-bold"></p>
                                </div>
                            </div>
                        </div>
                        <div class="kpi-card bg-white p-4 rounded-xl shadow">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-orange-100 rounded-lg p-3"><i
                                        class="ph-bold ph-package-minus text-2xl text-orange-600"></i></div>
                                <div class="ml-2 flex-grow min-w-0">
                                    <p class="text-sm font-medium text-gray-500 truncate">Hàng tồn kho thấp</p>
                                    <p id="low-stock-count" class="text-xl font-bold"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mt-6">
                        <div class="lg:col-span-3 bg-white p-4 rounded-xl shadow">
                            <h3 class="text-lg font-semibold mb-4">Doanh thu 6 tháng gần nhất (VND)</h3>
                            <div class="h-80"><canvas id="revenueChart"></canvas></div>
                        </div>
                        <div class="lg:col-span-2 bg-white p-4 rounded-xl shadow">
                            <h3 class="text-lg font-semibold mb-4">Tỷ lệ trạng thái đơn hàng</h3>
                            <div class="h-80 flex items-center justify-center"><canvas id="orderStatusChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">Đơn hàng gần đây</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 data-table">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col">Số YCSX</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Giá trị</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-orders-table">
                                    <tr>
                                        <td colspan="4" class="text-center p-4 text-gray-500">Đang tải dữ liệu...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6 bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">Các mặt hàng tồn kho thấp</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 data-table">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Tồn kho hiện tại</th>
                                        <th scope="col">Mức tối thiểu</th>
                                        <th scope="col">Cần nhập thêm</th>
                                    </tr>
                                </thead>
                                <tbody id="low-stock-items-table">
                                    <tr>
                                        <td colspan="5" class="text-center p-4 text-gray-500">Đang tải dữ liệu...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section id="quotes-section" class="content-section hidden">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Danh sách Báo giá</h2>
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 data-table">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col">ID Báo giá</th>
                                        <th scope="col">Số báo giá</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Ngày báo giá</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody id="quotes-table">
                                    <tr>
                                        <td colspan="6" class="text-center p-4 text-gray-500">Đang tải dữ liệu...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section id="orders-section" class="content-section hidden">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Quản lý Đơn hàng</h2>
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">Tất cả Đơn hàng</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 data-table">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col">Số YCSX</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Giá trị</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody id="all-orders-table">
                                    <tr>
                                        <td colspan="5" class="text-center p-4 text-gray-500">Đang tải dữ liệu...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section id="inventory-section" class="content-section hidden">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Lịch sử Xuất/Nhập Kho</h2>
                    <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">Lịch sử Nhập kho</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 data-table">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col">ID Giao dịch</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Ngày nhập</th>
                                    </tr>
                                </thead>
                                <tbody id="inventory-in-table">
                                    <tr>
                                        <td colspan="5" class="text-center p-4 text-gray-500">Đang tải dữ liệu...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">Lịch sử Xuất kho</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 data-table">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col">ID Giao dịch</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Ngày xuất</th>
                                    </tr>
                                </thead>
                                <tbody id="inventory-out-table">
                                    <tr>
                                        <td colspan="5" class="text-center p-4 text-gray-500">Đang tải dữ liệu...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <script>
        // Store chart instances to prevent duplicates
        let revenueChartInstance = null;
        let orderStatusChartInstance = null;

        // Function to format number as currency (VND)
        function formatCurrency(number) {
            // Sử dụng regex để thay thế ký tự "₫" bằng " VND" và loại bỏ khoảng trắng không cần thiết
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(number).replace('₫', '').trim() + ' VND';
        }

        // Function to get a color for the order/quote status based on content
        function getStatusColor(status) {
            const lowerStatus = status.toLowerCase();

            // Màu sắc cho các trạng thái cụ thể (bạn có thể tùy chỉnh)
            if (lowerStatus.includes('hoàn thành')) return 'bg-primary-500'; // Xanh lá chính
            if (lowerStatus.includes('đang sản xuất')) return 'bg-amber-500'; // Vàng cam
            if (lowerStatus.includes('chờ giao') || lowerStatus.includes('đã chuẩn bị'))
                return 'bg-sky-500'; // Xanh da trời
            if (lowerStatus.includes('hủy')) return 'bg-rose-500'; // Đỏ hồng
            if (lowerStatus.includes('mới tạo')) return 'bg-indigo-500'; // Xanh tím
            if (lowerStatus.includes('chờ duyệt')) return 'bg-purple-500'; // Tím
            if (lowerStatus.includes('đã duyệt')) return 'bg-primary-600'; // Xanh lá đậm hơn
            if (lowerStatus.includes('từ chối')) return 'bg-gray-500'; // Xám

            return 'bg-slate-400'; // Màu mặc định nếu không khớp
        }

        // --- FUNCTIONS TO RENDER DATA ---
        function updateKPIs(kpis) {
            document.getElementById('monthly-revenue').textContent = formatCurrency(kpis.monthlyRevenue);
            document.getElementById('new-quotes').textContent = kpis.newQuotes;
            document.getElementById('new-orders').textContent = kpis.newOrders;
            document.getElementById('pending-delivery').textContent = kpis.pendingDelivery;
            document.getElementById('low-stock-count').textContent = kpis.lowStockCount;
        }

        function renderRecentOrders(orders) {
            const tableBody = document.getElementById('recent-orders-table');
            if (orders.length === 0) {
                tableBody.innerHTML =
                    '<tr><td colspan="4" class="text-center p-4 text-gray-500">Không có đơn hàng nào gần đây.</td></tr>';
                return;
            }
            let html = '';
            orders.forEach(order => {
                html += `
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-3 py-1.5 font-medium text-gray-900 whitespace-nowrap">${order.SoYCSX}</td>
                        <td class="px-3 py-1.5">${order.TenCongTy}</td>
                        <td class="px-3 py-1.5 font-semibold">${formatCurrency(order.TongTien)}</td>
                        <td class="px-3 py-1.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium text-white ${getStatusColor(order.TrangThai)}">
                                ${order.TrangThai}
                            </span>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }

        function renderLowStockItems(items) {
            const tableBody = document.getElementById('low-stock-items-table');
            if (items.length === 0) {
                tableBody.innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-gray-500">Không có mặt hàng nào tồn kho thấp.</td></tr>';
                return;
            }
            let html = '';
            items.forEach(item => {
                const needed = item.minimum_stock_level - item.quantity;
                html += `
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-3 py-1.5 font-medium text-gray-900 whitespace-nowrap">${item.variant_sku}</td>
                        <td class="px-3 py-1.5">${item.variant_name}</td>
                        <td class="px-3 py-1.5">${item.quantity}</td>
                        <td class="px-3 py-1.5">${item.minimum_stock_level}</td>
                        <td class="px-3 py-1.5 font-semibold text-orange-600">${needed > 0 ? needed : 0}</td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }

        function renderQuotes(quotes) {
            const tableBody = document.getElementById('quotes-table');
            if (quotes.length === 0) {
                tableBody.innerHTML =
                    '<tr><td colspan="6" class="text-center p-4 text-gray-500">Không có báo giá nào.</td></tr>';
                return;
            }
            let html = '';
            quotes.forEach(quote => {
                html += `
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-3 py-1.5 font-medium text-gray-900 whitespace-nowrap">${quote.BaoGiaID}</td>
                        <td class="px-3 py-1.5">${quote.SoBaoGia}</td>
                        <td class="px-3 py-1.5">${quote.TenCongTy}</td>
                        <td class="px-3 py-1.5">${quote.NgayBaoGia}</td>
                        <td class="px-3 py-1.5 font-semibold">${formatCurrency(quote.TongTien)}</td>
                        <td class="px-3 py-1.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium text-white ${getStatusColor(quote.TrangThaiBaoGia)}">
                                ${quote.TrangThaiBaoGia}
                            </span>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }

        function renderAllOrders(orders) {
            const tableBody = document.getElementById('all-orders-table');
            if (orders.length === 0) {
                tableBody.innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-gray-500">Không có đơn hàng nào.</td></tr>';
                return;
            }
            let html = '';
            orders.forEach(order => {
                html += `
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-3 py-1.5 font-medium text-gray-900 whitespace-nowrap">${order.SoYCSX}</td>
                        <td class="px-3 py-1.5">${order.TenCongTy}</td>
                        <td class="px-3 py-1.5">${order.NgayTao}</td>
                        <td class="px-3 py-1.5 font-semibold">${formatCurrency(order.TongTien)}</td>
                        <td class="px-3 py-1.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium text-white ${getStatusColor(order.TrangThai)}">
                                ${order.TrangThai}
                            </span>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }

        function renderInventoryIn(transactions) {
            const tableBody = document.getElementById('inventory-in-table');
            if (transactions.length === 0) {
                tableBody.innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-gray-500">Không có giao dịch nhập kho nào.</td></tr>';
                return;
            }
            let html = '';
            transactions.forEach(t => {
                html += `
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-3 py-1.5 font-medium text-gray-900 whitespace-nowrap">${t.transaction_id}</td>
                        <td class="px-3 py-1.5">${t.variant_sku}</td>
                        <td class="px-3 py-1.5">${t.variant_name}</td>
                        <td class="px-3 py-1.5">${t.quantity_changed}</td>
                        <td class="px-3 py-1.5">${t.transaction_date}</td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }

        function renderInventoryOut(transactions) {
            const tableBody = document.getElementById('inventory-out-table');
            if (transactions.length === 0) {
                tableBody.innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-gray-500">Không có giao dịch xuất kho nào.</td></tr>';
                return;
            }
            let html = '';
            transactions.forEach(t => {
                html += `
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-3 py-1.5 font-medium text-gray-900 whitespace-nowrap">${t.transaction_id}</td>
                        <td class="px-3 py-1.5">${t.variant_sku}</td>
                        <td class="px-3 py-1.5">${t.variant_name}</td>
                        <td class="px-3 py-1.5">${t.quantity_changed}</td>
                        <td class="px-3 py-1.5">${t.transaction_date}</td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }


        function renderRevenueChart(data) {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            if (revenueChartInstance) {
                revenueChartInstance.destroy();
            }
            revenueChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(d => d.month),
                    datasets: [{
                        label: 'Doanh thu',
                        data: data.map(d => d.revenue),
                        backgroundColor: 'rgba(142, 193, 74, 0.8)', // #8EC14A with opacity
                        borderColor: 'rgba(142, 193, 74, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e7eb'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        function renderOrderStatusChart(data) {
            const ctx = document.getElementById('orderStatusChart').getContext('2d');
            if (orderStatusChartInstance) {
                orderStatusChartInstance.destroy();
            }
            orderStatusChartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.map(d => d.label),
                    datasets: [{
                        label: 'Số lượng đơn',
                        data: data.map(d => d.data),
                        backgroundColor: [
                            '#8ec14a', // Main primary color
                            '#f59e0b', // Amber-500
                            '#3b82f6', // Blue-500
                            '#ef4444', // Red-500
                            '#8b5cf6', // Violet-500
                            '#ec4899' // Pink-500
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                boxWidth: 12,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });
        }

        // --- NAVIGATION LOGIC ---
        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                link.classList.remove('text-white');
                link.classList.add('text-primary-100', 'hover:bg-primary-700', 'hover:text-white');
            });
            const activeLink = document.querySelector(`.nav-link[data-target="${sectionId}"]`);
            if (activeLink) {
                activeLink.classList.add('active');
                activeLink.classList.remove('text-primary-100', 'hover:bg-primary-700');
                activeLink.classList.add('text-white');
            }
        }

        // --- FETCH DATA AND INITIALIZE THE DASHBOARD ---
        async function fetchDashboardData() {
            try {
                const response = await fetch('./api/get_dashboard_data.php');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();

                // Call rendering functions with live data
                updateKPIs(data.kpis);
                renderRecentOrders(data.recentOrders);
                renderRevenueChart(data.revenueLast6Months);
                renderOrderStatusChart(data.orderStatus);
                renderLowStockItems(data.lowStockItems);
                renderQuotes(data.quotes);
                renderAllOrders(data.allOrders);
                renderInventoryIn(data.inventoryIn);
                renderInventoryOut(data.inventoryOut);

            } catch (error) {
                console.error("Could not fetch dashboard data:", error);
                // Update specific elements with error messages, instead of replacing whole sections
                document.getElementById('monthly-revenue').textContent = 'Lỗi tải dữ liệu!';
                document.getElementById('new-quotes').textContent = 'Lỗi!';
                document.getElementById('new-orders').textContent = 'Lỗi!';
                document.getElementById('pending-delivery').textContent = 'Lỗi!';
                document.getElementById('low-stock-count').textContent = 'Lỗi!';

                document.getElementById('recent-orders-table').innerHTML =
                    '<tr><td colspan="4" class="text-center p-4 text-red-500">Lỗi khi tải dữ liệu. Vui lòng thử lại.</td></tr>';
                document.getElementById('low-stock-items-table').innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-red-500">Lỗi khi tải dữ liệu. Vui lòng thử lại.</td></tr>';
                document.getElementById('quotes-table').innerHTML =
                    '<tr><td colspan="6" class="text-center p-4 text-red-500">Lỗi khi tải dữ liệu. Vui lòng thử lại.</td></tr>';
                document.getElementById('all-orders-table').innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-red-500">Lỗi khi tải dữ liệu. Vui lòng thử lại.</td></tr>';
                document.getElementById('inventory-in-table').innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-red-500">Lỗi khi tải dữ liệu. Vui lòng thử lại.</td></tr>';
                document.getElementById('inventory-out-table').innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-red-500">Lỗi khi tải dữ liệu. Vui lòng thử lại.</td></tr>';

                // Destroy charts if they were initialized and an error occurred during subsequent data fetches
                if (revenueChartInstance) revenueChartInstance.destroy();
                if (orderStatusChartInstance) orderStatusChartInstance.destroy();
                // Optionally, display a placeholder message for charts
                document.getElementById('revenueChart').parentElement.innerHTML = '<p class="text-center text-red-500">Không thể tải biểu đồ doanh thu.</p>';
                document.getElementById('orderStatusChart').parentElement.innerHTML = '<p class="text-center text-red-500">Không thể tải biểu đồ trạng thái đơn hàng.</p>';

            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Attach event listeners to navigation links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = e.target.closest('.nav-link').dataset.target;
                    showSection(targetId);
                });
            });

            // Show dashboard section by default on load
            showSection('dashboard-section');
            fetchDashboardData();
        });
    </script>
</body>

</html>