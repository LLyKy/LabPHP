<?php
include 'config/connect.php';

$sql = "SELECT COUNT(*) AS total FROM NHANVIEN";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / 5);

echo "<div style='text-align: center;'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='index.php?page=".$i."' style='display: inline-block; padding: 8px 16px; text-decoration: none; color: #007bff; border: 1px solid #007bff; border-radius: 4px; margin-right: 5px; transition: background-color 0.3s;'>".$i."</a> ";
}
echo "</div>";
$conn->close();
?>
