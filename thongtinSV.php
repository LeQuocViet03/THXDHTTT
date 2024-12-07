<?php
session_start();

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "QLPHONGTHUCHANH";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Kết nối thất bại!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM sinhvien where maSV = '$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        echo '<h1>Thông Tin Sinh Viên</h1>';
        echo '<div class="notification-container">';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Mã sinh viên:</strong></div>';
        echo '<div class="content1">' . $row['maSV'] . '</div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Họ và tên:</strong></div>';
        echo '<div class="content1">' . $row['hoTen'] . '</div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Ngày sinh:</strong></div>';
        echo '<div class="content1"></div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Nơi sinh:</strong></div>';
        echo '<div class="content1"></div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Giới tính:</strong></div>';
        echo '<div class="content1"></div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Khoa:</strong></div>';
        echo '<div class="content1">' . $row['khoa'] . '</div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Khóa học:</strong></div>';
        echo '<div class="content1">' . $row['khoaHoc'] . '</div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Số điện thoại:</strong></div>';
        echo '<div class="content1"></div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Email:</strong></div>';
        echo '<div class="content1">' . $row['email'] . '</div>';
        echo '</div>';
        echo '<div class="notification">';
        echo '<div class="content"><strong>Địa chỉ:</strong></div>';
        echo '<div class="content1"></div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo 'Chưa đăng nhập';
    }
}
?>