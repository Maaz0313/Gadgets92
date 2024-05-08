<?php
session_start();
require('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

if(isset($_POST['resend_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $con->query($sql);
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        if($row['verify_status'] == '0')
        {
            $mail = new PHPMailer(true);
            try
            {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.office365.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'gadgets92.web@gmail.com';
                $mail->Password = 'vgfncqofrefttnfw';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('gadgets92.web@gmail.com', 'Gadgets92');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $verify_token = $row['verify_token'];
                $email_template = "
                <h2>You have registered with Gadgets92</h2>
                <h5>Verify your email address to Login with the link given below</h5>
                <br>
                <a style='text-align:center' href='http://localhost/Gadgets92/verify-email.php?token=$verify_token'>Click here to verify</a>
                ";
                $mail->Body    = $email_template;

                $mail->send();
                $_SESSION['succuss_msg'] = "Verification code sent to your email address";
                header('Location: login.php');

            }
            catch (Exception $e)
            {
                $_SESSION['fail_msg'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                header('Location: resend-verification-email.php');
            }
        }
        else
        {
            $_SESSION['fail_msg'] = "Email already verified";
            header('Location: resend-verification-email.php');
        }
    }
    else
    {
        $_SESSION['fail_msg'] = "Email does not exist";
        header('Location: resend-verification-email.php');
    }
    }
    else
    {
        $_SESSION['fail_msg'] = "Email is required";
        header('Location: resend-verification-email.php');
        exit(0);
    }
}