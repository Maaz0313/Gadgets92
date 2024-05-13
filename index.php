<?php
session_start();
require('dbcon.php');
include('inc/header.php');
include('inc/functions.inc.php');
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
<main>
    <!-- Mobiles section -->
    <div class="product-container">

        <div class="row">
            <h4 class="col-6">Upcoming Mobile Phones</h4>
            <div class="col-6 text-end">
                <a href="mobiles/index.php?sort=upcoming" class="text-decoration-none text-black fw-medium">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
            </div>
        </div>
        <div class="product-cards">
        <?php
        $upcoming_sql = "SELECT * FROM products INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id WHERE products.release_date > CURDATE() LIMIT 5";
        $upcoming_result = mysqli_query($con, $upcoming_sql);
        if (!$upcoming_result) {
            $_SESSION['fail_msg'] = mysqli_error($con);
        }
        while ($upcoming_row = mysqli_fetch_assoc($upcoming_result)) {
        ?>
        
            <!-- Product Card 1 -->

            <div class="product-card">
                <a class="text-decoration-none text-black" href="mobiles/<?=$upcoming_row['product_slug'] ?>">
                    <div class="product-image">
                        <img src="<?='admin/images/products/'.$upcoming_row['product_image'] ?>" alt="mobile img">
                    </div>
                    <div class="product-name"><?=$upcoming_row['product_name'] ?></div>
                    <div class="product-price">Rs.<?=formatPrice($upcoming_row['price']) ?></div>
                </a>
            </div>

        <?php
        }
        ?>
        </div>
    </div>

    <div class="product-container">

        <div class="row">
            <h4 class="col-6">Latest Mobile Phones</h4>
            <div class="col-6 text-end">
                <a href="mobiles/index.php?sort=latest" class="text-decoration-none text-black fw-medium ">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
            </div>
        </div>

        <div class="product-cards">
            <!-- Product Card 1 -->
            <?php
            $latest_sql = "SELECT * FROM products INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id WHERE products.release_date < CURDATE() ORDER BY products.release_date DESC LIMIT 5";
            $latest_result = mysqli_query($con, $latest_sql);
            if (!$latest_result) {
                $_SESSION['fail_msg'] = mysqli_error($con);
            }
            while ($latest_row = mysqli_fetch_assoc($latest_result)) {
            ?>
            <div class="product-card">
                <a class="text-decoration-none text-black" href="mobiles/<?=$latest_row['product_slug'] ?>">
                    <div class="product-image">
                        <img src="<?='admin/images/products/'.$latest_row['product_image'] ?>" alt="Product 1">
                    </div>
                    <div class="product-name"><?=$latest_row['product_name'] ?></div>
                    <div class="product-price">Rs.<?=formatPrice($latest_row['price']) ?></div>
                </a>
            </div>

            <?php
            }
            ?>
        </div>
    </div>

    <div class="product-container">

        <div class="row">
            <h4 class="col-6">Big Battery Mobile Phones</h4>
            <div class="col-6 text-end">
                <a href="mobiles/index.php?sort=battery" class="text-decoration-none text-black fw-medium ">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
            </div>
        </div>

        <div class="product-cards">
            <!-- Product Card 1 -->
            <?php
            $battery_sql = "SELECT * FROM products INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id WHERE mobile_specs.battery_capacity > '3600 mAh' LIMIT 5";
            $battery_result = mysqli_query($con, $battery_sql);
            if (!$battery_result) {
                $_SESSION['fail_msg'] = mysqli_error($con);
            }
            while ($battery_row = mysqli_fetch_assoc($battery_result)) {
            ?>
            <div class="product-card">
                <a class="text-decoration-none text-black" href="mobiles/<?=$battery_row['product_slug'] ?>">
                    <div class="product-image">
                        <img src="<?='admin/images/products/'.$battery_row['product_image'] ?>" alt="Product 1">
                    </div>
                    <div class="product-name"><?=$battery_row['product_name'] ?></div>
                    <div class="product-price">Rs.<?=formatPrice($battery_row['price']) ?></div>
                </a>
            </div>

            <?php
            }
            ?>
        </div>
    </div>

    <div class="product-container">

        <div class="row">
            <h4 class="col-6">Latest Laptops</h4>
            <div class="col-6 text-end">
                <a href="laptops/index.php?sort=latest" class="text-decoration-none text-black fw-medium ">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
            </div>
        </div>

        <div class="product-cards">
            <!-- Product Card 1 -->
            <?php
            $laptop_sql = "SELECT * FROM products INNER JOIN laptop_specs ON products.product_id = laptop_specs.product_id ORDER BY products.release_date DESC LIMIT 5";
            $laptop_result = mysqli_query($con, $laptop_sql);
            if (!$laptop_result) {
                $_SESSION['fail_msg'] = mysqli_error($con);
            }
            while ($laptop_row = mysqli_fetch_assoc($laptop_result)) {
            ?>
            <div class="product-card">
                <a class="text-decoration-none text-black" href="laptops/<?=$laptop_row['product_slug'] ?>">
                    <div class="product-image">
                        <img src="<?='admin/images/products/'.$laptop_row['product_image'] ?>" alt="Product 1">
                    </div>
                    <div class="product-name"><?=$laptop_row['product_name'] ?></div>
                    <div class="product-price">Rs.<?=formatPrice($laptop_row['price']) ?></div>
                </a>
            </div>

            <?php
            }
            ?>

        </div>
    </div>

    <div class="container mt-5 mb-3">
        <div class="row">
            <h4 class="col-6">Latest Blogs</h4>
            <div class="col-6 text-end">
                <a href="#" class="text-decoration-none text-black fw-medium ">View All &rarr;</a>
            </div>
        </div>
        <div class="row row-gap-3">
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-3 row row-gap-3">
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <a class="text-decoration-none" href="#">
                    <div class="card mx-auto" style="width: 15rem;">
                        <img src="https://placehold.co/286x180.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top 7 Best Phones Under 10000 in India September 2023</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="b-example-divider"></div>
</main>
<?php
include('inc/footer.php');
?>