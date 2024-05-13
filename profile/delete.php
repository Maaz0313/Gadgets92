<?php
//logout and delete current logged in user $_SESSION['auth_user'] from database
require ('../dbcon.php');
if(session_start() == false) {
    session_start();
}
if (isset($_SESSION['auth_user'])) {
    $id = (int)$_SESSION['auth_user']['user_id'];
    $sql = "DELETE FROM users WHERE id = $id";
    echo $sql;
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION['success_msg'] = "Account deleted successfully";
        unset($_SESSION['authenticated'], $_SESSION['auth_user']);
        header("Location: login.php");
    } else {
        $_SESSION['fail_msg'] = "Failed to delete account";
        header("Location: edit.php");
    }
} else {
    header("Location: ../login.php");
}