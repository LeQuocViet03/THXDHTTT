<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống quản lý phòng thực hành</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <script>
        function loadContent(page) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", page + ".php", true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById('content-right').innerHTML = this.responseText;
                } else {
                    console.error("Error loading content: ", this.status);
                }
            };
            xhr.onerror = function () {
                console.error("Request error");
            };
            xhr.send();
        }
        function timKiemSV() {
            const keyword = document.getElementById("search").value.trim();
            if (keyword === "") {
                alert("Vui lòng nhập từ khóa để tìm kiếm!");
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `timkiemSV.php?keyword=${encodeURIComponent(keyword)}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById("studentTable").innerHTML = this.responseText;
                } else {
                    console.error("Lỗi tải kết quả tìm kiếm:", this.status);
                }
            };
            xhr.onerror = function () {
                console.error("Lỗi khi gửi yêu cầu tìm kiếm.");
            };
            xhr.send();
        }
        function timKiemGV() {
            const keyword = document.getElementById("search").value.trim();
            if (keyword === "") {
                alert("Vui lòng nhập từ khóa để tìm kiếm!");
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `timkiemGV.php?keyword=${encodeURIComponent(keyword)}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById("teacherTable").innerHTML = this.responseText;
                } else {
                    console.error("Lỗi tải kết quả tìm kiếm:", this.status);
                }
            };
            xhr.onerror = function () {
                console.error("Lỗi khi gửi yêu cầu tìm kiếm.");
            };
            xhr.send();
        }
        function timKiemPH() {
            const keyword = document.getElementById("search").value.trim();
            if (keyword === "") {
                alert("Vui lòng nhập từ khóa để tìm kiếm!");
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `timkiemPH.php?keyword=${encodeURIComponent(keyword)}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById("labTable").innerHTML = this.responseText;
                } else {
                    console.error("Lỗi tải kết quả tìm kiếm:", this.status);
                }
            };
            xhr.onerror = function () {
                console.error("Lỗi khi gửi yêu cầu tìm kiếm.");
            };
            xhr.send();
        }
        function loc() {
            const keyword = document.getElementById("phongHoc").value.trim();
            if (keyword === "") {
                alert("Vui lòng chọn phòng để lọc!");
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `locTKB.php?keyword=${encodeURIComponent(keyword)}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById("TableTKB").innerHTML = this.responseText;
                } else {
                    console.error("Lỗi tải kết quả lọc:", this.status);
                }
            };
            xhr.onerror = function () {
                console.error("Lỗi khi gửi yêu cầu lọc.");
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="logoQuyNhon-icon.png" alt="Logo" class="logo">
            <h1 class="site-title">HỆ THỐNG QUẢN LÝ PHÒNG THỰC HÀNH</h1>
        </div>
    </header>

    <nav class="nav-bar">
        <ul class="nav-menu">
            <li><a href="#" onclick="loadContent('quanlySV')">Thông tin sinh viên</a></li>
            <li><a href="#" onclick="loadContent('quanlyGV')">Thông tin giảng viên</a></li>
            <li><a href="#" onclick="loadContent('quanlyPH')">Thông tin phòng học</a></li>
            <li><a href="#" onclick="loadContent('lichhoc')">Thời khóa biểu</a></li>
            <li><a href="#" onclick="loadContent('thongbaoAD')">Gửi thông báo</a></li>
            <li class="user-info">
                <a href="logout.php"><?php echo $username;?>
            </li>
        </ul>
    </nav>

    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-menu">
                <h3>Thống kê</h3>
                <ul>
                    <li><a href="test2.php">Lịch sử sữa chữa</a></li>
                    <li><a href="#">Lịch sử báo cáo</a></li>
                    <li><a href="#">Lịch sử thay đổi phòng học</a></li>
                </ul>
            </div>
        </aside>

        <div id = "content-right" class="content-right">
            <h2>Chào mừng! <a><?php echo $username;?></h2>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p>Copyright © 2024, Hệ thống quản lý phòng thực hành</p>
            <p>Địa chỉ: 170 An Dương Vương - Quy Nhơn - Bình Định</p>
            <p>Được phát triển bởi VAT-Team, nhóm sinh viên Công nghệ thông tin trường Đại học Quy Nhơn</p>
            <p>Thông tin liên hệ:</p>
            <p>Điện thoại: 0383955040</p>
            <p>Email: lequocvietqn212@gmail.com</p>
        </div>
    </footer>
</body>
</html>