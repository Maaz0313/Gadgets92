<?php
$title = "Mobile Finder";
$description = "Ditch the decision fatigue. Find a mobile that suits your needs using our comprehensive mobile finder tool.";
require ('../dbcon.php');
require ('../inc/header.php');
require ('../inc/functions.inc.php');

// var_dump($_);

// Get comparison data from the session
$compareProducts = isset($_SESSION['compare']['products']) ? $_SESSION['compare']['products'] : []; 
$compareCategory = isset($_SESSION['compare']['category']) ? $_SESSION['compare']['category'] : null;

// Fetch product details (only names for this example)
$productsData = [];
if (!empty($compareProducts)) {
    $products = getProductDetails($compareProducts);
    foreach ($compareProducts as $productId) {
        $productsData[$productId] = $products[$productId]; // Or any data you need 
    }
}

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$brand = isset($_GET['brand']) ? mysqli_real_escape_string($con, $_GET['brand']) : '';
$filter_option = isset($_GET['sort']) && in_array($_GET['sort'], ['low_price', 'high_price']) ? $_GET['sort'] : "";
$orderClause = '';
// echo "filter option: " . $filter_option;
switch ($filter_option) {
    case "low_price":
        $orderClause .= " ORDER BY products.price ASC";
        $low_price_selected = "selected";
        break;
    case "high_price":
        $orderClause .= " ORDER BY products.price DESC";
        $high_price_selected = "selected";
        break;
}
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
if (isset($_GET['sort']) && $_GET['sort'] == "upcoming") {
    $whereClause .= " AND products.release_date > CURDATE()";
}
if (isset($_GET['sort']) && $_GET['sort'] == "latest") {
    $orderClause .= " ORDER BY products.release_date DESC";
    $latest_selected = "selected";
}
if (isset($_GET['sort']) && $_GET['sort'] == "battery") {
    $orderClause .= " ORDER BY mobile_specs.battery_capacity DESC";
}
if (isset($_GET['min']) && isset($_GET['max']) && !empty($_GET['min']) && !empty($_GET['max'])) {
    $min = mysqli_real_escape_string($con, $_GET['min']);
    $max = mysqli_real_escape_string($con, $_GET['max']);
    $whereClause .= " AND products.price BETWEEN $min AND $max";
}
// page nos. logic
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 5;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$count_query = "SELECT COUNT(*) AS total_records FROM products
INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id WHERE products.status = 1 ";
$count_final_query = $count_query . $whereClause;
$result_count = mysqli_query(
    $con,
    $count_final_query
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
// echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;
// final query
$sql = "SELECT *
    FROM products
    INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id
    INNER JOIN brands ON products.brand_id = brands.brand_id
    WHERE products.status = 1 " . $whereClause . $orderClause . "
    LIMIT $offset, $total_records_per_page";
// echo $sql;
// exit(0);
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
<main class="box pb-3">
    <!-- intro -->
    <div class="bg-white container-lg mb-1">
        <nav class="p-1 pb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../">Home</a></li>
                <li class="breadcrumb-item"><a href="../mobiles/">Mobiles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mobile Finder</li>
            </ol>
        </nav>
        <div class="row">
            <h4 class="fw-bold">Mobile Finder - Find Your Desired Mobile</h4>
        </div>
        <div class="row">
            <p>Ditch the decision fatigue. Find a mobile that suits your needs using our comprehensive mobile finder
                tool.</p>
        </div>
    </div>
    <!-- filters shown on mobile screens only -->
    <div class="container-lg bg-white mb-1 d-md-none d-lg-none d-xl-none">
        <div class="row">
            <div class="col py-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight">
                <span class="d-flex-center d-flex-justify-center">
                    <span class="d-flex-center pe-1">
                        <svg fill="#111" width="15px" height="15px" viewBox="0 -2.5 29 29"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m11.2 24 6.4-4v-6.4l11.2-13.6h-28.8l11.2 13.6z"></path>
                        </svg>
                    </span>
                    Filters</span>
            </div>
            <!-- offcanvas starts -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Search
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <input type="search" name="search" class="form-control shadow-none" id="search_text"
                                        placeholder="Search Mobile" aria-label="Search">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Price
                                </button>
                            </h2>
                            <div id="price" class="accordion-collapse collapse">
                                <form class="accordion-body p-0 p-2 d-table w-100 price-range-form" method="get">
                                    <div class="column">
                                        <div class="mini">Min</div>
                                        <input type="number" class="inp" required name="min" value="0">
                                    </div>
                                    <div class="column">
                                        <div class="mini">Max</div>
                                        <input type="number" class="inp" required name="max" value="196900">
                                    </div>
                                    <div class="column">
                                        <button type="submit" class="go-btn">Go</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#brands" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Brands
                                </button>
                            </h2>

                            <div id="brands" class="accordion-collapse collapse">
                                <div class="accordion-body" id="brand-filter-form">
                                    <input class="form-control shadow-none mb-3" type="search" name="" id=""
                                        placeholder="Search brands">
                                    <?php
                                    $brand_sql = "SELECT * FROM brands WHERE cat_id = 1 ORDER BY brand_name";
                                    $brand_result = mysqli_query($con, $brand_sql);
                                    $brands = [];
                                    while ($brand_row = mysqli_fetch_assoc($brand_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    name="brands[]" value="<?= $brand_row['brand_name'] ?>" id="brand">
                                                <?= $brand_row['brand_name'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#m_ram" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    RAM
                                </button>
                            </h2>
                            <div id="m_ram" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $ram_query = "SELECT DISTINCT ram FROM mobile_specs ORDER BY ram DESC";
                                    $ram_res = mysqli_query($con, $ram_query);
                                    while ($ram_row = mysqli_fetch_assoc($ram_res)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $ram_row['ram'] ?>" id="ram">
                                                <?= $ram_row['ram'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#m_internal_storage" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Internal Storage
                                </button>
                            </h2>
                            <div id="m_internal_storage" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $internal_storage_query = "SELECT DISTINCT internal_storage FROM mobile_specs ORDER BY internal_storage";
                                    $internal_storage_result = mysqli_query($con, $internal_storage_query);
                                    while ($internal_storage_row = mysqli_fetch_assoc($internal_storage_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $internal_storage_row['internal_storage'] ?>"
                                                    id="internal_storage">
                                                <?= $internal_storage_row['internal_storage'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#screen_size_id" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Screen Size
                                </button>
                            </h2>
                            <div id="screen_size_id" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $screen_size_query = "SELECT DISTINCT screen_size FROM mobile_specs ORDER BY screen_size";
                                    $screen_size_result = mysqli_query($con, $screen_size_query);
                                    while ($screen_size_row = mysqli_fetch_assoc($screen_size_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $screen_size_row['screen_size'] ?>" id="screen_size">
                                                <?= $screen_size_row['screen_size'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#screen_resolution_id"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Screen Resolution
                                </button>
                            </h2>
                            <div id="screen_resolution_id" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $screen_resolution_query = "SELECT DISTINCT screen_resolution FROM mobile_specs ORDER BY screen_resolution";
                                    $screen_resolution_result = mysqli_query($con, $screen_resolution_query);
                                    while ($screen_resolution_row = mysqli_fetch_assoc($screen_resolution_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $screen_resolution_row['screen_resolution'] ?>"
                                                    id="screen_resolution">
                                                <?= $screen_resolution_row['screen_resolution'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#m_battery" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Battery Capacity
                                </button>
                            </h2>
                            <div id="m_battery" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $battery_query = "SELECT DISTINCT battery_capacity FROM mobile_specs ORDER BY battery_capacity";
                                    $battery_result = mysqli_query($con, $battery_query);
                                    while ($battery_row = mysqli_fetch_assoc($battery_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $battery_row['battery_capacity'] ?>" id="battery">
                                                <?= $battery_row['battery_capacity'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#m_front_camera" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Front Camera
                                </button>
                            </h2>
                            <div id="m_front_camera" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $front_camera_query = "SELECT DISTINCT front_camera FROM mobile_specs ORDER BY front_camera";
                                    $front_camera_result = mysqli_query($con, $front_camera_query);
                                    while ($front_camera_row = mysqli_fetch_assoc($front_camera_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $front_camera_row['front_camera'] ?>" id="front_camera">
                                                <?= $front_camera_row['front_camera'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#m_rear_camera" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Rear Camera
                                </button>
                            </h2>
                            <div id="m_rear_camera" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $rear_camera_query = "SELECT DISTINCT rear_camera FROM mobile_specs ORDER BY rear_camera";
                                    $rear_camera_result = mysqli_query($con, $rear_camera_query);
                                    while ($rear_camera_row = mysqli_fetch_assoc($rear_camera_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $rear_camera_row['rear_camera'] ?>" id="rear_camera">
                                                <?= $rear_camera_row['rear_camera'] ?>
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
                                <button class="accordion-button shadow-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#m_os" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Operating System
                                </button>
                            </h2>
                            <div id="m_os" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <?php
                                    $os_query = "SELECT DISTINCT os FROM mobile_specs ORDER BY os";
                                    $os_result = mysqli_query($con, $os_query);
                                    while ($os_row = mysqli_fetch_assoc($os_result)) {
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input shadow-none product_check" type="checkbox"
                                                    value="<?= $os_row['os'] ?>" id="os">
                                                <?= $os_row['os'] ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
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
                        <svg width="15px" height="15px" viewBox="0.1 0.07 0.2 0.26" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path fill="#111" d="M0.275 0.175h-0.15l0.075 -0.1z"></path>
                            <path fill="#111" d="M0.125 0.225h0.15l-0.075 0.1z"></path>
                        </svg>
                    </span>
                    Sort By
                    <select class="position-absolute top-0 d-block opacity-0" onchange="sort_product_drop()"
                        id="sort_product">
                        <option value="latest" <?= isset($latest_selected) ? $latest_selected : '' ?>>
                            Latest
                        </option>
                        <option value="low_price" <?= isset($low_price_selected) ? $low_price_selected : '' ?>>
                            Lowest Price
                        </option>
                        <option value="high_price" <?= isset($high_price_selected) ? $high_price_selected : '' ?>>
                            Highest Price
                        </option>
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
                            <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Search
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <input type="search" name="search" class="form-control shadow-none" id="search_text"
                                    placeholder="Search Mobile" aria-label="Search">
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo">
                                Price
                            </button>
                        </h2>
                        <div id="price" class="accordion-collapse collapse">
                            <form class="accordion-body p-0 p-2 d-table w-100 price-range-form" method="get">
                                <div class="column">
                                    <div class="mini">Min</div>
                                    <input type="number" class="inp" required name="min" value="0">
                                </div>
                                <div class="column">
                                    <div class="mini">Max</div>
                                    <input type="number" class="inp" required name="max" value="196900">
                                </div>
                                <div class="column">
                                    <button type="submit" class="go-btn">Go</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#brands" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Brands
                            </button>
                        </h2>

                        <div id="brands" class="accordion-collapse collapse">
                            <div class="accordion-body" id="brand-filter-form">
                                <input class="form-control shadow-none mb-3" type="search" name="" id=""
                                    placeholder="Search brands">
                                <?php
                                $brand_sql = "SELECT * FROM brands WHERE cat_id = 1 ORDER BY brand_name";
                                $brand_result = mysqli_query($con, $brand_sql);
                                $brands = [];
                                while ($brand_row = mysqli_fetch_assoc($brand_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                name="brands[]" value="<?= $brand_row['brand_name'] ?>" id="brand">
                                            <?= $brand_row['brand_name'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#m_ram" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                RAM
                            </button>
                        </h2>
                        <div id="m_ram" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $ram_query = "SELECT DISTINCT ram FROM mobile_specs ORDER BY ram DESC";
                                $ram_res = mysqli_query($con, $ram_query);
                                while ($ram_row = mysqli_fetch_assoc($ram_res)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $ram_row['ram'] ?>" id="ram">
                                            <?= $ram_row['ram'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#m_internal_storage" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Internal Storage
                            </button>
                        </h2>
                        <div id="m_internal_storage" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $internal_storage_query = "SELECT DISTINCT internal_storage FROM mobile_specs ORDER BY internal_storage";
                                $internal_storage_result = mysqli_query($con, $internal_storage_query);
                                while ($internal_storage_row = mysqli_fetch_assoc($internal_storage_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $internal_storage_row['internal_storage'] ?>"
                                                id="internal_storage">
                                            <?= $internal_storage_row['internal_storage'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#screen_size_id" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Screen Size
                            </button>
                        </h2>
                        <div id="screen_size_id" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $screen_size_query = "SELECT DISTINCT screen_size FROM mobile_specs ORDER BY screen_size";
                                $screen_size_result = mysqli_query($con, $screen_size_query);
                                while ($screen_size_row = mysqli_fetch_assoc($screen_size_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $screen_size_row['screen_size'] ?>" id="screen_size">
                                            <?= $screen_size_row['screen_size'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#screen_resolution_id" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Screen Resolution
                            </button>
                        </h2>
                        <div id="screen_resolution_id" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $screen_resolution_query = "SELECT DISTINCT screen_resolution FROM mobile_specs ORDER BY screen_resolution";
                                $screen_resolution_result = mysqli_query($con, $screen_resolution_query);
                                while ($screen_resolution_row = mysqli_fetch_assoc($screen_resolution_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $screen_resolution_row['screen_resolution'] ?>"
                                                id="screen_resolution">
                                            <?= $screen_resolution_row['screen_resolution'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#m_battery" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Battery Capacity
                            </button>
                        </h2>
                        <div id="m_battery" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $battery_query = "SELECT DISTINCT battery_capacity FROM mobile_specs ORDER BY battery_capacity";
                                $battery_result = mysqli_query($con, $battery_query);
                                while ($battery_row = mysqli_fetch_assoc($battery_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $battery_row['battery_capacity'] ?>" id="battery">
                                            <?= $battery_row['battery_capacity'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#m_front_camera" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Front Camera
                            </button>
                        </h2>
                        <div id="m_front_camera" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $front_camera_query = "SELECT DISTINCT front_camera FROM mobile_specs ORDER BY front_camera";
                                $front_camera_result = mysqli_query($con, $front_camera_query);
                                while ($front_camera_row = mysqli_fetch_assoc($front_camera_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $front_camera_row['front_camera'] ?>" id="front_camera">
                                            <?= $front_camera_row['front_camera'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#m_rear_camera" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Rear Camera
                            </button>
                        </h2>
                        <div id="m_rear_camera" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $rear_camera_query = "SELECT DISTINCT rear_camera FROM mobile_specs ORDER BY rear_camera";
                                $rear_camera_result = mysqli_query($con, $rear_camera_query);
                                while ($rear_camera_row = mysqli_fetch_assoc($rear_camera_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $rear_camera_row['rear_camera'] ?>" id="rear_camera">
                                            <?= $rear_camera_row['rear_camera'] ?>
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
                            <button class="accordion-button shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#m_os" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Operating System
                            </button>
                        </h2>
                        <div id="m_os" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php
                                $os_query = "SELECT DISTINCT os FROM mobile_specs ORDER BY os";
                                $os_result = mysqli_query($con, $os_query);
                                while ($os_row = mysqli_fetch_assoc($os_result)) {
                                    ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input shadow-none product_check" type="checkbox"
                                                value="<?= $os_row['os'] ?>" id="os">
                                            <?= $os_row['os'] ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                                ?>
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
                                    <a class="text-decoration-none text-black"
                                        href="<?= $base_url . '/mobiles/' . $row['product_slug'] ?>">
                                        <img class="bd-placeholder-img img-fluid rounded-start"
                                            alt="<?= $row['product_name'] ?>"
                                            src="../admin/images/products/<?= $row['product_image'] ?>"
                                            style="width: auto; height:150px">
                                    </a>
                                    <div class="row d-flex justify-content-center mt-3 fw-bold add-to-compare"
                                        data-product-id="<?= $row['product_id']; ?>"
                                        data-category-id="<?= $row['category_id']; ?>"
                                        style="font-size: 13px;cursor: pointer;">
                                        + Compare</div>
                                </div>
                                <div class="col-9">
                                    <a class="text-decoration-none text-black"
                                        href="<?= $base_url . '/mobiles/' . $row['product_slug'] ?>">
                                        <div class="card-body p-0">
                                            <h5
                                                class="card-title fw-bold d-flex align-items-center justify-content-between">
                                                <div class="text-start"><?= $row['product_name'] ?></div>

                                                <div class="text-end " style="font-size: 17px;">Rs.
                                                    <?= formatPrice($row['price']) ?>
                                                </div>
                                            </h5>
                                            <p class="card-text">

                                            <div class="pro-grid-specs pl10 pr10 pb10">
                                                <div class="lineheight20 specs font13">
                                                    <ul class="key-specs row row-cols-md-2 gx-5">
                                                        <li> <?= $row['ram'] ?> RAM</li>
                                                        <li> <?= $row['internal_storage'] ?> Internal Storage</li>
                                                        <li> <?= $row['display'] ?> Display</li>
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
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
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
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                            } ?>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination -->

            </div>
        </div>
    </div>
</main>
<div class="bx" id="compareToggler" data-bs-toggle="offcanvas" data-bs-target="#compareOffcanvas"
    style="display: none;">
    <span class="badge-container">
        <i class="fas fa-balance-scale fa-xs"></i>
        <span class="badge bg-primary text-white" id="compareCount">0</span>
    </span>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="compareOffcanvas" aria-labelledby="compareOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="compareOffcanvasLabel">Compare Products</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="compareProducts">
        <div id="productCardsContainer"> 
            <!-- Products will be added here -->
        </div>
        <div id="compareFooter">
            <div class="align-items-center" id="compareMessage">Add at least two products to compare.</div>
            <a href="#" class="btn btn-primary d-none" id="compareNowBtn">Compare Now</a>
        </div>
    </div>
</div>
<?php
require ('../inc/footer.php');
?>
<script type="text/javascript">
    $(document).ready(function () {
        // Function to perform AJAX request
        function sendAJAXRequest(searchTerm, minPrice, maxPrice) {
            $('#loader').show();

            var action = 'data';
            var brand = get_filter_text('brand');
            var ram = get_filter_text('ram');
            var internal_storage = get_filter_text('internal_storage');
            var screen_size = get_filter_text('screen_size');
            var screen_resolution = get_filter_text('screen_resolution');
            var battery = get_filter_text('battery');
            var os = get_filter_text('os');
            var front_camera = get_filter_text('front_camera');
            var rear_camera = get_filter_text('rear_camera');

            var search = "";
            if (searchTerm !== undefined) {
                search = searchTerm;
            } else {
                search = $('#search_text').val();
            }

            var data = {
                action: action,
                brand: brand,
                ram: ram,
                internal_storage: internal_storage,
                screen_size: screen_size,
                screen_resolution: screen_resolution,
                battery: battery,
                os: os,
                front_camera: front_camera,
                rear_camera: rear_camera
            };

            if (search !== "") {
                data.search = search;
            }

            if (minPrice !== "" && maxPrice !== "") {
                data.min_price = minPrice;
                data.max_price = maxPrice;
            }

            $.ajax({
                url: "action.php",
                method: "POST",
                data: data,
                success: function (response) {
                    $('#result').html(response);
                    $('#loader').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                }
            });
        }

        // AJAX call when checkboxes are clicked
        $('.product_check').click(function () {
            sendAJAXRequest(null); // No search term for checkbox clicks
        });

        // Event listener for Enter key press on search input
        $(document).on('keypress', '#search_text', function (e) {
            if (e.which == 13) {
                e.preventDefault();
                sendAJAXRequest($(this).val());
            }
        });

        // Price range form submit handler
        $('.price-range-form').each(function () { // Target forms with class "price-range-form"
            $(this).submit(function (e) {
                e.preventDefault(); // Prevent default form submission
                // Get min and max price values from the form
                var minPrice = $(this).find('input[name="min"]').val();
                var maxPrice = $(this).find('input[name="max"]').val();
                sendAJAXRequest(null, minPrice, maxPrice); // Send AJAX request 
            });
        });

        // Function to get filter values from checkboxes
        function get_filter_text(text_id) {
            var filterData = [];
            $('#' + text_id + ':checked').each(function () {
                filterData.push($(this).val());
            });
            return filterData;
        }
    });

    // Function for sort dropdown
    function sort_product_drop() {
        var sort_product = $('#sort_product').val();
        window.location.href = "index.php?sort=" + sort_product;
    }

    // logic for compare button
    document.addEventListener('DOMContentLoaded', function () {
        const comparisonData = <?php echo json_encode([
            'products' => $compareProducts,
            'category' => $compareCategory,
            'productsData' => $productsData,
        ]); ?>; 
        comparisonData.products = comparisonData.products || [];
        const compareToggler = document.getElementById('compareToggler');
    const compareCount = document.getElementById('compareCount');
    const compareOffcanvas = document.getElementById('compareOffcanvas');
        const compareProducts = document.getElementById('compareProducts');
        const compareProductsContainer = $('#productCardsContainer');
    const compareFooter = document.getElementById('compareFooter');
                const compareMessage = document.getElementById('compareMessage');
            const compareNowBtn = document.getElementById('compareNowBtn');

                function populateOffcanvas() {
                    compareProductsContainer.html('');

                    if (comparisonData.products.length > 0) { 
                        comparisonData.products.forEach(productId => {
                            const productCard = `
                                <div class="card product-card mb-3" data-product-id="${productId}">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-from-compare" 
                                            data-product-id="${productId}" aria-label="Close"></button> 
                                    <div class="row g-0">
                                        <div class="col-md-4 text-center">
                                            <img class="bd-placeholder-img img-fluid rounded-start" 
                                                alt="${comparisonData.productsData[productId].product_name}"
                                                src="../admin/images/products/${comparisonData.productsData[productId].product_image}"
                                                style="width: auto; height:150px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                            <h6 class="card-title">${comparisonData.productsData[productId]['product_name']}</h6>
                                            <div class="card-text">Rs.${comparisonData.productsData[productId]['price']}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                compareProductsContainer.prepend(productCard);
                                }); 
                    }

                    updateCompareUI(); // Update the UI (counter, button visibility)
                }

        function updateCompareUI() {
            const productCount = document.querySelectorAll('#productCardsContainer .product-card').length;
            compareCount.textContent = productCount;

            if (productCount > 0) {
                compareToggler.style.display = 'flex';
            } else {
                compareToggler.style.display = 'none';
            }

            if (productCount >= 2) {
                compareNowBtn.classList.remove('d-none');
                compareMessage.classList.add('d-none');
                const productIds = Array.from(document.querySelectorAll('#compareProducts .product-card'))
                    .map(card => card.dataset.productId)
                    .join(',');
                compareNowBtn.href = `/mobiles/compare.php?pid=${productIds}`;
            } else {
                compareNowBtn.classList.add('d-none');
                compareMessage.classList.remove('d-none');
            }
        }

        // Add to Compare Event
        $('.add-to-compare').click(function () {
            const productId = $(this).data('product-id');
            const categoryId = $(this).data('category-id');

            $.ajax({
                url: 'product_listing.php',
                method: 'POST',
                data: {
                    action: 'add',
                    productId: productId,
                    categoryId: categoryId
                },
                success: function (data) {
                    // console.log(data);
                    data = JSON.parse(data);
                    // Assuming data is returned as JSON
                    if (data.error) {
                        alert(data.error);
                    } 
                    if(data.success=="Product added.")
                    {
                        comparisonData.products.push(productId);
                        comparisonData.productsData[productId] = { // Update the productsData array as well
                            product_name: data.productName, // Assuming your response includes productName, etc.
                            product_image: data.productImage,
                            price: data.price
                        };

                        populateOffcanvas(comparisonData); // Repopulate offcanvas using updated data
                        updateCompareUI();
                        alert(data.success);
                    }
                },
                error: function (error) {
                    console.error('AJAX request failed:', error);
                    // Handle the error more gracefully (e.g., display an error message to the user)
                    alert("An error occurred. Please try again later.");
                }
            });
        });

        // Remove from Compare Event (using jQuery's event delegation)
        $('#compareProducts').on('click', '.remove-from-compare', function (event) {
            const productId = $(this).data('product-id');

            $.ajax({
                url: 'product_listing.php',
                method: 'POST',
                data: {
                    action: 'remove',
                    productId: productId
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.success == 'Product removed.') {
                        $(event.target).closest('.product-card').remove();
                        updateCompareUI();
                        alert(data.success);
                        comparisonData.products = comparisonData.products.filter(id => id != productId);
                        delete comparisonData.productsData[productId];

                        // --- FIX: Call populateOffcanvas() only on success ---
                        populateOffcanvas(comparisonData);
                    }
                },
                error: function (error) {
                    console.error('AJAX request failed:', error);
                    // Handle the error 
                    alert("An error occurred. Please try again later.");
                }
            });
        });
        populateOffcanvas(); // Initial update on page load
    });
</script>