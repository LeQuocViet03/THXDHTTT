<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlphongthuchanh";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $email = $_POST['email'];
    $khoa = $_POST['khoa'];
    $khoaHoc = $_POST['khoaHoc'];

$sql = "UPDATE sinhvien
        SET hoTen = ?, email = ?, khoa = ?, khoaHoc = ?
        WHERE maSV = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $hoTen, $email, $khoa, $khoaHoc, $maSV);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Cập nhật thông tin sinh viên thành công!');
            window.history.back();
        </script>";
    } else {
        echo "<script>
            alert('Cập nhật thông tin sinh viên không thành công!');
            window.history.back();
        </script>";
    }
} else {
    echo "Lỗi thực thi: " . $stmt->error;
}

$stmt->close();
}
$conn->close();
?>