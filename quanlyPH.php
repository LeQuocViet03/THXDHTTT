<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
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
    </style>
</head>
<body>

<h1>Quản Lý Thông Tin Phòng Học</h1>

<div class="search-bar">
    <input type="text" id="search" placeholder="Tìm kiếm phòng học...">
    <button onclick="timKiem()">Tìm Kiếm</button>
</div>

<table>
    <thead>
        <tr>
            <th>Mã Phòng</th>
            <th>Số Lượng Máy Tính</th>
            <th>Số Lượng Tivi</th>
            <th>Số Lượng Máy Chiếu</th>
            <th>Số Lượng Điều Hòa</th>
            <th>Số Lượng Quạt</th>
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

            $sql = "SELECT * FROM phonghoc WHERE Rand() LIMIT 5";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["maPhong"] . "</td>";
                    echo "<td>" . $row["soLuongPC"] . "</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td class='action-buttons'>
                            <button class='edit-btn' onclick='chinhSuaPhong(" . $row["maPhong"] . ")'>Sửa</button>
                        </td>";
                    echo "<td>
                            <button class='delete-btn' onclick='xoaPhong(" . $row["maPhong"] . ")'>Xóa</button>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có phòng học nào!</td></tr>";
            }

            $conn->close();
        ?>
    </tbody>
</table>

<script>
    // Xử lý tìm kiếm
    function timKiem() {
        const keyword = document.getElementById("search").value.toLowerCase();
        if (keyword === "") {
            alert("Vui lòng nhập từ khóa để tìm kiếm!");
        } else {
            alert("Tìm kiếm phòng học với từ khóa: " + keyword);
            // Thực hiện tìm kiếm hoặc gọi API
        }
    }
</script>

</body>
</html>