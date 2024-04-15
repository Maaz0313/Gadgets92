<?php
session_start();
require '../../dbcon.php';
$title = "Add Brand";
require '../inc/header.php';
if (!isset($_SESSION['ADMIN_LOGIN'])) {
    $_SESSION['status'] = "Please login first to access Admin Dashboard";
    header('Location: login.php');
    exit(0);
}
if (isset($_POST['submit'])) {
    $brand_name = mysqli_real_escape_string($con, $_POST['brand_name']);
    $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']);
    $sql = "INSERT INTO brands(brand_name, cat_id) VALUES('$brand_name', '$cat_id')";
    $insert_brand = mysqli_query($con, $sql);
    if ($insert_brand) {
        $_SESSION['status'] = "Brand added successfully";
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
        mysqli_close($con);
    } else {
        $_SESSION['status'] = "Failed to add brand" . mysqli_error($con);
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
        mysqli_close($con);
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Brand</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li class="active">Add Brand</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <form class="p-4" action="" method="post">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" name="brand_name" id="brand_name" class="form-control w-50">
                    </div>
                    <div class="form-group">
                        <label for="cat_id">Category</label>
                        <select name="cat_id" id="cat_id" class="form-control w-50">
                            <option value="" disabled selected>Select Category</option>
                            <?php
                            $sql = "SELECT * FROM categories";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?= $row['cat_id'] ?>"><?= $row['cat_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require '../inc/footer.php';