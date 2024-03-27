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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #007bff;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            height: 40px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>


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
</html>