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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
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
            AND
                giangvien.maGV = $username
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
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thời Khóa Biểu Giảng Viên</title>
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
    </style>
</head>
<body>
    <h1>Thời Khóa Biểu Giảng Viên</h1>
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
