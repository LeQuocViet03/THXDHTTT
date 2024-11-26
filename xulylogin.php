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
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql1 = "SELECT * FROM sinhvien WHERE maSV = '$username' AND matKhau = '$password'";
    $result1 = $conn->query($sql1);
    $sql2 = "SELECT * FROM giangvien WHERE maGV = '$username' AND matKhau = '$password'";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM admin WHERE taiKhoan = '$username' AND matKhau = '$password'";
    $result3 = $conn->query($sql3);

    if ($result1->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: indexSV.php");
    } else if($result2->num_rows > 0){
        $_SESSION['username'] = $username;
        header("Location: indexGV.php");
    }else if($result3->num_rows > 0){
        $_SESSION['username'] = $username;
        header("Location: indexADMIN.php");
    }else {
        echo "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>