<?php
$link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$base_url = "http://gadgets92.test";
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($title)) {
            echo $title . " | ";
        } else {
            echo "";
        }
        ?>Gadgets92
    </title>
    <meta name="description" content="<?= isset($description)? $description : 'Gadgets92 is your one-stop shop for viewing all technical specifications of consumers electronic products like Smartphones, Laptops, Smartwatches etc.' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://www.findprix.com/style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <!-- title icon -->
    <link rel="shortcut icon" href="<?php echo $base_url; ?>/img/logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/style.css">

</head>

<body>
    <?php
    $res = explode('/', parse_url($url, PHP_URL_PATH));
    if (isset($res[1]) && isset($res[2])) {
        $res = $res[1] . '/' . $res[2];
    }
    else {
        $res = $res[1];
    }
    // echo $res;
    ?>
    <header>
        <nav class="navbar navbar-expand-md bg-secondary">
            <div class="container">
                <!-- Logo and Brand -->
                <a class="navbar-brand d-flex align-items-center" href="<?= $base_url; ?>">
                    <img src="<?php echo $base_url; ?>/img/logo/logo.png" alt="Logo" height="50" class="d-inline-block align-text-top">
                    <span class="fs-2" style="color: #122f42;">Gadgets<span style="color: #44a8eb;">92</span></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="offcanvasWithBothOptions" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="search1">
                    <!-- Centered Search Bar -->
                    <form class="d-flex mx-auto position-relative" id="form-search" autocomplete="off">
                        <input class="form-control me-2" onkeyup="fx_1(this.value)" name="search" type="search" placeholder="Search" aria-label="Search" id="qu">
                        <ul class="search-results position-absolute top-100 start-0 d-none list-group list-unstyled bg-white" id="livesearch1"></ul>
                        <button class="btn btn-success float-start" type="submit">Search</button>
                    </form>
                    <!-- Login/Signup Buttons -->
                    <div class="d-flex">
                        <?php
                        if (isset($_SESSION["authenticated"])) {
                        ?>
                            <a href="<?= $base_url; ?>/logout.php?continue=<?php echo $link ?>" class="btn btn-info text-white me-2">Logout</a>
                        <?php
                        } else {
                        ?>
                            <a href="<?= $base_url; ?>/login.php?continue=<?php echo $link ?>" class="btn btn-info text-white me-2">Login</a>
                            <a href="<?= $base_url; ?>/signup.php" class="btn btn-primary">Signup</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>


        <!-- Search bar shown on mobile screens only -->
        <form class="py-3 d-flex justify-content-end d-md-none custom-form position-relative" style="background-color:#FFDB58;" method="get" autocomplete="off" id="search2">
            <input class="form-control w-50 ms-auto" onkeyup="fx_2(this.value)" name="search" type="search" placeholder="Search" aria-label="Search" id="mu">
            <ul class="search-results d-none list-group list-unstyled bg-white" id="livesearch2"></ul>
            <button class="btn btn-success custom-btn me-auto" type="submit">Search</button>
        </form>

        <nav class="navbar navbar-expand-md bg-md">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= $res == "mobiles/" || $res == "mobiles/product.php" || $_SERVER['REQUEST_URI'] == "/mobiles/index.php" ? "active" : "text-white"; ?>" aria-current="page" href="<?= $base_url; ?>/mobiles/">Mobiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $res == "laptops/" || $res == "laptops/product.php" || $_SERVER['REQUEST_URI'] == "/laptops/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/laptops/">Laptops</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $res == "televisions/" || $res == "televisions/product.php" || $_SERVER['REQUEST_URI'] == "/televisions/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/televisions/">Televisions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $res == "watches/" || $res == "watches/product.php" || $_SERVER['REQUEST_URI'] == "/watches/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/watches/">Smart Watches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $res == "headsets/" || $res == "headsets/product.php" || $_SERVER['REQUEST_URI'] == "/headsets/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/headsets/">Headsets</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Shown on mobile screens -->
        <!-- Offcanvas nav menu -->
        <div class="offcanvas offcanvas-start bg-secondary" data-bs-backdrop="true" data-bs-scroll="true" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title ms-3" id="navbarOffcanvasLabel">
                    <a class="navbar-brand d-flex align-items-center" href="<?= $base_url; ?>">
                        <img src="<?php echo $base_url; ?>/img/logo/logo.png" alt="Logo" height="50" class="d-inline-block align-text-top">
                        <span class="fs-2" style="color: #122f42;">Gadgets<span style="color: #44a8eb;">92</span></span>
                    </a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Offcanvas menu items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link ms-3 <?= $res == "mobiles/" || $res == "mobiles/product.php" || $_SERVER['REQUEST_URI'] == "/mobiles/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/mobiles/">Mobiles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3 <?= $res == "laptops/" || $res == "laptops/product.php" || $_SERVER['REQUEST_URI'] == "/laptops/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/laptops/">Laptops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3 <?= $res == "televisions/" || $res == "televisions/product.php" || $_SERVER['REQUEST_URI'] == "/televisions/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/televisions/">Televisions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3 <?= $res == "watches/" || $res == "watches/product.php" || $_SERVER['REQUEST_URI'] == "/watches/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/watches/">Smart Watches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3 <?= $res == "headsets/" || $res == "headsets/product.php" || $_SERVER['REQUEST_URI'] == "/headsets/index.php" ? "active" : "text-white"; ?>" href="<?= $base_url; ?>/headsets/">Headsets</a>
                    </li>
                    <li class="nav-item mt-3 ms-3">
                        <?php
                        if (isset($_SESSION["authenticated"])) {
                        ?>
                            <a href="<?= $base_url; ?>/logout.php?continue=<?php echo $link ?>" class="btn btn-info text-white me-2">Logout</a>
                        <?php

                        } else {
                        ?>
                            <a href="<?= $base_url; ?>/login.php?continue=<?php echo $link ?>" class="btn btn-info text-white me-2">Login</a>
                            <a href="<?= $base_url; ?>/signup.php" class="btn btn-primary">Signup</a>
                        <?php
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Offcanvas nav menu ends-->
    </header>