<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khách Hàng (Nâng cao)</title>
    <link href="https://unpkg.com/tabulator-tables@5.6.0/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --success-color: #28a745;
            --danger-color: #dc3545;
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

        #add-company-btn {
            background-color: var(--success-color);
        }

        #manage-pricemech-btn {
            background-color: var(--info-color);
        }

        .filter-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-controls input,
        .filter-controls select {
            padding: 8px 12px;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
        }

        .filter-controls input {
            min-width: 300px;
        }

        .tabulator-row.tabulator-tree-level-1 {
            background-color: #f8f9fa !important;
        }

        .tabulator-cell .action-icon {
            cursor: pointer;
            margin: 0 5px;
            font-size: 16px;
            transition: transform 0.2s, color 0.2s;
        }

        .icon-add-contact {
            color: var(--success-color);
        }

        .icon-edit {
            color: var(--primary-color);
        }

        .icon-delete {
            color: var(--danger-color);
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
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 25px;
            border: none;
            width: 90%;
            max-width: 800px;
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
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
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

        .manager-container {
            padding: 10px;
        }

        .add-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            align-items: flex-end;
        }

        .add-form .form-group {
            flex-grow: 1;
            margin-bottom: 0;
        }

        .add-form button {
            padding: 8px 15px;
            height: 35px;
            color: white;
            background-color: var(--success-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        .manager-list {
            list-style-type: none;
            padding: 0;
            max-height: 45vh;
            overflow-y: auto;
        }

        .manager-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .manager-list li:nth-child(even) {
            background-color: #f9f9f9;
        }

        .manager-list li:hover {
            background-color: #f1f3f5;
        }

        .item-content {
            flex-grow: 1;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .item-actions button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            font-size: 15px;
            margin-left: 8px;
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

        .btn-cancel {
            color: var(--dark-gray);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fa fa-users"></i> Trang Quản Lý Khách Hàng</h1>
        <div class="controls-container">
            <div class="filter-controls">
                <label for="filter-field-select" class="font-weight-bold">Lọc theo:</label>
                <select id="filter-field-select">
                    <option value="">-- Tất cả các trường --</option>
                    <option value="TenCongTy">Tên Công Ty</option>
                    <option value="HoTen">Người Liên Hệ</option>
                    <option value="Email">Email</option>
                    <option value="DiaChi">Địa Chỉ</option>
                    <option value="MaSoThue">Mã Số Thuế</option>
                </select>
                <input id="filter-value-input" type="text" placeholder="Nhập giá trị tìm kiếm...">
                <button id="clear-filter-btn" class="action-button"
                    style="background-color: var(--dark-gray); margin-left: 0;">
                    <i class="fa fa-times"></i> Xóa Lọc
                </button>
            </div>
            <div class="action-buttons">
                <button id="manage-pricemech-btn" class="action-button"><i class="fa fa-dollar-sign"></i> Quản lý Cơ chế
                    giá</button>
                <button id="add-company-btn" class="action-button"><i class="fa fa-plus"></i> Thêm Công Ty</button>
            </div>
        </div>
        <div id="customer-table"></div>
    </div>

    <div id="company-modal" class="modal"></div>
    <div id="contact-modal" class="modal"></div>
    <div id="pricemech-modal" class="modal"></div>
    <div id="toast"></div>

    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.6.0/dist/js/tabulator.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let table;
            let originalTableData = [];
            let coCheGiaOptions = [];

            // --- CÁC HÀM TIỆN ÍCH ---
            function showToast(message, type = 'success') {
                const toast = document.getElementById("toast");
                toast.textContent = message;
                toast.className = `show ${type}`;
                setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
            }

            async function fetchAPI(url, options = {}) {
                try {
                    const response = await fetch(url, options);
                    const result = await response.json();
                    if (!response.ok || (result && result.success === false)) {
                        throw new Error(result.message || 'Lỗi từ server');
                    }
                    return result;
                } catch (error) {
                    showToast(error.message, 'error');
                    console.error('Lỗi Fetch:', error);
                    throw error;
                }
            }

            // --- QUẢN LÝ MODAL ---
            function openModal(modalId, title, content) {
                const modal = document.getElementById(modalId);
                modal.innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>${title}</h2>
                            <span class="close-btn">&times;</span>
                        </div>
                        ${content}
                    </div>`;
                modal.style.display = "flex";
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = "none";
            }

            // --- CÁC HÀM XỬ LÝ DỮ LIỆU ---
            function showCompanyForm(company = {}) {
                const isEdit = !!company.CongTyID;
                const title = isEdit ? `Sửa thông tin công ty: ${company.TenCongTy}` : 'Thêm Công Ty Mới';

                let coCheGiaSelectOptions = '<option value="">-- Chọn --</option>';
                coCheGiaOptions.forEach(opt => {
                    const selected = opt.CoCheGiaID == company.CoCheGiaID ? 'selected' : '';
                    coCheGiaSelectOptions += `<option value="${opt.CoCheGiaID}" ${selected}>${opt.TenCoChe}</option>`;
                });

                const formContent = `
                    <form id="company-form">
                        <input type="hidden" name="CongTyID" value="${company.CongTyID || ''}">
                        <div class="form-grid">
                            <div class="form-group"> <label>Tên Công Ty (*)</label> <input type="text" name="TenCongTy" value="${company.TenCongTy || ''}" required> </div>
                            <div class="form-group"> <label>Địa Chỉ</label> <input type="text" name="DiaChi" value="${company.DiaChi || ''}"> </div>
                            <div class="form-group"> <label>Mã Số Thuế</label> <input type="text" name="MaSoThue" value="${company.MaSoThue || ''}"> </div>
                            <div class="form-group"> <label>Số Điện Thoại</label> <input type="text" name="SoDienThoaiChinh" value="${company.SoDienThoaiChinh || ''}"> </div>
                            <div class="form-group"> <label>Cơ Chế Giá</label> <select name="CoCheGiaID">${coCheGiaSelectOptions}</select> </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="action-button" style="background-color: var(--primary-color);">Lưu</button>
                        </div>
                    </form>`;
                openModal('company-modal', title, formContent);
            }

            function showContactForm(contact = {}, companyId) {
                const isEdit = !!contact.NguoiLienHeID;
                const finalCompanyId = contact.CongTyID || companyId;
                const title = isEdit ? `Sửa người liên hệ: ${contact.HoTen}` : 'Thêm Người Liên Hệ Mới';
                const formContent = `
                    <form id="contact-form">
                        <input type="hidden" name="NguoiLienHeID" value="${contact.NguoiLienHeID || ''}">
                        <input type="hidden" name="CongTyID" value="${finalCompanyId}">
                        <div class="form-grid">
                            <div class="form-group"> <label>Họ Tên (*)</label> <input type="text" name="HoTen" value="${contact.HoTen || ''}" required> </div>
                            <div class="form-group"> <label>Chức Vụ</label> <input type="text" name="ChucVu" value="${contact.ChucVu || ''}"> </div>
                            <div class="form-group"> <label>Email</label> <input type="email" name="Email" value="${contact.Email || ''}"> </div>
                            <div class="form-group"> <label>Số Di Động</label> <input type="text" name="SoDiDong" value="${contact.SoDiDong || ''}"> </div>
                        </div>
                        <div class="modal-footer">
                             <button type="submit" class="action-button" style="background-color: var(--primary-color);">Lưu</button>
                        </div>
                    </form>`;
                openModal('contact-modal', title, formContent);
            }

            // --- QUẢN LÝ CƠ CHẾ GIÁ ---
            async function priceMechAPI(action, data = {}) {
                return await fetchAPI('api/handle_pricemech.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action, ...data })
                });
            }

            function renderPriceMechList(items) {
                const listElement = document.getElementById('pricemech-list');
                if (!listElement) return;
                listElement.innerHTML = '';
                if (!items || items.length === 0) {
                    listElement.innerHTML = '<li>Không có dữ liệu.</li>';
                    return;
                }
                items.forEach(item => {
                    const li = document.createElement('li');
                    li.dataset.id = item.CoCheGiaID;
                    // SỬA LỖI: Hiển thị 0.00 nếu PhanTramDieuChinh là null hoặc undefined
                    const phanTram = item.PhanTramDieuChinh || '0.00';
                    li.innerHTML = `
                        <div class="item-content">
                            <span class="item-detail"><b>Mã:</b> <span class="data-MaCoChe">${item.MaCoChe}</span></span>
                            <span class="item-detail"><b>Tên:</b> <span class="data-TenCoChe">${item.TenCoChe}</span></span>
                            <span class="item-detail"><b>Điều chỉnh:</b> <span class="data-PhanTramDieuChinh">${phanTram}</span>%</span>
                        </div>
                        <div class="item-actions">
                            <button class="btn-edit" title="Sửa"><i class="fa fa-pencil"></i></button>
                            <button class="btn-delete" title="Xóa"><i class="fa fa-trash"></i></button>
                        </div>`;
                    listElement.appendChild(li);
                });
            }

            async function loadPriceMechs() {
                try {
                    const result = await priceMechAPI('get_all');
                    renderPriceMechList(result.data);
                } catch (error) { /* Handled by fetchAPI */ }
            }

            // --- ĐỊNH NGHĨA BẢNG TABULATOR ---
            function createColumnDefinitions() {
                return [
                    {
                        title: "Tên Công Ty", field: "TenCongTy", minWidth: 300, frozen: true,
                        formatter: (cell) => {
                            const data = cell.getRow().getData();
                            if (cell.getRow().getTreeParent() === false) {
                                return `<strong style='color: #0056b3;'>${data.TenCongTy}</strong>`;
                            }
                            return "";
                        }
                    },
                    { title: "Người Liên Hệ", field: "HoTen", width: 200 },
                    { title: "Email", field: "Email", width: 250 },
                    {
                        title: "Cơ Chế Giá",
                        field: "TenCoChe",
                        width: 200,
                        formatter: (cell) => {
                            const data = cell.getRow().getData();
                            if (cell.getRow().getTreeParent() !== false) return "";
                            if (!data.TenCoChe) return "<span style='color:#999;'>--Chưa chọn--</span>";
                            const percent = data.PhanTramDieuChinh || 0;
                            const color = parseFloat(percent) < 0 ? 'var(--danger-color)' : 'var(--success-color)';
                            return `${data.TenCoChe} <span style='color: ${color}; font-weight: bold;'>(${percent}%)</span>`;
                        }
                    },
                    { title: "Địa Chỉ", field: "DiaChi", width: 350 },
                    {
                        title: "Thao tác", hozAlign: "center", width: 150, headerSort: false,
                        formatter: (cell) => {
                            const isCompany = cell.getRow().getTreeParent() === false;
                            if (isCompany) {
                                return `
                                    <i class="fa-solid fa-user-plus action-icon icon-add-contact" title="Thêm người liên hệ"></i>
                                    <i class="fa-solid fa-pencil action-icon icon-edit" title="Sửa thông tin công ty"></i>
                                    <i class="fa-solid fa-trash-can action-icon icon-delete" title="Xóa công ty"></i>`;
                            } else {
                                return `
                                    <i class="fa-solid fa-pencil action-icon icon-edit" title="Sửa người liên hệ"></i>
                                    <i class="fa-solid fa-trash-can action-icon icon-delete" title="Xóa người liên hệ"></i>`;
                            }
                        },
                        cellClick: async (e, cell) => {
                            const data = cell.getRow().getData();
                            const isCompany = cell.getRow().getTreeParent() === false;
                            if (e.target.classList.contains('icon-add-contact')) { showContactForm({}, data.CongTyID); }
                            else if (e.target.classList.contains('icon-edit')) { if (isCompany) showCompanyForm(data); else showContactForm(data); }
                            else if (e.target.classList.contains('icon-delete')) {
                                const entity = isCompany ? 'công ty' : 'người liên hệ';
                                const name = data.TenCongTy || data.HoTen;
                                if (confirm(`Bạn có chắc muốn xóa ${entity} "${name}"?`)) {
                                    try {
                                        const url = isCompany ? 'api/delete_company.php' : 'api/delete_contact.php';
                                        const idField = isCompany ? 'CongTyID' : 'NguoiLienHeID';
                                        await fetchAPI(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ id: data[idField] }) });
                                        showToast(`Xóa ${entity} thành công!`, 'success');
                                        cell.getRow().delete();
                                    } catch (error) { /* handled */ }
                                }
                            }
                        }
                    },
                ];
            }

            function applyTableFilters() {
                const field = document.getElementById("filter-field-select").value;
                const value = document.getElementById("filter-value-input").value;
                if (!value) { table.setData(originalTableData); return; }
                const lowerCaseValue = value.toLowerCase();
                let filterFields = field ? [field] : ["TenCongTy", "HoTen", "Email", "DiaChi", "MaSoThue"];
                const filteredData = originalTableData.filter(company => {
                    let match = false;
                    for (const f of filterFields) { if (company[f] && String(company[f]).toLowerCase().includes(lowerCaseValue)) { match = true; break; } }
                    if (match) return true;
                    if (company._children) {
                        for (const contact of company._children) {
                            for (const f of filterFields) { if (contact[f] && String(contact[f]).toLowerCase().includes(lowerCaseValue)) { match = true; break; } }
                            if (match) return true;
                        }
                    }
                    return false;
                });
                table.setData(filteredData).then(() => { table.getRows().forEach(row => row.treeExpand()); });
            }

            // --- KHỞI TẠO VÀ TƯƠNG TÁC ---
            function setupEventListeners() {
                document.getElementById('add-company-btn').onclick = () => showCompanyForm();
                document.getElementById('manage-pricemech-btn').onclick = () => {
                    document.getElementById('pricemech-modal').style.display = "flex";
                    loadPriceMechs();
                };

                const filterFieldSelect = document.getElementById('filter-field-select');
                const filterValueInput = document.getElementById('filter-value-input');
                const clearFilterBtn = document.getElementById('clear-filter-btn');
                let filterTimeout;
                function triggerFilter() { clearTimeout(filterTimeout); filterTimeout = setTimeout(applyTableFilters, 300); }
                filterFieldSelect.addEventListener('change', triggerFilter);
                filterValueInput.addEventListener('keyup', triggerFilter);
                clearFilterBtn.addEventListener('click', () => {
                    filterFieldSelect.value = "";
                    filterValueInput.value = "";
                    table.setData(originalTableData);
                });

                document.body.addEventListener('click', function (event) {
                    if (event.target.classList.contains('close-btn') || event.target.classList.contains('modal')) {
                        event.target.closest('.modal').style.display = 'none';
                    }
                    if (event.target.closest('.btn-edit')) {
                        const li = event.target.closest('li');
                        const ma = li.querySelector('.data-MaCoChe').textContent;
                        const ten = li.querySelector('.data-TenCoChe').textContent;
                        // SỬA LỖI: Lấy giá trị số từ text content
                        const phanTram = parseFloat(li.querySelector('.data-PhanTramDieuChinh').textContent) || 0;
                        li.innerHTML = `
                            <div class="item-content">
                                <input type="text" class="edit-MaCoChe" value="${ma}" placeholder="Mã" style="width: 80px;">
                                <input type="text" class="edit-TenCoChe" value="${ten}" placeholder="Tên" style="flex-grow: 1;">
                                <input type="number" step="0.01" class="edit-PhanTramDieuChinh" value="${phanTram}" placeholder="%" style="width: 80px;">
                            </div>
                            <div class="item-actions">
                                <button class="btn-save-edit" title="Lưu"><i class="fa fa-check"></i></button>
                                <button class="btn-cancel" title="Hủy"><i class="fa fa-times"></i></button>
                            </div>`;
                    }
                    if (event.target.closest('.btn-cancel')) { loadPriceMechs(); }
                    if (event.target.closest('.btn-save-edit')) {
                        const li = event.target.closest('li');
                        const data = { id: li.dataset.id, MaCoChe: li.querySelector('.edit-MaCoChe').value, TenCoChe: li.querySelector('.edit-TenCoChe').value, PhanTramDieuChinh: li.querySelector('.edit-PhanTramDieuChinh').value };
                        priceMechAPI('update', data).then(async () => {
                            await loadPriceMechs();
                            const result = await fetchAPI('api/get_customer_options.php');
                            coCheGiaOptions = result.data;
                            await reloadAndRefilter(); // Cập nhật lại bảng chính
                        });
                    }
                    if (event.target.closest('.btn-delete')) {
                        const li = event.target.closest('li');
                        if (confirm('Bạn có chắc muốn xóa cơ chế giá này?')) {
                            priceMechAPI('delete', { id: li.dataset.id }).then(async () => {
                                await loadPriceMechs();
                                const result = await fetchAPI('api/get_customer_options.php');
                                coCheGiaOptions = result.data;
                                await reloadAndRefilter(); // Cập nhật lại bảng chính
                            });
                        }
                    }
                });

                document.body.addEventListener('submit', async function (event) {
                    event.preventDefault();
                    let url, data;
                    const formData = new FormData(event.target);
                    data = Object.fromEntries(formData.entries());

                    if (event.target.id === 'company-form' || event.target.id === 'contact-form') {
                        if (event.target.id === 'company-form') { url = data.CongTyID ? 'api/update_company.php' : 'api/add_company.php'; }
                        else { url = data.NguoiLienHeID ? 'api/update_contact.php' : 'api/add_contact.php'; }
                        try {
                            await fetchAPI(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data) });
                            showToast('Lưu thông tin thành công!', 'success');
                            closeModal('company-modal');
                            closeModal('contact-modal');
                            await reloadAndRefilter();
                        } catch (error) { /* handled */ }
                    } else if (event.target.id === 'form-add-pricemech') {
                        const addData = { MaCoChe: document.getElementById('add-MaCoChe').value, TenCoChe: document.getElementById('add-TenCoChe').value, PhanTramDieuChinh: document.getElementById('add-PhanTramDieuChinh').value };
                        await priceMechAPI('add', addData);
                        event.target.reset();
                        await loadPriceMechs();
                        const result = await fetchAPI('api/get_customer_options.php');
                        coCheGiaOptions = result.data;
                        await reloadAndRefilter();
                    }
                });
            }

            // HÀM MỚI: Tải lại dữ liệu và áp dụng lại bộ lọc
            async function reloadAndRefilter() {
                const result = await fetchAPI("api/get_customers_tree.php");
                originalTableData = result.data;
                applyTableFilters();
            }

            async function initialize() {
                const optionsResult = await fetchAPI('api/get_customer_options.php');
                coCheGiaOptions = optionsResult.data;

                table = new Tabulator("#customer-table", {
                    height: "75vh",
                    layout: "fitColumns",
                    placeholder: "Đang tải dữ liệu...",
                    dataTree: true,
                    dataTreeStartExpanded: false,
                    dataTreeChildField: "_children",
                    columns: createColumnDefinitions(),
                });

                document.getElementById('pricemech-modal').innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2><i class="fa fa-dollar-sign"></i> Quản Lý Cơ Chế Giá</h2>
                            <span class="close-btn">&times;</span>
                        </div>
                        <div class="manager-container">
                            <form id="form-add-pricemech" class="add-form">
                                <div class="form-group"><label>Mã Cơ Chế</label><input type="text" id="add-MaCoChe" required></div>
                                <div class="form-group"><label>Tên Cơ Chế</label><input type="text" id="add-TenCoChe" required></div>
                                <div class="form-group"><label>% Điều Chỉnh</label><input type="number" step="0.01" id="add-PhanTramDieuChinh" required></div>
                                <button type="submit"><i class="fa fa-plus"></i> Thêm</button>
                            </form>
                            <ul id="pricemech-list" class="manager-list"></ul>
                        </div>
                    </div>`;

                try {
                    const result = await fetchAPI("api/get_customers_tree.php");
                    originalTableData = result.data;
                    table.setData(originalTableData);
                } catch (error) {
                    table.setPlaceholder("Lỗi tải dữ liệu. Vui lòng thử lại.");
                }

                setupEventListeners();
            }

            initialize();
        });
    </script>
</body>

</html>