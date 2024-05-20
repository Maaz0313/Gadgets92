<?php
session_start();
require '../../dbcon.php';
$title = "Add Category";
require '../inc/header.php';
require '../functions/logic.php';

if (isset($_POST['submit'])) {
    $name = sanitize_data(mysqli_real_escape_string($con, $_POST['cat_name']));
    $insert_cat = mysqli_execute_query($con, "INSERT INTO categories (`name`) VALUES (?)", [$name]);
    if ($insert_cat) {
        $_SESSION['success_msg'] = "Category added successfully";
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
        mysqli_close($con);
    } else {
        $_SESSION['fail_msg'] = "Failed to add category" . mysqli_error($con);
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Category</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Add Category</li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Category</strong>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_name">Category Name</label>
                                <input type="text" id="cat_name" name="cat_name" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="index.php" class="btn btn-danger">Cancel</a>
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