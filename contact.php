<?php
session_start();
$title = "Contact Us";
require('inc/header.php');
?>
<style>
    .contact-section {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 90vh;
        padding: 0 20px;
        margin: 0;
        background: linear-gradient(to right, rgb(33, 147, 176), rgb(109, 213, 237));
    }

    .contact-form {
        max-width: 400px;
        width: 100%;
    }
</style>
<section class="contact-section">
    <div class="contact-form">
        <h2 class="text-center mb-4">Contact Us</h2>
        <form action="contactSubmit.php" method="post">
            <?php
            if (isset($_SESSION['status'])) {
                ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>
                        <?= $_SESSION['status']; ?>
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['status']);
            }
            ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required placeholder="Enter your name" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required placeholder="Enter your email" >
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" required placeholder="Enter your subject" >
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" name="msg" id="message" rows="4" required placeholder="Enter your message"
                    ></textarea>
            </div>
            <button type="submit" name="btn_submit_contact" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
<?php
require('inc/footer.php');
?>