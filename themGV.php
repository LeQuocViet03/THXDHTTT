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
    $maGV = $_POST['maGV'];
    $matKhau = $_POST['matKhau'];
    $hoTen = $_POST['hoTen'];
    $email = $_POST['email'];
    $khoa = $_POST['khoa'];

    $sql = "INSERT INTO giangvien (maGV, matKhau, hoTen, email, khoa) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $maGV, $matKhau, $hoTen, $email, $khoa);

    if ($stmt->execute()) {
        echo "<script>
            alert('Thêm giảng viên thành công!');
            window.history.back();
        </script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>