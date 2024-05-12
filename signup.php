<?php
$title = "Sign Up";
session_start();
if (isset($_SESSION["authenticated"]))
{
    $_SESSION["status"] = "You are already logged in!";
    header("Location: index.php");
    exit(0);
}
require('inc/header.php'); 
?>
    <link rel="stylesheet" href="css/signup.css">

    <main>
        <div class="container-fluid bg-white text-black pb-4 pt-sm-3">
            <div class="text-center">
                <h1 class="display-6">Sign up</h1>
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
            </div>
        </div>
        <section class="bg-dark-subtle w-md-100 w-sm-100 text-black pb-4">
            <form enctype="multipart/form-data" class="row g-3 p-3 w-md-75 w-sm-65 mx-auto" action="signupCode.php" method="POST">
                <div class="col-12">
                    <label for="validationDefault01" class="form-label">Name <span class="req">*</span></label>
                    <input type="text" class="form-control" name="name" id="validationDefault01" required
                        oninvalid="this.setCustomValidity('Please Enter your full name')" oninput="setCustomValidity('')">
                </div>
                <div class="col-12">
                    <label for="validationDefault01" class="form-label">Profile Picture (jpg, png, jpeg, gif)<span class="req">*</span></label>
                    <input type="file" class="form-control btn btn-primary" name="profile" id="validationDefault01" required
                        oninvalid="this.setCustomValidity('Please Select your profile picture')" oninput="setCustomValidity('')">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email address <span class="req">*</span></label>
                    <input type="email" class="form-control" name="email" id="inputEmail4" required
                        oninvalid="this.setCustomValidity('Please enter a valid email')" oninput="setCustomValidity('')">
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Password <span class="req">*</span></label>
                    <input type="password" class="form-control" name="pwd" id="inputPassword4" required
                        oninvalid="this.setCustomValidity('Please Enter valid password')" oninput="setCustomValidity('')">
                </div>
                <div class="col-12">
                    <button type="submit" name="register_btn" class="btn btn-primary">Sign Up</button>
                </div>
            </form>
        </section>
    </main>
<?php
require('inc/footer.php');
?>