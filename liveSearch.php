<?php
include('dbcon.php');
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$base_url = $protocol . $_SERVER['HTTP_HOST'];

include('inc/functions.inc.php');
$s1 = sanitize_data(mysqli_real_escape_string($con, $_GET['n']));
$select_query = "SELECT * FROM products where product_name LIKE CONCAT('%', ?, '%')";
$sql = mysqli_execute_query($con, $select_query, [$s1]) or die(mysqli_error($con));

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
    <li class='p-3 d-inline'>
        <a class='link-p-colr' href='" . $base_url . $url."/" . $row['product_slug'] . "'>
            <div class='live-outer'>
                <div class='live-im'>
                    <img class='flex-shrink-0' src='" . $base_url . "/admin/images/products/" . $row['product_image'] . "'/>
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
