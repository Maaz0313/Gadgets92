<?php
session_start();
include('dbcon.php');
if(isset($_POST['login_btn']))
{
    
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['pwd']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['pwd']);

        $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_array($login_query_run);

            if($row['verify_status']=='1')
            {
                $_SESSION['authenticated'] = true;
                $_SESSION['auth_user'] = [
                    'user_id' => $row['id'],
                    'username' => $row['name'],
                    'email' => $row['email']
                ];
                $_SESSION['status'] = "You have logged in successfully!";
                header('Location: '. $_GET['continue']);
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Please verify your email address to login!";
                header('Location: login.php');
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email or Password is Invalid!";
            header('Location: login.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "All fields are required!";
        header('Location: login.php');
        exit(0);
    }
    
}