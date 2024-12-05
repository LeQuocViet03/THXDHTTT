<?php
session_start();

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "QLPHONGTHUCHANH";

$conn = mysqli_connect($sname, $uname, $password, $db_name);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $thoiGian = date('Y-m-d H:i:s');
    $tenHP = trim($_POST['tenHP']);
    $maPhongCu = trim($_POST['maPhongCu']);
    $maPhongMoi = trim($_POST['maPhongMoi']);
    $maCaCu = trim($_POST['maCaCu']);
    $maCaMoi = trim($_POST['maCaMoi']);

    if (!empty($tenHP) && !empty($maPhongCu) && !empty($maPhongMoi) && !empty($maCaCu) && !empty($maCaMoi)) {
        $sql1 = "UPDATE phancong
                SET maCH = '$maCaMoi', maPhong = '$maPhongMoi'
                WHERE maCH = '$maCaCu' 
                AND maPhong = '$maPhongCu' 
                AND maLHP = (SELECT maLHP FROM hocphan WHERE tenHP = '$tenHP')";

        $sql2 = "INSERT INTO lsthaydoi(maGV, tenHP, phongCu, phongMoi, caCu, caMoi, thoiGian)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("sssssss", $username, $tenHP, $maPhongCu, $maPhongMoi, $maCaCu, $maCaMoi, $thoiGian);

        if (mysqli_query($conn, $sql1)) {
            $stmt2->execute();
            header("Location: indexGV.php");
        } 
    }
}
?>
