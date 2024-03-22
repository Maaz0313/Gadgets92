<?php
session_start();

unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_USERNAME']);
$_SESSION['status'] = "You have logged out successfully!";
header("Location: login.php");
exit(0);