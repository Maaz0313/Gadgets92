<?php
session_start();
require '../../dbcon.php';

require '../functions/logic.php';

$title = "Categories";
require '../inc/header.php';


if (isset($_SESSION['success_msg'])) {
    echo '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        ' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
} 

if (isset($_SESSION['fail_msg'])) {
    echo '<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        ' . $_SESSION['fail_msg'] . '</div>';
    unset($_SESSION['fail_msg']);
}

?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li class="active">Categories</li>
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
                <a href="add.php" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Add Category</a>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM categories";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr role="row" class="even">
                                        <td class="sorting_1"><?= $row['cat_name'] ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['cat_id'] ?>" class="btn btn-success">Edit</a>
                                            <a href="delete.php?id=<?= $row['cat_id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                mysqli_close($con);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require '../inc/footer.php';
?>