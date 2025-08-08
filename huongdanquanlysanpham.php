<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hướng Dẫn Sử Dụng Hệ Thống Quản Lý Sản Phẩm</title>
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
        font-size: 16px;
        line-height: 1.6;
        color: var(--text-color);
    }

    .container {
        max-width: 960px;
        margin: auto;
        background-color: #fff;
        padding: 30px;
        border-radius: var(--border-radius);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
    }

    h1,
    h2,
    h3,
    h4 {
        color: var(--dark-gray);
        margin-top: 1.5em;
        margin-bottom: 0.8em;
    }

    h1 {
        font-size: 2.5em;
        text-align: center;
        color: var(--primary-color);
        margin-bottom: 1em;
    }

    h2 {
        font-size: 2em;
        border-bottom: 2px solid var(--medium-gray);
        padding-bottom: 10px;
        margin-bottom: 1em;
        color: var(--primary-color);
    }

    h3 {
        font-size: 1.5em;
        color: var(--dark-gray);
    }

    p {
        margin-bottom: 1em;
    }

    ol,
    ul {
        margin-bottom: 1em;
        padding-left: 20px;
    }

    ol li,
    ul li {
        margin-bottom: 0.5em;
    }

    strong {
        color: var(--primary-color);
    }

    hr {
        border: 0;
        border-top: 1px solid var(--medium-gray);
        margin: 2em 0;
    }

    /* Guidance Section Styling */
    .guidance-section {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .guidance-section h2 {
        color: var(--primary-color);
        margin-top: 0;
        margin-bottom: 15px;
        border-bottom: none;
        padding-bottom: 0;
    }

    .form-example-container {
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-top: 20px;
        background-color: var(--light-gray);
    }

    .form-example-container h3 {
        margin-top: 0;
        color: var(--dark-gray);
        margin-bottom: 20px;
    }

    .form-grid-example {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group-example {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .form-group-example label {
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-color);
        font-size: 0.9em;
        /* Smaller label font size for clarity */
    }

    .form-group-example input,
    .form-group-example select {
        padding: 8px 12px;
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
        width: 100%;
        box-sizing: border-box;
        font-size: 1em;
    }

    .form-group-example .tooltip-text {
        visibility: hidden;
        width: 200px;
        /* Increased width for better text flow */
        background-color: var(--dark-gray);
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 5px 10px;
        /* Added horizontal padding */
        position: absolute;
        z-index: 10;
        /* Increased z-index */
        bottom: 125%;
        left: 50%;
        margin-left: -100px;
        /* Half of new width */
        opacity: 0;
        transition: opacity 0.3s;
        font-size: 0.85em;
        /* Slightly larger tooltip text */
        line-height: 1.4;
    }

    .form-group-example .tooltip-text::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: var(--dark-gray) transparent transparent transparent;
    }

    .form-group-example:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }

    .action-button-example {
        background-color: var(--primary-color);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-size: 1em;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 15px;
        /* Added margin-top for separation */
    }

    .action-button-example.success {
        background-color: var(--success-color);
    }

    .input-with-button-example {
        display: flex;
        gap: 5px;
    }

    .input-with-button-example select {
        flex-grow: 1;
    }

    .add-option-btn-example {
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        background-color: var(--success-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1.2em;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tabs-example {
        display: flex;
        flex-wrap: wrap;
        /* Allow tabs to wrap on smaller screens */
        border-bottom: 1px solid var(--medium-gray);
        margin-bottom: 15px;
    }

    .tab-link-example {
        padding: 10px 15px;
        cursor: pointer;
        border: 1px solid transparent;
        border-bottom: none;
        color: var(--text-color);
        white-space: nowrap;
        /* Prevent tab names from breaking */
    }

    .tab-link-example.active {
        border-color: var(--medium-gray);
        border-bottom-color: white;
        font-weight: 500;
        background-color: white;
        border-radius: 4px 4px 0 0;
        margin-bottom: -1px;
    }

    .tab-content-example {
        display: none;
        padding-top: 15px;
    }

    .tab-content-example.active {
        display: block;
    }

    .attribute-manager-grid-example {
        display: grid;
        grid-template-columns: 1fr;
        /* Stack columns on mobile */
        gap: 20px;
        min-height: 30vh;
    }

    @media (min-width: 768px) {

        /* Two columns on larger screens */
        .attribute-manager-grid-example {
            grid-template-columns: 200px 1fr;
        }
    }

    .attributes-list-example,
    .options-container-example {
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
        padding: 15px;
        background-color: white;
        overflow-y: auto;
    }

    .attributes-list-example ul,
    .options-list-example ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .attributes-list-item-example,
    .options-list-item-example {
        padding: 8px 12px;
        border-radius: var(--border-radius);
        cursor: pointer;
        margin-bottom: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .attributes-list-item-example:hover,
    .options-list-item-example:hover {
        background-color: var(--light-gray);
    }

    .attributes-list-item-example.active {
        background-color: var(--primary-color);
        color: white;
        font-weight: 500;
    }

    .options-list-item-example input {
        flex-grow: 1;
        border: 1px solid var(--medium-gray);
        padding: 6px 10px;
        border-radius: 4px;
    }

    .options-list-item-example .option-actions-example {
        display: flex;
        gap: 5px;
        margin-left: 10px;
    }

    .option-actions-example button {
        background: none;
        border: none;
        font-size: 1.1em;
        cursor: pointer;
        padding: 5px;
    }

    .add-item-form-example {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid var(--medium-gray);
        flex-wrap: wrap;
        /* Allow form items to wrap */
    }

    .add-item-form-example input {
        flex-grow: 1;
        padding: 8px 12px;
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
    }

    .add-item-form-example button {
        flex-shrink: 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 600px) {
        body {
            padding: 10px;
            font-size: 14px;
        }

        .container {
            padding: 15px;
        }

        h1 {
            font-size: 2em;
        }

        h2 {
            font-size: 1.5em;
        }

        h3 {
            font-size: 1.2em;
        }

        .form-grid-example {
            grid-template-columns: 1fr;
            /* Single column on small screens */
        }

        .form-group-example .tooltip-text {
            width: 150px;
            margin-left: -75px;
            font-size: 0.8em;
        }

        .action-button-example {
            width: 100%;
            /* Full width buttons on small screens */
            justify-content: center;
        }

        .add-item-form-example {
            flex-direction: column;
            /* Stack add item form elements */
        }

        .add-item-form-example input,
        .add-item-form-example button {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fa fa-book"></i> Hướng Dẫn Sử Dụng Hệ Thống Quản Lý Sản Phẩm</h1>
        <p>Hệ thống này giúp bạn quản lý các **sản phẩm gốc** và **biến thể sản phẩm** (sản phẩm chi tiết) của mình,
            cùng với các thông tin liên quan như nhóm sản phẩm, loại phân loại, thuộc tính, đơn vị tính và quy đổi đơn
            vị.</p>

        <hr>

        <div class="guidance-section">
            <h2>1. 📊 Tổng Quan Giao Diện Chính</h2>
            <p>Khi truy cập trang, bạn sẽ thấy một bảng chính hiển thị danh sách các **sản phẩm chi tiết (biến thể)**.
                Phía trên bảng là các công cụ lọc và nút chức năng.</p>
            <ul>
                <li><strong>Bộ lọc</strong>:
                    <ul>
                        <li><strong>Nhóm SP</strong>: Lọc sản phẩm theo nhóm (ví dụ: Gối đỡ, Cùm).</li>
                        <li><strong>Loại Phân Loại</strong>: Lọc sản phẩm theo loại phân loại (ví dụ: Inox, Thép).</li>
                        <li><strong>Tìm kiếm</strong>: Tìm kiếm theo Mã SKU, tên biến thể hoặc tên sản phẩm gốc.</li>
                        <li><strong>Xóa Lọc</strong>: Xóa tất cả các điều kiện lọc hiện có.</li>
                    </ul>
                </li>
                <li><strong>Nút chức năng</strong>:
                    <ul>
                        <li><strong>Xóa đã chọn</strong>: Xóa các biến thể được chọn trong bảng (chỉ hiển thị khi có
                            biến thể được chọn).</li>
                        <li><strong>Quản lý Dữ liệu</strong>: Mở cửa sổ quản lý các dữ liệu chung của hệ thống (thuộc
                            tính, loại sản phẩm, nhóm sản phẩm, đơn vị tính, quy đổi đơn vị).</li>
                        <li><strong>Thêm SP Gốc</strong>: Mở cửa sổ để thêm hoặc chỉnh sửa thông tin sản phẩm gốc.</li>
                        <li><strong>Thêm SP Chi tiết</strong>: Mở cửa sổ để thêm hoặc chỉnh sửa thông tin biến thể sản
                            phẩm.</li>
                    </ul>
                </li>
            </ul>
        </div>

        <hr>

        <div class="guidance-section">
            <h2>2. ➕ Thêm / Chỉnh Sửa Sản Phẩm Gốc</h2>
            <p>Sản phẩm gốc (Product) là khái niệm tổng quát cho một dòng sản phẩm, ví dụ "Gối đỡ đế vuông". Mỗi sản
                phẩm gốc có thể có nhiều biến thể (ví dụ: Gối đỡ đế vuông phi 20, Gối đỡ đế vuông phi 25).</p>
            <p>Để thêm hoặc chỉnh sửa sản phẩm gốc:</p>
            <ol>
                <li>Nhấp vào nút <strong>"Thêm SP Gốc"</strong> để mở form.</li>
                <li>Điền các thông tin sau vào form:</li>
            </ol>

            <div class="form-example-container">
                <h3>Form Thêm/Chỉnh Sửa Sản Phẩm Gốc</h3>
                <div class="form-grid-example">
                    <div class="form-group-example">
                        <label>Tên Sản phẩm gốc</label>
                        <input type="text" placeholder="Ví dụ: Gối đỡ đế vuông">
                        <span class="tooltip-text">Tên chung của dòng sản phẩm.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Mã Gốc (Base SKU)</label>
                        <input type="text" placeholder="Ví dụ: GDV">
                        <span class="tooltip-text">Mã định danh cơ bản của sản phẩm.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Tiền tố Mã (SKU Prefix)</label>
                        <input type="text" placeholder="Ví dụ: GDV-">
                        <span class="tooltip-text">Tiền tố này sẽ được thêm vào SKU của các biến thể.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Tiền tố Tên (Name Prefix)</label>
                        <input type="text" placeholder="Ví dụ: Gối đỡ đế vuông">
                        <span class="tooltip-text">Tiền tố này sẽ được thêm vào tên của các biến thể.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Nhóm Sản phẩm</label>
                        <select>
                            <option value="">-- Chọn --</option>
                            <option>Gối đỡ</option>
                            <option>Cùm</option>
                        </select>
                        <span class="tooltip-text">Phân loại sản phẩm gốc vào một nhóm cụ thể.</span>
                    </div>
                </div>
                <button class="action-button-example">Lưu</button>
            </div>
            <ol start="3">
                <li>Nhấp vào nút <strong>"Lưu"</strong> để lưu thông tin sản phẩm gốc.</li>
            </ol>
        </div>

        <hr>

        <div class="guidance-section">
            <h2>3. 📝 Thêm / Chỉnh Sửa Sản Phẩm Chi Tiết (Biến Thể)</h2>
            <p>Sản phẩm chi tiết (Variant) là một phiên bản cụ thể của sản phẩm gốc, với các thuộc tính và giá trị riêng
                biệt (ví dụ: Gối đỡ đế vuông có đường kính trong 20mm, độ dày 5mm, bản rộng 30mm).</p>
            <p>Để thêm hoặc chỉnh sửa sản phẩm chi tiết:</p>
            <ol>
                <li>Để thêm mới: Nhấp vào nút <strong>"Thêm SP Chi tiết"</strong>.</li>
                <li>Để chỉnh sửa: Nhấp vào biểu tượng <i class="fa-solid fa-edit action-icon icon-edit"
                        style="color: var(--warning-color);"></i> trên hàng của biến thể bạn muốn sửa trong bảng chính.
                </li>
                <li>Điền các thông tin sau vào form:</li>
            </ol>

            <div class="form-example-container">
                <h3>Form Thêm/Chỉnh Sửa Sản Phẩm Chi Tiết</h3>
                <div class="form-grid-example">
                    <div class="form-group-example">
                        <label>Sản phẩm gốc (*)</label>
                        <select>
                            <option value="">-- Chọn --</option>
                            <option>Gối đỡ đế vuông</option>
                            <option>Cùm U</option>
                        </select>
                        <span class="tooltip-text">Chọn sản phẩm gốc mà biến thể này thuộc về.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Tên Biến Thể</label>
                        <input type="text" placeholder="Tự động đề xuất">
                        <span class="tooltip-text">Tên đầy đủ của biến thể, thường được tạo tự động dựa trên sản phẩm
                            gốc và thuộc tính.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Mã Biến Thể (SKU)</label>
                        <input type="text" placeholder="Tự động đề xuất">
                        <span class="tooltip-text">Mã SKU duy nhất cho biến thể, thường được tạo tự động dựa trên sản
                            phẩm gốc và thuộc tính.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Giá Gốc</label>
                        <input type="number" value="0">
                        <span class="tooltip-text">Giá bán của biến thể sản phẩm.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Loại Phân Loại</label>
                        <select>
                            <option value="">-- Chọn --</option>
                            <option>Inox 304</option>
                            <option>Thép</option>
                        </select>
                        <span class="tooltip-text">Phân loại phụ cho biến thể (ví dụ: chất liệu).</span>
                    </div>
                </div>
                <hr style="margin: 15px 0;">
                <h4 style="margin-bottom: 15px;">Các thuộc tính</h4>
                <div class="form-grid-example">
                    <div class="form-group-example">
                        <label>Độ dày</label>
                        <div class="input-with-button-example">
                            <select>
                                <option value="">-- Không chọn --</option>
                                <option>5mm</option>
                                <option>10mm</option>
                            </select>
                            <button type="button" class="add-option-btn-example" title="Thêm tùy chọn mới">+</button>
                        </div>
                        <span class="tooltip-text">Chọn hoặc thêm giá trị độ dày. Nhấn '+' để thêm tùy chọn mới.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Bản rộng</label>
                        <div class="input-with-button-example">
                            <select>
                                <option value="">-- Không chọn --</option>
                                <option>30mm</option>
                                <option>40mm</option>
                            </select>
                            <button type="button" class="add-option-btn-example" title="Thêm tùy chọn mới">+</button>
                        </div>
                        <span class="tooltip-text">Chọn hoặc thêm giá trị bản rộng. Nhấn '+' để thêm tùy chọn
                            mới.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Đường kính trong</label>
                        <div class="input-with-button-example">
                            <select>
                                <option value="">-- Không chọn --</option>
                                <option>20mm</option>
                                <option>25mm</option>
                            </select>
                            <button type="button" class="add-option-btn-example" title="Thêm tùy chọn mới">+</button>
                        </div>
                        <span class="tooltip-text">Chọn hoặc thêm giá trị đường kính trong. Nhấn '+' để thêm tùy chọn
                            mới.</span>
                    </div>
                    <div class="form-group-example">
                        <label>ID Thông Số</label>
                        <div class="input-with-button-example">
                            <select>
                                <option value="">-- Không chọn --</option>
                                <option>PN20</option>
                                <option>PN25</option>
                            </select>
                            <button type="button" class="add-option-btn-example" title="Thêm tùy chọn mới">+</button>
                        </div>
                        <span class="tooltip-text">Chọn hoặc thêm giá trị ID Thông Số. Nhấn '+' để thêm tùy chọn
                            mới.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Nguồn gốc</label>
                        <div class="input-with-button-example">
                            <select>
                                <option value="">-- Không chọn --</option>
                                <option>Việt Nam</option>
                                <option>Trung Quốc</option>
                            </select>
                            <button type="button" class="add-option-btn-example" title="Thêm tùy chọn mới">+</button>
                        </div>
                        <span class="tooltip-text">Chọn hoặc thêm giá trị Nguồn gốc. Nhấn '+' để thêm tùy chọn
                            mới.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Xử lý bề mặt</label>
                        <div class="input-with-button-example">
                            <select>
                                <option value="">-- Không chọn --</option>
                                <option>Mạ kẽm</option>
                                <option>Sơn tĩnh điện</option>
                            </select>
                            <button type="button" class="add-option-btn-example" title="Thêm tùy chọn mới">+</button>
                        </div>
                        <span class="tooltip-text">Chọn hoặc thêm giá trị Xử lý bề mặt. Nhấn '+' để thêm tùy chọn
                            mới.</span>
                    </div>
                </div>
                <button class="action-button-example success">Lưu Biến Thể</button>
            </div>
            <ol start="4">
                <li>Nhấp vào nút <strong>"Lưu Biến Thể"</strong> để lưu thông tin.</li>
            </ol>
        </div>

        <hr>

        <div class="guidance-section">
            <h2>4. 📦 Quản Lý Tồn Kho</h2>
            <p>Bạn có thể cập nhật số lượng tồn kho cho từng biến thể sản phẩm.</p>
            <ol>
                <li>Trong bảng chính, nhấp vào biểu tượng <i
                        class="fa-solid fa-boxes-packing action-icon icon-inventory"
                        style="color: var(--info-color);"></i> trên hàng của biến thể bạn muốn quản lý tồn kho.</li>
                <li>Một cửa sổ sẽ hiển thị với các trường nhập liệu cho từng đơn vị tính (ví dụ: "Thùng" và "Cái").</li>
            </ol>

            <div class="form-example-container">
                <h3>Form Quản Lý Tồn Kho</h3>
                <p>Nhập số lượng mới theo từng đơn vị tính.</p>
                <div class="form-grid-example">
                    <div class="form-group-example">
                        <label>Thùng</label>
                        <input type="number" value="0">
                        <span class="tooltip-text">Số lượng theo đơn vị tính lớn hơn (nếu có quy đổi).</span>
                    </div>
                    <div class="form-group-example">
                        <label>Cái (Đơn vị cơ sở)</label>
                        <input type="number" value="0">
                        <span class="tooltip-text">Số lượng theo đơn vị tính cơ sở.</span>
                    </div>
                    <div class="form-group-example">
                        <label>Định mức tồn kho tối thiểu (Cái)</label>
                        <input type="number" value="0">
                        <span class="tooltip-text">Mức tồn kho tối thiểu mong muốn cho biến thể này.</span>
                    </div>
                </div>
                <button class="action-button-example success">Lưu Tồn Kho</button>
            </div>
            <ol start="3">
                <li>Nhấp vào nút <strong>"Lưu Tồn Kho"</strong> để cập nhật.</li>
            </ol>
            <p>Hệ thống sẽ tự động tính toán tổng số lượng tồn kho dựa trên quy tắc quy đổi đơn vị đã thiết lập.</p>
        </div>

        <hr>

        <div class="guidance-section">
            <h2>5. 🗃️ Quản Lý Dữ Liệu Chung</h2>
            <p>Phần này cho phép bạn quản lý các danh mục dữ liệu được sử dụng xuyên suốt hệ thống, bao gồm thuộc tính,
                loại sản phẩm, nhóm sản phẩm, đơn vị tính và quy đổi đơn vị.</p>
            <ol>
                <li>Nhấp vào nút <strong>"Quản lý Dữ liệu"</strong> để mở cửa sổ quản lý.</li>
                <li>Chọn một trong các tab sau:</li>
            </ol>

            <div class="form-example-container">
                <h3>Cửa Sổ Quản Lý Dữ Liệu Chung</h3>
                <div class="tabs-example">
                    <span class="tab-link-example active">Thuộc tính</span>
                    <span class="tab-link-example">Loại Sản phẩm</span>
                    <span class="tab-link-example">Nhóm Sản phẩm</span>
                    <span class="tab-link-example">Đơn vị tính</span>
                    <span class="tab-link-example">Quy đổi Đơn vị</span>
                </div>
                <div class="tab-content-example active">
                    <h4>Quản lý Thuộc tính và Tùy chọn</h4>
                    <div class="attribute-manager-grid-example">
                        <div class="attributes-list-example">
                            <h3>Loại thuộc tính</h3>
                            <ul>
                                <li class="attributes-list-item-example active">Độ dày</li>
                                <li class="attributes-list-item-example">Bản rộng</li>
                                <li class="attributes-list-item-example">Đường kính trong</li>
                                <li class="attributes-list-item-example">Kích thước ren</li>
                                <li class="attributes-list-item-example">Nguồn gốc</li>
                                <li class="attributes-list-item-example">Xử lý bề mặt</li>
                                <li class="attributes-list-item-example">ID Thông Số</li>
                            </ul>
                        </div>
                        <div class="options-container-example">
                            <h3 id="options-title-example">Các tùy chọn cho: Độ dày</h3>
                            <ul class="options-list-example">
                                <li class="options-list-item-example">
                                    <input type="text" value="5mm">
                                    <div class="option-actions-example">
                                        <button title="Lưu"><i class="fa fa-save icon-save"
                                                style="color: var(--primary-color);"></i></button>
                                        <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                                style="color: var(--danger-color);"></i></button>
                                    </div>
                                </li>
                                <li class="options-list-item-example">
                                    <input type="text" value="10mm">
                                    <div class="option-actions-example">
                                        <button title="Lưu"><i class="fa fa-save icon-save"
                                                style="color: var(--primary-color);"></i></button>
                                        <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                                style="color: var(--danger-color);"></i></button>
                                    </div>
                                </li>
                            </ul>
                            <form class="add-item-form-example">
                                <input type="text" placeholder="Nhập giá trị tùy chọn mới" required>
                                <button type="submit" class="action-button-example success">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-content-example" id="types-example">
                    <h4>Quản lý Loại Sản phẩm</h4>
                    <div class="data-item-list-container-example">
                        <ul class="data-item-list-example">
                            <li class="data-item-example">
                                <input type="text" value="Inox 304">
                                <div class="item-actions-example">
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </div>
                            </li>
                            <li class="data-item-example">
                                <input type="text" value="Thép">
                                <div class="item-actions-example">
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </div>
                            </li>
                        </ul>
                        <form class="add-item-form-example">
                            <input type="text" placeholder="Nhập tên loại mới" required>
                            <button type="submit" class="action-button-example success">Thêm</button>
                        </form>
                    </div>
                </div>
                <div class="tab-content-example" id="groups-example">
                    <h4>Quản lý Nhóm Sản phẩm</h4>
                    <div class="data-item-list-container-example">
                        <ul class="data-item-list-example">
                            <li class="data-item-example">
                                <input type="text" value="Gối đỡ">
                                <div class="item-actions-example">
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </div>
                            </li>
                            <li class="data-item-example">
                                <input type="text" value="Cùm">
                                <div class="item-actions-example">
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </div>
                            </li>
                        </ul>
                        <form class="add-item-form-example">
                            <input type="text" placeholder="Nhập tên nhóm mới" required>
                            <button type="submit" class="action-button-example success">Thêm</button>
                        </form>
                    </div>
                </div>
                <div class="tab-content-example" id="units-example">
                    <h4>Quản lý Đơn vị tính</h4>
                    <div class="data-item-list-container-example">
                        <ul class="data-item-list-example">
                            <li class="data-item-example">
                                <input type="text" value="Cái">
                                <div class="item-actions-example">
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </div>
                            </li>
                            <li class="data-item-example">
                                <input type="text" value="Thùng">
                                <div class="item-actions-example">
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </div>
                            </li>
                            <li class="data-item-example">
                                <input type="text" value="Mét">
                                <div class="item-actions-example">
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </div>
                            </li>
                        </ul>
                        <form class="add-item-form-example">
                            <input type="text" placeholder="Nhập tên đơn vị mới" required>
                            <button type="submit" class="action-button-example success">Thêm</button>
                        </form>
                    </div>
                </div>
                <div class="tab-content-example" id="conversions-example">
                    <h4>Quy tắc Quy đổi Đơn vị</h4>
                    <table class="tabulator-example">
                        <thead class="tabulator-header-example">
                            <tr>
                                <th>Sản phẩm gốc</th>
                                <th>Quy tắc</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Gối đỡ đế vuông</td>
                                <td>1 Thùng = <input type="number" value="100" style="width: 60px;"> Cái</td>
                                <td>
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cùm U</td>
                                <td>1 Mét = <input type="number" value="50" style="width: 60px;"> Cái</td>
                                <td>
                                    <button title="Lưu"><i class="fa fa-save icon-save"
                                            style="color: var(--primary-color);"></i></button>
                                    <button title="Xóa"><i class="fa fa-trash-can icon-delete"
                                            style="color: var(--danger-color);"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form id="add-conversion-form-example" class="add-item-form-example">
                        <h4>Thêm quy tắc mới</h4>
                        <div class="form-grid-example">
                            <div class="form-group-example">
                                <label>Sản phẩm gốc</label>
                                <select>
                                    <option value="">-- Chọn SP Gốc --</option>
                                    <option>Gối đỡ đế vuông</option>
                                    <option>Cùm U</option>
                                </select>
                            </div>
                            <div class="form-group-example">
                                <label>Đơn vị lớn</label>
                                <select>
                                    <option value="">-- Chọn Đơn vị --</option>
                                    <option>Thùng</option>
                                    <option>Mét</option>
                                </select>
                            </div>
                            <div class="form-group-example">
                                <label>Đơn vị nhỏ</label>
                                <select>
                                    <option value="">-- Chọn Đơn vị --</option>
                                    <option>Cái</option>
                                </select>
                            </div>
                            <div class="form-group-example">
                                <label>Hệ số quy đổi</label>
                                <input type="number" placeholder="Ví dụ: 100" required>
                            </div>
                        </div>
                        <button type="submit" class="action-button-example">Lưu quy tắc</button>
                    </form>
                </div>
            </div>
            <p><strong>Lưu ý:</strong> Khi bạn chỉnh sửa giá trị trong danh sách, hãy nhấp vào biểu tượng <i
                    class="fa fa-save icon-save" style="color: var(--primary-color);"></i> để lưu thay đổi.</p>
        </div>

        <hr>

        <div class="guidance-section">
            <h2>6. 🗑️ Xóa Sản Phẩm Chi Tiết</h2>
            <p>Bạn có thể xóa một hoặc nhiều biến thể sản phẩm cùng lúc.</p>
            <ol>
                <li><strong>Để xóa một biến thể</strong>: Biểu tượng xóa không có sẵn trên mỗi hàng trong bảng chính.
                    Bạn cần chọn biến thể đó.</li>
                <li><strong>Để xóa nhiều biến thể</strong>:
                    <ul>
                        <li>Chọn các hàng biến thể bạn muốn xóa bằng cách nhấp vào ô kiểm ở cột đầu tiên của mỗi hàng.
                        </li>
                        <li>Khi có biến thể được chọn, nút <strong>"Xóa đã chọn"</strong> sẽ xuất hiện ở góc trên bên
                            phải của bảng, hiển thị số lượng mục đã chọn (ví dụ: "Xóa (3) mục").</li>
                        <li>Nhấp vào nút <strong>"Xóa đã chọn"</strong>. Một hộp thoại xác nhận sẽ hiện ra.</li>
                        <li>Xác nhận việc xóa để hoàn tất.</li>
                    </ul>
                </li>
            </ol>
        </div>

        <hr>

        <div class="guidance-section">
            <h2>7. 🔔 Thông Báo (Toast)</h2>
            <p>Hệ thống sử dụng các thông báo "toast" nhỏ gọn ở cuối màn hình để thông báo về các thao tác thành công
                hoặc lỗi (ví dụ: "Lưu biến thể thành công!", "Đã xóa!").</p>
        </div>

    </div>

    <script>
    // JavaScript để chuyển đổi tab trong phần "Quản lý Dữ liệu Chung"
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.tabs-example .tab-link-example');
        const tabContents = document.querySelectorAll('.form-example-container .tab-content-example');

        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all tab links and contents
                tabLinks.forEach(item => item.classList.remove('active'));
                tabContents.forEach(item => item.classList.remove('active'));

                // Add active class to the clicked tab link
                this.classList.add('active');

                // Get the ID of the target content tab
                const targetTabId = this.textContent.trim().replace(/\s/g, '-').toLowerCase() +
                    '-example';
                const targetContent = document.getElementById(targetTabId);

                // Add active class to the corresponding content tab
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });

        // Set initial active tab (default to 'Thuộc tính')
        const initialTab = document.querySelector('.tabs-example .tab-link-example.active');
        if (initialTab) {
            const initialTargetId = initialTab.textContent.trim().replace(/\s/g, '-').toLowerCase() +
            '-example';
            const initialContent = document.getElementById(initialTargetId);
            if (initialContent) {
                initialContent.classList.add('active');
            }
        } else { // Fallback if no active class is initially set, activate the first one
            if (tabLinks.length > 0) {
                tabLinks[0].classList.add('active');
                const firstTabTargetId = tabLinks[0].textContent.trim().replace(/\s/g, '-').toLowerCase() +
                    '-example';
                const firstTabContent = document.getElementById(firstTabTargetId);
                if (firstTabContent) {
                    firstTabContent.classList.add('active');
                }
            }
        }
    });
    </script>
</body>

</html>