<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "qlphongthuchanh";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
                
        $sql = "SELECT * FROM phonghoc
                WHERE maPhong LIKE ? OR dayPhong LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $keyword . "%";
        $stmt->bind_param("ss", $searchParam, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
                
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["maPhong"] . "</td>";
                echo "<td>" . $row["dayPhong"] . "</td>";
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
        }
    }
?>