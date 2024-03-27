<?php
session_start();
require_once 'config/db.class.php';
if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$db = new Db();
$connection = $db->connect();

$phongBanResult = $connection->query("SELECT Ma_Phong, Ten_Phong FROM PHONGBAN");
$phongBans = [];
if ($phongBanResult) {
    while ($row = $phongBanResult->fetch_assoc()) {
        $phongBans[] = $row;
    }
}
?>

<!-- Đây là form để thêm nhân viên -->
<form action="process_add_employee.php" method="post">
    Mã Nhân Viên: <input type="text" name="manv"><br>
    Tên Nhân Viên: <input type="text" name="tennv"><br>
    Giới Tính: 
    <select name="phai">
        <option value="Nữ">Nữ</option>
        <option value="Nam">Nam</option>
    </select><br>
    Nơi Sinh: <input type="text" name="noisinh"><br>
    Tên Phòng:
    <select name="tenphong">
        <?php foreach ($phongBans as $phongBan): ?>
            <option value="<?php echo $phongBan['Ma_Phong']; ?>"><?php echo $phongBan['Ten_Phong']; ?></option>
        <?php endforeach; ?>
    </select><br>
    Lương: <input type="number" name="luong"><br>
    <input type="submit" value="Thêm Nhân Viên">
</form>
