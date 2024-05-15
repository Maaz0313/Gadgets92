<?php
require '../dbcon.php';
require '../inc/functions.inc.php';
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$base_url = $protocol . $_SERVER['HTTP_HOST'];
if (isset($_POST['action'])) {
    $whereClause = '';
    if (isset($_POST['brand'])) {
        $brand = implode("','", $_POST['brand']);
        $whereClause .= " AND brands.brand_name IN ('" . $brand . "')";
    }
    if (isset($_POST['ram'])) {
        $ram = implode("','", $_POST['ram']);
        $whereClause .= " AND mobile_specs.ram IN ('" . $ram . "')";
    }
    if (isset($_POST['internal_storage'])) {
        $internal_storage = implode("','", $_POST['internal_storage']);
        $whereClause .= " AND mobile_specs.internal_storage IN ('" . $internal_storage . "')";
    }
    if (isset($_POST['screen_size'])) {
        $screen_size = implode("','", $_POST['screen_size']);
        $whereClause .= " AND mobile_specs.screen_size IN ('" . $screen_size . "')";
    }
    if (isset($_POST['screen_resolution'])) {
        $screen_resolution = implode("','", $_POST['screen_resolution']);
        $whereClause .= " AND mobile_specs.screen_resolution IN ('" . $screen_resolution . "')";
    }
    if (isset($_POST['battery'])) {
        $battery = implode("','", $_POST['battery']);
        $whereClause .= " AND mobile_specs.battery_capacity IN ('" . $battery . "')";
    }
    if (isset($_POST['os'])) {
        $os = implode("','", $_POST['os']);
        $whereClause .= " AND mobile_specs.os IN ('" . $os . "')";
    }
    if (isset($_POST['front_camera'])) {
        $front_camera = implode("','", $_POST['front_camera']);
        $whereClause .= " AND mobile_specs.front_camera IN ('" . $front_camera . "')";
    }
    if (isset($_POST['rear_camera'])) {
        $rear_camera = implode("','", $_POST['rear_camera']);
        $whereClause .= " AND mobile_specs.rear_camera IN ('" . $rear_camera . "')";
    }
    // page nos. logic
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
    INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id INNER JOIN brands ON products.brand_id = brands.brand_id  WHERE products.status = 1 " . $whereClause
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

    $sql = "SELECT * FROM products 
            INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id 
            INNER JOIN brands ON products.brand_id = brands.brand_id 
            WHERE products.status=1" . $whereClause . "
            LIMIT $offset, $total_records_per_page";

    $result = mysqli_query($con, $sql);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '
            <div class="card mb-3 p-3">
                            <div class="row g-0">
                                <div class="col-3 text-center">
                                    <a class="text-decoration-none text-black" href="' . $base_url . '/mobiles/' . $row['product_slug'] . '">
                                        <img class="bd-placeholder-img img-fluid rounded-start" alt="mobile-image" src="../admin/images/products/' . $row['product_image'] . '" style="width: auto; height:150px">
                                    </a>
                                    <div class="row d-flex justify-content-center mt-3 fw-bold cmpr" style="font-size: 13px;cursor: pointer;">+ Compare</div>
                                </div>
                                <div class="col-9">
                                    <a class="text-decoration-none text-black" href="' . $base_url . '/mobiles/' . $row['product_slug'] . '">
                                        <div class="card-body p-0">
                                            <h5 class="card-title fw-bold d-flex align-items-center justify-content-between">
                                                <div class="text-start">' . $row['product_name'] . '</div>

                                                <div class="text-end " style="font-size: 17px;">Rs. ' . formatPrice($row['price']) . '</div>
                                            </h5>
                                            <p class="card-text">

                                            <div class="pro-grid-specs pl10 pr10 pb10">
                                                <div class="lineheight20 specs font90">
                                                    <ul class="key-specs row row-cols-md-2 gx-5">
                                                        <li> ' . $row['ram'] . ' RAM</li>
                                                        <li> ' . $row['internal_storage'] . ' Internal Storage</li>
                                                        <li> ' . $row['display'] . ' Display</li>
                                                        <li> ' . $row['front_camera'] . ' Front Camera</li>
                                                        <li> ' . $row['rear_camera'] . ' Rear Camera</li>
                                                        <li> ' . $row['chipset'] . ' Processor</li>
                                                        <li> ' . $row['os'] . ' Operating System</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
            ';
        }
        $output .= '
    <nav aria-label="...">
        <ul class="pagination justify-content-center">

            <li class="page-item '. ($page_no <= 1 ? 'disabled' : '') .'">
                <a class="page-link" '. ($page_no > 1 ? "href='?page_no=$previous_page'" : '') .'>Previous</a>
            </li>

            ';

            if ($total_no_of_pages <= 10) {
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page_no) {
                        $output .= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                    } else {
                        $output .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            } elseif ($total_no_of_pages > 10) {

                if ($page_no <= 4) {
                    for ($counter = 1; $counter < 8; $counter++) {
                        if ($counter == $page_no) {
                            $output .= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            $output .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                    $output .= "<li class='page-item'><a class='page-link'>...</a></li>";
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                    $output .= "<li class='page-item'><a class='page-link'>...</a></li>";
                    for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                        if ($counter == $page_no) {
                            $output .= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            $output .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                    $output .= "<li class='page-item'><a class='page-link'>...</a></li>";
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                } else {
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                    $output .= "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                    $output .= "<li class='page-item'><a class='page-link'>...</a></li>";

                    for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                        if ($counter == $page_no) {
                            $output .= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            $output .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                }
            }

            $output .= '
            <li class="page-item '. ($page_no >= $total_no_of_pages ? 'disabled' : '') .'">
                <a class="page-link" '. ($page_no < $total_no_of_pages ? "href='?page_no=$next_page'" : '') .'>Next</a>
            </li>
            '. ($page_no < $total_no_of_pages ? "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>" : '') ;
    } else {
        $output = '<h3>No Products Found!</h3>';
    }
    echo $output;
}