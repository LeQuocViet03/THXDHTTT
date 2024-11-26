<?php
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
            giangvien.hoTen AS tenGV
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

    $thoiKhoaBieu[$ca][$thu] = "Phòng: $phong GV: $tenGV";
}

$danhSachThu = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
$danhSachCa = [1, 2, 3, 4];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thời Khóa Biểu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
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
    </style>
</head>
<body>
    <h1>Thời Khóa Biểu</h1>
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
                            <?php
                            echo isset($thoiKhoaBieu[$ca][$thu]) 
                                ? htmlspecialchars($thoiKhoaBieu[$ca][$thu]) 
                                : "Trống";
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
