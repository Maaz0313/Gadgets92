<?php
session_start();
$title = "Resend Verification Email";
require('inc/header.php');
?>

<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if(isset($_SESSION['status']))
                {
                    ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['status']; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['status']);
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