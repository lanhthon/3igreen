<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
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
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--medium-gray);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 500;
        }

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

        ul {
            list-style-type: none;
            padding: 0;
            max-height: 50vh;
            overflow-y: auto;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        li:nth-child(even) {
            background-color: #f9f9f9;
        }

        li:hover {
            background-color: #f1f3f5;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1><i class="fa fa-sitemap"></i> Quản Lý Danh Mục</h1>
            <a href="quan-ly-san-pham.html" class="back-link"><i class="fa fa-arrow-left"></i> Quay lại trang sản
                phẩm</a>
        </div>

        <div class="manager-grid">
            <div class="category-manager">
                <h2><i class="fa fa-tags"></i> Loại Sản Phẩm</h2>
                <form class="add-form" id="form-add-loai">
                    <input type="text" id="input-add-loai" placeholder="Nhập tên loại mới..." required>
                    <button type="submit"><i class="fa fa-plus"></i> Thêm</button>
                </form>
                <ul id="list-loai">
                </ul>
            </div>

            <div class="category-manager">
                <h2><i class="fa fa-layer-group"></i> Nhóm Sản Phẩm</h2>
                <form class="add-form" id="form-add-nhom">
                    <input type="text" id="input-add-nhom" placeholder="Nhập tên nhóm mới..." required>
                    <button type="submit"><i class="fa fa-plus"></i> Thêm</button>
                </form>
                <ul id="list-nhom">
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const API_URL = 'api/handle_category.php';

            const loaiList = document.getElementById('list-loai');
            const nhomList = document.getElementById('list-nhom');

            const loaiForm = document.getElementById('form-add-loai');
            const nhomForm = document.getElementById('form-add-nhom');

            const loaiInput = document.getElementById('input-add-loai');
            const nhomInput = document.getElementById('input-add-nhom');

            /**
             * Hàm fetch API chung
             */
            async function fetchAPI(action, type, data = {}) {
                try {
                    const response = await fetch(API_URL, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action, type, ...data })
                    });
                    const result = await response.json();
                    if (!result.success) {
                        throw new Error(result.message || 'Có lỗi xảy ra');
                    }
                    return result;
                } catch (error) {
                    alert('Lỗi: ' + error.message);
                    throw error;
                }
            }

            /**
             * Render danh sách danh mục (loại hoặc nhóm)
             */
            function renderList(listElement, items, type) {
                listElement.innerHTML = '';
                if (items.length === 0) {
                    listElement.innerHTML = '<li>Không có dữ liệu.</li>';
                    return;
                }
                items.forEach(item => {
                    const li = document.createElement('li');
                    li.dataset.id = item.id;
                    li.innerHTML = `
                        <span class="item-name">${item.name}</span>
                        <div class="item-actions">
                            <button class="btn-edit" title="Sửa"><i class="fa fa-pencil"></i></button>
                            <button class="btn-delete" title="Xóa"><i class="fa fa-trash"></i></button>
                        </div>
                    `;
                    listElement.appendChild(li);

                    // Gán sự kiện cho nút Sửa và Xóa
                    li.querySelector('.btn-edit').addEventListener('click', () => handleEdit(type, item.id, item.name));
                    li.querySelector('.btn-delete').addEventListener('click', () => handleDelete(type, item.id, item.name));
                });
            }

            /**
             * Tải và hiển thị tất cả danh mục
             */
            async function loadCategories() {
                try {
                    const result = await fetchAPI('get_all', '');
                    renderList(loaiList, result.data.loaiSanPham, 'loai');
                    renderList(nhomList, result.data.nhomSanPham, 'nhom');
                } catch (error) {
                    console.error("Không thể tải danh mục:", error);
                }
            }

            /**
             * Xử lý thêm mới
             */
            async function handleAdd(type, name) {
                if (!name.trim()) {
                    alert('Tên không được để trống!');
                    return;
                }
                try {
                    await fetchAPI('add', type, { name: name });
                    loadCategories(); // Tải lại danh sách
                } catch (error) {
                    console.error(`Không thể thêm ${type}:`, error);
                }
            }

            /**
             * Xử lý sửa
             */
            async function handleEdit(type, id, oldName) {
                const newName = prompt(`Nhập tên mới cho "${oldName}":`, oldName);
                if (newName && newName.trim() !== '' && newName !== oldName) {
                    try {
                        await fetchAPI('update', type, { id: id, name: newName });
                        loadCategories();
                    } catch (error) {
                        console.error(`Không thể sửa ${type}:`, error);
                    }
                }
            }

            /**
             * Xử lý xóa
             */
            async function handleDelete(type, id, name) {
                if (confirm(`Bạn có chắc muốn xóa "${name}"? \nLưu ý: Hành động này có thể ảnh hưởng đến các sản phẩm đang liên kết.`)) {
                    try {
                        await fetchAPI('delete', type, { id: id });
                        loadCategories();
                    } catch (error) {
                        console.error(`Không thể xóa ${type}:`, error);
                    }
                }
            }

            // Lắng nghe sự kiện submit form
            loaiForm.addEventListener('submit', (e) => {
                e.preventDefault();
                handleAdd('loai', loaiInput.value);
                loaiInput.value = '';
            });

            nhomForm.addEventListener('submit', (e) => {
                e.preventDefault();
                handleAdd('nhom', nhomInput.value);
                nhomInput.value = '';
            });

            // Tải dữ liệu lần đầu
            loadCategories();
        });
    </script>
</body>

</html>