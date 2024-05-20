<?php
session_start();
require '../../dbcon.php';
require '../functions/logic.php';
if(isset($_GET['id'])){
    $id = sanitize_data(mysqli_real_escape_string($con, $_GET['id']));
    // $image = sanitize_data($_GET['image']);
    $sql = "SELECT `product_image` FROM products WHERE product_id = ?";
    $result = mysqli_execute_query($con, $sql, [$id]);
    $row = mysqli_fetch_assoc($result);
    $image = $row['product_image'];
    $sql = "DELETE FROM products WHERE product_id = ?";
    $result = mysqli_execute_query($con, $sql, [$id]);
    if($result){
        unlink('../images/products/' . $image);
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