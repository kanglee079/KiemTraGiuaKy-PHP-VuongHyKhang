<?php
session_start();
require_once 'config/db.class.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

// Nhận dữ liệu từ form
$maNV = $_POST['manv'];
$tenNV = $_POST['tennv'];
$phai = $_POST['phai'];
$noiSinh = $_POST['noisinh'];
$maPhong = $_POST['tenphong']; 
$luong = $_POST['luong'];

$db = new Db();
$connection = $db->connect();

$stmt = $connection->prepare("INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong);

if ($stmt->execute()) {
    $stmt->close();
    $connection->close();
    header('Location: index.php');
    exit();
} else {
    echo "Có lỗi xảy ra khi thêm nhân viên: " . $stmt->error;
}

$stmt->close();
$connection->close();
