<?php
session_start();
require_once 'config/db.class.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$db = new Db();
$connection = $db->connect();

$maNV = isset($_GET['id']) ? $_GET['id'] : '';
$stmt = $connection->prepare("SELECT * FROM NHANVIEN WHERE Ma_NV = ?");
$stmt->bind_param("s", $maNV);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

$phongBanResult = $connection->query("SELECT Ma_Phong, Ten_Phong FROM PHONGBAN");
$phongBans = [];
if ($phongBanResult) {
    while ($row = $phongBanResult->fetch_assoc()) {
        $phongBans[] = $row;
    }
}
?>

<form action="process_edit_employee.php" method="post">
    <input type="hidden" name="manv" value="<?php echo $employee['Ma_NV']; ?>"> 
    Tên Nhân Viên: <input type="text" name="tennv" value="<?php echo $employee['Ten_NV']; ?>"><br>
    Giới Tính: <input type="text" name="phai" value="<?php echo $employee['Phai']; ?>"><br>
    Nơi Sinh: <input type="text" name="noisinh" value="<?php echo $employee['Noi_Sinh']; ?>"><br>
    Tên Phòng:
    <select name="tenphong">
        <?php foreach ($phongBans as $phongBan): ?>
            <option value="<?php echo $phongBan['Ma_Phong']; ?>" <?php echo ($phongBan['Ma_Phong'] == $employee['Ma_Phong']) ? 'selected' : ''; ?>><?php echo $phongBan['Ten_Phong']; ?></option>
        <?php endforeach; ?>
    </select><br>
    Lương: <input type="number" name="luong" value="<?php echo $employee['Luong']; ?>"><br>
    <input type="submit" value="Cập Nhật Nhân Viên">
</form>
