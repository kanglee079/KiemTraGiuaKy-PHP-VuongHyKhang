<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/db.class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $role = 'user'; 

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $db = new Db();
    $result = $db->query_execute("INSERT INTO users (username, password, fullname, email, role) VALUES ('$username', '$hashed_password', '$fullname', '$email', '$role')");

    if ($result) {
        echo "Đăng ký thành công!";
        header("Location: login.php");
        exit;
    } else {
        echo "Có lỗi xảy ra. Vui lòng thử lại.";
    }
}
