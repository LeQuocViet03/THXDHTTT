<?php
session_start();

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "QLPHONGTHUCHANH";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Kết nối cơ sở dữ liệu thất bại!"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $maPhong = isset($_POST['maPhong']) ? $_POST['maPhong'] : '';

    if (empty($maPhong)) {
        echo json_encode(["status" => "error", "message" => "Mã phòng không hợp lệ."]);
        exit;
    }

    $sql = "DELETE FROM phonghoc WHERE maPhong = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Lỗi truy vấn: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $maPhong);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa phòng học thành công."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Xóa phòng học thất bại."]);
    }

    $stmt->close();
}

$conn->close();
?>
