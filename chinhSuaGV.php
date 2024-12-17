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
    $maGV = $_POST['maGV'];
    $hoTen = $_POST['hoTen'];
    $email = $_POST['email'];
    $khoa = $_POST['khoa'];

$sql = "UPDATE giangvien
        SET hoTen = ?, email = ?, khoa = ?
        WHERE maGV = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $hoTen, $email, $khoa, $maGV);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Cập nhật thông tin giảng viên thành công!');
            window.history.back();
        </script>";
    } else {
        echo "<script>
            alert('Cập nhật thông tin giảng viên không thành công!');
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