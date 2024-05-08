<?php
if (!isset($_SESSION['ADMIN_LOGIN'])) {
    $_SESSION['fail_msg'] = "Please login first to access Admin Dashboard";
    ?><script>window.location.href = '../login.php';</script><?php
    exit(0);
}

function sanitize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  