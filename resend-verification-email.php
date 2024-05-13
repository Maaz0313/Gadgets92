<?php
session_start();
$title = "Resend Verification Email";
require('dbcon.php');
require('inc/header.php');
?>

<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
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
                <div class="card" style="border:1px solid rgba(0, 0, 0, 0.175);">
                    <div class="card-header">
                        Resend Verification Email
                    </div>
                    <div class="card-body">
                        <form action="resend-code.php" method="post">
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="resend_btn" class="btn btn-primary">Resend</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require('inc/footer.php');
?>