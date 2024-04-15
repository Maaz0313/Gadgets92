<?php
session_start();
require '../../dbcon.php';
$title = "Brands";
require '../inc/header.php';
if (!isset($_SESSION['ADMIN_LOGIN'])) {
    $_SESSION['status'] = "Please login first to access Admin Dashboard";
    ?>
    <script>
        window.location.href = "../login.php";
    </script>
    <?php
    exit(0);
}

$query = "SELECT * FROM brands INNER JOIN categories ON brands.cat_id = categories.cat_id ORDER BY brand_id DESC";
$result = mysqli_query($con, $query);
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
                        <h1>Brands</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li class="active">Brands</li>
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
            <a href="add.php" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Add Brand</a>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr role="row" class="even">
                                        <td class="sorting_1"><?= $row['brand_name'] ?></td>
                                        <td><?= $row['cat_name'] ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['brand_id'] ?>" class="btn btn-success">Edit</a>
                                            <a href="delete.php?id=<?= $row['brand_id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
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