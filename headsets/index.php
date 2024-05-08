<?php
$title = "Headset Finder";
$description = "Ditch the decision fatigue. Find a headset that suits your needs using our comprehensive headset finder tool.";

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
    INNER JOIN headset_specs ON products.product_id = headset_specs.product_id"
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$brand = isset($_GET['brand']) ? mysqli_real_escape_string($con, $_GET['brand']) : '';
$whereClause = '';

if ($searchTerm) {
    $whereClause = " AND products.product_name LIKE '%" . mysqli_real_escape_string($con, $searchTerm) . "%'";
} else {
    $whereClause = '';
}

if ($brand) {
    $whereClause .= " AND brands.brand_name = '" . $brand . "'";
} else {
    $whereClause .= '';
}
$sql = "SELECT *
    FROM products
    INNER JOIN headset_specs ON products.product_id = headset_specs.product_id
    INNER JOIN brands ON products.brand_id = brands.brand_id
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
<main class="box pb-3">
    <!-- intro -->
    <div class="bg-white container-lg mb-1">
        <nav class="p-1 pb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../">Home</a></li>
                <li class="breadcrumb-item"><a href="/headsets/">Headsets</a></li>
                <li class="breadcrumb-item active" aria-current="page">Headset Finder</li>
            </ol>
        </nav>
        <div class="row">
            <h4 class="fw-bold">Headset Finder - Find Your Desired Headset</h4>
        </div>
        <div class="row">
            <p>Ditch the decision fatigue. Find a headset that suits your needs using our comprehensive headset finder tool.</p>
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
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#brands" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Brands
                                </button>
                            </h2>

                            <div id="brands" class="accordion-collapse collapse">
                                <form class="accordion-body" method="get" id="brand-filter-form">
                                    <input class="form-control shadow-none mb-3" type="search" name="" id="" placeholder="Search brands">
                                    <?php
                                    $brand_sql = "SELECT * FROM brands WHERE cat_id = 3 ORDER BY brand_name";
                                    $brand_result = mysqli_query($con, $brand_sql);
                                    while ($brand_row = mysqli_fetch_assoc($brand_result)) {
                                    ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox" name="brand" value="<?= $brand_row['brand_name'] ?>" id="brand">
                                                <?= $brand_row['brand_name'] ?>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#type_id" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Type
                                </button>
                            </h2>
                            <div id="type_id" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $type_query = "SELECT DISTINCT `type` FROM headset_specs ORDER BY `type`";
                                    $type_result = mysqli_query($con, $type_query);
                                    while ($type_row = mysqli_fetch_assoc($type_result)) {
                                    ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox" value="<?= $type_row['type'] ?>" id="type">
                                                <?= $type_row['type'] ?>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#design_id" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Design
                                </button>
                            </h2>
                            <div id="design_id" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $design_query = "SELECT DISTINCT design FROM headset_specs ORDER BY design";
                                    $design_result = mysqli_query($con, $design_query);
                                    while ($design_row = mysqli_fetch_assoc($design_result)) {
                                    ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox" value="<?= $design_row['design'] ?>" id="design">
                                                <?= $design_row['design'] ?>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#conn" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Connectivity
                                </button>
                            </h2>
                            <div id="conn" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $conn_query = "SELECT DISTINCT connectivity FROM headset_specs ORDER BY connectivity";
                                    $conn_result = mysqli_query($con, $conn_query);
                                    while ($conn_row = mysqli_fetch_assoc($conn_result)) {
                                    ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox" value="<?= $conn_row['connectivity'] ?>" id="connectivity">
                                                <?= $conn_row['connectivity'] ?>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#water" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Water Resistant
                                </button>
                            </h2>
                            <div id="water" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox" value="1" id="water_resistant">
                                            Water Resistant
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
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#brands" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Brands
                            </button>
                        </h2>

                        <div id="brands" class="accordion-collapse collapse">
                            <form class="accordion-body" method="get" id="brand-filter-form">
                                <input class="form-control shadow-none mb-3" type="search" name="" id="" placeholder="Search brands">
                                <?php
                                $brand_sql = "SELECT * FROM brands WHERE cat_id = 3 ORDER BY brand_name";
                                $brand_result = mysqli_query($con, $brand_sql);
                                while ($brand_row = mysqli_fetch_assoc($brand_result)) {
                                ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox" name="brand" value="<?= $brand_row['brand_name'] ?>" id="brand">
                                            <?= $brand_row['brand_name'] ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#type_id" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Type
                            </button>
                        </h2>
                        <div id="type_id" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $type_query = "SELECT DISTINCT `type` FROM headset_specs ORDER BY `type`";
                                $type_result = mysqli_query($con, $type_query);
                                while ($type_row = mysqli_fetch_assoc($type_result)) {
                                ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox" value="<?= $type_row['type'] ?>" id="type">
                                            <?= $type_row['type'] ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#design_id" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Design
                            </button>
                        </h2>
                        <div id="design_id" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $design_query = "SELECT DISTINCT design FROM headset_specs ORDER BY design";
                                $design_result = mysqli_query($con, $design_query);
                                while ($design_row = mysqli_fetch_assoc($design_result)) {
                                ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox" value="<?= $design_row['design'] ?>" id="design">
                                            <?= $design_row['design'] ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#conn" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Connectivity
                            </button>
                        </h2>
                        <div id="conn" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $conn_query = "SELECT DISTINCT connectivity FROM headset_specs ORDER BY connectivity";
                                $conn_result = mysqli_query($con, $conn_query);
                                while ($conn_row = mysqli_fetch_assoc($conn_result)) {
                                ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox" value="<?= $conn_row['connectivity'] ?>" id="connectivity">
                                            <?= $conn_row['connectivity'] ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#water" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Water Resistant
                            </button>
                        </h2>
                        <div id="water" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input shadow-none product_check" type="checkbox" value="1" id="water_resistant">
                                        Water Resistant
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="col-md-9 bg-white py-2">
                <div class="text-center">
                    <img src="../img/loader.gif" alt="Loading..." width="200" id="loader" style="display:none;">
                </div>
                <div id="result">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="card mb-3 p-3">
                            <div class="row g-0">
                                <div class="col-3 text-center">
                                    <a href="<?= $base_url . '/headsets/' . $row['product_slug'] ?>"><img class="bd-placeholder-img img-fluid rounded-start" alt="<?= $row['product_name'] ?>" src="../admin/images/products/<?= $row['product_image'] ?>" style="width: auto; height:150px"></a>
                                    <div class="row d-flex justify-content-center mt-3 fw-bold cmpr" style="font-size: 13px;cursor: pointer;">+ Compare</div>
                                </div>
                                <div class="col-9">
                                    <a class="text-decoration-none text-black" href="<?= $base_url . '/headsets/' . $row['product_slug'] ?>">
                                        <div class="card-body p-0">
                                            <h5 class="card-title fw-bold d-flex align-items-center justify-content-between">
                                                <div class="text-start"><?= $row['product_name'] ?></div>

                                                <div class="text-end " style="font-size: 17px;">Rs. <?= formatPrice($row['price']) ?></div>
                                            </h5>
                                            <p class="card-text">

                                            <div class="pro-grid-specs pl10 pr10 pb10">
                                                <div class="lineheight20 specs font90">
                                                    <ul class="key-specs row row-cols-md-2 gx-5">
                                                        <li> <?= $row['design'] ?></li>
                                                        <li> <?= $row['type'] ?></li>
                                                        <li> <?= $row['battery_life'] ?> Battery Life</li>
                                                        <li> <?= $row['connectivity'] ?> Connectivity</li>
                                                        <li> <?= $row['built-in_mic'] == '1' ? 'Built-in Mic' : 'No Built-in Mic' ?></li>
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
                </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.product_check').click(function() {
            $('#loader').show();
            var action = 'data';
            var brand = get_filter_text('brand');
            var type = get_filter_text('type');
            var design = get_filter_text('design');
            var connectivity = get_filter_text('connectivity');
            var water_resistant = get_filter_text('water_resistant');
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    action: action,
                    brand: brand,
                    type: type,
                    design: design,
                    connectivity: connectivity,
                    water_resistant: water_resistant
                },
                success: function(response) {
                    $('#result').html(response);
                    $('#loader').hide();
                }
            });
        });

        function get_filter_text(text_id) {
            var filterData = [];
            $('#' + text_id + ':checked').each(function() {
                filterData.push($(this).val());
            });
            return filterData;
        }
    });
</script>