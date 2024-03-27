<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập và có quyền 'admin' chưa
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Nếu không, chuyển hướng đến trang đăng nhập
    header('location: login_account.php');
    exit(); // Dừng thực thi script
}

// Kiểm tra xem đã có mã nhân viên được chọn để xóa chưa
if (!isset($_GET['id'])) {
    // Nếu không, chuyển hướng đến trang index.php hoặc thông báo lỗi
    header('location: index.php');
    exit();
} else {
    // Kết nối CSDL
    include 'config/connect.php';

    // Lấy mã nhân viên từ URL
    $ma_nv = $_GET['id'];

    // Query xóa nhân viên khỏi CSDL
    $sql = "DELETE FROM NHANVIEN WHERE Ma_NV = '$ma_nv'";

    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng đến trang index.php hoặc thông báo thành công
        header('location: index.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
