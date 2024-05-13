<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$base_url = $protocol . $_SERVER['HTTP_HOST'];
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_FILES['picture']['name'])) {
    // Include database configuration file
    include_once '../dbcon.php';
    
    // File upload configuration
    $result = 0;
    $uploadDir = "../profiles/";
    $fileName = time() . '_' . basename($_FILES['picture']['name']);
    $targetPath = $uploadDir . $fileName;
    // Get current user ID from session
        $userId = $_SESSION['auth_user']['user_id'];
        $fetchProfile = mysqli_query($con,"SELECT `profile` FROM users WHERE id = $userId"); // get current profile picture name from db for technical purposes
        $profile = mysqli_fetch_assoc($fetchProfile);
        $profile = $profile['profile'];
    // Upload file to server
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
        
        // Update picture name in the database
        $update = mysqli_query($con,"UPDATE users SET `profile` = '".$fileName."' WHERE id = $userId");
        
        // Update status
        if ($update) {
            unlink($uploadDir . $profile);
            $result = 1;
        }
    }
    
    // Load JavaScript function to show the upload status
    echo '<script type="text/javascript">window.top.window.completeUpload(' . $result . ',\'' . $targetPath . '\');</script>';
}