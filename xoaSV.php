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
    $maSV = isset($_POST['maSV']) ? $_POST['maSV'] : '';

    if (empty($maSV)) {
        echo json_encode(["status" => "error", "message" => "Mã sinh viên không hợp lệ."]);
        exit;
    }

    $sql = "DELETE FROM sinhvien WHERE maSV = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Lỗi truy vấn: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $maSV);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa sinh viên thành công."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Xóa sinh viên thất bại."]);
    }

    $stmt->close();
}

$conn->close();
?>
