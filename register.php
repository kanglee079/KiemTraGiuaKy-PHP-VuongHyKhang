<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .register-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .register-container h2 {
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

        .form-group input[type="submit"],
        .form-group .btn {
            width: 100%;
            height: 40px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .form-group .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2>Đăng Ký</h2>
            <form action="register_process.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                </div>
                <div class="form-group">
                    <input type="text" name="fullname" class="form-control" placeholder="Họ và tên" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Đăng Ký" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
