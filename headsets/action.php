<?php
require '../dbcon.php';
require '../inc/functions.inc.php';
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$base_url = $protocol . $_SERVER['HTTP_HOST'];
if (isset($_POST['action'])) {
    $whereClause ='';
    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $searchTerm = $_POST['search'];
        $searchTerm = sanitize_data(mysqli_real_escape_string($con, $searchTerm)); 
        $whereClause .= " AND products.product_name LIKE '%{$searchTerm}%'";
    }
    if(isset($_POST['min_price']) && isset($_POST['max_price']) && (!empty($_POST['min_price']) || $_POST['min_price']==0) && !empty($_POST['max_price'])) {
        $minPrice = sanitize_data(mysqli_real_escape_string($con,$_POST['min_price']));
        $maxPrice = sanitize_data(mysqli_real_escape_string($con,$_POST['max_price']));
        $whereClause .= " AND products.price BETWEEN $minPrice AND $maxPrice";
    }
    if (isset($_POST['brand']) && !empty($_POST['brand'])) {
        $brand = implode("','", $_POST['brand']);
        $whereClause .= " AND brands.brand_name IN ('" . $brand . "')";
    }
    if (isset($_POST['type'])) {
        $type = implode("','", $_POST['type']);
        $whereClause .= " AND headset_specs.type IN ('" . $type . "')";
    }
    if (isset($_POST['design'])) {
        $design = implode("','", $_POST['design']);
        $whereClause .= " AND headset_specs.design IN ('" . $design . "')";
    }
    if (isset($_POST['connectivity'])) {
        $connectivity = implode("','", $_POST['connectivity']);
        $whereClause .= " AND headset_specs.connectivity IN ('" . $connectivity . "')";
    }
    if (isset($_POST['water_resistant'])) {
        $water_resistant = implode("','", $_POST['water_resistant']);
        $whereClause .= " AND headset_specs.water_resistant IN ('" . $water_resistant . "')";
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
    $result_count = mysqli_query(
        $con,
        "SELECT COUNT(*) AS total_records FROM products
    INNER JOIN headset_specs ON products.product_id = headset_specs.product_id INNER JOIN brands ON products.brand_id = brands.brand_id WHERE products.status = 1 " . $whereClause
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

    $sql = "SELECT * FROM products 
            INNER JOIN headset_specs ON products.product_id = headset_specs.product_id 
            INNER JOIN brands ON products.brand_id = brands.brand_id 
            WHERE products.status=1" . $whereClause. "
    LIMIT $offset, $total_records_per_page";

    $result = mysqli_query($con, $sql);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '
            <div class="card mb-3 p-3">
                <div class="row g-0">
                    <div class="col-3 text-center">
                        <a href="' . $base_url . '/headsets/' . $row['product_slug'] . '"><img class="bd-placeholder-img img-fluid rounded-start" alt="mobile-image" src="../admin/images/products/' . $row['product_image'] . '" style="width: auto; height:150px"></a>
                        <div class="row d-flex justify-content-center mt-3 fw-bold cmpr" style="font-size: 13px;cursor: pointer;">+ Compare</div>
                    </div>
                    <div class="col-9">
                        <a class="text-decoration-none text-black" href="' . $base_url . '/headsets/' . $row['product_slug'] . '">
                            <div class="card-body p-0">
                                <h5 class="card-title fw-bold d-flex align-items-center justify-content-between">
                                    <div class="text-start">' . $row['product_name'] . '</div>

                                    <div class="text-end " style="font-size: 17px;">Rs. ' . formatPrice($row['price']) . '</div>
                                </h5>
                                <p class="card-text">

                                <div class="pro-grid-specs pl10 pr10 pb10">
                                    <div class="lineheight20 specs font90">
                                        <ul class="key-specs row row-cols-md-2 gx-5">
                                            <li> ' . $row['design'] . '</li>
                                            <li> ' . $row['type'] . '</li>
                                            <li> ' . $row['battery_life'] . ' Battery Life</li>
                                            <li> ' . $row['connectivity'] . ' Connectivity</li>
                                            <li> ' . ($row['built-in_mic'] == '1' ? 'Built-in Mic' : 'No Built-in Mic') . '</li>
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
                <strong>Showing Page '. $page_no." of ".$total_no_of_pages.'</strong>
        
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
