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
</html>