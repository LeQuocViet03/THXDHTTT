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
                
        $sql = "SELECT * FROM hocphan
                WHERE maLHP LIKE ? OR tenHP LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $keyword . "%";
        $stmt->bind_param("ss", $searchParam, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
                
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
        }
    }
?>