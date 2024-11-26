<?php
session_start();

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "QLPHONGTHUCHANH";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Kết nối thất bại!";
}

$conn->set_charset("utf8mb4");
$sql = "SELECT noiDung, thoiGian FROM lsthongbao ORDER BY thoiGian DESC";
$result = $conn->query($sql);

$notifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="notification-container">';
        echo '<div class="notification">';
        echo '<div class="content">' . $row['noiDung'] . '</div>';
        echo '<div class="time">' . $row['thoiGian'] . '</div>';
        echo '</div>';
    }
} else {
    echo "Không có thông báo nào.";
}
?>