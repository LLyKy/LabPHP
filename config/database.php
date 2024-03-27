<?php

include 'connect.php';

// Tạo bảng NHANVIEN
$sql_create_nhanvien = "CREATE TABLE NHANVIEN (
    Ma_NV varchar(3) PRIMARY KEY NOT NULL,
    Ten_NV varchar(100) NOT NULL,
    Phai varchar(3),
    Noi_Sinh varchar(200),
    Ma_Phong varchar(2),
    Luong int,
    FOREIGN KEY (Ma_Phong) REFERENCES PHONGBAN(Ma_Phong)
)";

if ($conn->query($sql_create_nhanvien) === TRUE) {
    echo "Bảng NHANVIEN đã được tạo thành công<br>";
} else {
    echo "Lỗi: " . $conn->error;
}

// Tạo bảng PHONGBAN
// $sql_create_phongban = "CREATE TABLE PHONGBAN (
//     Ma_Phong varchar(2) PRIMARY KEY NOT NULL,
//     Ten_Phong varchar(30) NOT NULL
// )";

// if ($conn->query($sql_create_phongban) === TRUE) {
//     echo "Bảng PHONGBAN đã được tạo thành công<br>";
// } else {
//     echo "Lỗi: " . $conn->error;
// }

// Nhập dữ liệu cho bảng NHANVIEN
$sql_insert_nhanvien = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong)
VALUES 
('A01', 'Nguyễn Thị Hải', 'NU', 'Hà Nội', 'TC', 600),
('A02', 'Trần Văn Chính', 'NAM', 'Bình Định', 'QT', 500),
('A03', 'Lê Trần Bạch Yến', 'NU', 'TP HCM', 'TC', 700),
('A04', 'Trần Anh Tuấn', 'NAM', 'Hà Nội', 'KT', 800),
('B01', 'Trần Thanh Mai', 'NU', 'Hải Phòng', 'TC', 800),
('B02', 'Trần Thị Thu Thủy', 'NU', 'TP HCM', 'KT', 700),
('B03', 'Nguyễn Thị Nở', 'NU', 'Ninh Bình', 'KT', 400)";

if ($conn->multi_query($sql_insert_nhanvien) === TRUE) {
    echo "Dữ liệu đã được nhập vào bảng NHANVIEN thành công<br>";
} else {
    echo "Lỗi: " . $conn->error;
}

// Nhập dữ liệu cho bảng PHONGBAN
// $sql_insert_phongban = "INSERT INTO PHONGBAN (Ma_Phong, Ten_Phong)
// VALUES 
// ('QT', 'Quản Trị'),
// ('TC', 'Tài Chính'),
// ('KT', 'Kỹ Thuật')";

// if ($conn->multi_query($sql_insert_phongban) === TRUE) {
//     echo "Dữ liệu đã được nhập vào bảng PHONGBAN thành công<br>";
// } else {
//     echo "Lỗi: " . $conn->error;
// }


//Tạo bảng NHANVIEN
$sql_create_user = "CREATE TABLE User (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('user', 'admin') NOT NULL
)";
if ($conn->query($sql_create_user) === TRUE) {
    echo "Bảng User đã được tạo thành công<br>";
} else {
    echo "Lỗi: " . $conn->error;
}


//Đóng kết nối
$conn->close();
