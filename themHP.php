<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlphongthuchanh";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maLHP = $_POST['maLHP'];
    $tenHP = $_POST['tenHP'];
    $khoa = $_POST['khoa'];
    $khoaHoc = $_POST['khoaHoc'];

    $sql = "INSERT INTO hocphan (maLHP, tenHP, khoa, khoaHoc) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $maLHP, $tenHP, $khoa, $khoaHoc);

    if ($stmt->execute()) {
        echo "<script>
            alert('Thêm học phần thành công!');
            window.history.back();
        </script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>