<?php
session_start();
require '../../dbcon.php';
require '../functions/logic.php';
if (isset($_GET['id'])) {
    $id = sanitize_data($_GET['id']);
    $query = "DELETE FROM categories WHERE cat_id = '$id'";
    $result = mysqli_query($con, $query);
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
