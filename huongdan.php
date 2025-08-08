<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hướng Dẫn Sử Dụng Phần Mềm Báo Giá</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .header-green {
            background-color: #e2f0d9;
        }

        .title-green {
            color: #008000;
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.75rem;
        }

        .excel-table th,
        .excel-table td {
            border: 1px solid #999;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        .excel-table th {
            background-color: #e2f0d9;
            font-weight: bold;
            text-align: center;
        }

        /* Styling for explanation boxes */
        .explanation-box {
            background-color: #f0f9ff; /* Light blue */
            border-left: 4px solid #3b82f6; /* Blue border */
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: #1e40af; /* Darker blue text */
        }

        .explanation-box p {
            margin-bottom: 0.5rem;
        }

        .explanation-box ul {
            list-style-type: disc;
            margin-left: 1.25rem;
        }

        .explanation-box ul li {
            margin-bottom: 0.25rem;
        }

        .field-label {
            font-weight: bold;
            color: #333;
        }

        .field-value {
            color: #555;
        }

        .input-field {
            background-color: #f8fafc; /* Light gray for static inputs */
            border: 1px solid #e2e8f0;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            width: 100%;
        }

        .input-field.disabled {
            background-color: #f1f5f9;
            color: #94a3b8;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
            margin-top: 2rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 0.5rem;
        }
    </style>
</head>

