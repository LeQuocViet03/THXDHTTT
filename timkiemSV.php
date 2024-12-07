<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "qlphongthuchanh";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
                
        $sql = "SELECT * FROM sinhvien
                WHERE maSV LIKE ? OR hoTen LIKE ? OR khoa LIKE ? OR khoaHoc LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $keyword . "%";
        $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
                
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["maSV"] . "</td>";
                echo "<td>" . $row["hoTen"] . "</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>" . $row["khoa"] . "</td>";
                echo "<td>" . $row["khoaHoc"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>
                        <button class='edit-btn' onclick='chinhSuaSV(" . $row["maSV"] . ")'>Sửa</button>
                    </td>";
                echo "<td>
                        <button class='delete-btn' onclick='xoaSV(" . $row["maSV"] . ")'>Xóa</button>
                    </td>";
                echo "</tr>";
            }
        }
    }
?>