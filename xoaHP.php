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
    $maLHP = isset($_POST['maLHP']) ? $_POST['maLHP'] : '';

    if (empty($maLHP)) {
        echo json_encode(["status" => "error", "message" => "Mã lớp học phần không hợp lệ."]);
        exit;
    }

    $sql = "DELETE FROM hocphan WHERE maLHP = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Lỗi truy vấn: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $maLHP);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa học phần thành công."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Xóa học phần thất bại."]);
    }

    $stmt->close();
}

$conn->close();
?>
