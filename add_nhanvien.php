<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập và có quyền 'admin' chưa
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Nếu không, chuyển hướng đến trang đăng nhập
    header('location: login_account.php');
    exit(); // Dừng thực thi script
}

// Kết nối CSDL
include 'config/connect.php';

// Xử lý form thêm nhân viên
if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    // Query thêm nhân viên vào CSDL
    $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
            VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', $luong)";

    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng đến trang index.php hoặc thông báo thành công
        header('location: index.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên Mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="form-container">
        <h1>Thêm Nhân Viên Mới</h1>
        <form action="" method="POST">
            <label for="ma_nv">Mã Nhân Viên:</label><br>
            <input type="text" id="ma_nv" name="ma_nv" required><br>
            
            <label for="ten_nv">Tên Nhân Viên:</label><br>
            <input type="text" id="ten_nv" name="ten_nv" required><br>
            
            <label for="phai">Giới Tính:</label><br>
            <input type="text" id="phai" name="phai" required><br>
            
            <label for="noi_sinh">Nơi Sinh:</label><br>
            <input type="text" id="noi_sinh" name="noi_sinh" required><br>
            
            <label for="ma_phong">Mã Phòng:</label><br>
            <input type="text" id="ma_phong" name="ma_phong" required><br>
            
            <label for="luong">Lương:</label><br>
            <input type="text" id="luong" name="luong" required><br><br>
            
            <input type="submit" name="submit" value="Thêm Nhân Viên">
        </form>
    </div>
</body>
</html>
