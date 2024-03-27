<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config/db.class.php';
require_once 'entities/employee.class.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 5; 
$totalEmployees = Employee::countAll(); 
$totalPages = ceil($totalEmployees / $perPage);
$skip = ($page - 1) * $perPage; 

$employees = Employee::getList($skip, $perPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Nhân Viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .gender-image {
            width: 50px; 
            height: auto; 
        }
        .pagination {
            justify-content: center; 
        }
        table {
            margin-top: 20px; 
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Thông Tin Nhân Viên</h1>
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <a href="add_employee.php" class="btn btn-primary">Thêm Nhân Viên</a>
        <?php endif; ?>
        <table class="table table-striped table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Mã Nhân Viên</th>
                    <th>Tên Nhân Viên</th>
                    <th>Giới Tính</th>
                    <th>Nơi Sinh</th>
                    <th>Tên Phòng</th>
                    <th>Lương</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <td><?php echo $employee->getMaNV(); ?></td>
                        <td><?php echo $employee->getTenNV(); ?></td>
                        <td>
                            <img class="gender-image" src="images/<?php echo $employee->getGenderImage(); ?>" alt="Gender">
                        </td>
                        <td><?php echo $employee->getNoiSinh(); ?></td>
                        <td><?php echo $employee->getTenPhong(); ?></td>
                        <td><?php echo number_format($employee->getLuong()); ?></td>
                        <td>
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <a href="edit_employee.php?id=<?php echo $employee->getMaNV(); ?>" class="btn btn-warning">Sửa</a>
                                <form action="process_delete_employee.php" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa nhân viên này?');" style="display: inline-block;">
                                    <input type="hidden" name="manv" value="<?php echo $employee->getMaNV(); ?>">
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item<?php echo $page == $i ? ' active' : '' ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <form action="logout.php" method="post">
        <button type="submit">Đăng Xuất</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

