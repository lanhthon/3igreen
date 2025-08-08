<?php
// Mật khẩu người dùng nhập vào
$matKhauTuNguoiDung = '123';

// Băm mật khẩu bằng thuật toán BCRYPT (tiêu chuẩn hiện nay)
$passwordHash = password_hash($matKhauTuNguoiDung, PASSWORD_BCRYPT);

// Kết quả sẽ là một chuỗi dài, ví dụ: '$2y$10$Q7eY/eM5J.d84qZkF7nBDO7U9GzT8f26.T2b7.Vn1gK84oP8Y/f.G'
echo $passwordHash; 
?>