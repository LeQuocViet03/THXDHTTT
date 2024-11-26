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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taiKhoan = $_SESSION['username'];
    $noiDung = trim($_POST['noiDung']);
    $thoiGian = date('Y-m-d H:i:s');

    $sql = "INSERT INTO lsthongbao (taiKhoan, noiDung, thoiGian) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$taiKhoan , $noiDung, $thoiGian);
    if ($stmt->execute()) {
            $message = "Báo cáo đã được gửi thành công!";
            header("Location: indexADMIN.php");
        }
    $stmt->close();
}
?>