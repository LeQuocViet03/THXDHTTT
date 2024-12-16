<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$servername = "localhost";
$username = "root";
$password = "";
$database = "qlphongthuchanh";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($fileExtension == 'csv') {
        $file = fopen($fileTmpName, 'r');
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $maSV = $row[0];
            $matKhau = $row[1];
            $hoTen = $row[2];
            $email = $row[3];
            $khoa = $row[4];
            $khoaHoc = $row[5];

            $sql = "INSERT INTO sinhvien (maSV, matKhau, hoTen, email, khoa, khoaHoc) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $maSV, $matKhau, $hoTen, $email, $khoa, $khoaHoc);
            $stmt->execute();
        }

        fclose($file);
        echo "Thêm sinh viên thành công!";
    }
    // elseif ($fileExtension == 'xls' || $fileExtension == 'xlsx') {
    //     try {
    //         $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpName);
    //         $sheet = $spreadsheet->getActiveSheet();
    //         $highestRow = $sheet->getHighestRow();

    //         for ($row = 2; $row <= $highestRow; $row++) {
    //             $maSV = $sheet->getCell("A$row")->getValue();
    //             $matKhau = $sheet->getCell("B$row")->getValue();
    //             $hoTen = $sheet->getCell("C$row")->getValue();
    //             $email = $sheet->getCell("D$row")->getValue();
    //             $khoa = $sheet->getCell("E$row")->getValue();
    //             $khoaHoc = $sheet->getCell("F$row")->getValue();

    //             if ($maSV && $hoTen) {
    //                 $sql = "INSERT INTO sinhvien (maSV, matKhau, hoTen, email, khoa, khoaHoc) VALUES (?, ?, ?, ?, ?, ?)";
    //                 $stmt = $conn->prepare($sql);
    //                 $stmt->bind_param("ssssss", $maSV, $matKhau, $hoTen, $email, $khoa, $khoaHoc);
    //                 $stmt->execute();
    //             }
    //         }
    //     }catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    //         echo "Lỗi khi đọc file Excel: " . $e->getMessage();
    //     }
    //         echo "Thêm sinh viên từ file Excel thành công!";
    // } else {
        echo "Chỉ hỗ trợ file CSV hoặc Excel!";
    }
// } 
else {
    echo "Vui lòng chọn file để tải lên!";
}

$conn->close();
?>