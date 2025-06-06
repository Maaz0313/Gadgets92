<?php
date_default_timezone_set('Asia/Karachi');
require ('../dbcon.php');
require ('../inc/functions.inc.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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

$slug = isset($_GET['slug']) ? mysqli_real_escape_string($con, $_GET['slug']) : '';
// echo $slug;
// exit(0);
if (empty($slug)) {
    ?>
    <script>
        window.location.href = $base_url;
    </script>
    <?php
    exit;
}

$sql = "SELECT *
    FROM products
    INNER JOIN laptop_specs ON products.product_id = laptop_specs.product_id 
    INNER JOIN brands ON products.brand_id = brands.brand_id
    WHERE products.product_slug = '$slug'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if ($row === null) {
    ?>
    <script>
        window.location.href = $base_url;
    </script>
    <?php
    exit;
}
(int) $id = $row['product_id'];
$title = $row['product_name'];
$description = $row['product_description'];
require ('../inc/header.php');

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
<div class="box pb-3">
    <!-- features overview -->
    <div class="bg-light container mb-3">
        <nav class="p-2 pb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../">Home</a></li>
                <li class="breadcrumb-item"><a href="../laptops/">Laptops</a></li>
                <li class="breadcrumb-item"><a
                        href="../laptops/?brand=<?= $row['brand_name'] ?>"><?= $row['brand_name']; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $row['product_name'] ?></li>
            </ol>
        </nav>
        <div class="row">
            <h4><?= $row['product_name'] ?></h4>
        </div>
        <div class="row">
            <div class="col-auto">
                <span class="star">&#9733; <span class="text-black">0 <!-- average review count -->
                    </span></span>
            </div>
            <div class="col-auto">
                <span class="text-black">0 User Ratings</span>
            </div>
            <div class="col-auto">
                <span><a class="text-decoration-none text-black" href="#review">Write A Review</a></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content w300 h-auto h123 px-3">
                            <div class="modal-header p-0 py-2">
                                <h1 class="modal-title fs-5" id="exampleModalCenterTitle">Share this product via
                                </h1>
                                <button type="button" class="border-0 bg-white " data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <svg class="close-button" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
                                        <path
                                            d='M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z'>
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body mx-auto p-0">
                                <div class="p-3 lh-0">
                                    <div class="social-share lineheight0 padd15">
                                        <a class="mr10 d-inline-block"
                                            href="https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>"
                                            title="Facebook" target="_blank" rel="nofollow noopener">
                                            <svg class="whitebg border rounded-5" style="padding:8px;width:40px"
                                                viewBox="0 0 24 24" width="40" height="40" fill="#1877f2">
                                                <path
                                                    d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a class="mr10 d-inline-block" href="https://twitter.com/share?url=<?= $url ?>"
                                            title="Twitter" target="_blank" rel="nofollow noopener">
                                            <svg class="whitebg border rounded-5" style="padding:8px;width:40px"
                                                width="40" height="40" viewBox="352.95 129.27 962.66 962.66">
                                                <g>
                                                    <circle fill="#000" cx="834.28" cy="610.6" r="481.33"></circle>
                                                    <g id="layer1" transform="translate(52.390088,-25.058597)">
                                                        <path id="path1009" fill="#fff"
                                                            d="M485.39,356.79l230.07,307.62L483.94,914.52h52.11l202.7-218.98l163.77,218.98h177.32 L836.82,589.6l215.5-232.81h-52.11L813.54,558.46L662.71,356.79H485.39z M562.02,395.17h81.46l359.72,480.97h-81.46L562.02,395.17 z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                        <a class="mr10 d-inline-block"
                                            href="https://pinterest.com/pin/create/button/?url=<?= $url ?>"
                                            title="Pinterest" target="_blank" rel="nofollow noopener">
                                            <svg class="whitebg border rounded-5" style="padding:8px;width:40px"
                                                viewBox="0 0 774 1000.2" width="40" height="40" fill="#e60023">
                                                <path
                                                    d="M0 359c0-42 8.8-83.7 26.5-125s43-79.7 76-115 76.3-64 130-86S345.7 0 411 0c106 0 193 32.7 261 98s102 142.3 102 231c0 114-28.8 208.2-86.5 282.5S555.3 723 464 723c-30 0-58.2-7-84.5-21s-44.8-31-55.5-51l-40 158c-3.3 12.7-7.7 25.5-13 38.5S259.8 873 253.5 885c-6.3 12-12.7 23.3-19 34s-12.7 20.7-19 30-11.8 17.2-16.5 23.5-9 11.8-13 16.5l-6 8c-2 2.7-4.7 3.7-8 3s-5.3-2.7-6-6c0-.7-.5-5.3-1.5-14s-2-17.8-3-27.5-2-22.2-3-37.5-1.3-30.2-1-44.5 1.3-30.2 3-47.5 4.2-33.3 7.5-48c7.3-31.3 32-135.7 74-313-5.3-10.7-9.7-23.5-13-38.5s-5-27.2-5-36.5l-1-15c0-42.7 10.8-78.2 32.5-106.5S303.3 223 334 223c24.7 0 43.8 8.2 57.5 24.5S412 284.3 412 309c0 15.3-2.8 34.2-8.5 56.5s-13.2 48-22.5 77-16 52.5-20 70.5c-6.7 30-.8 56 17.5 78s42.8 33 73.5 33c52.7 0 96.2-29.8 130.5-89.5S634 402.7 634 318c0-64.7-21-117.5-63-158.5S470.3 98 395 98c-84 0-152.2 27-204.5 81S112 297.7 112 373c0 44.7 12.7 82.3 38 113 8.7 10 11.3 20.7 8 32-1.3 3.3-3.3 11-6 23s-4.7 19.7-6 23c-1.3 7.3-4.7 12.2-10 14.5s-11.3 2.2-18-.5c-39.3-16-68.8-43.5-88.5-82.5S0 411 0 359z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a class="mr10 d-inline-block"
                                            href="https://api.whatsapp.com/send?text=<?= $url ?>" title="WhatsApp"
                                            target="_blank" rel="nofollow noopener">
                                            <svg class="whitebg border rounded-5" style="padding:8px;width:40px"
                                                viewBox="0 0 24 24" width="40" height="40" fill="#25d366">
                                                <path
                                                    d="M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a class="mr10 d-inline-block"
                                            href="https://telegram.me/share/url?url=<?= $url ?>" title="Telegram"
                                            target="_blank" rel="nofollow noopener">
                                            <svg class="whitebg border rounded-5" style="padding:8px;width:40px"
                                                viewBox="0 0 24 24" width="40" height="40" fill="#229ed9">
                                                <path
                                                    d="M20.7 3.7 2.9 10.6c-1.2.4-1.2 1.1-.2 1.4l4.6 1.4 10.5-6.6c.5-.3 1-.1.6.2l-8.6 7.7-.3 4.7c.5 0 .7-.2 1-.5l2.2-2.1 4.6 3.4c.8.4 1.4.2 1.6-.8l3-14.2c.4-1.3-.4-1.8-1.2-1.5z">
                                                </path>
                                            </svg> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-relative overflow-hidden mx-auto mt-2">

                    <div class="m-0 p-0 border-0 d-block-tablet product-img mb-0 modulo-lightbox">
                        <div class="m-0 p-0 border-0">
                            <figure class="p-3 bg-secondary-subtle text-center rounded-3">
                                <a class="p-0 m-0 border-0 text-center" data-rel="smrt_glr"
                                    href="../admin/images/products/<?= $row['product_image'] ?>" target="_blank"
                                    data-thumb="../admin/images/products/<?= $row['product_image'] ?>">
                                    <img class="blend-mode ls-is-cached lazyloaded"
                                        data-src="../admin/images/products/<?= $row['product_image'] ?>"
                                        src="../admin/images/products/<?= $row['product_image'] ?>"
                                        alt="<?= $row['product_name'] ?>">
                                </a>
                            </figure>

                            <div data-bs-toggle="modal" data-bs-target="#exampleModalCenter"
                                class="modal-trg font13 cursorpointer d-flex align-items-center flex-row position-absolute top-0 right-0 m-3 "
                                data-popup="share_product">
                                <svg fill="#888" width="20px" height="20px" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.675 7.415 12.8 1.479C12.198 0.959 11.25 1.381 11.25 2.188v3.127C4.975 5.387 0 6.645 0 12.591c0 2.4 1.546 4.778 3.255 6.021 0.533 0.388 1.293 -0.099 1.097 -0.728C2.581 12.219 5.192 10.715 11.25 10.628V14.063c0 0.809 0.949 1.229 1.55 0.71l6.875 -5.938c0.432 -0.374 0.433 -1.045 0 -1.419z">
                                    </path>
                                </svg>
                            </div>
                            <div class="position-absolute d-flex justify-content-center fw-bold  add-to-compare"
                                        data-product-id="<?= $row['product_id']; ?>"
                                        data-category-id="<?= $row['category_id']; ?>"
                                        style="font-size: 17px;cursor: pointer;top: 15.7rem;right: 4.5rem;">+ Compare</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8 my-2">
                <div class="d-flex flex-wrap flex-row">
                    <span class="fs-4" style="font-weight: 700;">Rs. <?= formatPrice($row['price']) ?> <span
                            style="font-size: 13px;" class="fw-normal ">(onwards)</span></span>
                </div>
                <div class="row">
                    <span class="greycolor font13">
                        Available in 2 stores
                    </span>
                </div>
                <div class="row">
                    <span>
                        Realme Narzo N53 best price in Pakistan is at Rs. 35,000. The lowest price of Realme Narzo
                        N53
                        is Rs. 35,000 at Daraz.pk. The price was updated on January 1, 2024.
                    </span>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header p-0  bg-primary text-white">Amazon.in</div>
                            <div class="card-footer p-0 bg-secondary-subtle">
                                <h4 class="card-title mt-2">Rs. 8,999</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 sc-crd">
                        <div class="card border-warning text-center">
                            <div class="card-header p-0 bg-info text-white ">Flipkart.com</div>
                            <div class="card-footer p-0 bg-secondary-subtle">
                                <h4 class="card-title mt-2">Rs. 9,197</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <h6 class="fw-bolder ">Key Specifications</h6>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-calendar-date"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">Release Date</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;"
                                class="key-spec-value"><?= date("d M Y", strtotime($row['release_date'])); ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-memory"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">RAM</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;"
                                class="key-spec-value"><?= $row['ram_memory'] . ' ' . $row['ram_type']; ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-hdd-rack"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">SSD Storage</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;" class="key-spec-value"><?= $row['ssd_storage']; ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-battery-half"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">Battery</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;" class="key-spec-value"><?= $row['battery']; ?></span>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="d-flex align-items-center ">
                                <i class="fa fa-laptop"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">Display</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;" class="key-spec-value"><?= $row['display']; ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-cpu"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">Processor</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;" class="key-spec-value"><?= $row['processor']; ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-gpu-card"></i>
                                <span style="padding-left: 8px;" class="key-spec-name">GPU</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;" class="key-spec-value"><?= $row['graphics']; ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <svg height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"
                                    preserveAspectRatio="xMidYMid meet">
                                    <g fill="#333" stroke="none"
                                        transform="translate(0.000000,24.000000) scale(0.006977,-0.006977)">
                                        <path
                                            d="M1556 3299 c-551 -58 -1029 -396 -1267 -894 -381 -799 -40 -1749 763 -2125 417 -195 919 -195 1336 0 676 317 1041 1052 882 1781 -101 465 -411 863 -835 1074 -286 142 -575 196 -879 164z m444 -168 c442 -89 819 -380 1015 -786 54 -113 87 -210 116 -345 32 -151 32 -409 0 -560 -125 -582 -549 -1007 -1131 -1131 -138 -30 -398 -32 -535 -6 -589 114 -1031 549 -1156 1137 -30 142 -33 389 -5 535 85 457 377 840 793 1041 147 71 276 108 488 138 67 10 324 -4 415 -23z">
                                        </path>
                                        <path
                                            d="M2208 2268 c-192 -25 -325 -204 -278 -373 29 -104 121 -170 344 -245 205 -69 266 -109 266 -175 0 -63 -25 -101 -89 -132 -124 -61 -327 -20 -371 74 -15 32 -16 33 -87 33 -40 0 -73 -4 -73 -8 0 -5 7 -32 16 -61 39 -132 180 -211 382 -212 134 -2 218 28 289 103 81 84 104 229 51 319 -51 86 -111 123 -321 196 -153 53 -213 81 -246 117 -20 22 -23 32 -19 77 5 44 11 58 41 85 21 20 59 40 94 50 50 15 69 16 136 6 97 -14 155 -45 182 -95 l20 -37 73 0 c39 0 72 4 72 8 0 5 -7 32 -16 61 -44 149 -243 238 -466 209z">
                                        </path>
                                        <path
                                            d="M1069 2247 c-122 -42 -198 -112 -256 -232 -46 -97 -66 -213 -59 -335 20 -331 191 -511 486 -511 248 0 411 132 466 377 23 105 16 312 -15 406 -43 133 -142 243 -261 290 -43 17 -81 22 -175 25 -105 3 -128 1 -186 -20z m308 -147 c162 -71 237 -292 181 -530 -46 -191 -217 -295 -406 -246 -113 29 -184 98 -228 221 -25 71 -25 279 0 350 58 161 175 241 338 231 38 -3 88 -14 115 -26z">
                                        </path>
                                    </g>
                                </svg>
                                <span style="padding-left: 7px;" class="key-spec-name">OS (Operating System)</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;" class="key-spec-value"><?= $row['os']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- complete features -->
    <div class="container bg-light p-3 mb-3">
        <h5 class="fw-bold pb-2"><?= $row['product_name']; ?> Full Specifications</h5>
        <div class="category">
            <h3 class="">General (4)
                <span class="icon"><i class="bi bi-chevron-down"></i></span>
            </h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Release Date
                        </th>
                        <td>
                            <?= date("d M Y", strtotime($row['release_date'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Brand
                        </th>
                        <td>
                            <?= $row['brand_name']; ?>
                        </td>
                    </tr>
                    <th>
                        Model
                    </th>
                    <td>
                        <?= $row['model']; ?>
                    </td>
                    </tr>
                    <tr>
                        <th>
                            Operating System
                        </th>
                        <td>
                            <?= $row['os']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Design (3) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Dimensions
                        </th>
                        <td>
                            <?= $row['dimensions']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Weight
                        </th>
                        <td>
                            <?= $row['weight']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Colors
                        </th>
                        <td>
                            <?= $row['colors']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Display (6) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Display Tech
                        </th>
                        <td>
                            <?= $row['display']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Touch Screen
                        </th>
                        <td>
                            <?= $row['touch_screen'] == 1 ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Screen Size
                        </th>
                        <td>
                            <?= $row['screen_size']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Screen Resolution
                        </th>
                        <td>
                            <?= $row['screen_resolution']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Display Features
                        </th>
                        <td>
                            <?= $row['display_features']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Performance (6) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Processor
                        </th>
                        <td>
                            <?= $row['processor']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Processor Variant
                        </th>
                        <td>
                            <?= $row['processor_variant']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Clock Speed
                        </th>
                        <td>
                            <?= $row['clock_speed']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            No. of Cores
                        </th>
                        <td>
                            <?= $row['cores']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Graphics
                        </th>
                        <td>
                            <?= $row['graphics']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            System Architecture
                        </th>
                        <td>
                            <?= $row['sys_arch']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Storage (5) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            RAM
                        </th>
                        <td>
                            <?= $row['ram_memory'] . ' ' . $row['ram_type']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            RAM Frequency
                        </th>
                        <td>
                            <?= $row['ram_frequency']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cache
                        </th>
                        <td>
                            <?= $row['cache']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            SSD Storage
                        </th>
                        <td>
                            <?= $row['ssd_storage']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            HDD Storage
                        </th>
                        <td>
                            <?= $row['hdd_storage']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Battery (2) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Battery
                        </th>
                        <td>
                            <?= $row['battery']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Power Supply
                        </th>
                        <td>
                            <?= $row['power_supply']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Network & Connectivity (2) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Bluetooth
                        </th>
                        <td>
                            <?= $row['bluetooth']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Wi-Fi
                        </th>
                        <td>
                            <?= $row['wifi']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Ports (5) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Ethernet Port
                        </th>
                        <td>
                            <?= $row['ethernet_port']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            USB Ports
                        </th>
                        <td>
                            <?= $row['usb_port']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Headset Jack
                        </th>
                        <td>
                            <?= $row['headset_jack'] ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            HDMI Port
                        </th>
                        <td>
                            <?= $row['hdmi_port']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Multi Card Slot
                        </th>
                        <td>
                            <?= $row['multi_card_slot']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Multimedia (4) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Webcam
                        </th>
                        <td>
                            <?= $row['webcam'] ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Mic
                        </th>
                        <td>
                            <?= $row['mic'] ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Headset Jack
                        </th>
                        <td>
                            <?= $row['headset_jack'] ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Speakers
                        </th>
                        <td>
                            <?= $row['speakers']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Features (3) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <!-- Disk Drive -->
                    <tr>
                        <th>
                            Disk Drive
                        </th>
                        <td>
                            <?= $row['disk_drive'] ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                    <!-- Keyboard -->
                    <tr>
                        <th>
                            Keyboard
                        </th>
                        <td>
                            <?= $row['keyboard']; ?>
                        </td>
                    </tr>
                    <!-- Backlit Keyboard -->
                    <tr>
                        <th>
                            Backlit Keyboard
                        </th>
                        <td>
                            <?= $row['backlit_keyboard'] ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- user reviews -->
    <div class="container bg-light p-3" id="review">
        <div class="d-flex align-items-center p-2">
            <h5 class="fw-semibold" style="flex: 1;">User Reviews</h5>
        </div>
        <!-- offcanvas starts -->
        <div class="offcanvas offcanvas-bottom w-90 mx-auto h-auto " tabindex="-1" id="offcanvasBottom"
            aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div action="#">
                    <input type="hidden" name="product_id" id="product_id" value="<?= $row['product_id']; ?>">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['auth_user']['user_id']; ?>">
                    <h4 class="text-center mt-2 mb-4">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>
                    <div class="mb-3">
                        <label for="review_heading" class="form-label">Review Heading</label>
                        <input type="text" class="form-control" name="heading" id="review_heading">
                    </div>
                    <div class="mb-3">
                        <label for="review_summary" class="form-label">Review Summary</label>
                        <textarea class="form-control h-100 " name="summary" id="review_summary" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="save_review">Submit Review</button>
                </div>
            </div>
        </div>
        <!-- offcanvas ends -->
        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <span class="star-rating"></span>
                        </div>
                        <h3><span id="total_review">0</span> Review</h3>
                    </div>
                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <?php
                        if (isset($_SESSION['authenticated'], $_SESSION['auth_user'])) {
                            ?>
                            <button class="btn btn-primary fw-medium text-end" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Write a Review</button>
                            <?php
                        } else {
                            ?>
                            <a class="btn btn-primary fw-medium text-end"
                                href="../login.php?continue=<?php echo $link ?>">Login to
                                Review</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="review_content">
            <!-- All reviews here -->
        </div>
    </div>
</div>
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
require '../inc/footer.php';
?>
<style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #b5bec7;
    }

    .star-rating::before {
        content: "⭐⭐⭐⭐⭐";
        font-size: 16px;
    }

    .star-rating {
        display: inline-block;
        background-clip: text;
        -webkit-background-clip: text;
        color: rgba(0, 0, 0, 0.1);
        background-color: #b5bec7;
    }
</style>
<script>

    $(document).ready(function () {

        var rating_data = 0;

        $(document).on('mouseenter', '.submit_star', function () {

            var rating = $(this).data('rating');

            reset_background();

            for (var count = 1; count <= rating; count++) {

                $('#submit_star_' + count).addClass('text-warning');

            }

        });

        function reset_background() {
            for (var count = 1; count <= 5; count++) {

                $('#submit_star_' + count).addClass('star-light');

                $('#submit_star_' + count).removeClass('text-warning');

            }
        }

        $(document).on('click', '.submit_star', function () {

            rating_data = $(this).data('rating');

        });

        $(document).on('mouseleave', '.submit_star', function () {

            reset_background();
            for (var count = 1; count <= rating_data; count++) {

                $('#submit_star_' + count).removeClass('star-light');

                $('#submit_star_' + count).addClass('text-warning');
            }

        });

        //submit review
        $('#save_review').click(function () {

            var product_id = $('#product_id').val();

            var user_id = $('#user_id').val();

            var review_heading = $('#review_heading').val();

            var review_summary = $('#review_summary').val();

            if (rating_data == 0 || review_heading == '' || review_summary == '') {
                alert("Please Fill All Fields");
                return false;
            }
            else {
                $.ajax({
                    url: "submit_rating.php",
                    method: "POST",
                    data: { product_id: product_id, user_id: user_id, rating_data: rating_data, review_heading: review_heading, review_summary: review_summary },
                    success: function (data) {

                        //reset form data
                        reset_background();
                        $('#review_heading').val('');
                        $('#review_summary').val('');
                        //hide offcanvas
                        $('#offcanvasBottom').removeClass('show');
                        $('.offcanvas-backdrop').remove();
                        $('body').removeAttr('style');
                        alert(data);
                        load_rating_data();

                    }
                })
            }

        });

        load_rating_data();

        function load_rating_data() {
            var product_id = $('#product_id').val();
            $.ajax({
                url: "submit_rating.php",
                method: "POST",
                data: { action: 'load_data', product_id: product_id },
                dataType: "JSON",
                success: function (data) {
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);

                    var count_star = 0;

                    var percentageStarRating = (data.average_rating / 5) * 100;
                    $('.star-rating').css('background-image', 'linear-gradient(to right, gold 0%, gold ' + percentageStarRating + '%, transparent ' + percentageStarRating + '%, transparent 100%)');

                    $('#total_five_star_review').text(data.five_star_review);

                    $('#total_four_star_review').text(data.four_star_review);

                    $('#total_three_star_review').text(data.three_star_review);

                    $('#total_two_star_review').text(data.two_star_review);

                    $('#total_one_star_review').text(data.one_star_review);

                    $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                    $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                    $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                    $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                    $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                    if (Object.keys(data).length == 0) {
                        $('#review_content').html('<h3 class="text-center mt-4">No reviews yet!</h3>');
                    }
                    if (Object.keys(data).length > 0) {
                        var html = '';

                        for (var count = 0; count < data.review_data.length; count++) {

                            html += '<div class="d-flex flex-row p-3">';

                            html += '<img src="' + data.review_data[count].profile + '" width="40" height="40"class="rounded-circle me-2">';

                            html += '<div class="w-100">';

                            html += '<div class="d-flex justify-content-between align-items-center">';

                            html += '<div class="d-flex flex-row align-items-center"><span class="me-2">' + data.review_data[count].user_name + '</span></div>';

                            html += '<small>' + data.review_data[count].datetime + '</small>';

                            html += '</div>';

                            for (var star = 1; star <= 5; star++) {
                                var class_name = '';

                                if (data.review_data[count].rating >= star) {
                                    class_name = 'text-warning';
                                }
                                else {
                                    class_name = 'star-light';
                                }

                                html += '<i class="fas fa-star ' + class_name + '"></i>';
                            }

                            html += '<h5 style="font-size: 15px;" class="fw-bold ">' + data.review_data[count].review_heading + '</h5>';

                            html += '<p class="text-justify comment-text mb-0">' + data.review_data[count].review_summary + '</p>';
                            html += '</div>';

                            html += '</div>';
                        }

                        $('#review_content').html(html);
                    }
                }
            })
        }

    });
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
                compareNowBtn.href = `/laptops/compare.php?pid=${productIds}`;
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