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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi Báo Cáo</title>
    <style>
        .form-container {
            width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        select{
            font-size: 1.2rem;
            padding: 0.75rem 1.25rem;
            height: 3rem;
            width: 300px;
        }
        button {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Gửi Báo Cáo</h2>
    <div class="form-container">
        <form method="POST" action="guibaocaoSV.php">
            <div class="form-group">
                <label for="maPhong">Mã phòng:</label>
                <select id="maPhong" name="maPhong">
                    <?php
                        $sql = "SELECT maPhong FROM phonghoc";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['maPhong'] . "'>" . $row['maPhong'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="noiDung">Nội dung báo cáo:</label>
                <textarea id="noiDung" name="noiDung" rows="5" required></textarea>
            </div>
            <button type="submit">Gửi Báo Cáo</button>
        </form>
    </div>
</body>
</html>