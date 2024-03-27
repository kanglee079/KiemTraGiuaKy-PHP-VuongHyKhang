<?php
session_start();
require_once 'config/db.class.php';
if ($_SESSION['role'] != 'admin' || !isset($_POST['manv'])) {
    header('Location: index.php');
    exit();
}

$maNV = $_POST['manv'];

$db = new Db();
$maNV = $db->escape_string($maNV);

$result = $db->query_execute("DELETE FROM NHANVIEN WHERE Ma_NV = '$maNV'");

if ($result) {
    header('Location: index.php');
} else {
    echo "Có lỗi xảy ra khi xóa nhân viên.";
}
