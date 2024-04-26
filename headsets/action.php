<?php
require '../dbcon.php';
require '../inc/functions.inc.php';
$base_url = "http://gadgets92.test";
if (isset($_POST['action'])) {
    $sql = "SELECT * FROM products 
            INNER JOIN headset_specs ON products.product_id = headset_specs.product_id 
            INNER JOIN brands ON products.brand_id = brands.brand_id 
            WHERE products.status=1";

    if (isset($_POST['brand'])) {
        $brand = implode("','", $_POST['brand']);
        $sql .= " AND brands.brand_name IN ('" . $brand . "')";
    }
    if (isset($_POST['type'])) {
        $type = implode("','", $_POST['type']);
        $sql .= " AND headset_specs.type IN ('" . $type . "')";
    }
    if (isset($_POST['design'])) {
        $design = implode("','", $_POST['design']);
        $sql .= " AND headset_specs.design IN ('" . $design . "')";
    }
    if (isset($_POST['connectivity'])) {
        $connectivity = implode("','", $_POST['connectivity']);
        $sql .= " AND headset_specs.connectivity IN ('" . $connectivity . "')";
    }
    if (isset($_POST['water_resistant'])) {
        $water_resistant = implode("','", $_POST['water_resistant']);
        $sql .= " AND headset_specs.water_resistant IN ('" . $water_resistant . "')";
    }
    $result = mysqli_query($con, $sql);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '
            <div class="card mb-3 p-3">
                <div class="row g-0">
                    <div class="col-3 text-center">
                        <a href="'. $base_url . '/headsets/product.php?id=' . $row['product_id'] .'"><img class="bd-placeholder-img img-fluid rounded-start" alt="mobile-image" src="../admin/images/products/'. $row['product_image'] .'" style="width: auto; height:150px"></a>
                        <div class="row d-flex justify-content-center mt-3 fw-bold cmpr" style="font-size: 13px;cursor: pointer;">+ Compare</div>
                    </div>
                    <div class="col-9">
                        <a class="text-decoration-none text-black" href="'. $base_url . '/headsets/product.php?id=' . $row['product_id'] .'">
                            <div class="card-body p-0">
                                <h5 class="card-title fw-bold d-flex align-items-center justify-content-between">
                                    <div class="text-start">'. $row['product_name'] .'</div>

                                    <div class="text-end " style="font-size: 17px;">Rs. '. formatPrice($row['price']) .'</div>
                                </h5>
                                <p class="card-text">

                                <div class="pro-grid-specs pl10 pr10 pb10">
                                    <div class="lineheight20 specs font90">
                                        <ul class="key-specs row row-cols-md-2 gx-5">
                                            <li> '. $row['design'] .'</li>
                                            <li> '. $row['type'] .'</li>
                                            <li> '. $row['battery_life'] .' Battery Life</li>
                                            <li> '. $row['connectivity'] .' Connectivity</li>
                                            <li> '. ($row['built-in_mic'] == '1' ? 'Built-in Mic' : 'No Built-in Mic') .'</li>
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
