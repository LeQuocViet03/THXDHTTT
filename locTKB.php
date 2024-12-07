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

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $phongHocFilter = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        $sql = "SELECT 
                    cahoc.ngayHoc AS thu,
                    cahoc.caHoc AS ca,
                    phancong.maPhong AS phong,
                    giangvien.hoTen AS tenGV,
                    hocphan.tenHP AS tenHP
                FROM 
                    phancong
                JOIN 
                    cahoc ON phancong.maCH = cahoc.maCH
                JOIN 
                    giangvien ON phancong.maGV = giangvien.maGV
                JOIN
                    hocphan ON phancong.maLHP = hocphan.maLHP
                WHERE phancong.maPhong = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $phongHocFilter);
        $stmt->execute();
        $result = $stmt->get_result();

        $danhSachThu = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        $danhSachCa = [1, 2, 3, 4];
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
        .form-group select{
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
        #locButton {
            margin-left: 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #locButton:hover {
            background-color: #0056b3;
        }
        select{
            font-size: 1.0rem;
            padding: 0.75rem 1.25rem;
            height: 2.75rem;
            width: 300px;
        }
    </style>
</head>

<body>
    <table >
        <tbody id="TableTKB">
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
                            }else {
                                echo "Trống";
                            }
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