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
    $maGV = isset($_POST['maGV']) ? $_POST['maGV'] : '';

    if (empty($maGV)) {
        echo json_encode(["status" => "error", "message" => "Mã giảng viên không hợp lệ."]);
        exit;
    }

    $sql = "DELETE FROM giangvien WHERE maGV = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Lỗi truy vấn: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $maGV);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa giảng viên thành công."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Xóa giảng viên thất bại."]);
    }

    $stmt->close();
}

$conn->close();
?>