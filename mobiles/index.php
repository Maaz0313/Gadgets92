<?php
require('../inc/header.php');
require('../dbcon.php');
require('../inc/functions.inc.php');

if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = mysqli_query(
    $con,
    "SELECT COUNT(*) AS total_records FROM products
    INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id"
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$whereClause = '';

if ($searchTerm) {
    $whereClause = " AND products.product_name LIKE '%" . mysqli_real_escape_string($con, $searchTerm) . "%'";
} else {
    $whereClause = '';
}
if (isset($_GET['min']) && isset($_GET['max']) && !empty($_GET['min']) && !empty($_GET['max'])) {
    $min = mysqli_real_escape_string($con, $_GET['min']);
    $max = mysqli_real_escape_string($con, $_GET['max']);
    $whereClause .= " AND products.price BETWEEN $min AND $max";
}
$sql = "SELECT *
    FROM products
    INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id
    WHERE products.status = 1 " . $whereClause . "
    LIMIT $offset, $total_records_per_page";
$result = mysqli_query($con, $sql);
if (!$result) {
    $_SESSION['fail_msg'] = mysqli_error($con);
?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
}
?>
<style>
    .card {
        border: 1px solid #ddd;
    }

    .container {
        clear: both;
        max-width: 100%;
        margin: 0 auto;
    }

    .column {
        display: table-cell;
        vertical-align: bottom;
        text-align: center;
        padding-right: 4px;
    }

    .mini {
        font-size: 14px;
        color: gray;
    }

    .inp {
        width: 100%;
        height: 32px;
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 5px 0;
        text-align: center;
        font-size: 14px;
    }

    .go-btn {
        width: 100%;
        height: 32px;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        margin: 0;
        background-color: #00b0f0;
        border: none;
        border-radius: 3px;
        color: #fff;
        font-size: 14px;
    }

    .form-check-input {
        border-color: gray;
    }

    @media (max-width: 767px) {
        .sidebar {
            display: none;
        }
    }
</style>
<?php
if (isset($_SESSION['status'])) {
?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><?= $_SESSION['status']; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['status']);
}
?>
<main class="box pb-3">
    <!-- intro -->
    <div class="bg-white container-lg mb-1">
        <nav class="p-1 pb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Mobiles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mobile Finder</li>
            </ol>
        </nav>
        <div class="row">
            <h4 class="fw-bold">Mobile Finder - Find Your Desired Mobile</h4>
        </div>
        <div class="row">
            <p>Ditch the decision fatigue. Find a mobile that suits your needs using our comprehensive mobile finder tool.</p>
        </div>
    </div>
    <!-- filters shown on mobile screens only -->
    <div class="container-lg bg-white mb-1 d-md-none d-lg-none d-xl-none">
        <div class="row">
            <div class="col py-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <span class="d-flex-center d-flex-justify-center">
                    <span class="d-flex-center pe-1">
                        <svg fill="#111" width="15px" height="15px" viewBox="0 -2.5 29 29" xmlns="http://www.w3.org/2000/svg">
                            <path d="m11.2 24 6.4-4v-6.4l11.2-13.6h-28.8l11.2 13.6z"></path>
                        </svg>
                    </span>
                    Filters</span>
            </div>
            <!-- offcanvas starts -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Search
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <form role="search" action="" method="post">
                                        <input type="search" name="search" class="form-control shadow-none" placeholder="Search Mobile" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Price
                                </button>
                            </h2>
                            <div id="price" class="accordion-collapse collapse">
                                <div class="accordion-body p-0 p-2 d-table w-100">
                                    <div class="column">
                                        <div class="mini">Min</div>
                                        <input type="number" class="inp" value="0">
                                    </div>
                                    <div class="column">
                                        <div class="mini">Max</div>
                                        <input type="number" class="inp" value="196900">
                                    </div>
                                    <div class="column">
                                        <button class="go-btn">Go</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#brands" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Brands
                                </button>
                            </h2>
                            <div id="brands" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <input class="form-control shadow-none mb-3" type="search" name="" id="" placeholder="Search brands">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="google">
                                        <label class="form-check-label" for="google">
                                            Google
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="xiamo">
                                        <label class="form-check-label" for="xiamo">
                                            Xiaomi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="nothing">
                                        <label class="form-check-label" for="nothing">
                                            Nothing
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="samsung">
                                        <label class="form-check-label" for="samsung">
                                            Samsung
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="vivo">
                                        <label class="form-check-label" for="vivo">
                                            Vivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ram" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    RAM
                                </button>
                            </h2>
                            <div id="ram" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="2gb">
                                        <label class="form-check-label" for="2gb">
                                            2 GB
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="4gb">
                                        <label class="form-check-label" for="4gb">
                                            4 GB
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="6gb">
                                        <label class="form-check-label" for="6gb">
                                            6 GB
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="8gb">
                                        <label class="form-check-label" for="8gb">
                                            8 GB
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="12gb">
                                        <label class="form-check-label" for="12gb">
                                            12 GB
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="18gb">
                                        <label class="form-check-label" for="18gb">
                                            16 GB
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#battery" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Battery Capacity
                                </button>
                            </h2>
                            <div id="battery" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none" type="checkbox" value="3000" id="3000">
                                            3000 mAh & Above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="4000">
                                        <label class="form-check-label" for="4000">
                                            4000 mAh & Above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="5000">
                                        <label class="form-check-label" for="5000">
                                            5000 mAh & Above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="6000">
                                        <label class="form-check-label" for="6000">
                                            6000 mAh & Above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" value="" id="7000">
                                        <label class="form-check-label" for="7000">
                                            7000 mAh & Above
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- offcanvas ends -->
            <div class="col py-2">
                <span class="d-flex-center d-flex-justify-center position-relative">
                    <span class="d-flex-center pe-1">
                        <svg width="15px" height="15px" viewBox="0.1 0.07 0.2 0.26" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path fill="#111" d="M0.275 0.175h-0.15l0.075 -0.1z"></path>
                            <path fill="#111" d="M0.125 0.225h0.15l-0.075 0.1z"></path>
                        </svg>
                    </span>
                    Sort By
                    <select class="position-absolute top-0 start-0 d-block opacity-0 " name="" id="">
                        <option value="">Latest</option>
                        <option value="">Lowest Price</option>
                        <option value="">Highest Price</option>
                    </select>
                </span>

            </div>
        </div>
    </div>
    <!-- list -->
    <div class="container-lg pt-md-3 mb-3">
        <div class="row gx-3">
            <aside class="col-3 bg-white py-2 sidebar">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Search
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <form role="search" action="" method="get">
                                    <input type="search" name="search" class="form-control shadow-none" placeholder="Search Mobile" aria-label="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                Price
                            </button>
                        </h2>
                        <div id="price" class="accordion-collapse collapse">
                            <form class="accordion-body p-0 p-2 d-table w-100" method="get">
                                <div class="column">
                                    <div class="mini">Min</div>
                                    <input type="number" class="inp" name="min" value="0">
                                </div>
                                <div class="column">
                                    <div class="mini">Max</div>
                                    <input type="number" class="inp" name="max" value="196900">
                                </div>
                                <div class="column">
                                    <button type="submit" class="go-btn">Go</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Availability" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Availability
                            </button>
                        </h2>
                        <div id="Availability" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="Instock">
                                    <label class="form-check-label" for="Instock">
                                        Instock
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="OutofStock">
                                    <label class="form-check-label" for="OutofStock">
                                        Out of Stock
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="Upcoming">
                                    <label class="form-check-label" for="Upcoming">Upcoming</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#brands" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Brands
                            </button>
                        </h2>

                        <div id="brands" class="accordion-collapse collapse">
                            <form class="accordion-body" method="get" id="brand-filter-form">
                                <input class="form-control shadow-none mb-3" type="search" name="" id="" placeholder="Search brands">
                                <?php
                                function getBrands()
                                {
                                    global $con;
                                    $sql = "SELECT * FROM brands WHERE cat_id = 1";
                                    $result = mysqli_query($con, $sql);
                                    $brands = [];
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $brands[] = $row;
                                    }
                                    return $brands;
                                }
                                $brands = getBrands();
                                foreach ($brands as $brand) {
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" name="brands[]" value="<?= $brand['brand_name'] ?>" id="<?= $brand['brand_id'] ?>">
                                        <label class="form-check-label" for="<?= $brand['brand_id'] ?>">
                                            <?= $brand['brand_name'] ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>

                            </form>
                        </div>
                        <script>
                            document.getElementById('brand-filter-form').addEventListener('change', updateUrl);

                            function updateUrl() {
                                const selectedBrands = document.querySelectorAll('input[name="brands[]"]:checked');

                                let url = new URL(window.location.href);
                                url.searchParams.delete('brand');

                                if (selectedBrands.length > 0) {
                                    const brandIds = [];
                                    for (const checkbox of selectedBrands) {
                                        brandIds.push(checkbox.value);
                                    }
                                    url.searchParams.set('brand', brandIds.join(','));
                                }

                                // Update browser history for back/forward navigation
                                window.history.pushState({}, '', url.href);

                                // Update content based on selected brands using Fetch API
                                fetchContent(url.href);
                            }

                            async function fetchContent(url) {
                                try {
                                    const response = await fetch(url);
                                    if (!response.ok) {
                                        throw new Error(`HTTP error! status: ${response.status}`);
                                    }

                                    const content = await response.text();
                                    // document.getElementById('brand-content').innerHTML = content;
                                } catch (error) {
                                    console.error('Error fetching content:', error);
                                    // Handle error gracefully (e.g., display an error message to the user)
                                }
                            }

                            // Optional: Enhanced visual feedback (reuse code from previous response)
                        </script>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ram" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                RAM
                            </button>
                        </h2>
                        <div id="ram" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="2gb">
                                    <label class="form-check-label" for="2gb">
                                        2 GB
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="4gb">
                                    <label class="form-check-label" for="4gb">
                                        4 GB
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="6gb">
                                    <label class="form-check-label" for="6gb">
                                        6 GB
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="8gb">
                                    <label class="form-check-label" for="8gb">
                                        8 GB
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="12gb">
                                    <label class="form-check-label" for="12gb">
                                        12 GB
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="18gb">
                                    <label class="form-check-label" for="18gb">
                                        16 GB
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#battery" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Battery Capacity
                            </button>
                        </h2>
                        <div id="battery" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="2gb">
                                    <label class="form-check-label" for="2gb">
                                        3000 mAh & Above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="4gb">
                                    <label class="form-check-label" for="4gb">
                                        4000 mAh & Above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="6gb">
                                    <label class="form-check-label" for="6gb">
                                        5000 mAh & Above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="8gb">
                                    <label class="form-check-label" for="8gb">
                                        6000 mAh & Above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="" id="12gb">
                                    <label class="form-check-label" for="12gb">
                                        7000 mAh & Above
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="col-md-9 bg-white py-2">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="card mb-3 p-3">
                        <div class="row g-0">
                            <div class="col-3 text-center">
                                <a class="text-decoration-none text-black" href="<?= $base_url . '/laptops/product.php?id=' . $row['product_id'] ?>">
                                    <img class="bd-placeholder-img img-fluid rounded-start" alt="mobile-image" src="../admin/images/products/<?= $row['product_image'] ?>" style="width: auto; height:150px">
                                </a>
                                <div class="row d-flex justify-content-center mt-3 fw-bold cmpr" style="font-size: 13px;cursor: pointer;">+ Compare</div>
                            </div>
                            <div class="col-9">
                                <a class="text-decoration-none text-black" href="<?= $base_url . '/mobiles/product.php?id=' . $row['product_id'] ?>">
                                    <div class="card-body p-0">
                                        <h5 class="card-title fw-bold d-flex align-items-center justify-content-between">
                                            <div class="text-start"><?= $row['product_name'] ?></div>

                                            <div class="text-end " style="font-size: 17px;">Rs. <?= formatPrice($row['price']) ?></div>
                                        </h5>
                                        <p class="card-text">

                                        <div class="pro-grid-specs pl10 pr10 pb10">
                                            <div class="lineheight20 specs font90">
                                                <ul class="key-specs row row-cols-md-2 gx-5">
                                                    <li> <?= $row['ram'] ?> RAM</li>
                                                    <li> <?= $row['internal_storage'] ?> Internal Storage</li>
                                                    <li> <?= $row['screen_size'] . " " . $row['display'] ?> Display</li>
                                                    <li> <?= $row['front_camera'] ?> Front Camera</li>
                                                    <li> <?= $row['rear_camera'] ?> Rear Camera</li>
                                                    <li> <?= $row['chipset'] ?> Processor</li>
                                                    <li> <?= $row['os'] ?> Operating System</li>
                                                </ul>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Pagination -->
                <nav aria-label="...">
                    <ul class="pagination justify-content-center">
                        <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } 
                        ?>

                        <li class="page-item <?= $page_no <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" <?php if ($page_no > 1) {
                                                        echo "href='?page_no=$previous_page'";
                                                    } ?>>Previous</a>
                        </li>

                        <?php
                        if ($total_no_of_pages <= 10) {
                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                        } elseif ($total_no_of_pages > 10) {

                            if ($page_no <= 4) {
                                for ($counter = 1; $counter < 8; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                echo "<li class='page-item'><a class='page-link href='?page_no=$second_last'>$second_last</a></li>";
                                echo "<li class='page-item'><a class='page-link href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                            } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                echo "<li class='page-item'><a class='page-link href='?page_no=1'>1</a></li>";
                                echo "<li class='page-item'><a class='page-link href='?page_no=2'>2</a></li>";
                                echo "<li class='page-item'><a class='page-link>...</a></li>";
                                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                echo "<li class='page-item'><a class='page-link'>...</a></li>";

                                for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                            }
                        }
                        ?>

                        <li class="page-item <?= $page_no >= $total_no_of_pages ? 'disabled' : '' ?>">
                            <a class="page-link" <?php if ($page_no < $total_no_of_pages) {
                                                        echo "href='?page_no=$next_page'";
                                                    } ?>>Next</a>
                        </li>
                        <?php if ($page_no < $total_no_of_pages) {
                            echo "<li class='page-item'><a class='page-link href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                        } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>
<?php
require('../inc/footer.php');
?>