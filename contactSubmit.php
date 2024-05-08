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
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gadgets92.web@gmail.com';
        $mail->Password = 'vgfncqofrefttnfw';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('gadgets92.web@gmail.com');

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
    <table cellpadding='0' cellspacing='0' border='0' bgcolor='#f9f9f9' style='max-width: 600px; margin: 0 auto; border-collapse: collapse; border: 1px solid #ddd;'>
        <tr>
            <td style='padding: 20px;'>
                <h2>Contact Us Email</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Message:</strong></p>
                <p>{$msg}</p>
                <hr>
                <p style='font-size: 0.8em; color: #777;'>This email was sent from the contact form on <a href='http://gadgets92.test'>Gadgets 92</a>.</p>
            </td>
        </tr>
    </table>
        ";

        $mail->send();

        $_SESSION['succuss_msg'] = 'Thank you for contacting us. We will get back to you shortly.';
        header('Location: contact.php');
        exit(0);
    } catch (Exception $e) {
        $_SESSION['fail_msg'] = 'Oops, something went wrong. Please try again later. Error: ' . $mail->ErrorInfo;
        header('Location: contact.php');
        exit(0);
    }
}

if (isset($_POST['btn_submit_contact'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['msg']);
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            send_contact_email("$name", "$email", "$subject", "$message");
        } else {
            $_SESSION['fail_msg'] = "Error: " . mysqli_error($con);
            header('Location: contact.php');
            exit(0);
        }
    } else {
        $_SESSION['fail_msg'] = "Please fill all the fields";
        header('Location: contact.php');
        exit(0);
    }
}
