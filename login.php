<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Đăng Nhập</title>
</head>
<body>
    <div class="login-container">
        <h1>
            <img src="logoQuyNhon-icon.png" alt="Logo" class="logo" width="150" >
        </h1>
        <h2>
            TRƯỜNG ĐẠI HỌC QUY NHƠN
        </h2>
        <form action="xulylogin.php" method="post">
            <input type="text" name="username" placeholder="Tài khoản" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <input type="submit" value="Đăng nhập">
        </form>
        <form action="#" method="post">
            <input type="submit" value="Đăng nhập Gmail">
        </form>
    </div>
</body>
</html>