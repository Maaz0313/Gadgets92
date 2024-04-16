<?php
require '../dbcon.php';
require '../inc/functions.inc.php';
$base_url = "http://gadgets92.test";
if (isset($_POST['action'])) {
    $sql = "SELECT * FROM products 
            INNER JOIN laptop_specs ON products.product_id = laptop_specs.product_id 
            INNER JOIN brands ON products.brand_id = brands.brand_id 
            WHERE products.status=1";

    if (isset($_POST['brand'])) {
        $brand = implode("','", $_POST['brand']);
        $sql .= " AND brands.brand_name IN ('" . $brand . "')";
    }
    if (isset($_POST['ram'])) {
        $ram = implode("','", $_POST['ram']);
        $sql .= " AND laptop_specs.ram_memory IN ('" . $ram . "')";
    }
    if (isset($_POST['ssd_storage'])) {
        $ssd_storage = implode("','", $_POST['ssd_storage']);
        $sql .= " AND laptop_specs.ssd_storage IN ('" . $ssd_storage . "')";
    }
    if (isset($_POST['hdd_storage'])) {
        $hdd_storage = implode("','", $_POST['hdd_storage']);
        $sql .= " AND laptop_specs.hdd_storage IN ('" . $hdd_storage . "')";
    }
    if (isset($_POST['screen_size'])) {
        $screen_size = implode("','", $_POST['screen_size']);
        $sql .= " AND laptop_specs.screen_size IN ('" . $screen_size . "')";
    }
    if (isset($_POST['screen_resolution'])) {
        $screen_resolution = implode("','", $_POST['screen_resolution']);
        $sql .= " AND laptop_specs.screen_resolution IN ('" . $screen_resolution . "')";
    }
    if (isset($_POST['os'])) {
        $os = implode("','", $_POST['os']);
        $sql .= " AND laptop_specs.os IN ('" . $os . "')";
    }
    $result = mysqli_query($con, $sql);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '
            <div class="card mb-3 p-3">
                            <div class="row g-0">
                                <div class="col-3 text-center">
                                    <a href="'. $base_url . '/laptops/product.php?id=' . $row['product_id'] .'"><img class="bd-placeholder-img img-fluid rounded-start" alt="mobile-image" src="../admin/images/products/'. $row['product_image'] .'" style="width: auto; height:150px"></a>
                                    <div class="row d-flex justify-content-center mt-3 fw-bold cmpr" style="font-size: 13px;cursor: pointer;">+ Compare</div>
                                </div>
                                <div class="col-9">
                                    <a class="text-decoration-none text-black" href="'. $base_url . '/laptops/product.php?id=' . $row['product_id'] .'">
                                        <div class="card-body p-0">
                                            <h5 class="card-title fw-bold d-flex align-items-center justify-content-between">
                                                <div class="text-start">'. $row['product_name'] .'</div>

                                                <div class="text-end " style="font-size: 17px;">Rs. '. formatPrice($row['price']) .'</div>
                                            </h5>
                                            <p class="card-text">

                                            <div class="pro-grid-specs pl10 pr10 pb10">
                                                <div class="lineheight20 specs font90">
                                                    <ul class="key-specs row row-cols-md-2 gx-5">
                                                        <li> '. $row['processor'] .' Processor</li>
                                                        <li> '. $row['ram_memory'] . ' ' . $row['ram_type'] .' RAM</li>
                                                        <li> '. $row['screen_size'] .' HD Display</li>
                                                        <li> '. $row['ssd_storage'] .' SSD Storage</li>
                                                        <li> '. $row['graphics'] .' Graphics</li>
                                                        <li> '. $row['os'] .'</li>
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
    } else {
        $output = '<h3>No Products Found!</h3>';
    }
    echo $output;
}
