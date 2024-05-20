<?php
session_start();
require '../../dbcon.php';

if(isset($_GET['id'])){
    $id = htmlspecialchars(mysqli_real_escape_string($con, $_GET['id']));
    $result = mysqli_execute_query($con, "DELETE FROM brands WHERE brand_id = ?", [$id]);
    if($result){
        $_SESSION['success_msg'] = "Brand deleted successfully";
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
        mysqli_close($con);
    }
    else{
        $_SESSION['fail_msg'] = "Failed to delete brand";
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
        mysqli_close($con);
    }
}
else{
    $_SESSION['fail_msg'] = "Brand not found";
    ?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
    mysqli_close($con);
}