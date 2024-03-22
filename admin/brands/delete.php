<?php
session_start();
require '../../dbcon.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM brands WHERE brand_id = $id";
    $result = mysqli_query($con, $sql);
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