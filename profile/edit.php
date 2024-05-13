<?php
require ('../dbcon.php');
require ('../inc/header.php');
require ('../inc/functions.inc.php');
if (!isset($_SESSION['auth_user'])) {
    ?>
    <script>
        window.location.href = "../login.php";
    </script>
    <?php
    $_SESSION['fail_msg'] = "Please login first to access your profile page.";
    exit(0);
}
$id = (int) $_SESSION['auth_user']['user_id'];
$sql = "SELECT * FROM users WHERE id=" . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

//Image Update Logic


if (isset($_POST['submit'])) {
    $name = sanitize_data($_POST['name']);
    $password = sanitize_data($_POST['password']);
    $conf_password = sanitize_data($_POST['conf_password']);
    if ($password != $conf_password) {
        $_SESSION['fail_msg'] = "Password and confirm password not matched";
        ?>
        <script>
            window.location.href = 'edit.php';
        </script>
        <?php
        exit(0);
    }
    if (empty($password)) {
        $password = $row['password'];
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET name = '$name', password = '$password' WHERE id = $id";
    $update = mysqli_query($con, $sql);
    if ($update) {
        $_SESSION['success_msg'] = "Profile updated successfully";
        ?>
        <script>
            window.location.href = 'edit.php';
        </script>
        <?php
    } else {
        $_SESSION['fail_msg'] = "Profile update failed";
        ?>
        <script>
            window.location.href = 'edit.php';
        </script>
        <?php
    }
}
if (isset($_SESSION['success_msg'])) {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
}
if (isset($_SESSION['fail_msg'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
' . $_SESSION['fail_msg'] . '</div>';
    unset($_SESSION['fail_msg']);
}
?>
<main style="background-color: #0f172a;" data-bs-theme="dark">
    <section class="pt-5 pb-5">
        <div class="container">
            <!-- User info -->
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <!-- Bg -->
                    <div class="rounded-top"
                        style="background: url(../img/bg/profile-bg.jpg) no-repeat; background-size: cover; height: 100px">
                    </div>
                    <div class="card px-4 pt-2 pb-4 shadow-sm rounded-top-0 rounded-bottom-0 rounded-bottom-md-2"
                        style="background-color: #1e293b;">
                        <div class="d-flex align-items-end justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                                    <img src="<?= $base_url ?>/profiles/<?= $row['profile'] ?>"
                                        class="avatar-xl rounded-circle border border-4 border-white" alt="avatar">
                                </div>
                                <div class="lh-1">
                                    <h2 class="mb-0 text-white">
                                        <?= $row['name'] ?>
                                        <a href="#" class="" data-bs-toggle="tooltip" data-placement="top"
                                            aria-label="User" data-bs-original-title="User">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                                <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9"></rect>
                                                <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
                                            </svg>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm d-none d-md-block">Account
                                    Setting</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content -->
            <div class="row mt-0 mt-md-4">

                <div class="col-12">
                    <!-- Card -->
                    <div class="card" style="color:#64748b;background-color: #1e293b;">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0 text-white">Profile Details</h3>
                            <p class="mb-0">You have full control to manage your own account setting.</p>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-lg-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center mb-4 mb-lg-0">
                                    <div class="user-box">
                                        <div class="img-relative">
                                            <!-- Loading image -->
                                            <div class="overlay uploadProcess" style="display: none;">
                                                <div class="overlay-content"><img src="../img/loading.gif" /></div>
                                            </div>
                                            <!-- Hidden upload form -->
                                            <form method="post" action="upload.php" enctype="multipart/form-data"
                                                id="picUploadForm" target="uploadTarget">
                                                <input type="file" name="picture" id="fileInput" style="display:none" />
                                            </form>
                                            <iframe id="uploadTarget" name="uploadTarget" src="#"
                                                style="width:0;height:0;border:0px solid #fff;"></iframe>
                                            <!-- Image update link -->
                                            <a class="editLink" href="javascript:void(0);"><img
                                                    src="../img/edit.png" /></a>
                                            <!-- Profile image -->
                                            <img src="<?= $base_url ?>/profiles/<?= $row['profile'] ?>"
                                                id="imagePreview">
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Change Image</h4>
                                        <p class="mb-0">JPG, PNG, GIF no bigger than 80px wide and tall.</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div>
                                <h4 class="mb-0">Personal Details</h4>
                                <p class="mb-4">Edit your personal information and address.</p>
                                <!-- Form -->
                                <form class="row gx-3 needs-validation" novalidate="" method="post">
                                    <!-- Full name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="fname">Full Name</label>
                                        <input type="text" name="name" id="fname" class="form-control"
                                            placeholder="Full Name" value="<?= $row['name'] ?>" required>
                                        <div class="invalid-feedback">Please enter full name.</div>
                                    </div>
                                    <!-- Email -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="email">Email</label>
                                        <input readonly id="email" class="form-control" value="<?= $row['email'] ?>">
                                    </div>
                                    <!-- Password -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Password" value="<?= $row['password'] ?>" required>
                                        <div class="invalid-feedback">Please enter password.</div>
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="password2">Confirm Password</label>
                                        <input type="password" name="conf_password" id="password2" class="form-control"
                                            placeholder="Confirm Password" value="<?= $row['password'] ?>" required>
                                        <div class="invalid-feedback">Please enter confirm password.</div>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <button type="button" class="btn btn-dark" id="toggle">Show/Hide
                                            Password</button>
                                    </div>
                                    <div class="col-12">
                                        <!-- Button -->
                                        <button class="btn btn-primary" type="submit" name="submit">Update
                                            Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require '../inc/footer.php'; ?>
<script>
    $(document).ready(function () {
        //If image edit link is clicked
        $(".editLink").on('click', function (e) {
            e.preventDefault();
            $("#fileInput:hidden").trigger('click');
        });

        //On select file to upload
        $("#fileInput").on('change', function () {
            var image = $('#fileInput').val();
            var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            //validate file type
            if (!img_ex.exec(image)) {
                alert('Please upload only .jpg/.jpeg/.png/.gif file.');
                $('#fileInput').val('');
                return false;
            } else {
                $('.uploadProcess').show();
                $('#uploadForm').hide();
                $("#picUploadForm").submit();
            }
        });
    });

    //After completion of image upload process
    function completeUpload(success, fileName) {
        if (success == 1) {
            $('#imagePreview').attr("src", "");
            $('#imagePreview, .avatar-sm , .avatar-xl').attr("src", fileName);

            $('#fileInput').attr("value", fileName);
            $('.uploadProcess').hide();
        } else {
            $('.uploadProcess').hide();
            alert('There was an error during file upload!');
        }
        return true;
    }
    $(document).ready(function () {
        $('#toggle').click(function () {
            var passwordField = $('#password, #password2');
            var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
        });
    });

</script>