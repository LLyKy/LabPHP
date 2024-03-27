<?php
session_start();
include 'config/connect.php'; // Kết nối đến cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $username = $_POST['username'];
    $password = $_POST['password']; // Bạn cần mã hóa mật khẩu ở đây

    // Kiểm tra xem tài khoản và mật khẩu có khớp không
    $check_user_query = "SELECT * FROM User WHERE username='$username' AND password='$password' LIMIT 1";
    $result = $conn->query($check_user_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // Nếu thông tin đăng nhập đúng
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        header('location: index.php'); // Chuyển hướng đến trang index.php
    } else {
        echo "Sai username or password !!";
    }
}
?>
<!-- Biểu mẫu HTML cho trang đăng nhập -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

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

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
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
  
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form action="login_account.php" method="POST">
            <label for="username">Tên đăng nhập:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Mật khẩu:</label><br>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Đăng nhập">
        </form>
    </div>
</body>
</html>
