<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlphongthuchanh";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
$maSV = isset($_GET['maSV']) ? $_GET['maSV'] : '';
$tenSV = isset($_GET['tenSV']) ? $_GET['tenSV'] : '';
$khoa = isset($_GET['khoa']) ? $_GET['khoa'] : '';
$khoaHoc = isset($_GET['khoaHoc']) ? $_GET['khoaHoc'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

$sql = "UPDATE sinhvien 
        SET hoTen = ?, khoa = ?, khoaHoc = ?, email = ? 
        WHERE maSV = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $tenSV, $khoa, $khoaHoc, $email, $maSV);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Cập nhật thành công! Số dòng bị ảnh hưởng: " . $stmt->affected_rows;
    } else {
        echo "Không có dòng nào được cập nhật.";
    }
} else {
    echo "Lỗi thực thi: " . $stmt->error;
}

$stmt->close();
}
$conn->close();
?>