<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication         
    $mail->Host = 'smtp.gmail.com';                   //Set the SMTP server to send through
    $mail->Username = 'gadgets92.web@gmail.com';                //SMTP username
    $mail->Password = 'vgfncqofrefttnfw';                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        //Enable implicit TLS encryption
    $mail->Port = 587;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('gadgets92.web@gmail.com', 'Gadgets92');
    $mail->addAddress($email);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from Gadgets92';
    $email_template = "
    <h2>You have registered with Gadgets92</h2>
    <h5>Verify your email address to Login with the link given below</h5>
    <br>
    <a style='text-align:center' href='http://gadgets92.test/verify-email.php?token=$verify_token'>Click here to verify</a>
    ";
    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_POST['register_btn'])) {
    $name = htmlspecialchars($_POST['name']);
    $profile = $_FILES['profile']['name'];
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['pwd']);
    // hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $verify_token = md5(rand());
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Email exists or not
        $email_check_query = "SELECT `email` FROM `users` WHERE `email` = '$email' LIMIT 1";
        $email_check_query_run = mysqli_query($con, $email_check_query);
        if (mysqli_num_rows($email_check_query_run) > 0) {
            $_SESSION['fail_msg'] = 'Email Already Exists';
            header('Location: signup.php');
        } else {
            //image format validation
            $allowedImageTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
            if (!in_array($_FILES['profile']['type'], $allowedImageTypes)) {
                $_SESSION['fail_msg'] = 'Only JPG, JPEG, PNG & GIF files are allowed';
                header('Location: signup.php');
                exit(0);
            }
            else{
                // Upload image
            $img_ex = pathinfo($profile, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'profiles/' . $new_img_name;
            move_uploaded_file($_FILES['profile']['tmp_name'], $img_upload_path);
            }

            // Insert user data
            $insert_query = "INSERT INTO `users` (`name`, `profile`, `email`, `password`, `verify_token`) VALUES ('$name', '$new_img_name', '$email', '$password', '$verify_token')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                sendemail_verify("$name", "$email", "$verify_token");
                $_SESSION['succuss_msg'] = 'Registration Successful! Please check your inbox or spam folder to verify your Email Address.';
                header('Location: login.php');
            } else {
                $_SESSION['fail_msg'] = "Registration Failed";
                header('Location: signup.php');
            }
        }
    }
    else
    {
        $_SESSION['fail_msg'] = "Please fill all the fields";
        header('Location: signup.php');
        exit(0);
    }
}