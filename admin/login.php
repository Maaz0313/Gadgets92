<!doctype html>
<html lang="en">
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/dbcon.php';
session_start();
if (isset($_SESSION['ADMIN_LOGIN'])) {
    $_SESSION['fail_msg'] = "Already logged in";
    echo '<script>location.href="index.php";</script>';
    exit(0);
}
function sanitize_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['submit'])) {
    $username = sanitize_data(mysqli_real_escape_string($con, $_POST['username']));
    $password = sanitize_data(mysqli_real_escape_string($con, $_POST['password']));
    $res = mysqli_execute_query($con, 'SELECT * FROM admin_users WHERE username=?', [$username]);
    $row = $res->fetch_assoc();
    $count = $res->num_rows;
    if ($count>0 && password_verify($password, $row['password'])==true) {
        $_SESSION['ADMIN_LOGIN'] = 'YES';
        $_SESSION['ADMIN_USERNAME'] = $username;
        $_SESSION['ROLE'] = $row['role'];
        $_SESSION['success_msg'] = "Login successful";
        echo '<script>location.href="index.php";</script>';
        exit(0);
    } else {
        $_SESSION['fail_msg'] = "Please enter correct login details";
        echo '<script>location.href="login.php";</script>';
        exit(0);
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Gadgets92</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @import "https://fonts.googleapis.com/css?family=Open+Sans:400,600,700";

        body {
            display: table;
            font-family: open sans, sans-serif;
            font-size: 16px;
            width: 100%;
        }

        .login-content {
            max-width: 540px;
            margin: 8vh auto;
        }

        .mt-150 {
            margin-top: 150px;
        }

        .login-form {
            background: #fff;
            padding: 30px 30px 20px;
            border-radius: 2px;
        }

        .login-form .btn {
            width: 100%;
            text-transform: uppercase;
            font-size: 14px;
            padding: 15px;
            border: 0;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn,
        .button {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-transition: all .15s ease-in-out;
            transition: all .15s ease-in-out;
            border-radius: 3;
            cursor: pointer;
        }

        .field_error {
            color: red !important;
            margin-top: 15px;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form mt-150">
                    <form method="POST">
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                required="">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-success btn-flat form-control">Sign
                                in</button>
                        </div>
                    </form>
                    <div class="field_error">
                        <?php
                            if (isset($_SESSION['success_msg'])) {
                                echo $_SESSION['success_msg'];
                                unset($_SESSION['success_msg']);
                            } 
                            if (isset($_SESSION['fail_msg'])) {
                                echo $_SESSION['fail_msg'];
                                unset($_SESSION['fail_msg']);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>