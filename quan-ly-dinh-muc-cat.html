<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Định Mức Cắt</title>
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

        #add-btn {
            background-color: var(--success-color);
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

        .filter-controls input {
            padding: 8px 12px;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
            min-width: 350px;
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
            max-width: 600px;
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
            grid-template-columns: 1fr 1fr;
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
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fa fa-ruler-combined"></i> Trang Quản Lý Định Mức Cắt</h1>
        <div class="controls-container">
            <div class="filter-controls">
                <input id="filter-field" type="text" placeholder="Tìm theo Tên nhóm DN...">
            </div>
            <div class="action-buttons">
                <button id="add-btn" class="action-button"><i class="fa fa-plus"></i> Thêm mới</button>
            </div>
        </div>
        <div id="dinh-muc-table"></div>
    </div>

    <div id="dinh-muc-modal" class="modal"></div>
    <div id="toast"></div>

    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.6.0/dist/js/tabulator.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let table;

            // --- CÁC HÀM TIỆN ÍCH ---
            function showToast(message, type = 'success') {
                const toast = document.getElementById("toast");
                toast.textContent = message;
                toast.className = `show ${type}`;
                setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
            }

            async function fetchAPI(url, options) {
                try {
                    const response = await fetch(url, options);
                    const result = await response.json();
                    if (!response.ok || (result && result.success === false)) {
                        throw new Error(result.message || 'Lỗi từ máy chủ');
                    }
                    return result;
                } catch (error) {
                    showToast(error.message, 'error');
                    console.error('Lỗi Fetch:', error);
                    throw error;
                }
            }

            // --- QUẢN LÝ ĐỊNH MỨC CẮT ---
            async function loadAllDinhMuc() {
                showToast("Đang tải dữ liệu...", "info");
                try {
                    const result = await fetchAPI("api/get_dinh_muc.php");
                    showToast(`Tải thành công ${result.data.length} định mức!`, "success");
                    return result.data;
                } catch (error) {
                    showToast("Lỗi khi tải dữ liệu định mức.", "error");
                    return [];
                }
            }

            function createColumnDefinitions() {
                return [
                    { title: "ID", field: "DinhMucID", width: 60, headerSort: false },
                    { title: "Tên Nhóm DN", field: "TenNhomDN", minWidth: 150, editor: "input" },
                    {
                        title: "Hình Dạng", field: "HinhDang", width: 120, editor: "list",
                        editorParams: { values: { "Vuông": "Vuông", "Tròn": "Tròn" } }
                    },
                    { title: "Min DN", field: "MinDN", width: 100, editor: "number", hozAlign: "center" },
                    { title: "Max DN", field: "MaxDN", width: 100, editor: "number", hozAlign: "center" },
                    { title: "Bản Rộng", field: "BanRong", width: 120, editor: "number", hozAlign: "center" },
                    { title: "Số Bộ/Cây", field: "SoBoTrenCay", width: 120, editor: "number", hozAlign: "center" },
                    {
                        title: "Thao tác", hozAlign: "center", width: 100, headerSort: false,
                        formatter: (c) => `<i class="fa-solid fa-save action-icon icon-save" title="Lưu"></i> <i class="fa-solid fa-trash-can action-icon icon-delete" title="Xóa"></i>`,
                        cellClick: (e, cell) => {
                            const row = cell.getRow();
                            if (e.target.classList.contains('icon-delete')) {
                                if (confirm(`Bạn có chắc muốn xóa định mức "${row.getData().TenNhomDN}"?`)) {
                                    deleteDinhMuc(row.getData().DinhMucID, row);
                                }
                            } else if (e.target.classList.contains('icon-save')) {
                                saveDinhMucUpdate(row);
                            }
                        }
                    },
                ];
            }

            async function saveDinhMucUpdate(row) {
                row.getElement().style.opacity = '0.5';
                try {
                    await fetchAPI('api/update_dinh_muc.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(row.getData())
                    });
                    showToast('Cập nhật định mức thành công!', 'success');
                } finally {
                    row.getElement().style.opacity = '1';
                }
            }

            async function deleteDinhMuc(id, row) {
                try {
                    await fetchAPI('api/delete_dinh_muc.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: id })
                    });
                    showToast('Xóa định mức thành công!', 'success');
                    row.delete();
                } catch (error) { /* Đã được xử lý trong fetchAPI */ }
            }

            function applyTableFilters() {
                const filterValue = document.getElementById("filter-field").value;
                table.setFilter("TenNhomDN", "like", filterValue);
            }

            function setupEventListeners() {
                const addBtn = document.getElementById('add-btn');
                const modal = document.getElementById('dinh-muc-modal');
                let filterTimeout;

                document.getElementById("filter-field").addEventListener("keyup", () => {
                    clearTimeout(filterTimeout);
                    filterTimeout = setTimeout(applyTableFilters, 300);
                });

                addBtn.onclick = () => {
                    document.getElementById('dinh-muc-form').reset();
                    modal.style.display = "block";
                };

                document.body.addEventListener('click', function (event) {
                    if (event.target.classList.contains('close-btn') || event.target.id === 'dinh-muc-modal') {
                        modal.style.display = 'none';
                    }
                });

                document.getElementById('dinh-muc-form').addEventListener('submit', async function (event) {
                    event.preventDefault();
                    const formData = new FormData(event.target);
                    const data = Object.fromEntries(formData.entries());
                    try {
                        const result = await fetchAPI('api/add_dinh_muc.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(data)
                        });
                        showToast('Thêm định mức thành công!', 'success');
                        modal.style.display = "none";
                        // Thêm dữ liệu mới vào bảng mà không cần tải lại toàn bộ
                        table.addData([result.data], true);
                    } catch (error) { /* Đã được xử lý */ }
                });
            }

            async function initialize() {
                // Chèn HTML của Modal vào trang
                document.getElementById('dinh-muc-modal').innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id="modal-title">Thêm Định Mức Mới</h2>
                            <span class="close-btn">&times;</span>
                        </div>
                        <form id="dinh-muc-form">
                            <div class="form-grid">
                                <div class="form-group"> <label for="TenNhomDN">Tên Nhóm DN (*)</label> <input type="text" name="TenNhomDN" required> </div>
                                <div class="form-group"> <label for="HinhDang">Hình Dạng (*)</label> 
                                    <select name="HinhDang" required>
                                        <option value="Vuông">Vuông</option>
                                        <option value="Tròn">Tròn</option>
                                    </select>
                                </div>
                                <div class="form-group"> <label for="MinDN">Min DN (*)</label> <input type="number" name="MinDN" required> </div>
                                <div class="form-group"> <label for="MaxDN">Max DN (*)</label> <input type="number" name="MaxDN" required> </div>
                                <div class="form-group"> <label for="BanRong">Bản Rộng (*)</label> <input type="number" name="BanRong" required> </div>
                                <div class="form-group"> <label for="SoBoTrenCay">Số Bộ/Cây (*)</label> <input type="number" name="SoBoTrenCay" required> </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="action-button" style="background-color: var(--primary-color);">Lưu Định Mức</button>
                            </div>
                        </form>
                    </div>`;

                // Khởi tạo bảng Tabulator
                table = new Tabulator("#dinh-muc-table", {
                    height: "75vh",
                    layout: "fitColumns",
                    columns: createColumnDefinitions(),
                    pagination: true,
                    paginationMode: "local",
                    paginationSize: 20,
                    paginationSizeSelector: [10, 20, 50, 100, true],
                    placeholder: "Đang tải...",
                });

                // Tải dữ liệu và cài đặt các sự kiện
                const tableData = await loadAllDinhMuc();
                table.setData(tableData);
                if (tableData.length === 0) {
                    table.setPlaceholder("Không có dữ liệu định mức.");
                }
                setupEventListeners();
            }

            initialize();
        });
    </script>
</body>

</html>