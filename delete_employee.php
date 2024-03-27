<?php
session_start();
require_once 'config/db.class.php';
if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $maNV = $_GET['id'];
    $db = new Db();
    $result = $db->query_execute("DELETE FROM NHANVIEN WHERE Ma_NV = '$maNV'");
    if ($result) {
        // Xóa thành công, chuyển hướng về trang index
        header('Location: index.php');
    } else {
        echo "Có lỗi xảy ra khi xóa nhân viên.";
    }
}
