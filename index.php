<?php
session_start();
include('inc/header.php');
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
<main>
        <!-- Mobiles section -->
        <div class="product-container">

<div class="row">
    <h4 class="col-6">Upcoming Mobile Phones</h4>
    <div class="col-6 text-end">
        <a href="#" class="text-decoration-none text-black fw-medium">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
    </div>
</div>

<div class="product-cards">
    <!-- Product Card 1 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 1">
        </div>
        <div class="product-name">Product 1</div>
        <div class="product-price">$19.99</div>
        </a>
    </div>

    <!-- Product Card 2 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 2</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 3</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 4</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 5</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>
    
</div>
</div>

<div class="product-container">

<div class="row">
    <h4 class="col-6">Latest Mobile Phones</h4>
    <div class="col-6 text-end">
        <a href="#" class="text-decoration-none text-black fw-medium ">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
    </div>
</div>

<div class="product-cards">
    <!-- Product Card 1 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 1">
        </div>
        <div class="product-name">Product 1</div>
        <div class="product-price">$19.99</div>
        </a>
    </div>

    <!-- Product Card 2 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 2</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 3</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 4</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 5</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>
    
</div>
</div>

<div class="product-container">

<div class="row">
    <h4 class="col-6">Big Battery Mobile Phones</h4>
    <div class="col-6 text-end">
        <a href="#" class="text-decoration-none text-black fw-medium ">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
    </div>
</div>

<div class="product-cards">
    <!-- Product Card 1 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 1">
        </div>
        <div class="product-name">Product 1</div>
        <div class="product-price">$19.99</div>
        </a>
    </div>

    <!-- Product Card 2 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 2</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 3</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 4</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/mobiles/asus-rog-phone-7.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 5</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>
    
</div>
</div>

<div class="product-container">

<div class="row">
    <h4 class="col-6">Latest Laptops</h4>
    <div class="col-6 text-end">
        <a href="#" class="text-decoration-none text-black fw-medium ">View All <i class="fa-solid fa-arrow-right-long fw-bolder"></i></a>
    </div>
</div>

<div class="product-cards">
    <!-- Product Card 1 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/laptops/hp-15s-fr5012tu.webp" alt="Product 1">
        </div>
        <div class="product-name">Product 1</div>
        <div class="product-price">$19.99</div>
        </a>
    </div>

    <!-- Product Card 2 -->
    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/laptops/hp-15s-fr5012tu.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 2</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/laptops/hp-15s-fr5012tu.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 3</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/laptops/hp-15s-fr5012tu.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 4</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>

    
    <div class="product-card">
        <a class="text-decoration-none text-black" href="gadget.html">
        <div class="product-image">
            <img src="https://cdn.findprix.com/media/laptops/hp-15s-fr5012tu.webp" alt="Product 2">
        </div>
        <div class="product-name">Product 5</div>
        <div class="product-price">$29.99</div>
        </a>
    </div>
    
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