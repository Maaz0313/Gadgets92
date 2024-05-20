<?php
session_start();
require '../../dbcon.php';
require '../functions/logic.php';
if (isset($_GET['id'])) {
    $id = sanitize_data(mysqli_real_escape_string($con, (int)$_GET['id']));
    $result = mysqli_execute_query($con, "DELETE FROM categories WHERE id = ?", [$id]);
    if ($result) {
        $_SESSION['success_msg'] = "Category deleted successfully";
        ?>
        <script>
            window.location.href = "index.php";
        </script>
        <?php
    }
    else {
        $_SESSION['fail_msg'] = "Failed to delete category";
        ?>
        <script>
            window.location.href = "index.php";
        </script>
        <?php
    }
} else {
    $_SESSION['fail_msg'] = "Category not found";
    ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}
