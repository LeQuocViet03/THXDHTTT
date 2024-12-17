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
    $maPhong = $_POST['maPhong'];
    $dayPhong = $_POST['dayPhong'];
    $soLuongPC = $_POST['soLuongPC'];

$sql = "UPDATE phonghoc
        SET dayPhong = ?, soLuongPC = ?
        WHERE maPhong = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $dayPhong, $soLuongPC, $maSV);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Cập nhật thông tin phòng học thành công!');
            window.history.back();
        </script>";
    } else {
        echo "<script>
            alert('Cập nhật thông tin phòng học không thành công!');
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