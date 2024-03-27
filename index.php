<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login_account.php');
    exit(); 
}


if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login_account.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chính</title>
    <link rel="stylesheet" href="">
    <style>
        <?php
        include 'style.php';
        ?>
    </style>
   
</head>
<body>
    
    <header>
        <h1>QUẢN LÝ NHÂN SỰ</h1>
        <div class="user-info">
            <p>Xin chào, <?php echo $_SESSION['username']; ?>!</p>
            <form action="" method="POST">
                <input type="submit" name="logout" value="Đăng xuất">
            </form>
        </div>
        <?php
           if ($_SESSION['role'] == 'admin') {
            echo '<button onclick="location.href=\'add_nhanvien.php\'" style="background-image: url(\'images/\'); background-repeat: no-repeat; background-position: left center; padding-left: 20px;">Thêm nhân viên</button>';
        }
        
        ?>
    </header>

    <h2>THÔNG TIN NHÂN VIÊN</h2>

    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
            <?php
            if ($_SESSION['role'] == 'admin') {
                echo '<th>Tùy Chỉnh</th>';
            }
            ?>
        </tr>
        
        <?php
        include 'config/connect.php';

        $results_per_page = 5;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $start_from = ($page - 1) * $results_per_page;

        $sql = "SELECT NHANVIEN.Ma_NV, Ten_NV, Phai, Noi_Sinh, Ten_Phong, Luong
                FROM NHANVIEN
                JOIN PHONGBAN ON NHANVIEN.Ma_Phong = PHONGBAN.Ma_Phong
                LIMIT $start_from, $results_per_page";

        $result = $conn->query($sql);

        function displayEmployeeRow($row) {
            echo "<tr>";
            echo "<td>{$row['Ma_NV']}</td>";
            echo "<td>{$row['Ten_NV']}</td>";
            echo "<td><img src='images/";
            echo ($row['Phai'] == 'NU') ? 'woman.jpg' : 'man.jpg';
            echo "' alt='{$row['Phai']}'></td>";
            echo "<td>{$row['Noi_Sinh']}</td>";
            echo "<td>{$row['Ten_Phong']}</td>";
            echo "<td>{$row['Luong']}</td>";
            
            if ($_SESSION['role'] == 'admin') {
                echo "<td>";
                echo "<a href='edit_nhanvien.php?id={$row['Ma_NV']}'><img src='images/edit.png' alt='Edit'></a> | ";
                echo "<a href='delete_nhanvien.php?id={$row['Ma_NV']}'><img src='images/bin.png' alt='Delete'></a>";
                echo "</td>";
            }
        
            echo "</tr>";
        }
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                displayEmployeeRow($row);
            }
        } else {
            echo "Không có dữ liệu!";
        }
        

        $conn->close();
        ?>
    </table>

    <?php
        // chia trang
        include 'phantrang.php';
    ?>

</body>
</html>
