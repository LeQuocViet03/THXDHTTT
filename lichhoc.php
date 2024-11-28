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

    $sql = "SELECT 
                cahoc.ngayHoc AS thu,
                cahoc.caHoc AS ca,
                phancong.maPhong AS phong,
                giangvien.hoTen AS tenGV,
                hocphan.tenHP AS tenHP
            FROM 
                phancong
            JOIN 
                cahoc 
            ON 
                phancong.maCH = cahoc.maCH
            JOIN 
                giangvien 
            ON 
                phancong.maGV = giangvien.maGV
            JOIN
                hocphan
            ON
                phancong.maLHP = hocphan.maLHP
            ORDER BY 
                cahoc.caHoc, cahoc.ngayHoc";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $thoiKhoaBieu = [];
    while ($row = $result->fetch_assoc()) {
        $thu = $row['thu'];
        $ca = $row['ca'];
        $phong = $row['phong'];
        $tenGV = $row['tenGV'];
        $tenHP = $row['tenHP'];
        $thoiKhoaBieu[$ca][$thu] = "Môn:$tenHP-Phòng:$phong-GV:$tenGV";
    }

    $danhSachThu = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
    $danhSachCa = [1, 2, 3, 4];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thời Khóa Biểu Tổng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            height: 70px;
        }
        .headerTKB {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .headerTKB h1 {
            margin: 0;
        }
        .headerTKB .buttons {
            display: flex;
            gap: 10px;
        }
        .buttons button {
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .buttons button:hover {
            background-color: #0056b3;
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
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: none;
        }
        button[type="submit"], button[type="button"] {
            margin-top: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
        }
        button[type="button"] {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="headerTKB">
        <h1>Thời Khóa Biểu Tổng</h1>
        <div class="buttons">
            <button onclick="datlich()">Đặt lịch học</button>
            <button onclick="alert('Đổi lịch học: Chức năng đang được phát triển!')">Đổi lịch học</button>
            <button onclick="location.reload()">Làm Mới</button>
        </div>
    </div>

    <div class="modal" id="datlich">
        <div class="modal-content">
            <h2>Gửi Báo Cáo</h2>
            <div class="form-container">
                <form>
                    <div class="form-group">
                        <label for="maPhong">Mã phòng:</label>
                        <input type="text" id="maPhong" name="maPhong" required>
                    </div>
                    <div class="form-group">
                        <label for="noiDung">Nội dung báo cáo:</label>
                        <textarea id="noiDung" name="noiDung" rows="5" required></textarea>
                    </div>
                    <button type="submit">Gửi Báo Cáo</button>
                    <button type="button" onclick="dong1()">Đóng</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function datlich() {
            document.getElementById("datlich").style.display = "flex";
        }

        function dong1() {
            document.getElementById("datlich").style.display = "none";
        }
    </script>

    <table>
        <thead>
            <tr>
                <th>Ca</th>
                <?php foreach ($danhSachThu as $thu): ?>
                    <th><?php echo $thu; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($danhSachCa as $ca): ?>
                <tr>
                    <td><?php echo "Ca $ca"; ?></td>
                    <?php foreach ($danhSachThu as $thu): ?>
                        <td>
                            <div>
                            <?php
                            if(isset($thoiKhoaBieu[$ca][$thu]) ){
                                $string = htmlspecialchars($thoiKhoaBieu[$ca][$thu]);
                                $tt = explode("-",$string);
                                echo $tt[0]."</div><div>".$tt[1]."</div><div>".$tt[2];
                            }
                            else echo "Trống";
                            ?>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
