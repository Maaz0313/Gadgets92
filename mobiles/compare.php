<?php
require ('../dbcon.php');
require ('../inc/functions.inc.php');
// Get product IDs from the URL
// Get product IDs from the URL and handle errors
if (isset($_GET['pid'])) {
    $productIds = explode(',', $_GET['pid']);
    $productIds = array_filter($productIds);
} else {
    // Handle cases where 'pid' is missing from the URL 
    ?>
    <script>
        alert("Error: Missing product IDs");
        window.location.href = "index.php"; 
    </script>
    <?php
    exit; // Stop further execution 
}
if (count($productIds) < 2) {
    ?>
    <script>
        alert("Error: You need to select at least two products to compare.");
        window.location.href = "index.php"; // Redirect back to the product listing page
    </script>
    <?php
    exit; // Stop further execution
}
if (count($productIds) > 3) {
    ?>
    <script>
        alert("Error: You can compare a maximum of three products at a time.");
        window.location.href = "index.php";
    </script>
    <?php
    exit; 
} 
// Fetch product details in the order specified in the URL
$products = [];
foreach ($productIds as $productId) {
    $sql = "SELECT * FROM products
            INNER JOIN mobile_specs ON products.product_id = mobile_specs.product_id 
            INNER JOIN brands ON products.brand_id = brands.brand_id
            WHERE products.product_id = ?"; // Fetch one product at a time
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $products[$productId] = $result->fetch_assoc(); // Use product ID as key
}
// $json_pretty = json_encode($products, JSON_PRETTY_PRINT); 
// echo "<pre>" . $json_pretty . "</pre>";
if (isset($products)) {
    $title = implode(' vs ', array_map(function ($product) {
        return $product['product_name'];
    }, $products));
}
if (isset($products)) {
    $description= 'Comparison of '.implode(', ', array_map(function ($product) {
        return $product['product_name'];
    }, $products));
}
require ('../inc/header.php');

