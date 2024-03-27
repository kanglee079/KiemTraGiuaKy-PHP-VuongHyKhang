<?php
session_start();
require_once 'config/db.class.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$maNV = $_POST['manv'];
$tenNV = $_POST['tennv'];
$phai = $_POST['phai'];
$noiSinh = $_POST['noisinh'];
$maPhong = $_POST['tenphong'];
$luong = $_POST['luong'];

$db = new Db();
$connection = $db->connect();

$stmt = $connection->prepare("UPDATE NHANVIEN SET Ten_NV = ?, Phai = ?, Noi_Sinh = ?, Ma_Phong = ?, Luong = ? WHERE Ma_NV = ?");
$stmt->bind_param("ssssis", $tenNV, $phai, $noiSinh, $maPhong, $luong, $maNV);

if ($stmt->execute()) {
    $stmt->close();
    $connection->close();
    header('Location: index.php'); 
    exit();
} else {
    echo "Có lỗi xảy ra khi cập nhật thông tin nhân viên: " . $stmt->error;
}

$stmt->close();
$connection->close();
