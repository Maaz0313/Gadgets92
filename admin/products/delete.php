<?php
session_start();
require '../../dbcon.php';
require '../functions/logic.php';
if(isset($_GET['id'])){
    $id = sanitize_data($_GET['id']);
    $sql = "DELETE FROM products WHERE product_id = $id";
    $result = mysqli_query($con, $sql);
    if($result){
        $_SESSION['success_msg'] = "Product deleted successfully";
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
        mysqli_close($con);
    }
    else{
        $_SESSION['fail_msg'] = "Failed to delete product";
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
        mysqli_close($con);
    }
}
else{
    $_SESSION['fail_msg'] = "Product not found";
    ?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
    mysqli_close($con);
}