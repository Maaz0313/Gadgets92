<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You have logged out successfully!";
header('Location: '. $_GET['continue']);
exit(0);