<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "QLPHONGTHUCHANH";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Kết nối thất bại!";
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maPhong = trim($_POST['maPhong']);
    $noiDung = trim($_POST['noiDung']);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $thoiGian = date('Y-m-d H:i:s');

    if (!empty($maPhong) && !empty($noiDung)) {
        $sql = "INSERT INTO lsbaocao (maPhong, noiDung, thoiGian) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $maPhong, $noiDung, $thoiGian);
        if ($stmt->execute()) {
            $message = "Báo cáo đã được gửi thành công!";
            header("Location: indexGV.php");
        }else {
            $message = "Lỗi ghi dữ liệu vào cơ sở dữ liệu: " . $stmt->error;
        }

        $stmt->close();
    }else {
        $message = "Vui lòng điền đầy đủ thông tin.";
    }
}
?>