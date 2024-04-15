<?php
session_start();
require '../../dbcon.php';
if (!isset($_SESSION['ADMIN_LOGIN'])) {
    $_SESSION['status'] = "Please login first to access Admin Dashboard";
    header('Location: login.php');
    exit(0);
}
$title = "Edit Brand";
require '../inc/header.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM brands WHERE brand_id = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    $_SESSION['status'] = "Brand not found";
?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
    exit(0);
}
if (isset($_POST['submit'])) {
    $brand_name = mysqli_real_escape_string($con, $_POST['brand_name']);
    $sql = "UPDATE brands SET brand_name = '$brand_name' WHERE brand_id = $id";
    $update_brand = mysqli_query($con, $sql);
    if ($update_brand) {
        $_SESSION['status'] = "Brand updated successfully";
    ?>
        <script>
            window.location.href = 'index.php';
        </script>
    <?php
        mysqli_close($con);
        exit(0);
    } else {
        $_SESSION['status'] = "Failed to update brand" . mysqli_error($con);
    ?>
        <script>
            window.location.href = 'index.php';
        </script>
<?php
        mysqli_close($con);
        exit(0);
    }
}
?>

<?php
if (isset($_SESSION['status'])) {
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                            ' . $_SESSION['status'] . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
    unset($_SESSION['status']);
}
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Brand</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li><a href="index.php">Brands</a></li>
                            <li class="active">Edit Brand</li>
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
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Edit Brand</strong>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?= $row['brand_name'] ?>" required>
                            </div>
                            <div class="form-group">
                        <label for="cat_id">Category</label>
                        <select name="cat_id" id="cat_id" class="form-control w-50">
                            <option value="" disabled selected>Select Category</option>
                            <?php
                            $sql = "SELECT * FROM categories";
                            $result = mysqli_query($con, $sql);
                            while ($row2 = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?= $row2['cat_id'] ?>" <?= ($row2['cat_id'] == $row['cat_id']) ? 'selected' : '' ?>><?= $row2['cat_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require '../inc/footer.php';
?>