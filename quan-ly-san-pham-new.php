<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Biến Thể Sản Phẩm (Mới)</title>
    <link href="https://unpkg.com/tabulator-tables@5.6.0/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    /* [KHÔNG THAY ĐỔI] Giữ nguyên toàn bộ CSS của bạn ở đây */
    :root {
        --primary-color: #007bff;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --info-color: #17a2b8;
        --light-gray: #f8f9fa;
        --medium-gray: #dee2e6;
        --dark-gray: #343a40;
        --text-color: #495057;
        --border-radius: 8px;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        padding: 20px;
        background-color: var(--light-gray);
        font-size: 14px;
        color: var(--text-color);
    }

    .container {
        max-width: 98%;
        margin: auto;
    }

    .controls-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px 15px;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        margin-left: 10px;
    }

    #add-product-btn {
        background-color: var(--success-color);
    }

    #manage-category-btn {
        background-color: var(--info-color);
    }

    .tabulator-cell .action-icon {
        cursor: pointer;
        margin: 0 8px;
        font-size: 16px;
        transition: transform 0.2s, color 0.2s;
    }

    .icon-delete {
        color: var(--danger-color);
    }

    .icon-save {
        color: var(--primary-color);
    }

    .icon-delete:hover {
        color: #a71d2a;
        transform: scale(1.2);
    }

    .icon-save:hover {
        color: #0056b3;
        transform: scale(1.2);
    }

    .filter-controls {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .filter-controls input {
        padding: 8px 12px;
        border: 1px solid var(--medium-gray);
        border-radius: 4px;
        min-width: 300px;
    }

    .filter-group-tabs {
        display: flex;
        gap: 5px;
        background-color: #e9ecef;
        padding: 4px;
        border-radius: 6px;
    }

    .filter-tab {
        padding: 6px 12px;
        border: none;
        background-color: transparent;
        cursor: pointer;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s ease;
        color: #495057;
    }

    .filter-tab:hover {
        background-color: #dee2e6;
    }

    .filter-tab.active {
        background-color: var(--primary-color);
        color: white;
        box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 25px;
        border: none;
        width: 90%;
        max-width: 900px;
        /* Tăng chiều rộng modal */
        border-radius: var(--border-radius);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--medium-gray);
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .close-btn {
        color: #6c757d;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        /* Điều chỉnh lại grid */
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid var(--medium-gray);
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-section-title {
        grid-column: 1 / -1;
        /* Tiêu đề chiếm toàn bộ hàng */
        font-size: 16px;
        font-weight: 600;
        color: var(--primary-color);
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 8px;
        margin-top: 20px;
        margin-bottom: 10px;
    }


    .modal-footer {
        border-top: 1px solid var(--medium-gray);
        margin-top: 25px;
        padding-top: 20px;
        text-align: right;
    }

    #toast {
        visibility: hidden;
        min-width: 280px;
        margin-left: -140px;
        background-color: var(--dark-gray);
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 16px;
        position: fixed;
        z-index: 2000;
        left: 50%;
        bottom: 30px;
        transition: all 0.5s ease;
        opacity: 0;
    }

    #toast.show {
        visibility: visible;
        opacity: 1;
    }

    #toast.success {
        background-color: var(--success-color);
    }

    #toast.error {
        background-color: var(--danger-color);
    }

    /* Các style khác giữ nguyên */
    .manager-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .category-manager {
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
        padding: 20px;
    }

    .category-manager h2 {
        margin-top: 0;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .add-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .add-form input {
        flex-grow: 1;
        padding: 8px 12px;
        border: 1px solid var(--medium-gray);
        border-radius: 4px;
    }

    .add-form button {
        padding: 8px 15px;
        color: white;
        background-color: var(--success-color);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
    }

    .category-manager ul {
        list-style-type: none;
        padding: 0;
        max-height: 40vh;
        overflow-y: auto;
    }

    .category-manager li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .item-content {
        flex-grow: 1;
        display: flex;
        align-items: center;
    }

    .category-manager li:nth-child(even) {
        background-color: #f9f9f9;
    }

    .category-manager li:hover {
        background-color: #f1f3f5;
    }

    .item-actions button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        font-size: 15px;
        margin-left: 8px;
        vertical-align: middle;
    }

    .btn-edit {
        color: var(--primary-color);
    }

    .btn-delete {
        color: var(--danger-color);
    }

    .btn-save-edit {
        color: var(--success-color);
    }

    .btn-cancel-edit {
        color: var(--dark-gray);
    }

    .btn-confirm-delete {
        color: var(--danger-color);
    }

    .tabulator {
        border: 1px solid var(--medium-gray);
        border-bottom: 1px solid var(--medium-gray);
    }

    .tabulator .tabulator-header .tabulator-col {
        border-right: 1px solid var(--medium-gray);
    }

    .tabulator .tabulator-row .tabulator-cell {
        border-right: 1px solid var(--medium-gray);
    }

    .tabulator .tabulator-header .tabulator-col:last-of-type,
    .tabulator .tabulator-row .tabulator-cell:last-of-type {
        border-right: none;
    }

    .tabulator .tabulator-header .tabulator-col .tabulator-col-title {
        white-space: normal;
        text-overflow: clip;
        line-height: 1.3;
        padding: 4px 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fa fa-cubes"></i> Trang Quản Lý Biến Thể Sản Phẩm</h1>
        <div class="controls-container">
            <div class="filter-controls">
                <input id="filter-field" type="text" placeholder="Tìm theo Mã, Tên biến thể, Tên gốc...">
                <div id="group-filter-tabs" class="filter-group-tabs"></div>
            </div>
            <div class="action-buttons">
                <button id="manage-category-btn" class="action-button"><i class="fa fa-sitemap"></i> Quản lý Danh
                    mục</button>
                <button id="add-product-btn" class="action-button"><i class="fa fa-plus"></i> Thêm biến thể</button>
            </div>
        </div>
        <div id="product-table"></div>
    </div>

    <div id="product-modal" class="modal"></div>
    <div id="category-modal" class="modal"></div>
    <div id="toast"></div>

    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.6.0/dist/js/tabulator.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let pageOptions = {};
        let table;

        // --- CÁC HÀM HỖ TRỢ CHUNG ---
        function showToast(message, type = 'success') {
            const toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = `show ${type}`;
            setTimeout(() => {
                toast.className = toast.className.replace("show", "");
            }, 3000);
        }

        async function fetchAPI(url, options) {
            try {
                const response = await fetch(url, options);
                const result = await response.json();
                if (!response.ok || (result && result.success === false)) {
                    throw new Error(result.message || 'Có lỗi xảy ra từ máy chủ');
                }
                return result;
            } catch (error) {
                showToast(error.message, 'error');
                console.error('Fetch Error:', error);
                throw error;
            }
        }

        function populateSelect(selectId, options, valueField, textField) {
            const select = document.getElementById(selectId);
            if (!select) return;
            select.innerHTML = '<option value="">-- Chọn --</option>';
            if (!Array.isArray(options)) return;
            options.forEach(option => {
                const optionEl = document.createElement('option');
                optionEl.value = option[valueField];
                optionEl.textContent = option[textField];
                select.appendChild(optionEl);
            });
        }

        // --- QUẢN LÝ DANH MỤC (Giữ nguyên, không thay đổi) ---
        // ... (Toàn bộ code quản lý danh mục của bạn được giữ nguyên ở đây) ...
        // Tôi sẽ ẩn đi cho gọn, bạn chỉ cần copy paste code cũ của bạn vào đây
        async function categoryAPI(action, type, data = {}) {
            /* ... */ }

        function renderCategoryList(listElement, items, type) {
            /* ... */ }
        async function loadCategories() {
            /* ... */ }
        // ... các hàm handleCategory...


        // --- QUẢN LÝ BIẾN THỂ SẢN PHẨM ---

        // [THAY ĐỔI] Tải toàn bộ dữ liệu từ API mới
        async function loadAllData() {
            showToast("Đang tải toàn bộ dữ liệu biến thể...", "info");
            let allData = [];
            // [THAY ĐỔI] Sử dụng API endpoint mới
            let firstPageUrl = "api/get_variants_paged_new.php?size=50&page=1";

            try {
                const firstPageResponse = await fetch(firstPageUrl);
                const firstPageJson = await firstPageResponse.json();

                if (!firstPageJson || !firstPageJson.data || typeof firstPageJson.last_page ===
                    'undefined') {
                    throw new Error("Cấu trúc dữ liệu trả về từ API không hợp lệ.");
                }

                allData = firstPageJson.data;
                const lastPage = firstPageJson.last_page;

                if (lastPage > 1) {
                    const pagePromises = [];
                    for (let page = 2; page <= lastPage; page++) {
                        // [THAY ĐỔI] Sử dụng API endpoint mới
                        let pageUrl = `api/get_variants_paged_new.php?size=50&page=${page}`;
                        pagePromises.push(fetch(pageUrl).then(res => res.json()));
                    }
                    const allPagesResponses = await Promise.all(pagePromises);
                    allPagesResponses.forEach(pageResponse => {
                        if (pageResponse && pageResponse.data) {
                            allData = allData.concat(pageResponse.data);
                        }
                    });
                }
                showToast(`Tải thành công ${allData.length} biến thể!`, "success");
                return allData;

            } catch (error) {
                console.error("Lỗi khi tải toàn bộ dữ liệu:", error);
                showToast("Lỗi khi tải dữ liệu biến thể.", "error");
                return [];
            }
        }

        // [THAY ĐỔI] Hàm render tab filter, giờ sẽ filter theo TenGoc
        function renderGroupFilterTabs(sanpham_goc) {
            const container = document.getElementById('group-filter-tabs');
            container.innerHTML = '';
            const allBtn = document.createElement('button');
            allBtn.className = 'filter-tab active';
            allBtn.textContent = 'Tất cả';
            allBtn.dataset.gocId = '';
            container.appendChild(allBtn);
            sanpham_goc.forEach(goc => {
                const gocBtn = document.createElement('button');
                gocBtn.className = 'filter-tab';
                gocBtn.textContent = goc.TenGoc;
                gocBtn.dataset.gocId = goc.GocID;
                container.appendChild(gocBtn);
            });
        }

        // [THAY ĐỔI] Cập nhật định nghĩa cột cho cấu trúc Biến thể
        function createColumnDefinitions(options) {
            const actionFormatter = (cell) => `
                    <i class="fa-solid fa-save action-icon icon-save" title="Lưu thay đổi"></i>
                    <i class="fa-solid fa-trash-can action-icon icon-delete" title="Xóa biến thể"></i>`;

            return [{
                    title: "ID",
                    field: "BienTheID",
                    width: 60,
                    headerSort: false
                },
                {
                    title: "Mã Hàng (SKU)",
                    field: "MaHang",
                    width: 180,
                    editor: "input",
                    frozen: true
                },
                {
                    title: "Tên Biến Thể",
                    field: "TenBienThe",
                    width: 250,
                    editor: "input"
                },
                {
                    title: "Sản phẩm gốc",
                    field: "TenGoc",
                    width: 150
                },

                // Các cột thuộc tính
                {
                    title: "Tình Trạng",
                    field: "TinhTrang",
                    width: 120,
                    editor: "list",
                    editorParams: {
                        values: {
                            "Mới": "Mới",
                            "Hàng cũ": "Hàng cũ"
                        }
                    }
                },
                {
                    title: "Xử Lý Bề Mặt",
                    field: "XuLyBeMat",
                    width: 140,
                    editor: "list",
                    editorParams: {
                        values: {
                            "Mạ kẽm": "Mạ kẽm",
                            "Nhúng nóng": "Nhúng nóng"
                        }
                    }
                },
                {
                    title: "ID Thông Số",
                    field: "ID_ThongSo",
                    width: 120,
                    editor: "input"
                },
                {
                    title: "Độ Dày",
                    field: "DoDay",
                    width: 100,
                    hozAlign: "right",
                    editor: "input"
                },
                {
                    title: "Bản Rộng",
                    field: "BanRong",
                    width: 100,
                    hozAlign: "right",
                    editor: "input"
                },
                {
                    title: "Ren",
                    field: "KichThuocRen",
                    width: 80,
                    editor: "input"
                },
                {
                    title: "Nguồn Gốc",
                    field: "NguonGoc",
                    width: 110,
                    editor: "input"
                },
                {
                    title: "Hình Dạng",
                    field: "HinhDang",
                    width: 110,
                    editor: "input"
                },

                // Các cột giá trị, tồn kho
                {
                    title: "Giá Gốc",
                    field: "GiaGoc",
                    width: 130,
                    hozAlign: "right",
                    editor: "number",
                    formatter: "money",
                    formatterParams: {
                        symbol: " ₫",
                        precision: 0
                    }
                },
                {
                    title: "Đơn Vị Tính",
                    field: "DonViTinh",
                    width: 100,
                    editor: "input"
                },
                {
                    title: "Tồn Kho",
                    field: "SoLuongTonKho",
                    width: 100,
                    hozAlign: "right",
                    editor: "number"
                },

                {
                    title: "Thao tác",
                    hozAlign: "center",
                    width: 100,
                    frozen: "right",
                    headerSort: false,
                    formatter: actionFormatter,
                    cellClick: (e, cell) => {
                        const row = cell.getRow();
                        const data = row.getData();
                        if (e.target.classList.contains('icon-delete')) {
                            if (confirm(`Bạn có chắc muốn xóa biến thể "${data.TenBienThe}"?`)) {
                                handleVariantAction('delete', {
                                    id: data.BienTheID
                                }, row);
                            }
                        } else if (e.target.classList.contains('icon-save')) {
                            handleVariantAction('update', {
                                data: data
                            }, row);
                        }
                    }
                },
            ];
        }

        // [THAY ĐỔI] Hàm chung để xử lý Thêm/Sửa/Xóa biến thể
        async function handleVariantAction(action, payload, row = null) {
            if (row) row.getElement().style.opacity = '0.5';

            const body = {
                action: action,
                ...payload
            };
            try {
                const result = await fetchAPI('api/handle_variant_new.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                showToast(result.message, 'success');

                if (action === 'delete' && row) {
                    row.delete();
                } else if (action === 'update' && row) {
                    row.reformat();
                } else if (action === 'create') {
                    document.getElementById('product-modal').style.display = 'none';
                    // Tải lại toàn bộ dữ liệu để cập nhật bảng
                    const newData = await loadAllData();
                    table.setData(newData);
                }
            } catch (error) {
                // Lỗi đã được hiển thị bởi fetchAPI
            } finally {
                if (row) row.getElement().style.opacity = '1';
            }
        }

        // [THAY ĐỔI] Tải các options cho trang
        async function fetchPageOptions() {
            try {
                // [THAY ĐỔI] API endpoint mới
                const result = await fetchAPI('api/get_options_new.php');
                pageOptions = result.data;
                renderGroupFilterTabs(pageOptions.sanpham_goc);
                return pageOptions;
            } catch (error) {
                /* Handled */ }
            return null;
        }

        async function refreshOptionsAndTable() {
            showToast("Đang làm mới danh mục...", "info");
            const options = await fetchPageOptions();
            if (table && options) {
                table.setColumns(createColumnDefinitions(options));
                showToast("Làm mới thành công!", "success");
            }
        }

        // [THAY ĐỔI] Áp dụng filter mới
        function applyTableFilters() {
            const filters = [];
            let currentTextFilter = document.getElementById("filter-field").value;
            let currentGroupFilter = document.querySelector('#group-filter-tabs .filter-tab.active').dataset
                .gocId;

            if (currentTextFilter) {
                filters.push([{
                        field: "MaHang",
                        type: "like",
                        value: currentTextFilter
                    },
                    {
                        field: "TenBienThe",
                        type: "like",
                        value: currentTextFilter
                    },
                    {
                        field: "TenGoc",
                        type: "like",
                        value: currentTextFilter
                    }
                ]);
            }
            if (currentGroupFilter) {
                filters.push({
                    field: "GocID",
                    type: "=",
                    value: currentGroupFilter
                });
            }
            table.setFilter(filters);
        }

        function setupEventListeners() {
            // Main Page Listeners
            const manageCategoryBtn = document.getElementById('manage-category-btn');
            const addProductBtn = document.getElementById('add-product-btn');
            let filterTimeout;
            document.getElementById("filter-field").addEventListener("keyup", function() {
                clearTimeout(filterTimeout);
                filterTimeout = setTimeout(applyTableFilters, 300);
            });

            document.getElementById('group-filter-tabs').addEventListener('click', function(e) {
                if (e.target.classList.contains('filter-tab')) {
                    this.querySelectorAll('.filter-tab').forEach(tab => tab.classList.remove('active'));
                    e.target.classList.add('active');
                    applyTableFilters();
                }
            });

            // Modal Generic Controls
            const productModal = document.getElementById('product-modal');
            const categoryModal = document.getElementById('category-modal');

            addProductBtn.onclick = () => {
                productModal.style.display = "block";
                populateSelect('GocID', pageOptions.sanpham_goc, 'GocID', 'TenGoc');
                document.getElementById('variant-form').reset();
            };

            // manageCategoryBtn.onclick = ... (giữ nguyên)

            // Using Event Delegation for dynamically added content
            document.body.addEventListener('click', function(event) {
                if (event.target.classList.contains('close-btn')) {
                    event.target.closest('.modal').style.display = 'none';
                }
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                }
            });

            // [THAY ĐỔI] Xử lý submit form biến thể
            document.body.addEventListener('submit', async function(event) {
                if (event.target.id === 'variant-form') {
                    event.preventDefault();
                    const formData = new FormData(event.target);
                    const mainData = {};
                    const attributes = {};

                    for (const [key, value] of formData.entries()) {
                        if (key.startsWith('attributes[')) {
                            const attrKey = key.slice(11, -
                            1); // Lấy tên thuộc tính từ attributes[Ten]
                            if (value) attributes[attrKey] = value;
                        } else {
                            mainData[key] = value;
                        }
                    }

                    const payload = {
                        ...mainData,
                        attributes: attributes
                    };
                    handleVariantAction('create', {
                        data: payload
                    });
                }
                // Xử lý submit form category giữ nguyên
            });
        }

        async function initialize() {
            // [THAY ĐỔI] Cập nhật lại HTML cho modal thêm biến thể
            document.getElementById('product-modal').innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id="modal-title">Thêm Biến Thể Sản Phẩm Mới</h2>
                            <span class="close-btn">&times;</span>
                        </div>
                        <form id="variant-form">
                            <div class="form-grid">
                                <div class="form-section-title">1. Thông tin chung</div>
                                <div class="form-group"> 
                                    <label for="GocID">Sản phẩm gốc (*)</label> 
                                    <select id="GocID" name="GocID" required></select>
                                </div>
                                <div class="form-group"> 
                                    <label for="MaHang">Mã Hàng (SKU) (*)</label> 
                                    <input type="text" id="MaHang" name="MaHang" required> 
                                </div>
                                <div class="form-group"> 
                                    <label for="TenBienThe">Tên Biến Thể (*)</label> 
                                    <input type="text" id="TenBienThe" name="TenBienThe" required> 
                                </div>
                                <div class="form-group"> 
                                    <label for="GiaGoc">Giá Gốc</label> 
                                    <input type="number" id="GiaGoc" name="GiaGoc" step="1" value="0"> 
                                </div>
                                 <div class="form-group"> <label for="DonViTinh">Đơn Vị Tính</label> <input type="text" id="DonViTinh" name="DonViTinh" value="Bộ"> </div>
                                <div class="form-group"> 
                                    <label for="SoLuongTonKho">Tồn Kho</label> 
                                    <input type="number" id="SoLuongTonKho" name="SoLuongTonKho" value="0"> 
                                </div>

                                <div class="form-section-title">2. Thuộc tính chi tiết</div>
                                
                                <div class="form-group">
                                    <label for="attribute_ID_ThongSo">ID Thông Số</label>
                                    <input type="text" id="attribute_ID_ThongSo" name="attributes[ID_ThongSo]">
                                </div>
                                <div class="form-group">
                                    <label for="attribute_DoDay">Độ Dày (mm)</label>
                                    <input type="text" id="attribute_DoDay" name="attributes[DoDay]">
                                </div>
                                <div class="form-group">
                                    <label for="attribute_BanRong">Bản Rộng (mm)</label>
                                    <input type="text" id="attribute_BanRong" name="attributes[BanRong]">
                                </div>
                                <div class="form-group">
                                    <label for="attribute_KichThuocRen">Kích Thước Ren</label>
                                    <input type="text" id="attribute_KichThuocRen" name="attributes[KichThuocRen]">
                                </div>
                                <div class="form-group">
                                    <label for="attribute_NguonGoc">Nguồn Gốc</label>
                                     <input type="text" id="attribute_NguonGoc" name="attributes[NguonGoc]" value="sản xuất">
                                </div>
                                <div class="form-group">
                                    <label for="attribute_HinhDang">Hình Dạng</label>
                                     <input type="text" id="attribute_HinhDang" name="attributes[HinhDang]">
                                </div>
                                <div class="form-group">
                                    <label for="attribute_XuLyBeMat">Xử lý bề mặt</label>
                                    <select id="attribute_XuLyBeMat" name="attributes[XuLyBeMat]">
                                        <option value="">-- Mặc định --</option>
                                        <option value="Mạ kẽm">Mạ kẽm</option>
                                        <option value="Nhúng nóng">Nhúng nóng</option>
                                        <option value="Sơn tĩnh điện">Sơn tĩnh điện</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="attribute_TinhTrang">Tình trạng</label>
                                     <select id="attribute_TinhTrang" name="attributes[TinhTrang]">
                                        <option value="Mới">Mới</option>
                                        <option value="Hàng cũ">Hàng cũ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="action-button" style="background-color: var(--primary-color);">Lưu Biến Thể</button>
                            </div>
                        </form>
                    </div>`;

            // HTML cho modal category giữ nguyên
            // document.getElementById('category-modal').innerHTML = ...

            const options = await fetchPageOptions();
            if (!options) {
                showToast("Lỗi nghiêm trọng: Không thể tải các tùy chọn cho trang.", "error");
                return;
            }

            table = new Tabulator("#product-table", {
                height: "75vh",
                layout: "fitColumns",
                columns: createColumnDefinitions(options),
                pagination: true,
                paginationMode: "local",
                paginationSize: 50,
                paginationSizeSelector: [10, 25, 50, 100, true],
                paginationCounter: "rows",
                placeholder: "Đang tải dữ liệu...",
            });

            const tableData = await loadAllData();
            if (tableData.length === 0) {
                table.setPlaceholder("Không có dữ liệu biến thể.");
            }
            table.setData(tableData);

            setupEventListeners();
        }

        initialize();
    });
    </script>
</body>

</html>