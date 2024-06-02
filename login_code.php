<?php
session_start();
include('dbcon.php');
if (isset($_POST['login_btn'])) {

    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['pwd']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['pwd']);
        $login_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);

            if ($row['verify_status'] == '1') {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['authenticated'] = true;
                    $_SESSION['auth_user'] = [
                        'user_id' => $row['id'],
                        'username' => $row['name'],
                        'profile' => $row['profile'],
                        'email' => $row['email']
                    ];
                    $_SESSION['succuss_msg'] = "You have logged in successfully!";
                    if (isset($_GET['continue'])) {
                        header('Location: ' . $_GET['continue']);
                        exit(0);
                    }
                    header('Location: index.php');
                    exit(0);
                } else {
                    $_SESSION['fail_msg'] = "Incorrect Credentials!!";
                    header('Location: login.php');
                    exit(0);
                }
            } else {
                $_SESSION['fail_msg'] = "Please verify your email address to login!";
                header('Location: login.php');
                exit(0);
            }
        } else {
            $_SESSION['fail_msg'] = "Incorrect Credentials!";
            header('Location: login.php');
            exit(0);
        }
    } else {
        $_SESSION['fail_msg'] = "All fields are required!";
        header('Location: login.php');
        exit(0);
    }
}
