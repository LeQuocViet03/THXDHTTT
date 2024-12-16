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
    $maPhong = $_POST['maPhong'];
    $dayPhong = $_POST['dayPhong'];
    $soLuongPC = $_POST['soLuongPC'];

    $sql = "INSERT INTO phonghoc (maPhong, dayPhong, soLuongPC) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $maPhong, $dayPhong, $soLuongPC);

    if ($stmt->execute()) {
        echo "<script>
            alert('Thêm phòng học thành công!');
            window.history.back();
        </script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>