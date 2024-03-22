<?php
session_start();
require('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_contact_email($name, $email, $subject, $msg)
{
        $toEmail = 'gadgets92@outlook.com';
       $emailSubject = $subject;
       $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];
       $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $msg];
       $body = join(PHP_EOL, $bodyParagraphs);

       if (mail($toEmail, $emailSubject, $body, $headers)) {

        $_SESSION['status'] = 'Thank you for contacting us. We will get back to you shortly.';
        header('Location: contact.php');
        exit(0);
       } else {
           $_SESSION['status'] = 'Oops, something went wrong. Please try again later';
           header('Location: contact.php');
           exit(0);
       }
}

if(isset($_POST['btn_submit_contact']))
{
    $name = htmlspecialchars($_POST['name']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['msg']);
    if(!empty($name) && !empty($email) && !empty($subject) && !empty($message))
    {
        $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        $result = mysqli_query($con, $sql);
        if($result){
            send_contact_email("$name", "$email", "$subject", "$message");
        }
        else{
            $_SESSION['status'] = "Error: " .mysqli_error($con);
            header('Location: contact.php');
            exit(0);
        }
        
    }
    else
    {
        $_SESSION['status'] = "Please fill all the fields";
        header('Location: contact.php');
        exit(0);
    }
}