<body class="bg-gray-100 p-4 md:p-6">
    <div class="max-w-4xl mx-auto bg-white p-4 md:p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-6">Hướng Dẫn Sử Dụng Phần báo giá</h1>

        <div class="explanation-box">
           
            <p><span class="font-bold text-red-600">Lưu ý quan trọng:</span> Trong hệ thống thực tế, khi trạng thái báo giá là "<span class="font-bold">Chốt</span>" hoặc "<span class="font-bold">Tạch</span>", bạn sẽ <span class="font-bold underline">không thể chỉnh sửa</span> bất kỳ thông tin nào của báo giá. Các trường nhập liệu và nút chỉnh sửa sẽ bị vô hiệu hóa để đảm bảo tính toàn vẹn dữ liệu.</p>
        </div>

        <!-- Thanh Tiêu Đề & Các Nút Chức Năng Chính -->
        <div class="section-title">1. Thanh Tiêu Đề & Các Nút Chức Năng Chính</div>
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 bg-white py-3 px-4 shadow-md rounded-md gap-4">
            <h2 id="page-title" class="text-xl md:text-2xl font-bold text-gray-800">Mô phỏng Tạo Báo Giá Mới</h2>
            <div class="flex flex-wrap items-center justify-center md:justify-end gap-2 md:gap-4">
                <div>
                    <label for="quote-status-select" class="font-bold text-sm">Trạng thái:</label>
                    <select id="quote-status-select" class="bg-white border border-gray-300 rounded-md py-1 px-2 text-sm font-bold input-field disabled" disabled>
                        <option value="Mới tạo">Mới tạo</option>
                        <option value="Đấu thầu">Đấu thầu</option>
                        <option value="Đàm phán">Đàm phán</option>
                        <option value="Chốt">Chốt</option>
                        <option value="Tạch">Tạch</option>
                    </select>
                </div>
                <div>
                    <label for="price-schema" class="font-bold text-sm">Cơ chế giá:</label>
                    <select id="price-schema" class="bg-white border border-gray-300 rounded-md py-1 px-2 text-sm font-bold input-field disabled" disabled>
                        <option value="p0">P0 - Giá niêm yết</option>
                        <option value="p1">P1 - Giá đối tác</option>
                        <option value="p2">P2 - Giá ưu đãi</option>
                    </select>
                </div>
                <button id="save-quote-btn" class="px-4 py-2 text-sm bg-green-600 text-white rounded-md shadow-sm opacity-70 cursor-not-allowed" disabled>
                    <i class="fas fa-save mr-2"></i>Lưu
                </button>
                <button id="export-excel-btn" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md shadow-sm opacity-70 cursor-not-allowed" disabled>
                    <i class="fas fa-file-excel mr-2"></i>Xuất Excel
                </button>
                <button id="export-pdf-btn" class="px-4 py-2 text-sm bg-red-600 text-white rounded-md shadow-sm opacity-70 cursor-not-allowed" disabled>
                    <i class="fas fa-file-pdf mr-2"></i>Xuất PDF
                </button>
            </div>
        </div>
        <div class="explanation-box">
            <p><span class="field-label">Tiêu đề trang:</span> Hiển thị tên của trang hiện tại (ví dụ: "Mô phỏng Tạo Báo Giá Mới").</p>
            <p><span class="field-label">Trạng thái:</span> Là menu thả xuống để chọn trạng thái của báo giá. Trong hệ thống thực tế, khi chọn "Chốt" hoặc "Tạch", báo giá sẽ không thể chỉnh sửa được nữa.</p>
            <p><span class="field-label">Cơ chế giá:</span> Menu thả xuống để chọn cơ chế giá áp dụng. Trong hệ thống thực tế, việc thay đổi cơ chế giá sẽ tự động cập nhật đơn giá sản phẩm.</p>
            <p><span class="field-label">Nút "Lưu":</span> Dùng để lưu lại các thay đổi trên báo giá.</p>
            <p><span class="field-label">Nút "Xuất Excel":</span> Dùng để xuất báo giá ra file Excel.</p>
            <p><span class="field-label">Nút "Xuất PDF":</span> Dùng để xuất báo giá ra file PDF.</p>
        </div>

        <!-- Khu Vực Thông Tin Chung của Báo Giá -->
        <div class="section-title">2. Khu Vực Thông Tin Chung</div>
        <div id="printable-quote-area" class="bg-white p-4 md:p-6 rounded-md shadow-sm border border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start mb-4">
                <div><img src="https://placehold.co/100x50/cccccc/333333?text=Logo" alt="Logo" class="h-12"></div>
                <div class="text-right text-xs mt-4 md:mt-0">
                    <p class="font-bold">CÔNG TY CỔ PHẦN DỊCH VỤ VÀ CÔNG NGHỆ 3I</p>
                    <p>Office: Số 45, ngõ 70, phố Văn Trì, P. Minh Khai, Q. Bắc Từ Liêm, Hà Nội</p>
                    <p>Tel: +84 (24)37858452; Fax: +84 (24) 37858453</p>
                    <p>MST: 0105 779 721</p>
                </div>
            </div>

            <h3 class="text-center text-lg md:text-xl font-bold uppercase mb-4 title-green">Báo giá kiêm xác nhận đặt hàng</h3>
            <div class="container mx-auto p-0 md:p-4 text-xs font-sans">
                <div class="grid grid-cols-1 md:grid-cols-5 border border-gray-400 divide-y md:divide-y-0 md:divide-x divide-gray-400 mb-6">

                    <div class="col-span-1 md:col-span-3 p-2 bg-gray-100">
                        <label for="customer-name-input" class="font-bold mr-2">Gửi tới:</label>
                        <input type="text" id="customer-name-input" value="Công ty TNHH Xây Dựng Số 1" class="inline-block w-2/3 bg-transparent input-field disabled" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2 flex items-center justify-between">
                        <label for="customer-tel-input" class="font-bold mr-1">Tel:</label>
                        <input type="text" id="customer-tel-input" class="w-2/3 bg-transparent input-field disabled text-right" value="02431234567" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2 flex items-center justify-between">
                        <label for="customer-fax-input" class="font-bold mr-1">Fax:</label>
                        <input type="text" id="customer-fax-input" class="w-2/3 bg-transparent input-field disabled text-right" value="02431234568" disabled>
                    </div>

                    <div class="col-span-1 md:col-span-5 p-2 bg-gray-100">
                        <label for="customer-address-input" class="font-bold mr-2">Địa chỉ:</label>
                        <input type="text" id="customer-address-input" value="123 Đường Giải Phóng, Hà Nội" class="inline-block w-4/5 bg-transparent input-field disabled" disabled>
                    </div>

                    <div class="col-span-1 md:col-span-2 p-2 bg-gray-100 flex items-center">
                        <label for="recipient-name-input" class="font-bold mr-2">Người nhận:</label>
                        <input type="text" id="recipient-name-input" value="Nguyễn Văn A" class="w-3/5 bg-transparent input-field disabled" disabled>
                    </div>

                    <div class="col-span-1 md:col-span-2 p-2 flex items-center justify-between">
                        <label for="customer-email-input" class="font-bold mr-1">Email:</label>
                        <input type="email" id="customer-email-input" class="w-2/3 bg-transparent input-field disabled text-right" value="vana@xdso1.com" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2 flex items-center justify-between">
                        <label class="font-bold mr-1">Hp:</label>
                        <input type="text" id="customer-hp-input" class="w-2/3 bg-transparent input-field disabled text-right" value="0912345678" disabled>
                    </div>

                    <div class="col-span-1 md:col-span-1 bg-green-200 p-2 text-center font-bold">Người báo giá</div>
                    <div class="col-span-1 md:col-span-1 bg-green-200 p-2 text-center font-bold">Chức vụ</div>
                    <div class="col-span-1 md:col-span-1 bg-green-200 p-2 text-center font-bold">Di động</div>
                    <div class="col-span-1 md:col-span-2 bg-green-200 p-2 text-center font-bold">Hiệu lực</div>

                    <div class="col-span-1 md:col-span-1 p-2">
                        <input type="text" id="quote-person-input" value="Nguyễn Văn Tester" class="w-full bg-transparent input-field disabled" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2 text-blue-600">
                        <input type="text" id="position-input" value="Nhân viên Kinh doanh" class="w-full bg-transparent input-field disabled text-blue-600" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2">
                        <input type="text" id="mobile-input" value="0912345678" class="w-full bg-transparent input-field disabled" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-2 p-2">
                        <input type="text" id="quote-validity-input" value="20 ngày kể từ ngày báo giá" class="w-full bg-transparent input-field disabled" disabled>
                    </div>

                    <div class="col-span-1 md:col-span-2 bg-green-200 p-2 font-bold">T.gian giao hàng:</div>
                    <div class="col-span-1 md:col-span-2 bg-green-200 p-2 font-bold">Điều kiện thanh toán:</div>
                    <div class="col-span-1 md:col-span-1 bg-green-200 p-2 font-bold">Địa điểm giao hàng:</div>

                    <div class="col-span-1 md:col-span-2 p-2">
                        <input type="text" id="delivery-conditions-input" value="7-10 ngày sau khi nhận được xác nhận đặt hàng." class="w-full bg-transparent input-field disabled" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-2 p-2">
                        <input type="text" id="payment-terms-input" value="Theo thỏa thuận giữa hai bên" class="w-full bg-transparent input-field disabled" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2">
                        <input type="text" id="delivery-location-input" value="Hà Nội" class="w-full bg-transparent input-field disabled" disabled>
                    </div>

                    <div class="col-span-1 md:col-span-1 bg-green-200 p-2 text-center font-bold">Dự án:</div>
                    <div class="col-span-1 md:col-span-1 bg-green-200 p-2 text-center font-bold">Hạng mục:</div>
                    <div class="col-span-1 md:col-span-1 bg-green-200 p-2 text-center font-bold">Số:</div>
                    <div class="col-span-1 md:col-span-2 bg-green-200 p-2 text-center font-bold">Ngày:</div>

                    <div class="col-span-1 md:col-span-1 p-2">
                        <input type="text" id="project-name-input" value="DA-XD-HN-2023" class="w-full bg-transparent input-field disabled" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2">
                        <input type="text" id="category-input" value="PUR&ULA" class="w-full bg-transparent input-field disabled" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-1 p-2"> <input type="text" id="quote-number-input" value="3i/P0-250724/1234/CTXD1" class="w-full bg-transparent input-field disabled text-blue-600" disabled>
                    </div>
                    <div class="col-span-1 md:col-span-2 p-2">
                        <input type="text" id="quote_date" value="25/07/2024" class="w-full bg-transparent input-field disabled" disabled>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row border border-gray-400 text-xs">
                    <div class="w-full md:w-2/3 p-4 border-b md:border-b-0 md:border-r border-gray-400">
                        <p class="font-bold text-base mb-2">Certificate and Standard Follow:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Material: High Density Polyurethane Foam ASTM D1622 130kg/m3 to 220kg/m3</li>
                            <li>Thermal Conductivity: ASTM C518 0.034 W/Mk at 24 Dgree</li>
                            <li>Compressive Strength: ASTM 1621 1.2 to 3.5 MPa</li>
                            <li>Water Absorption: ASTM D1056 &lt;10% Weight</li>
                            <li>Flame Retardant: DIN 4102 Class B2</li>
                        </ul>
                    </div>
                    <div class="w-full md:w-1/3 p-4 flex flex-col items-center justify-center text-center bg-gray-50">
                        <p class="text-6xl font-bold text-red-600 mb-2">B2</p>
                        <p class="font-bold text-lg mb-1">DIN4102-B2</p>
                        <p class="text-sm">Chống cháy lan, tự dập tắt lửa</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="explanation-box">
            <p><span class="field-label">Logo & Thông tin công ty 3i:</span> Hiển thị thông tin liên hệ của công ty bạn.</p>
            <p><span class="field-label">Tiêu đề báo giá:</span> "Báo giá kiêm xác nhận đặt hàng" là tiêu đề chính.</p>
            <p><span class="field-label">Gửi tới (Tên công ty):</span> Nhập tên công ty khách hàng. Trong hệ thống thực tế, khi gõ, sẽ có gợi ý từ danh sách khách hàng có sẵn và tự động điền các thông tin liên hệ khác (Tel, Fax, Địa chỉ, Email, Hp).</p>
            <p><span class="field-label">Người nhận:</span> Tên người liên hệ cụ thể tại công ty khách hàng.</p>
            <p><span class="field-label">Người báo giá, Chức vụ, Di động:</span> Thông tin của nhân viên kinh doanh/người tạo báo giá, thường được điền tự động.</p>
            <p><span class="field-label">Hiệu lực:</span> Thời gian báo giá có hiệu lực.</p>
            <p><span class="field-label">T.gian giao hàng, Điều kiện thanh toán, Địa điểm giao hàng:</span> Các điều khoản giao hàng và thanh toán.</p>
            <p><span class="field-label">Dự án:</span> Tên dự án liên quan. Trong hệ thống thực tế, sẽ có gợi ý khi gõ.</p>
            <p><span class="field-label">Hạng mục:</span> Hạng mục công việc hoặc loại sản phẩm chính.</p>
            <p><span class="field-label">Số:</span> Mã số định danh của báo giá, tự động tạo dựa trên thông tin khách hàng, cơ chế giá và ngày báo giá.</p>
            <p><span class="field-label">Ngày:</span> Ngày tạo báo giá (định dạng dd/mm/yyyy).</p>
            <p><span class="field-label">Certificate and Standard Follow & DIN4102-B2:</span> Thông tin về tiêu chuẩn và khả năng chống cháy của sản phẩm.</p>
        </div>

        <!-- Bảng Chi Tiết Sản Phẩm (BOM - Bill of Materials) -->
        <div class="section-title">3. Bảng Chi Tiết Sản Phẩm</div>
        <div class="mb-4 overflow-x-auto">
            <table class="excel-table min-w-full" id="main-product-table">
                <colgroup>
                    <col style="width: 2%;">
                    <col style="width: 12%;">
                    <col style="width: 20%;">
                    <col style="width: 8%;">
                    <col style="width: 8%;">
                    <col style="width: 8%;">
                    <col style="width: 8%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: auto;">
                    <col style="width: 2%;">
                </colgroup>
                <thead>
                    <tr class="header-green">
                        <th rowspan="2">Stt.</th>
                        <th rowspan="2">Mã hàng</th>
                        <th rowspan="2">Tên sản phẩm</th>
                        <th colspan="3">Kích thước (mm)</th>
                        <th rowspan="2">Số lượng (bộ)</th>
                        <th rowspan="2">Đơn giá (Sau thuế)</th>
                        <th rowspan="2">Thành tiền (Sau thuế)</th>
                        <th rowspan="2">Ghi chú</th>
                        <th rowspan="2"></th>
                    </tr>
                    <tr class="header-green">
                        <th>ID</th>
                        <th>Độ dày</th>
                        <th>Bản rộng</th>
                    </tr>
                </thead>
                <tbody id="quote-items-bom">
                    <tr class="group-header" data-category-id="cat-pur">
                        <td colspan="11">
                            <div class="font-bold p-2 flex justify-between items-center">PUR
                                <div class="group-actions">
                                    <button class="add-item-in-group text-lg opacity-70 cursor-not-allowed" disabled title="Thêm dòng vào nhóm">
                                        <i class="fas fa-plus-circle text-blue-500"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="bom-item-row">
                        <td class="stt text-center">1</td>
                        <td><input type="text" class="product-code input-field disabled" value="PU-FIX-100x150" disabled></td>
                        <td class="product-name align-middle">Gối đỡ PU Foam 100x150</td>
                        <td class="product-id-thongso text-center">ID1</td>
                        <td class="dim-thickness text-center">100</td>
                        <td class="dim-width text-center">150</td>
                        <td><input type="text" class="product-quantity input-field disabled text-right" value="10" disabled></td>
                        <td><input type="text" class="unit-price input-field disabled text-right" value="100,000" disabled></td>
                        <td class="line-total text-right font-semibold">1,000,000</td>
                        <td><input type="text" class="note input-field disabled" value="Ghi chú sản phẩm A" disabled></td>
                        <td class="text-center"><button class="delete-item-btn text-gray-400 opacity-70 cursor-not-allowed" disabled title="Xóa dòng"><i class="fas fa-times"></i></button></td>
                    </tr>
                    <tr class="bom-item-row">
                        <td class="stt text-center">2</td>
                        <td><input type="text" class="product-code input-field disabled" value="PU-FIX-150x200" disabled></td>
                        <td class="product-name align-middle">Gối đỡ PU Foam 150x200</td>
                        <td class="product-id-thongso text-center">ID2</td>
                        <td class="dim-thickness text-center">150</td>
                        <td class="dim-width text-center">200</td>
                        <td><input type="text" class="product-quantity input-field disabled text-right" value="5" disabled></td>
                        <td><input type="text" class="unit-price input-field disabled text-right" value="150,000" disabled></td>
                        <td class="line-total text-right font-semibold">750,000</td>
                        <td><input type="text" class="note input-field disabled" value="Ghi chú sản phẩm B" disabled></td>
                        <td class="text-center"><button class="delete-item-btn text-gray-400 opacity-70 cursor-not-allowed" disabled title="Xóa dòng"><i class="fas fa-times"></i></button></td>
                    </tr>
                    <tr class="group-header" data-category-id="cat-ula">
                        <td colspan="11">
                            <div class="font-bold p-2 flex justify-between items-center">ULA
                                <div class="group-actions">
                                    <button class="add-item-in-group text-lg opacity-70 cursor-not-allowed" disabled title="Thêm dòng vào nhóm">
                                        <i class="fas fa-plus-circle text-blue-500"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="bom-item-row">
                        <td class="stt text-center">1</td>
                        <td><input type="text" class="product-code input-field disabled" value="ULA-FIX-D32" disabled></td>
                        <td class="product-name align-middle">Cùm ULA D32</td>
                        <td class="product-id-thongso text-center">ID3</td>
                        <td class="dim-thickness text-center">32</td>
                        <td class="dim-width text-center">N/A</td>
                        <td><input type="text" class="product-quantity input-field disabled text-right" value="20" disabled></td>
                        <td><input type="text" class="unit-price input-field disabled text-right" value="25,000" disabled></td>
                        <td class="line-total text-right font-semibold">500,000</td>
                        <td><input type="text" class="note input-field disabled" value="Ghi chú sản phẩm C" disabled></td>
                        <td class="text-center"><button class="delete-item-btn text-gray-400 opacity-70 cursor-not-allowed" disabled title="Xóa dòng"><i class="fas fa-times"></i></button></td>
                    </tr>
                    <tr class="shipping-fee-row bom-item-row bg-gray-50">
                        <td class="stt text-center"></td>
                        <td colspan="5" class="px-4 py-2 text-right font-semibold">Phí vận chuyển:</td>
                        <td><input type="text" class="product-quantity input-field disabled text-right" value="1" disabled></td>
                        <td><input type="text" class="unit-price input-field disabled text-right" id="shipping-fee-input" value="100,000" disabled></td>
                        <td class="line-total text-right font-semibold">100,000</td>
                        <td><input type="text" class="note input-field disabled" value="Chi phí vận chuyển" readonly disabled></td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-2">
                <button class="px-3 py-1 text-xs bg-gray-600 text-white rounded-md shadow-sm opacity-70 cursor-not-allowed" disabled>
                    <i class="fas fa-plus-circle mr-2"></i>Thêm dòng trống
                </button>
            </div>
        </div>
        <div class="explanation-box">
            <p><span class="field-label">Các cột trong bảng:</span></p>
            <ul>
                <li><span class="field-label">Stt.:</span> Số thứ tự của sản phẩm.</li>
                <li><span class="field-label">Mã hàng:</span> Mã định danh của sản phẩm. Trong hệ thống thực tế, bạn sẽ gõ vào đây (ví dụ: "PU", "ULA") để tìm kiếm và chọn sản phẩm từ danh sách gợi ý. <span class="font-bold">Sau khi chọn, sản phẩm sẽ tự động được nhóm theo loại (ví dụ: PUR, ULA) ở trang quản lý sản phẩm.</span></li>
                <li><span class="field-label">Tên sản phẩm, Kích thước (ID, Độ dày, Bản rộng):</span> Tự động điền sau khi chọn Mã hàng.</li>
                <li><span class="field-label">Số lượng (bộ):</span> Số lượng sản phẩm yêu cầu. Trong hệ thống thực tế, bạn có thể chỉnh sửa số này và "Thành tiền" sẽ tự động cập nhật.</li>
                <li><span class="field-label">Đơn giá (Sau thuế):</span> Đơn giá của sản phẩm. Trong hệ thống thực tế, bạn có thể chỉnh sửa số này và "Thành tiền" sẽ tự động cập nhật.</li>
                <li><span class="field-label">Thành tiền (Sau thuế):</span> Tự động tính toán (Số lượng x Đơn giá).</li>
                <li><span class="field-label">Ghi chú:</span> Thêm ghi chú cho từng sản phẩm.</li>
                <li><span class="field-label">Nút xóa dòng:</span> Biểu tượng thùng rác (<i class="fas fa-times"></i>) để xóa một dòng sản phẩm.</li>
            </ul>
            <p><span class="field-label">Thêm dòng trống:</span> Nút này dùng để thêm một dòng sản phẩm mới vào cuối bảng.</p>
            <p><span class="field-label">Dòng "Phí vận chuyển":</span> Dòng đặc biệt để nhập chi phí vận chuyển, ảnh hưởng đến tổng tiền.</p>
        </div>

        <!-- Khu Vực Tổng Kết & Chuyển Đổi Số -->
        <div class="section-title">4. Khu Vực Tổng Kết</div>
        <div class="flex flex-col md:flex-row justify-between items-start mb-4 text-xs">
            <div class="w-full md:w-2/3 pr-0 md:pr-4"></div>
            <div class="w-full md:w-1/3">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="pr-2 font-semibold">Tổng cộng trước thuế:</td>
                            <td id="subtotal" class="text-right font-semibold">2,250,000</td>
                        </tr>
                        <tr>
                            <td class="pr-2">VAT 10%:</td>
                            <td id="vat" class="text-right">225,000</td>
                        </tr>
                        <tr class="font-bold border-t border-gray-400">
                            <td class="pr-2">Tổng sau thuế:</td>
                            <td id="total" class="text-right">2,575,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="explanation-box">
            <p><span class="field-label">Tổng cộng trước thuế:</span> Tổng giá trị của tất cả sản phẩm trước khi tính VAT và phí vận chuyển (tự động tính toán).</p>
            <p><span class="field-label">VAT 10%:</span> Thuế giá trị gia tăng 10% của tổng tiền trước thuế (tự động tính toán).</p>
            <p><span class="field-label">Tổng sau thuế:</span> Tổng giá trị cuối cùng của báo giá, bao gồm tất cả sản phẩm, VAT và phí vận chuyển (tự động tính toán).</p>
        </div>

        <!-- Khu Vực Thông Tin Bổ Sung & Chữ Ký -->
        <div class="section-title">5. Khu Vực Thông Tin Bổ Sung & Chữ Ký</div>
        <div class="mt-4 text-xs border-t-2 border-gray-400 pt-4">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-7/12 pr-0 md:pr-4">
                    <div class="flex flex-col sm:flex-row mb-2">
                        <span class="font-bold whitespace-nowrap mr-2">Bằng chữ:</span>
                        <input type="text" id="amount-in-words" class="italic w-full bg-transparent input-field disabled" value="Hai triệu năm trăm bảy mươi lăm nghìn đồng chẵn." readonly disabled>
                    </div>
                    <p class="mb-2"><span class="font-bold">Xuất xứ:</span> 3iG - Việt Nam</p>
                    <p class="font-bold mb-1">** Đơn giá trên bao gồm thuế VAT 10%, chi phí vận chuyển.</p>
                    <p class="font-bold mb-1">** Sản phẩm Gối đỡ Pu Foam 3i-Fix chống cháy lan chuẩn B2, có lớp gioăng
                        bên trong.</p>
                    <p class="mb-4">Sản phẩm Cùm Ula 3i-Fix thép tráng kẽm + 2 Ecu liền long đen</p>
                    <div class="flex flex-col sm:flex-row mb-4 gap-2">
                        <div class="w-full sm:w-1/2 pr-0 sm:pr-1 text-center">
                            <img id="image1-preview" src="https://placehold.co/400x300/cccccc/333333?text=Ảnh+1" alt="Xem trước ảnh 1"
                                class="mx-auto border max-w-full h-auto opacity-70 cursor-not-allowed">
                        </div>
                        <div class="w-full sm:w-1/2 pl-0 sm:pl-1 text-center">
                            <img id="image2-preview" src="https://placehold.co/400x300/cccccc/333333?text=Ảnh+2" alt="Xem trước ảnh 2"
                                class="mx-auto border max-w-full h-auto opacity-70 cursor-not-allowed">
                        </div>
                    </div>
                    <div>
                        <p class="font-bold">Thông tin chuyển khoản:</p>
                        <p>Chủ tài khoản: <span class="font-bold">Công ty TNHH sản xuất và ứng dụng vật liệu xanh
                                3i</span></p>
                        <p>Số tài khoản: <span class="font-bold">46668888</span></p>
                        <p>Ngân hàng <span class="font-bold">TMCP Hàng Hải Việt Nam (MSB) - chi nhánh Thanh Xuân</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-around mt-16 text-xs gap-4">
            <div class="text-center">
                <p class="font-bold">Đại diện bên bán hàng</p>
            </div>
            <div class="text-center">
                <p class="font-bold">Đại diện bên mua hàng</p>
            </div>
        </div>
        <div class="explanation-box">
            <p><span class="field-label">Bằng chữ:</span> Tổng tiền sau thuế được chuyển đổi thành chữ (chỉ đọc).</p>
            <p><span class="field-label">Xuất xứ & Ghi chú sản phẩm:</span> Các thông tin bổ sung về nguồn gốc và đặc điểm sản phẩm.</p>
            <p><span class="field-label">Hình ảnh:</span> Khu vực hiển thị ảnh liên quan đến báo giá. Trong hệ thống thực tế, bạn có thể tải ảnh lên đây.</p>
            <p><span class="field-label">Thông tin chuyển khoản:</span> Chi tiết tài khoản ngân hàng của 3i.</p>
            <p><span class="field-label">Đại diện bên bán hàng / Đại diện bên mua hàng:</span> Khu vực để ký tên và đóng dấu xác nhận báo giá.</p>
        </div>

        <!-- Luồng Tạo Đơn Hàng Khi Báo Giá "Chốt" -->
        <div class="section-title">6. Luồng Tạo Đơn Hàng Khi Báo Giá "Chốt"</div>
        <div class="explanation-box">
            <p class="font-bold text-lg mb-2">Khi một báo giá được chuyển sang trạng thái "<span class="font-bold text-green-600">Chốt</span>", hệ thống sẽ tự động kích hoạt quy trình tạo đơn hàng (Yêu cầu sản xuất - YCSX) theo các bước sau:</p>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">1. Kiểm tra Báo giá và Trạng thái:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Hệ thống kiểm tra báo giá để đảm bảo nó tồn tại và chưa có đơn hàng nào được tạo từ báo giá này trước đó.</li>
                <li><span class="font-bold text-red-600">Điều kiện quan trọng:</span> Chỉ những báo giá có trạng thái chính xác là "<span class="font-bold">Chốt</span>" mới có thể tạo đơn hàng. Nếu báo giá chưa chốt, quá trình sẽ dừng lại và báo lỗi.</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">2. Lấy thông tin chi tiết sản phẩm từ Báo giá:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Tất cả các sản phẩm và số lượng yêu cầu trong báo giá sẽ được lấy ra. Đồng thời, hệ thống cũng lấy thông tin về nguồn gốc sản phẩm (sản xuất hay nhập khẩu) và các thông số kỹ thuật liên quan.</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">3. Tạo Đơn hàng (YCSX) mới:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Một bản ghi đơn hàng mới sẽ được tạo trong cơ sở dữ liệu với các thông tin cơ bản từ báo giá (ID báo giá, thông tin khách hàng, dự án, người báo giá, v.v.).</li>
                <li>Số Yêu cầu sản xuất (<span class="font-bold">SoYCSX</span>) sẽ được tạo tự động (ví dụ: <span class="font-mono">DH-2024-00001</span>).</li>
                <li>Ban đầu, trạng thái của đơn hàng sẽ là "<span class="font-bold">Chờ xử lý</span>".</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">4. Xử lý từng sản phẩm, tính toán tồn kho và nhu cầu:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Đối với mỗi sản phẩm trong đơn hàng, hệ thống sẽ thực hiện các bước sau:
                    <ul class="list-circle list-inside ml-4 mt-1">
                        <li><span class="font-bold">Kiểm tra tồn kho vật lý:</span> Lấy số lượng sản phẩm hiện có trong kho.</li>
                        <li><span class="font-bold">Kiểm tra số lượng đã gán cho đơn khác:</span> Tính toán số lượng sản phẩm đã được "đặt trước" cho các đơn hàng khác đang chờ xử lý (chưa giao hoặc chưa hủy).</li>
                        <li><span class="font-bold">Tính tồn kho khả dụng:</span> <span class="font-mono">Tồn kho khả dụng = Tồn kho vật lý - Số lượng đã gán cho đơn khác</span>.</li>
                        <li><span class="font-bold">Tính số lượng lấy từ kho:</span> <span class="font-mono">Số lượng lấy từ kho = Min(Số lượng yêu cầu, Tồn kho khả dụng)</span>. Đây là số lượng có thể đáp ứng ngay lập tức từ kho.</li>
                        <li><span class="font-bold">Tính số lượng cần sản xuất/nhập thêm (<span class="font-mono">SoLuongCanSX</span>):</span> <span class="font-mono">Số lượng cần SX = Số lượng yêu cầu - Số lượng lấy từ kho</span>.</li>
                    </ul>
                </li>
                <li>Chi tiết từng sản phẩm (bao gồm <span class="font-mono">SoLuongLayTuKho</span> và <span class="font-mono">SoLuongCanSX</span>) sẽ được lưu vào bảng <span class="font-mono">chitiet_donhang</span>.</li>
                <li>Nếu <span class="font-mono">SoLuongCanSX > 0</span> và sản phẩm có nguồn gốc là "<span class="font-bold">sản xuất</span>", số lượng này sẽ được tổng hợp để tính toán nhu cầu sản xuất tổng thể.</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">5. Tính toán ngày hoàn thành dự kiến và cập nhật trạng thái đơn hàng:</h4>
            <ul class="list-disc list-inside ml-4">
                <li><span class="font-bold">Ngày giao hàng cho khách (<span class="font-mono">NgayGiaoDuKien</span>):</span> Dựa trên thời gian giao hàng trong báo giá, hệ thống sẽ tính toán ngày giao hàng dự kiến, bỏ qua các ngày cuối tuần.</li>
                <li><span class="font-bold">Ngày hoàn thành sản xuất dự kiến (<span class="font-mono">NgayHoanThanhDuKien</span>):</span>
                    <ul class="list-circle list-inside ml-4 mt-1">
                        <li>Nếu <span class="font-bold">tổng số lượng sản phẩm cần sản xuất lớn hơn 0</span>: Hệ thống sẽ tính toán số ngày sản xuất cần thiết dựa trên năng suất sản xuất trung bình. Ngày hoàn thành dự kiến sẽ được tính bằng cách cộng số ngày này vào ngày hiện tại, bỏ qua cuối tuần. Trạng thái cuối cùng của đơn hàng sẽ là "<span class="font-bold">Chờ sản xuất</span>".</li>
                        <li>Nếu <span class="font-bold">không có sản phẩm nào cần sản xuất thêm</span> (tức là tất cả đều có thể lấy từ kho hoặc là hàng nhập khẩu): Ngày hoàn thành dự kiến sẽ là ngày làm việc tiếp theo. Trạng thái cuối cùng của đơn hàng sẽ là "<span class="font-bold">Chờ chuẩn bị hàng</span>".</li>
                    </ul>
                </li>
                <li>Trạng thái và các ngày dự kiến này sẽ được cập nhật vào bản ghi đơn hàng.</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">6. Tạo Lệnh Sản Xuất (LSX) nếu cần:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Nếu có bất kỳ sản phẩm nào cần sản xuất thêm, hệ thống sẽ tạo một <span class="font-bold">Lệnh sản xuất</span> mới.</li>
                <li>Số lệnh sản xuất (<span class="font-mono">SoLenhSX</span>) sẽ được tạo tự động (ví dụ: <span class="font-mono">LSX-2024-00001</span>).</li>
                <li>Trạng thái ban đầu của lệnh sản xuất là "<span class="font-bold">Chờ sản xuất</span>".</li>
                <li>Chi tiết từng sản phẩm cần sản xuất (bao gồm số lượng bộ, số cây cần cắt dựa trên định mức) sẽ được lưu vào bảng <span class="font-mono">chitiet_lenh_san_xuat</span>.</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">7. Luồng Sản Xuất và Chuẩn Bị Hàng:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Sau khi Lệnh Sản Xuất (LSX) được tạo (nếu có), các sản phẩm sẽ được đưa vào quy trình sản xuất.</li>
                <li>Khi quá trình sản xuất hoàn tất, trạng thái của Lệnh Sản Xuất sẽ được cập nhật thành "<span class="font-bold">Đã hoàn thành</span>".</li>
                <li><span class="font-bold">Kiểm tra tồn kho tổng thể:</span> Hệ thống sẽ kiểm tra lại tồn kho tổng thể của tất cả các sản phẩm trong đơn hàng (bao gồm cả những sản phẩm vừa sản xuất xong và những sản phẩm có sẵn trong kho).</li>
                <li><span class="font-bold text-green-600">CHUYỂN TRẠNG THÁI ĐƠN HÀNG SANG "CHỜ XUẤT KHO":</span> Nếu tất cả các sản phẩm trong đơn hàng đã đủ số lượng yêu cầu (đã sản xuất xong hoặc đã có sẵn trong kho), trạng thái của Đơn hàng (YCSX) sẽ tự động chuyển sang "<span class="font-bold">Chờ xuất kho</span>". Tại thời điểm này, đơn hàng đã sẵn sàng để được đóng gói và xuất đi.</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">8. Luồng Xuất Kho và Giao Hàng:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Khi đơn hàng ở trạng thái "<span class="font-bold">Chờ xuất kho</span>", bộ phận kho sẽ tạo một <span class="font-bold">Phiếu Xuất Kho (PXK)</span> để chuẩn bị hàng gửi đi.</li>
                <li>Sau khi hàng được xuất đi và PXK được xác nhận hoàn tất, trạng thái của Đơn hàng (YCSX) sẽ tự động chuyển sang "<span class="font-bold">Đã giao hàng</span>".</li>
                <li>Lúc này, đơn hàng đã hoàn tất toàn bộ quy trình từ báo giá đến giao nhận.</li>
            </ul>

            <h4 class="font-bold mt-4 mb-2 text-blue-700">9. Hoàn tất giao dịch:</h4>
            <ul class="list-disc list-inside ml-4">
                <li>Nếu tất cả các bước trên thành công, giao dịch sẽ được xác nhận.</li>
                <li>Một thông báo thành công sẽ được gửi về cho người dùng, bao gồm số đơn hàng và số lệnh sản xuất (nếu có).</li>
            </ul>

            <p class="font-bold mt-4">Tóm tắt luồng trạng thái đơn hàng sau khi báo giá "Chốt" và quá trình sản xuất:</p>
            <div class="mt-2 text-center">
                <p class="font-bold text-green-700">Báo giá "Chốt"</p>
                <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                <p class="font-bold text-blue-700">Tạo Đơn hàng (YCSX) với trạng thái "Chờ xử lý"</p>
                <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                <p class="font-bold text-purple-700">Hệ thống kiểm tra tồn kho và nhu cầu sản xuất</p>
                <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                <div class="flex flex-col md:flex-row justify-center items-start md:gap-8">
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-red-700">Nếu có sản phẩm cần sản xuất</p>
                        <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                        <p class="font-bold text-orange-700">Đơn hàng chuyển trạng thái sang "Chờ sản xuất"</p>
                        <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                        <p class="font-bold text-indigo-700">Tạo Lệnh Sản Xuất (LSX)</p>
                        <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                        <p class="font-bold text-yellow-700">Sản xuất hoàn tất</p>
                    </div>
                    <div class="hidden md:block border-l-2 border-gray-300 h-24 mx-4"></div>
                    <div class="flex flex-col items-center mt-4 md:mt-0">
                        <p class="font-bold text-green-700">Nếu không có sản phẩm cần sản xuất (đủ tồn kho/hàng nhập)</p>
                        <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                        <p class="font-bold text-teal-700">Đơn hàng chuyển trạng thái sang "Chờ chuẩn bị hàng"</p>
                    </div>
                </div>
                <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                <p class="font-bold text-blue-800">Tất cả sản phẩm đủ số lượng (tồn kho/sản xuất xong)</p>
                <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                <p class="font-bold text-purple-800">Đơn hàng chuyển trạng thái sang "Chờ xuất kho"</p>
                <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                <p class="font-bold text-pink-800">Xuất kho hoàn tất</p>
                <i class="fas fa-arrow-down text-gray-600 my-2"></i>
                <p class="font-bold text-green-800">Đơn hàng chuyển trạng thái sang "Đã giao hàng"</p>
            </div>
        </div>
    </div>
</body>

</html>
