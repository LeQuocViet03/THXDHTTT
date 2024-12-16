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
    $maSV = $_POST['maSV'];
    $matKhau = $_POST['matKhau'];
    $hoTen = $_POST['hoTen'];
    $email = $_POST['email'];
    $khoa = $_POST['khoa'];
    $khoaHoc = $_POST['khoaHoc'];

    $sql = "INSERT INTO sinhvien (maSV, matKhau, hoTen, email, khoa, khoaHoc) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $maSV, $matKhau, $hoTen, $email, $khoa, $khoaHoc);

    if ($stmt->execute()) {
        echo "<script>
            alert('Thêm sinh viên thành công!');
            window.history.back();
        </script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>