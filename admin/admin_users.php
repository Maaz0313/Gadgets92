<?php
session_start();
require '../dbcon.php';


$title = "Admin Users";
require 'inc/header.php';
$query = "SELECT * FROM admin_users";
$result = mysqli_query($con, $query);

if (isset($_SESSION['success_msg']) || isset($_SESSION['fail_msg'])) {
    if (isset($_SESSION['success_msg'])) {
        echo '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        ' . $_SESSION['success_msg'] . '</div>';
        unset($_SESSION['success_msg']);
    } else {
        echo '<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        ' . $_SESSION['fail_msg'] . '</div>';
        unset($_SESSION['fail_msg']);
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>All Admin Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">All Admin Users</li>
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
                <a href="add_admin.php" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Add Admin User</a>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr role="row" class="even">
                                        <td class="sorting_1"><?= $row['username'] ?></td>
                                        <td><?= $row['password'] ?></td>
                                        <td><span class="label label-info"><?= $row['role'] ?></span></td>
                                        <td><?= $row['created_at'] ?></td>
                                    </tr>
                                <?php }
                                mysqli_close($con) ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>
<?php require 'inc/footer.php' ?>