<?php
require '../dbcon.php';
require '../inc/functions.inc.php';
$base_url = "http://gadgets92.test";
if (isset($_POST['action'])) {
    $sql = "SELECT * FROM products 
            INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id 
            INNER JOIN brands ON products.brand_id = brands.brand_id 
            WHERE products.status=1";
    
    if (isset($_POST['brand'])) {
        $brand = implode("','", $_POST['brand']);
        $sql .= " AND brands.brand_name IN ('" . $brand . "')";
    }
    if (isset($_POST['ram'])) {
        $ram = implode("','", $_POST['ram']);
        $sql .= " AND mobile_specs.ram IN ('" . $ram . "')";
    }
    if (isset($_POST['internal_storage'])) {
        $internal_storage = implode("','", $_POST['internal_storage']);
        $sql .= " AND mobile_specs.internal_storage IN ('" . $internal_storage . "')";
    }
    if (isset($_POST['screen_size'])) {
        $screen_size = implode("','", $_POST['screen_size']);
        $sql .= " AND mobile_specs.screen_size IN ('" . $screen_size . "')";
    }
    if (isset($_POST['screen_resolution'])) {
        $screen_resolution = implode("','", $_POST['screen_resolution']);
        $sql .= " AND mobile_specs.screen_resolution IN ('" . $screen_resolution . "')";
    }
    if (isset($_POST['battery'])) {
        $battery = implode("','", $_POST['battery']);
        $sql .= " AND mobile_specs.battery_capacity IN ('" . $battery . "')";
    }
    if (isset($_POST['os'])) {
        $os = implode("','", $_POST['os']);
        $sql .= " AND mobile_specs.os IN ('" . $os . "')";
    }
    if (isset($_POST['front_camera'])) {
        $front_camera = implode("','", $_POST['front_camera']);
        $sql .= " AND mobile_specs.front_camera IN ('" . $front_camera . "')";
    }
    if (isset($_POST['rear_camera'])) {
        $rear_camera = implode("','", $_POST['rear_camera']);
        $sql .= " AND mobile_specs.rear_camera IN ('" . $rear_camera . "')";
    }
    $result = mysqli_query($con, $sql);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '
            <div class="card mb-3 p-3">
                            <div class="row g-0">
                                <div class="col-3 text-center">
                                    <a class="text-decoration-none text-black" href="'. $base_url . '/mobiles/' . $row['product_slug'].'">
                                        <img class="bd-placeholder-img img-fluid rounded-start" alt="mobile-image" src="../admin/images/products/'. $row['product_image'].'" style="width: auto; height:150px">
                                    </a>
                                    <div class="row d-flex justify-content-center mt-3 fw-bold cmpr" style="font-size: 13px;cursor: pointer;">+ Compare</div>
                                </div>
                                <div class="col-9">
                                    <a class="text-decoration-none text-black" href="'. $base_url . '/mobiles/' . $row['product_slug'].'">
                                        <div class="card-body p-0">
                                            <h5 class="card-title fw-bold d-flex align-items-center justify-content-between">
                                                <div class="text-start">'. $row['product_name'].'</div>

                                                <div class="text-end " style="font-size: 17px;">Rs. '. formatPrice($row['price']).'</div>
                                            </h5>
                                            <p class="card-text">

                                            <div class="pro-grid-specs pl10 pr10 pb10">
                                                <div class="lineheight20 specs font90">
                                                    <ul class="key-specs row row-cols-md-2 gx-5">
                                                        <li> '. $row['ram'].' RAM</li>
                                                        <li> '. $row['internal_storage'].' Internal Storage</li>
                                                        <li> '. $row['display'].' Display</li>
                                                        <li> '. $row['front_camera'].' Front Camera</li>
                                                        <li> '. $row['rear_camera'].' Rear Camera</li>
                                                        <li> '. $row['chipset'].' Processor</li>
                                                        <li> '. $row['os'].' Operating System</li>
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
    }
    else {
        $output = '<h3>No Products Found!</h3>';
    }
    echo $output;
}