<?php
require ('../dbcon.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id = (int)$_SESSION['auth_user']['user_id'];
$sql = "SELECT * FROM users WHERE id=".$id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$title = $row['name'];
require ('../inc/header.php');

if (!isset($_SESSION['auth_user']))
{
    ?>
    <script>
        window.location.href = "../login.php";
    </script>
    <?php
    $_SESSION['fail_msg'] = "Please login first to access your profile page.";
    exit(0);
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
<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #f6d365;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
    }
</style>

<section class="vh-90" style="background-color: #303030;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-black"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="<?=$base_url?>/profiles/<?=$row['profile']?>"
                                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                            <h5><?=$row['name']?></h5>
                            <p>User</p>
                            <a class="text-black" href="<?=$base_url?>/profile/edit.php"><i class="far fa-edit mb-5"></i></a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Information</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?=$row['email']?></p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a class="mb-2" href="../logout.php?continue=<?=$link?>"><button type="button" class="btn btn-danger">Logout</button></a>
                                    <!-- delete account btn -->
                                    <a href="../profile/delete.php"><button type="button" class="btn btn-danger">Delete Account</button></a>
                                    <p class="text-black-50 text-sm">Your account will be deleted immediately.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require ('../inc/footer.php');
?>