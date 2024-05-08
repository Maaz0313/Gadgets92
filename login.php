<?php
session_start();
if (isset($_SESSION["authenticated"])) {
  $_SESSION["status"] = "You are already logged in!";
  header("Location: index.php");
  exit(0);
}
$title = "Login";
require('inc/header.php');
?>
<main class="bg-secondary-subtle py-2">
  <div class="form-signin w-100 m-auto">
    <form class="text-center" action="login_code.php" method="post">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <?php
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
      <div class="form-floating">
        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating mt-3">
        <input type="password" class="form-control" name="pwd" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="mt-4 w-100 btn btn-lg btn-primary" name="login_btn" type="submit">Sign in</button>
      <hr>
      <p class="mt-3 mb-3">Didn't receive your verification code?<br><a href="resend-verification-email.php">Resend</a></p>
    </form>
  </div>
</main>
<?php
require('inc/footer.php');
?>