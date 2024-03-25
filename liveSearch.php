<?php
include('dbcon.php');
// include('inc/header.php');
$base_url = "http://gadgets92.test";

include('inc/functions.inc.php');
$s1 = $_REQUEST["n"];
$select_query = "select * from products where product_name like '%" . $s1 . "%'";
$sql = mysqli_query($con, $select_query) or die(mysqli_error($con));
$row = mysqli_fetch_array($sql);

$s = "";
while ($row = mysqli_fetch_array($sql)) {
    switch ($row['category_id']) {
        case 1:
            $url = "/mobiles";
            break;
        case 2:
            $url = "/laptops";
            break;
        case 3:
            $url = "/headsets";
            break;
        case 4:
            $url = "/watches";
            break;
        case 5:
            $url = "/televisions";
            break;
        default:
            $url = "/";
            break;
    }
    $s .= "
    <li class='p-3'>
        <a class='link-p-colr' href='" . $base_url . $url ."/product.php?id=" . $row['product_id'] . "'>
            <div class='live-outer'>
                <div class='live-im'>
                    <img style='width: fit-content; height: 60px;' src='" . $base_url . "/admin/images/products/" . $row['product_image'] . "'/>
                </div>
                <div class='live-product-det ps-3'>
                    <div class='live-product-name'>
                        <p>" . $row['product_name'] . "</p>
                    </div>
                    <div class='live-product-price'>
                        <div class='live-product-price-text'><p>Rs." . formatPrice($row['price']) . "</p></div>
                    </div>
                </div>
            </div>
        </a>
    </li>
	";
}
echo $s;
