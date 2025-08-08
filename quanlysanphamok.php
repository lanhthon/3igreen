<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm Chi Tiết</title>
    <link href="https://unpkg.com/tabulator-tables@5.6.1/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    :root {
        --primary-color: #0d6efd;
        --success-color: #198754;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --info-color: #0dcaf0;
        --light-gray: #f8f9fa;
        --medium-gray: #dee2e6;
        --dark-gray: #343a40;
        --text-color: #495057;
        --border-radius: 0.375rem;
    }

    body {
        font-family: system-ui, -apple-system, sans-serif;
        padding: 20px;
        background-color: var(--light-gray);
        font-size: 14px;
    }

    .container {
        max-width: 98%;
        margin: auto;
    }

    .controls-container {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 20px;
        align-items: end;
        margin-bottom: 20px;
        padding: 1rem;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
    }

    .filter-section {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-weight: 500;
        margin-bottom: 5px;
        font-size: 12px;
        color: #6c757d;
    }

    .filter-group input,
    .filter-group select {
        padding: 8px 12px;
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
    }

    #filter-field {
        min-width: 250px;
    }

    .action-buttons {
        display: flex;
        align-items: center;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        color: white;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        margin-left: 10px;
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
        background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-content {
        background-color: #fff;
        margin: 3% auto;
        padding: 25px;
        border: none;
        width: 90%;
        max-width: 1000px;
        border-radius: var(--border-radius);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15);
        animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--medium-gray);
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 1.5rem;
    }

    .close-btn {
        color: #6c757d;
        font-size: 2rem;
        font-weight: bold;
        cursor: pointer;
        line-height: 1;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
        border-radius: var(--border-radius);
        box-sizing: border-box;
    }

    .form-group input[readonly] {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    .form-group.hidden {
        display: none;
    }

    .input-with-button {
        display: flex;
        gap: 5px;
    }

    .input-with-button select {
        flex-grow: 1;
    }

    .add-option-btn {
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        background-color: var(--success-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 20px;
        cursor: pointer;
    }

    .modal-footer {
        text-align: right;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid var(--medium-gray);
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

    .tabulator-cell .action-icon {
        cursor: pointer;
        margin: 0 8px;
        font-size: 16px;
        transition: transform 0.2s;
    }

    .icon-edit {
        color: var(--warning-color);
    }

    .icon-save {
        color: var(--primary-color);
    }

    .icon-delete {
        color: var(--danger-color);
    }

    .icon-inventory {
        color: var(--info-color);
    }

    .product-name-cell {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .product-name-cell .product-name-text {
        flex-grow: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .product-name-cell .product-action-icon {
        margin-left: 10px;
        cursor: pointer;
        color: var(--primary-color);
        font-size: 1.1em;
    }

    #data-manager-body .tabs {
        display: flex;
        border-bottom: 1px solid var(--medium-gray);
        margin-bottom: 15px;
    }

    #data-manager-body .tab-link {
        padding: 10px 15px;
        cursor: pointer;
        border: 1px solid transparent;
        border-bottom: none;
    }

    #data-manager-body .tab-link.active {
        border-color: var(--medium-gray);
        border-bottom-color: white;
        font-weight: 500;
        background-color: white;
        border-radius: 4px 4px 0 0;
        margin-bottom: -1px;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .attribute-manager-grid {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 20px;
        min-height: 50vh;
    }

    .attributes-list,
    .data-item-list {
        border-right: 1px solid var(--medium-gray);
        padding-right: 20px;
        overflow-y: auto;
    }

    .attributes-list ul,
    .options-list ul,
    .data-item-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .attributes-list-item,
    .options-list-item,
    .data-item {
        padding: 10px 15px;
        border-radius: var(--border-radius);
        cursor: pointer;
        margin-bottom: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .attributes-list-item:hover,
    .data-item:hover {
        background-color: var(--light-gray);
    }

    .attributes-list-item.active {
        background-color: var(--primary-color);
        color: white;
        font-weight: 500;
    }

    .options-list-item input,
    .data-item input {
        flex-grow: 1;
        border: 1px solid var(--medium-gray);
        padding: 6px 10px;
        border-radius: 4px;
    }

    .options-list-item .option-actions,
    .data-item .item-actions {
        display: flex;
        gap: 5px;
        margin-left: 10px;
    }

    .option-actions button,
    .item-actions button {
        background: none;
        border: none;
        font-size: 16px;
        cursor: pointer;
        padding: 5px;
    }

    .add-item-form {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--medium-gray);
    }

    .add-item-form input {
        flex-grow: 1;
    }

    .tabulator {
        border: 1px solid var(--medium-gray);
    }

    .tabulator .tabulator-header .tabulator-col {
        border-right: 1px solid var(--medium-gray);
        border-bottom: 1px solid var(--medium-gray);
    }

    .tabulator .tabulator-row .tabulator-cell {
        border-right: 1px solid var(--medium-gray);
    }

    .tabulator .tabulator-row {
        border-bottom: 1px solid var(--medium-gray);
    }

    .pagination-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 10px;
        padding: 10px;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
        font-size: 14px;
        color: #6c757d;
    }

    .pagination-info select {
        padding: 6px 10px;
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
    }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fa fa-boxes-stacked"></i> Danh Sách Sản Phẩm Chi Tiết</h1>
        <div class="controls-container">
            <div class="filter-section">
                <div class="filter-group"><label>Nhóm SP</label><select id="filter-group-id"></select></div>
                <div class="filter-group"><label>Loại Phân Loại</label><select id="filter-loai-id"></select></div>
                <div class="filter-group"><label>Tìm kiếm</label><input id="filter-field" type="text"
                        placeholder="Mã, tên sản phẩm..."></div>
                <div class="filter-group"><label>&nbsp;</label><button id="clear-filters-btn" class="action-button"
                        style="background-color: var(--dark-gray);"><i class="fa fa-times"></i> Xóa Lọc</button></div>
            </div>
            <div class="action-buttons">
                <button id="delete-selected-btn" class="action-button"
                    style="background-color: var(--danger-color); display: none;"><i class="fa fa-trash-can"></i> Xóa đã
                    chọn</button>
                <button id="data-manager-btn" class="action-button" style="background-color: var(--info-color);"><i
                        class="fa fa-database"></i> Quản lý Dữ liệu</button>
                <button id="add-product-btn" class="action-button" style="background-color: var(--primary-color);"><i
                        class="fa fa-plus"></i> Thêm SP Gốc</button>
                <button id="add-variant-btn" class="action-button" style="background-color: var(--success-color);"><i
                        class="fa fa-plus"></i> Thêm SP Chi tiết</button>
            </div>
        </div>
        <div id="variants-table"></div>

        <div class="pagination-info">
            <span id="total-variants"></span>
        </div>
    </div>

    <div id="toast"></div>

    <script src="https://unpkg.com/tabulator-tables@5.6.1/dist/js/tabulator.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const API_URL = 'api/api.php';
        let variantsTable;
        let variantFormState = {};
        let currentVariantId = null;
        let shouldRestoreVariantForm = false;

        // --- HÀM TIỆN ÍCH ---
        function showToast(message, type = 'success') {
            const toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = `show ${type}`;
            setTimeout(() => {
                toast.className = toast.className.replace("show", "");
            }, 4000);
        }
        async function apiRequest(action, data = {}) {
            try {
                const response = await fetch(`${API_URL}?action=${action}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (!result.success) throw new Error(result.message || 'API Error');
                return result.data;
            } catch (error) {
                showToast(error.message, 'error');
                console.error('API Request Error:', error);
                throw error;
            }
        }

        function populateSelect(selectEl, data, valueField, textField, addDefault = true) {
            selectEl.innerHTML = addDefault ? '<option value="">-- Chọn --</option>' : '';
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item[valueField];
                option.textContent = item[textField];
                if (item.base_sku) option.dataset.baseSku = item.base_sku;
                if (item.sku_prefix) option.dataset.skuPrefix = item.sku_prefix;
                if (item.name_prefix) option.dataset.namePrefix = item.name_prefix;
                selectEl.appendChild(option);
            });
        }

        function createModal(id) {
            let modal = document.getElementById(id);
            if (!modal) {
                modal = document.createElement('div');
                modal.id = id;
                document.body.appendChild(modal);
            }
            modal.className = 'modal';
            return modal;
        }

        // --- BẢNG BIẾN THỂ & BỘ LỌC ---
        function initializeTable() {
            variantsTable = new Tabulator("#variants-table", {
                height: "75vh",
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 50,
                paginationSizeSelector: [10, 25, 50, 100, true],
                paginationElement: document.querySelector(".pagination-info"),
                placeholder: "Đang tải dữ liệu...",
                selectable: true,
                index: "variant_id",
                initialSort: [{
                    column: "variant_id",
                    dir: "desc"
                }],
                rowSelectionChanged: (data, rows) => {
                    const deleteBtn = document.getElementById('delete-selected-btn');
                    const count = data.length;
                    deleteBtn.style.display = count > 0 ? 'inline-flex' : 'none';
                    if (count > 0) deleteBtn.innerHTML =
                        `<i class="fa fa-trash-can"></i> Xóa (${count}) mục`;
                },
                dataLoaded: (data) => {
                    document.getElementById('total-variants').textContent =
                        `Tổng số: ${data.length} sản phẩm`;
                },
                columns: [{
                        formatter: "rowSelection",
                        titleFormatter: "rowSelection",
                        hozAlign: "center",
                        headerSort: false,
                        width: 60,
                        frozen: true,
                        cellClick: (e, cell) => cell.getRow().toggleSelect()
                    },
                    {
                        title: "ID",
                        field: "variant_id",
                        width: 60,
                        frozen: true
                    },
                    {
                        title: "Mã SKU",
                        field: "variant_sku",
                        width: 180,
                        frozen: true
                    },
                    {
                        title: "Tên Biến Thể",
                        field: "variant_name",
                        width: 250
                    },
                    {
                        title: "Tên SP Gốc",
                        field: "product_name",
                        width: 250,
                        formatter: (cell) => {
                            const data = cell.getRow().getData();
                            return `<div class="product-name-cell"><span class="product-name-text">${data.product_name}</span><i class="fa-solid fa-edit product-action-icon" title="Sửa SP Gốc" data-product-id="${data.product_id}"></i></div>`;
                        },
                        cellClick: (e, cell) => {
                            if (e.target.classList.contains('product-action-icon')) {
                                openProductForm(e.target.dataset.productId);
                            }
                        }
                    },
                    {
                        title: "Nhóm SP",
                        field: "group_name",
                        width: 150
                    },
                    {
                        title: "Loại Phân Loại",
                        field: "loai_name",
                        width: 250
                    },
                    {
                        title: "Giá",
                        field: "price",
                        width: 120,
                        hozAlign: "right",
                        formatter: "money",
                        formatterParams: {
                            symbol: " ₫"
                        }
                    },
                    {
                        title: "Tồn kho",
                        field: "inventory_display",
                        width: 200,
                        hozAlign: "left"
                    },
                    {
                        title: "ID Thông Số",
                        field: "ID Thông Số",
                        width: 120,
                        hozAlign: "center"
                    },
                    {
                        title: "Độ dày",
                        field: "Độ dày",
                        width: 100,
                        hozAlign: "center"
                    },
                    {
                        title: "Bản rộng",
                        field: "Bản rộng",
                        width: 100,
                        hozAlign: "center"
                    },
                    {
                        title: "Đường kính trong",
                        field: "Đường kính trong",
                        width: 150,
                        hozAlign: "center"
                    },
                    {
                        title: "Kích thước ren",
                        field: "Kích thước ren",
                        width: 120,
                        hozAlign: "center"
                    },
                    {
                        title: "Nguồn gốc",
                        field: "Nguồn gốc",
                        width: 120,
                        hozAlign: "center"
                    },
                    {
                        title: "Xử lý bề mặt",
                        field: "Xử lý bề mặt",
                        width: 150,
                        hozAlign: "center"
                    },
                    {
                        title: "Hậu tố SKU",
                        field: "sku_suffix",
                        width: 120,
                        hozAlign: "center"
                    },
                    {
                        field: "minimum_stock_level",
                        visible: false
                    },
                    {
                        field: "base_unit_name",
                        visible: false
                    },
                    {
                        field: "quantity_in_base_unit",
                        visible: false
                    },
                    {
                        title: "Thao Tác",
                        hozAlign: "center",
                        width: 160,
                        headerSort: false,
                        frozen: true,
                        formatter: (cell) =>
                            `<i class="fa-solid fa-edit action-icon icon-edit" title="Sửa Biến thể"></i><i class="fa-solid fa-boxes-packing action-icon icon-inventory" title="Quản lý Tồn kho"></i><i class="fa-solid fa-trash-can action-icon icon-delete" title="Xóa Biến thể"></i>`,
                        cellClick: (e, cell) => {
                            e.stopPropagation();
                            const data = cell.getRow().getData();
                            if (e.target.closest('.icon-edit')) {
                                openVariantForm(data.variant_id);
                            } else if (e.target.closest('.icon-inventory')) {
                                openInventoryManager(data.variant_id, data.variant_sku);
                            } else if (e.target.closest('.icon-delete')) {
                                if (confirm(
                                        `Bạn có chắc muốn xóa sản phẩm "${data.variant_name}"?`
                                        )) {
                                    apiRequest('delete_multiple_variants', {
                                            ids: [data.variant_id]
                                        })
                                        .then(() => {
                                            showToast('Đã xóa sản phẩm thành công.');
                                            loadAllVariants();
                                        });
                                }
                            }
                        }
                    }
                ]
            });
            loadAllVariants();
        }

        async function loadAllVariants() {
            try {
                const data = await apiRequest('get_all_variants_flat');
                variantsTable.setData(data);
            } catch (error) {
                variantsTable.setPlaceholder("Lỗi tải dữ liệu.");
            }
        }

        async function initializeFilters() {
            const groupSelect = document.getElementById('filter-group-id');
            const loaiSelect = document.getElementById('filter-loai-id');

            try {
                const [groups, loai] = await Promise.all([apiRequest('get_product_groups'), apiRequest(
                    'get_all_loai')]);
                populateSelect(groupSelect, groups, 'group_id', 'name');
                populateSelect(loaiSelect, loai, 'LoaiID', 'TenLoai');
            } catch (error) {
                console.error("Lỗi tải bộ lọc");
            }
            document.getElementById('filter-field').addEventListener('keyup', applyTableFilters);
            groupSelect.addEventListener('change', applyTableFilters);
            loaiSelect.addEventListener('change', applyTableFilters);
        }

        function applyTableFilters() {
            const filters = [];
            const textValue = document.getElementById('filter-field').value;
            const groupId = document.getElementById('filter-group-id').value;
            const loaiId = document.getElementById('filter-loai-id').value;
            if (textValue) {
                filters.push([{
                    field: 'variant_sku',
                    type: 'like',
                    value: textValue
                }, {
                    field: 'variant_name',
                    type: 'like',
                    value: textValue
                }, {
                    field: 'product_name',
                    type: 'like',
                    value: textValue
                }]);
            }
            if (groupId) {
                filters.push({
                    field: 'group_id',
                    type: '=',
                    value: groupId
                });
            }
            if (loaiId) {
                filters.push({
                    field: 'LoaiID',
                    type: '=',
                    value: loaiId
                });
            }
            variantsTable.setFilter(filters);
        }

        async function openProductForm(productId = null) {
            const modal = createModal('product-form-modal');
            modal.innerHTML =
                `<div class="modal-content" style="max-width: 700px;"><div class="modal-header"><h2 id="product-form-title"></h2><span class="close-btn">&times;</span></div><form id="product-form"></form></div>`;
            const form = modal.querySelector('#product-form');
            const title = modal.querySelector('#product-form-title');
            let details = {};

            const [groups, units] = await Promise.all([apiRequest('get_product_groups'), apiRequest(
                'get_all_units')]);

            if (productId) {
                title.textContent = "Chỉnh sửa Sản phẩm gốc";
                details = await apiRequest('get_product_details', {
                    product_id: productId
                });
            } else {
                title.textContent = "Thêm Sản phẩm gốc mới";
            }
            form.innerHTML =
                `
                <input type="hidden" name="product_id" value="${productId || ''}">
                <div class="form-grid">
                    <div class="form-group"><label>Tên Sản phẩm gốc</label><input type="text" name="name" required value="${details.name || ''}"></div>
                    <div class="form-group"><label>Mã Gốc (Base SKU)</label><input type="text" name="base_sku" required value="${details.base_sku || ''}"></div>
                    <div class="form-group"><label>Tiền tố Mã (SKU Prefix)</label><input type="text" name="sku_prefix" value="${details.sku_prefix || ''}" placeholder="Ví dụ: PUR-S"></div>
                    <div class="form-group"><label>Tiền tố Tên (Name Prefix)</label><input type="text" name="name_prefix" value="${details.name_prefix || ''}" placeholder="Ví dụ: Gối đỡ đế vuông"></div>
                    <div class="form-group"><label>Nhóm Sản phẩm</label><select name="group_id" required></select></div>
                    <div class="form-group"><label>Đơn vị cơ sở</label><select name="base_unit_id" required></select></div>
                </div>
                <div class="modal-footer"><button type="submit" class="action-button" style="background-color: var(--success-color);">Lưu</button></div>`;

            const groupSelect = form.querySelector('select[name="group_id"]');
            const baseUnitSelect = form.querySelector('select[name="base_unit_id"]');
            populateSelect(groupSelect, groups, 'group_id', 'name', false);
            populateSelect(baseUnitSelect, units, 'unit_id', 'name', false);
            if (productId) {
                groupSelect.value = details.group_id;
                baseUnitSelect.value = details.base_unit_id;
            }

            form.onsubmit = async (e) => {
                e.preventDefault();
                const dataToSave = Object.fromEntries(new FormData(form).entries());
                await apiRequest('save_product', {
                    data: dataToSave
                });
                showToast('Lưu sản phẩm gốc thành công!');
                modal.style.display = 'none';
                loadAllVariants();
                initializeFilters(); // Tải lại bộ lọc phòng trường hợp có nhóm mới
            };
            modal.style.display = 'block';
        }

        async function openVariantForm(variantId = null) {
            const modal = createModal('variant-form-modal');
            modal.innerHTML =
                `<div class="modal-content"><div class="modal-header"><h2 id="variant-form-title"></h2><span class="close-btn">&times;</span></div><form id="variant-form"></form></div>`;
            const form = modal.querySelector('#variant-form');
            const title = modal.querySelector('#variant-form-title');

            currentVariantId = variantId;

            let details = {};
            if (variantId) {
                title.textContent = "Chỉnh Sửa Sản Phẩm Chi Tiết";
                if (!shouldRestoreVariantForm) {
                    details = await apiRequest('get_variant_details', {
                        variant_id: variantId
                    });
                    variantFormState = {
                        ...details
                    };
                } else {
                    details = {
                        ...variantFormState
                    };
                }
            } else {
                title.textContent = "Thêm Sản Phẩm Chi Tiết Mới";
                if (!shouldRestoreVariantForm) {
                    details = {};
                    variantFormState = {};
                } else {
                    details = {
                        ...variantFormState
                    };
                }
            }
            shouldRestoreVariantForm = false;

            const [allAttributes, allLoai, allBaseProducts] = await Promise.all([
                apiRequest('get_all_attributes'),
                apiRequest('get_all_loai'),
                apiRequest('get_all_base_products')
            ]);

            // ... (Phần tạo HTML cho form biến thể không đổi)

            // Event Listeners và logic tạo SKU tự động trong form không đổi

            form.onsubmit = async (e) => {
                e.preventDefault();
                const dataToSave = {
                    ...Object.fromEntries(new FormData(form).entries()),
                    option_ids: Array.from(form.querySelectorAll(
                            '.attribute-select:not(.hidden select)'))
                        .map(s => s.value)
                        .filter(Boolean)
                };
                await apiRequest('save_variant', {
                    data: dataToSave
                });
                showToast('Lưu biến thể thành công!');
                modal.style.display = 'none';
                loadAllVariants();
                variantFormState = {};
            };
            modal.style.display = 'block';
        }

        async function openInventoryManager(variantId, variantSku) {
            const modal = createModal('inventory-modal');
            modal.innerHTML =
                `<div class="modal-content" style="max-width: 600px;"><div class="modal-header"><h2>Tồn kho: ${variantSku}</h2><span class="close-btn">&times;</span></div><form id="inventory-form">Đang tải...</form></div>`;
            const form = modal.querySelector('#inventory-form');
            modal.style.display = 'block';

            try {
                const inventoryData = await apiRequest('get_inventory_for_variant', {
                    variant_id: variantId
                });
                const currentQuantity = parseInt(inventoryData.quantity || 0);
                const minimumStockLevel = parseInt(inventoryData.minimum_stock_level || 0);
                const unitName = inventoryData.unit_name || 'Đơn vị';

                form.innerHTML = `
                    <p>Nhập số lượng mới cho đơn vị cơ sở.</p>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Số lượng (${unitName})</label>
                            <input type="number" name="quantity" value="${currentQuantity}">
                        </div>
                        <div class="form-group">
                            <label>Định mức tồn kho tối thiểu (${unitName})</label>
                            <input type="number" name="minimum_stock_level" value="${minimumStockLevel}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="action-button" style="background-color: var(--success-color);">Lưu Tồn Kho</button>
                    </div>`;

                form.onsubmit = async (e) => {
                    e.preventDefault();
                    const newQuantity = parseInt(form.querySelector('[name="quantity"]').value ||
                    0);
                    const newMinimumStockLevel = parseInt(form.querySelector(
                        '[name="minimum_stock_level"]').value || 0);

                    await apiRequest('update_inventory', {
                        variant_id: variantId,
                        quantity: newQuantity,
                        minimum_stock_level: newMinimumStockLevel
                    });
                    showToast("Cập nhật tồn kho thành công!");
                    modal.style.display = 'none';
                    loadAllVariants();
                };
            } catch (err) {
                form.innerHTML = `<p style="color: red;">Lỗi: ${err.message}.</p>`;
            }
        }

        // ... (Các hàm openDataManager, loadDataForTab, loadAttributeManager, loadOptionsForAttribute, loadSimpleDataManager không đổi)

        function setupEventListeners() {
            document.getElementById("add-variant-btn").addEventListener("click", () => openVariantForm());
            document.getElementById("add-product-btn").addEventListener("click", () => openProductForm());
            document.getElementById("data-manager-btn").addEventListener("click", () => openDataManager());
            document.getElementById("clear-filters-btn").addEventListener("click", () => {
                document.getElementById('filter-group-id').value = '';
                document.getElementById('filter-loai-id').value = '';
                document.getElementById('filter-field').value = '';
                if (variantsTable) variantsTable.clearFilter();
            });
            document.getElementById('delete-selected-btn').addEventListener('click', async () => {
                if (!variantsTable) return;
                const selectedData = variantsTable.getSelectedData();
                if (selectedData.length === 0) return;
                if (confirm(`Bạn có chắc muốn xóa ${selectedData.length} sản phẩm đã chọn?`)) {
                    const idsToDelete = selectedData.map(row => row.variant_id);
                    await apiRequest('delete_multiple_variants', {
                        ids: idsToDelete
                    });
                    showToast(`Đã xóa thành công ${idsToDelete.length} sản phẩm.`);
                    loadAllVariants();
                }
            });
            document.body.addEventListener('click', e => {
                const modal = e.target.closest('.modal');
                if (e.target.classList.contains('close-btn')) {
                    if (modal.id === 'data-manager-modal' && modal.onCloseCallback &&
                        shouldRestoreVariantForm) {
                        modal.onCloseCallback();
                    }
                    shouldRestoreVariantForm = false;
                    if (modal) modal.style.display = 'none';
                }
            });
        }

        // --- KHỞI CHẠY ---
        initializeTable();
        initializeFilters();
        setupEventListeners();
    });
    </script>
</body>

</html>