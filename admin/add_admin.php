<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/dbcon.php';
require 'inc/header.php';
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $sql = "INSERT INTO admin_users(username, password, role) VALUES('$username', '$password', '$role')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION['success_msg'] = "Admin user created successfully";
?>
        <script>
            window.location.href = 'admin_users.php';
        </script>
    <?php
        mysqli_close($con);
        exit(0);
    } else {
        $_SESSION['fail_msg'] = "Failed to create admin";
    ?>
        <script>
            window.location.href = 'admin_users.php';
        </script>
<?php
        mysqli_close($con);
        exit(0);
    }
}

if (isset($_SESSION['success_msg'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
} 

if (isset($_SESSION['fail_msg'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <h1>Add Admin User</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Add Admin User</li>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Add Admin User</div>
                    <div class="card-body card-block">
                        <form action="#" method="post" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="username" placeholder="Username" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user-tag"></i></div>
                                    <input type="text" id="role" name="role" placeholder="Role" class="form-control">
                                </div>
                            </div>
                            <div class="form-actions form-group"><button type="submit" name="submit" class="btn btn-success btn-sm">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'inc/footer.php';
?>