?>
<main class="box pb-1 pdcm">
    <div class="fp-box" style="border: 1px solid #dee2e6;">

        <h4 class="fw-bold">
            <?php
            // Display product names in the heading (if $products is available)
            if (isset($products)) {
                echo implode(' vs ', array_map(function ($product) {
                    return $product['product_name'];
                }, $products));
            }
            ?>
        </h4>

        <p>Comparison of <?php
        if (isset($products)) {
            echo implode(', ', array_map(function ($product) {
                return $product['product_name'];
            }, $products));
        }
        ?>.</p>
    </div>
    <div class="container-lg mb-1" style="border: 1px solid #dee2e6;">
        <div class="pdcm-box">
            <div class="cmpr-spec-qlink hide-mobile">
                <div class="jump-specs whitebg padd10">
                    <ul class="list-unstyled">
                        <a class="greycolor font13 fontbold" href="#General">
                            <li>General</li>
                        </a>
                        <a class="greycolor font13 fontbold" href="#Design">
                            <li>Design</li>
                        </a>
                        <a class="greycolor font13 fontbold" href="#Display">
                            <li>Display</li>
                        </a>
                        <a class="greycolor font13 fontbold" href="#Camera">
                            <li>Camera</li>
                        </a>
                        <a class="greycolor font13 fontbold" href="#Performance">
                            <li>Performance</li>
                        </a>
                        <a class="greycolor font13 fontbold" href="#Storage">
                            <li>Storage</li>
                        </a>
                        <a class="greycolor font13 fontbold" href="#Battery">
                            <li>Battery</li>
                        </a>
                        <a class="greycolor font13 fontbold" href="#NetworkandConnectivity">
                            <li>Network and Connectivity</li>
                        </a> <a class="greycolor font13 fontbold" href="#Features">
                            <li>Features</li>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="cmpr-spec-box">
                <div class="pros"></div>
                <div class="cmpr-spec-head">
                    <div class="d-flex-center">
                        <div class="text-center eq-col col-th-one pt10 pb10 pl10 pr10 hide-mobile position-relative">
                        </div>
                        <?php if (isset($products)): ?>
                            <?php foreach ($products as $productId => $product): ?>
                                <div class="text-center eq-col col-th-one pt10 pb10 pl10 pr10 position-relative">
                                    <figure class="pt10 pb10 pl10 pr10">
                                        <a href="/mobiles/<?php echo $product['product_slug']; ?>">
                                            <img class="lazyloaded"
                                                data-src="../admin/images/products/<?php echo $product['product_image']; ?>"
                                                src="../admin/images/products/<?php echo $product['product_image']; ?>"
                                                width="50" alt="<?php echo $product['product_name']; ?>">
                                        </a>
                                    </figure>
                                    <a class="blackcolor" href="/mobiles/<?php echo $product['product_slug']; ?>">
                                        <h2 class="font13 fontnormal text-clamp text-clamp-1">
                                            <?php echo $product['product_name']; ?>
                                        </h2>
                                    </a>
                                    <a class="blackcolor" href="/mobiles/<?php echo $product['product_slug']; ?>">
                                        <div class="fontbold mb5">Rs. <?php echo $product['price']; ?></div>
                                    </a>
                                    <div class="blackcolor d-inline recmpr cursorpointer mt5" pid="<?php echo $productId; ?>">
                                        <span class="d-flex-center position-absolute top-0 right-0 pt5 pb5 pl5 pr5">
                                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'
                                                style="height: 20px;width: 20px;;">
                                                <path
                                                    d='M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z'>
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="General" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">General</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Brand</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['brand_name']; ?></td>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Release Date</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?= date("d M Y", strtotime($product['release_date'])); ?></td>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Device Type</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['device_type']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">SIM</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['sim']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Operating System</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['os']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="Design" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Design</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Dimensions</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['dimensions']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Weight</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['weight']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Waterproof</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['waterproof']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Build Material</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['build_material']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Colours</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['colors']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="Display" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Display</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Touch Screen</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['touch_screen']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Display</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['display']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Screen Size</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['screen_size']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Screen Resolution</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['screen_resolution']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Bezel-less Display</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['bezel_less_display']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Screen Protection</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['screen_protection']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="Camera" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Camera</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Rear Camera</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['rear_camera']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Sensor</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['sensor']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?> 
                            </tr>
                            <tr>
                                <td class="spec-head">Flash</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['flash']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Rear Video Recording</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['rear_video_recording']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Rear Features</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['rear_features']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Front Camera</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['front_camera']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="Performance" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Performance</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">RAM</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['ram']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Chipset</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['chipset']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">GPU</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['gpu']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">CPU</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['cpu_cores']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="Storage" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Storage</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Internal Storage</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['internal_storage']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Memory Card Slot</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['sd_card_slot']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="Battery" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Battery</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Battery</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['battery_capacity'].', '.$product['battery_features']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Fast Charging</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['fast_charging']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="NetworkandConnectivity"
                        class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Network and Connectivity</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Network Support</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['network_support']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Bluetooth</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['bluetooth']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Wi-Fi</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['wifi']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">USB</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['usb']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">GPS</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['gps']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">NFC</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['nfc']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="scroll-margin-top:9.5em;" id="Features" class="text-center pl5 pr5 grey-bg pt10 pb5">
                        <h3 class="blackcolor">Features</h3>
                    </div>
                    <table class="cmpr-spec-tbl">
                        <tbody>
                            <tr>
                                <td class="spec-head">Audio Jack</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['audio_jack']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">FM Radio</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?php echo $product['fm_radio']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Loud Speaker</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?= $product['loud_speaker']==1 ? 'Yes' : 'No'; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Fingerprint Sensor</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?= $product['fingerprint_sensor']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td class="spec-head">Sensors</td>
                                <?php if (isset($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <td><?= $product['other_sensors']; ?></td> 
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require ('../inc/footer.php');
?>