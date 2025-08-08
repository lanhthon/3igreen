<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm (Master-Detail)</title>
    <link href="https://unpkg.com/tabulator-tables@5.6.0/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    /* ... CSS giữ nguyên như file trước ... */
    :root {
        --primary-color: #007bff;
        --success-color: #28a745;
        --light-gray: #f8f9fa;
        --medium-gray: #dee2e6;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
        padding: 20px;
        background-color: var(--light-gray);
    }

    .container {
        max-width: 98%;
        margin: auto;
    }

    .expand-icon {
        cursor: pointer;
        color: var(--primary-color);
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .expand-icon.expanded {
        transform: rotate(90deg);
    }

    .sub-table-container {
        padding: 15px 15px 15px 45px;
        background-color: #fdfdff;
        border-top: 1px solid #e9ecef;
        display: none;
    }

    .action-button {
        padding: 5px 10px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
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
        border-radius: 8px;
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
    }

    .form-section-title {
        grid-column: 1 / -1;
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
        background-color: #343a40;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 16px;
        position: fixed;
        z-index: 2000;
        left: 50%;
        bottom: 30px;
    }

    #toast.show {
        visibility: visible;
        opacity: 1;
        transition: opacity 0.5s;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fa fa-cubes"></i> Quản Lý Sản Phẩm (Tổng quan & Chi tiết)</h1>
        <div id="product-master-table"></div>
    </div>

    <div id="variant-detail-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Chi Tiết Biến Thể Sản Phẩm</h2>
                <span class="close-btn">&times;</span>
            </div>
            <form id="variant-detail-form">
                <input type="hidden" id="detail_BienTheID" name="BienTheID">
                <div class="form-grid">
                    <div class="form-section-title">1. Thông tin chung</div>
                    <div class="form-group">
                        <label for="detail_MaHang">Mã Hàng (SKU)</label>
                        <input type="text" id="detail_MaHang" name="MaHang" required>
                    </div>
                    <div class="form-group">
                        <label for="detail_TenBienThe">Tên Biến Thể</label>
                        <input type="text" id="detail_TenBienThe" name="TenBienThe" required>
                    </div>
                    <div class="form-group">
                        <label for="detail_GiaGoc">Giá Gốc</label>
                        <input type="number" id="detail_GiaGoc" name="GiaGoc" step="1">
                    </div>
                    <div class="form-group">
                        <label for="detail_DonViTinh">Đơn Vị Tính</label>
                        <input type="text" id="detail_DonViTinh" name="DonViTinh">
                    </div>
                    <div class="form-group">
                        <label for="detail_SoLuongTonKho">Tồn Kho</label>
                        <input type="number" id="detail_SoLuongTonKho" name="SoLuongTonKho">
                    </div>

                    <div class="form-section-title">2. Thuộc tính chi tiết</div>
                    <div class="form-group">
                        <label for="detail_attribute_ID_ThongSo">ID Thông Số</label>
                        <input type="text" id="detail_attribute_ID_ThongSo" name="attributes[ID_ThongSo]">
                    </div>
                    <div class="form-group">
                        <label for="detail_attribute_DoDay">Độ Dày (mm)</label>
                        <input type="text" id="detail_attribute_DoDay" name="attributes[DoDay]">
                    </div>
                    <div class="form-group">
                        <label for="detail_attribute_BanRong">Bản Rộng (mm)</label>
                        <input type="text" id="detail_attribute_BanRong" name="attributes[BanRong]">
                    </div>
                    <div class="form-group">
                        <label for="detail_attribute_KichThuocRen">Kích Thước Ren</label>
                        <input type="text" id="detail_attribute_KichThuocRen" name="attributes[KichThuocRen]">
                    </div>
                    <div class="form-group">
                        <label for="detail_attribute_HinhDang">Hình Dạng</label>
                        <input type="text" id="detail_attribute_HinhDang" name="attributes[HinhDang]">
                    </div>
                    <div class="form-group">
                        <label for="detail_attribute_XuLyBeMat">Xử lý bề mặt</label>
                        <select id="detail_attribute_XuLyBeMat" name="attributes[XuLyBeMat]">
                            <option value="">-- Mặc định --</option>
                            <option value="Mạ kẽm">Mạ kẽm</option>
                            <option value="Nhúng nóng">Nhúng nóng</option>
                            <option value="Sơn tĩnh điện">Sơn tĩnh điện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="detail_attribute_TinhTrang">Tình trạng</label>
                        <select id="detail_attribute_TinhTrang" name="attributes[TinhTrang]">
                            <option value="Mới">Mới</option>
                            <option value="Hàng cũ">Hàng cũ</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="action-button" style="background-color: var(--primary-color);"><i
                            class="fa fa-save"></i> Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast"></div>

    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.6.0/dist/js/tabulator.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Các hàm helper (fetchAPI, showToast)
        async function fetchAPI(url, options) {
            /* ... dán code fetchAPI của bạn ở đây ... */
        }

        function showToast(message, type = 'success') {
            /* ... dán code showToast của bạn ở đây ... */
        }

        // [THÊM MỚI] Hàm để điền dữ liệu vào form chi tiết
        function populateDetailForm(data) {
            const form = document.getElementById('variant-detail-form');
            form.reset();
            // Điền thông tin chính
            for (const key in data) {
                const field = form.querySelector(`#detail_${key}`);
                if (field) field.value = data[key];
            }
            // Điền thông tin thuộc tính
            if (data.attributes) {
                for (const key in data.attributes) {
                    const attrField = form.querySelector(`#detail_attribute_${key}`);
                    if (attrField) attrField.value = data.attributes[key];
                }
            }
        }

        // Định nghĩa cột cho BẢNG CON
        const subTableColumns = [{
                title: "Mã Hàng (SKU)",
                field: "MaHang",
                width: 200,
                headerSort: false
            },
            {
                title: "Tên Biến Thể",
                field: "TenBienThe",
                minWidth: 350,
                headerSort: false
            },
            {
                title: "Giá Gốc",
                field: "GiaGoc",
                width: 150,
                hozAlign: "right",
                headerSort: false,
                formatter: "money",
                formatterParams: {
                    symbol: " ₫",
                    precision: 0
                }
            },
            {
                title: "Tồn Kho",
                field: "SoLuongTonKho",
                hozAlign: "right",
                width: 120,
                headerSort: false
            }
        ];

        // Khởi tạo bảng chính (master)
        const masterTable = new Tabulator("#product-master-table", {
            height: "85vh",
            layout: "fitColumns",
            placeholder: "Đang tải dữ liệu...",
            ajaxURL: "api/get_products_nested_new.php",
            rowFormatter: function(row) {
                const subTableContainer = document.createElement("div");
                subTableContainer.classList.add("sub-table-container");
                row.getElement().appendChild(subTableContainer);
                const expandIcon = row.getCell("expand").getElement().querySelector(".expand-icon");

                expandIcon.addEventListener("click", (e) => {
                    e.stopPropagation();
                    expandIcon.classList.toggle("expanded");
                    const isExpanded = subTableContainer.style.display === "block";
                    subTableContainer.style.display = isExpanded ? "none" : "block";
                    if (!isExpanded && !subTableContainer.classList.contains(
                            "tabulator-initialized")) {
                        new Tabulator(subTableContainer, {
                            layout: "fitColumns",
                            data: row.getData()._children,
                            columns: subTableColumns,
                            // [THÊM MỚI] Sự kiện click vào dòng của bảng con
                            rowClick: async function(e, subRow) {
                                const variantData = subRow.getData();
                                const modal = document.getElementById(
                                    'variant-detail-modal');
                                modal.style.display = 'block';
                                try {
                                    const result = await fetchAPI(
                                        'api/handle_variant_new.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                action: 'get_details',
                                                id: variantData
                                                    .BienTheID
                                            })
                                        });
                                    populateDetailForm(result.data);
                                } catch (err) {
                                    // lỗi đã được xử lý bởi fetchAPI
                                }
                            }
                        });
                        subTableContainer.classList.add("tabulator-initialized");
                    }
                });
            },
            columns: [{
                    title: "",
                    field: "expand",
                    width: 40,
                    hozAlign: "center",
                    headerSort: false,
                    formatter: () => `<i class="fa fa-chevron-right expand-icon"></i>`
                },
                {
                    title: "Sản Phẩm Gốc",
                    field: "TenGoc",
                    minWidth: 400
                },
                {
                    title: "Tổng Tồn Kho",
                    field: "TongTonKho",
                    width: 180,
                    hozAlign: "right",
                    formatter: (cell) =>
                        `<strong>${cell.getValue().toLocaleString('vi-VN')}</strong>`
                },
                {
                    title: "Thao tác",
                    width: 150,
                    hozAlign: "center",
                    headerSort: false,
                    formatter: () =>
                        `<button class="action-button" style="background-color: #28a745;"><i class="fa fa-plus"></i> Thêm biến thể</button>`
                }
            ],
        });

        // [THÊM MỚI] Logic để xử lý modal
        const detailModal = document.getElementById('variant-detail-modal');
        const detailForm = document.getElementById('variant-detail-form');

        detailModal.querySelector('.close-btn').onclick = () => detailModal.style.display = 'none';
        window.onclick = (event) => {
            if (event.target == detailModal) detailModal.style.display = 'none';
        }

        detailForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const mainData = {};
            const attributes = {};

            for (const [key, value] of formData.entries()) {
                if (key.startsWith('attributes[')) {
                    const attrKey = key.slice(11, -1);
                    if (value) attributes[attrKey] = value;
                } else {
                    mainData[key] = value;
                }
            }
            const payload = {
                ...mainData,
                attributes: attributes
            };

            try {
                await fetchAPI('api/handle_variant_new.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'update',
                        data: payload
                    })
                });
                detailModal.style.display = 'none';
                masterTable.setData(); // Tải lại toàn bộ dữ liệu để cập nhật
                showToast("Cập nhật thành công!", "success");
            } catch (err) {
                // lỗi đã được xử lý bởi fetchAPI
            }
        });
    });
    </script>
</body>

</html>