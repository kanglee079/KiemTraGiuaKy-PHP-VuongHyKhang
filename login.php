<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            height: 40px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>Đăng Nhập</h2>
            <form action="login_process.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Đăng Nhập" class="btn btn-primary btn-block">
                </div>
            </form>
            <div class="form-group">
                <a href="register.php" class="btn btn-secondary btn-block">Đăng Ký</a>
            </div>
        </div>
    </div>
</body>
</html>
