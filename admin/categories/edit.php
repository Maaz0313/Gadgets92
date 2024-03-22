<?php
session_start();
require '../../dbcon.php';
$title = "Edit Category";
require '../inc/header.php';

require '../functions/logic.php';

if (isset($_GET['id'])) {
    $id = sanitize_data($_GET['id']);
    $query = "SELECT * FROM categories WHERE cat_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    ?><script>window.location.href = 'index.php';</script><?php
    $_SESSION['fail_msg'] = "Brand id missing";
    exit(0);
}

if (isset($_POST['submit'])) {
    $name = sanitize_data($_POST['cat_name']);
    $sql = "UPDATE categories SET cat_name = '$name' WHERE cat_id = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        ?><script>window.location.href = 'index.php';</script><?php
        $_SESSION['success_msg'] = "Category updated successfully";
        exit(0);
    } else {
        ?><script>window.location.href = 'index.php';</script><?php
        $_SESSION['fail_msg'] = "Something went wrong";
        exit(0);
    }
}
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Category</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li><a href="index.php">Categories</a></li>
                            <li class="active">Edit</li>
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
                        <strong class="card-title">Edit Category</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="cat_name" class=" form-control-label">Category Name</label>
                                <input type="text" id="cat_name" name="cat_name" value="<?= $row['cat_name'] ?>" class="form-control" required>
                            </div>
                            <input type="hidden" name="cat_id" value="<?= $row['cat_id'] ?>">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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