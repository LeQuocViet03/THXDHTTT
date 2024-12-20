<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Học Phần</title>
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

        #formthemHP {
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

        #formthemHP h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #4CAF50;
        }

        #formthemHP label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        #formthemHP input[type="text"] {
            margin: 10px 0;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        #formthemHP button {
            margin-top: 10px;
            width: 65%;
        }

        #formthemHP button:first-child {
            margin-right: 4%;
            background-color: #007BFF;
        }

        #formthemHP button:first-child:hover {
            background-color: #0056b3;
        }

        #formthemHP button:last-child {
            background-color: #f44336;
        }

        #formthemHP button:last-child:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<h1>Quản Lý Thông Tin Học Phần</h1>

<div class="search-bar">
    <input type="text" id="search" placeholder="Tìm kiếm phòng học...">
    <button onclick="timKiemHP()">Tìm Kiếm</button>

    <button onclick="document.getElementById('formUpload').style.display = 'block'">Thêm bằng file</button>
    <div id="formUpload" style="display: none; border: 1px solid #ccc; padding: 20px; margin-top: 20px; width: 300px;">
        <h3>Thêm học phần bằng file</h3>
        <form action="uploadHP.php" method="POST" enctype="multipart/form-data">
            <label for="fileUpload">Chọn file CSV/Excel:</label><br>
            <input type="file" name="file" id="fileUpload" accept=".csv, .xls, .xlsx" required><br><br>
            <button type="submit">Tải lên</button>
            <button type="button" onclick="document.getElementById('formUpload').style.display = 'none'">Đóng</button>
        </form>
    </div>

    <button onclick="document.getElementById('formthemHP').style.display = 'block'">Thêm học phần</button>
    <div id="formthemHP" style="display: none; border: 1px solid #ccc; padding: 20px; margin-top: 20px; width: 300px;">
        <h3>Thêm Học Phần</h3>
        <form action="themHP.php" method="POST">
            <label>Mã lớp học phần:</label>
            <input type="text" name="maLHP" required>
            <label>Tên học phần:</label>
            <input type="text" name="tenHP" required>
            <label>Khoa:</label>
            <input type="text" name="khoa" required>
            <label>Khóa:</label>
            <input type="text" name="khoaHoc" required>
            <button type="submit">Thêm học phần</button>
            <button type="button" onclick="document.getElementById('formthemHP').style.display = 'none'">Đóng</button>
        </form>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Mã Lớp Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Khoa</th>
            <th>Khóa Học</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="HPTable">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qlphongthuchanh";

            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM hocphan WHERE Rand() LIMIT 5";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["maLHP"] . "</td>";
                    echo "<td>" . $row["tenHP"] . "</td>";
                    echo "<td>" . $row["khoa"] . "</td>";
                    echo "<td>" . $row["khoaHoc"] . "</td>";
                    echo "<td class='action-buttons'>
                            <button class='edit-btn' onclick='chinhSuaHP(" . $row["maLHP"] . ")'>Sửa</button>
                        </td>";
                    echo "<td>
                            <button class='delete-btn' onclick='xoaHP(" . $row["maLHP"] . ")'>Xóa</button>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có học phần nào!</td></tr>";
            }

            $conn->close();
        ?>
    </tbody>
</table>
</body>
</html>