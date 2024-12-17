<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Giảng Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            padding: 10px 15px;
            width: 400px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        table {
            width: 110%;
            margin: 0 auto 20px;
            border-collapse: collapse;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            text-align: center;
            padding: 12px 10px;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .edit-btn {
            display: flex;
            justify-content: center;
            padding: 8px 15px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #ffc107;
            color: black;
        }

        .delete-btn {
            display: flex;
            justify-content: center;
            padding: 8px 15px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #dc3545;
            color: white;
        }

        .edit-btn:hover {
            background-color: #e0a800;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .form-container {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input{
            font-size: 1.2rem;
            padding: 0.75rem 1.25rem;
            height: 3rem;
            width: 300px;
        }

        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: none;
        }

        button button[type="button"] {
            margin-top: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="button"] {
            background-color: #f44336;
            color: white;
        }

        #edit-btn{
            margin-left: 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #dong-btn{
            margin-left: 10px;
            padding: 8px 15px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #edit-btn:hover {
            background-color: #0056b3;
        }

        #formUpload {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
            width: 400px;
        }

        #formUpload h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #4CAF50;
        }

        #formUpload label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        #formUpload input[type="file"] {
            margin: 10px 0;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        #formUpload button {
            margin-top: 10px;
            width: 48%;
        }

        #formUpload button:first-child {
            margin-right: 4%;
            background-color: #007BFF;
        }

        #formUpload button:first-child:hover {
            background-color: #0056b3;
        }

        #formUpload button:last-child {
            background-color: #f44336;
        }

        #formUpload button:last-child:hover {
            background-color: #d32f2f;
        }

        #formOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        #formthemGV {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
            width: 400px;
        }

        #formthemGV h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #4CAF50;
        }

        #formthemGV label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        #formthemGV input[type="text"] {
            margin: 10px 0;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        #formthemGV button {
            margin-top: 10px;
            width: 65%;
        }

        #formthemGV button:first-child {
            margin-right: 4%;
            background-color: #007BFF;
        }

        #formthemGV button:first-child:hover {
            background-color: #0056b3;
        }

        #formthemGV button:last-child {
            background-color: #f44336;
        }

        #formthemGV button:last-child:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<h1>Quản Lý Thông Tin Giảng Viên</h1>

<div class="search-bar">
    <input type="text" id="search" placeholder="Tìm kiếm giảng viên...">
    <button onclick="timKiemGV()">Tìm Kiếm</button>

    <button onclick="document.getElementById('formUpload').style.display = 'block'">Thêm bằng file</button>
    <div id="formUpload" style="display: none; border: 1px solid #ccc; padding: 20px; margin-top: 20px; width: 300px;">
        <h3>Thêm giảng viên bằng file</h3>
        <form action="uploadGV.php" method="POST" enctype="multipart/form-data">
            <label for="fileUpload">Chọn file CSV/Excel:</label><br>
            <input type="file" name="file" id="fileUpload" accept=".csv, .xls, .xlsx" required><br><br>
            <button type="submit">Tải lên</button>
            <button type="button" onclick="document.getElementById('formUpload').style.display = 'none'">Đóng</button>
        </form>
    </div>
    
    <button onclick="document.getElementById('formthemGV').style.display = 'block'">Thêm giảng viên</button>
    <div id="formthemGV" style="display: none; border: 1px solid #ccc; padding: 20px; margin-top: 20px; width: 300px;">
        <h3>Thêm Giảng Viên</h3>
        <form action="themGV.php" method="POST">
            <label>Mã giảng viên:</label>
            <input type="text" name="maGV" required>
            <label>Mật khẩu:</label>
            <input type="text" name="matKhau" required>
            <label>Họ tên:</label>
            <input type="text" name="hoTen" required>
            <label>Email:</label>
            <input type="text" name="email" required>
            <label>Khoa:</label>
            <input type="text" name="khoa" required>
            <button type="submit">Thêm giảng viên</button>
            <button type="button" onclick="document.getElementById('formthemGV').style.display = 'none'">Đóng</button>
        </form>
    </div>
</div>

<div class="modal" id="formChinhSua">
    <div class="modal-content">
        <h2>Chỉnh sửa thông tin giảng viên</h2>
        <form id="formEdit" method="POST" action="chinhSuaGV.php">
            <div class="form-group">
                <label>Mã giảng viên:</label>
                <input type="text" id="editMaGV" name="maGV" readonly>
            </div>
            <div class="form-group">
                <label for="editTenGV">Tên giảng viên:</label>
                <input type="text" id="editTenGV" name="hoTen" required>
            </div>
            <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="text" id="editEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="editKhoa">Khoa:</label>
                <input type="text" id="editKhoa" name="khoa" required>
            </div>
            <button id = "edit-btn" type="submit" onclick="chinhSuaGV()">Lưu thay đổi</button>
            <button id = "dong-btn" type="button" onclick="dongForm()">Đóng</button>
        </form>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Mã Giảng Viên</th>
            <th>Họ Tên</th>
            <th>Ngày Sinh</th>
            <th>Nơi Sinh</th>
            <th>Giới Tính</th>
            <th>Khoa</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Địa Chỉ</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="teacherTable">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qlphongthuchanh";

            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM giangvien WHERE Rand() LIMIT 5";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["maGV"] . "</td>";
                    echo "<td>" . $row["hoTen"] . "</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td>" . $row["khoa"] . "</td>";
                    echo "<td></td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td></td>";
                    echo "<td>
                            <button class='edit-btn' onclick='moFormChinhSuaGV(" . $row["maGV"] . ")'>Sửa</button>
                        </td>";
                    echo "<td>
                            <button class='delete-btn' onclick='xoaGV(" . $row["maGV"] . ")'>Xóa</button>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có giảng viên nào!</td></tr>";
            }

            $conn->close();
        ?>
    </tbody>
</table>
</body>
</html>