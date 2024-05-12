<?php
date_default_timezone_set('Asia/Karachi');
require ('../dbcon.php');
require ('../inc/functions.inc.php');

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
    INNER JOIN headset_specs ON products.product_id = headset_specs.product_id 
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
    echo '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        ' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
}

if (isset($_SESSION['fail_msg'])) {
    echo '<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
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
                <li class="breadcrumb-item"><a href="../watches/">Smart Watches</a></li>
                <li class="breadcrumb-item"><a
                        href="../watches/?brand=<?= $row['brand_name'] ?>"><?= $row['brand_name'] ?></a></li>
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
                                class="modal-trg font90 cursorpointer d-flex align-items-center flex-row position-absolute top-0 right-0 m-3 "
                                data-popup="share_product">
                                <svg fill="#888" width="20px" height="20px" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.675 7.415 12.8 1.479C12.198 0.959 11.25 1.381 11.25 2.188v3.127C4.975 5.387 0 6.645 0 12.591c0 2.4 1.546 4.778 3.255 6.021 0.533 0.388 1.293 -0.099 1.097 -0.728C2.581 12.219 5.192 10.715 11.25 10.628V14.063c0 0.809 0.949 1.229 1.55 0.71l6.875 -5.938c0.432 -0.374 0.433 -1.045 0 -1.419z">
                                    </path>
                                </svg>
                            </div>
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
                    <span>
                        <?= $row['product_description'] ?>
                    </span>
                </div>
                <div class="row mt-4">
                    <h6 class="fw-bolder ">Key Specifications</h6>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="d-flex align-items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    stroke="currentColor" class="bi bi-earbuds" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6.825 4.138c.596 2.141-.36 3.593-2.389 4.117a4.4 4.4 0 0 1-2.018.054c-.048-.01.9 2.778 1.522 4.61l.41 1.205a.52.52 0 0 1-.346.659l-.593.19a.55.55 0 0 1-.69-.34L.184 6.99c-.696-2.137.662-4.309 2.564-4.8 2.029-.523 3.402 0 4.076 1.948zm-.868 2.221c.43-.112.561-.993.292-1.969-.269-.975-.836-1.675-1.266-1.563s-.561.994-.292 1.969.836 1.675 1.266 1.563m3.218-2.221c-.596 2.141.36 3.593 2.389 4.117a4.4 4.4 0 0 0 2.018.054c.048-.01-.9 2.778-1.522 4.61l-.41 1.205a.52.52 0 0 0 .346.659l.593.19c.289.092.6-.06.69-.34l2.536-7.643c.696-2.137-.662-4.309-2.564-4.8-2.029-.523-3.402 0-4.076 1.948m.868 2.221c-.43-.112-.561-.993-.292-1.969.269-.975.836-1.675 1.266-1.563s.561.994.292 1.969-.836 1.675-1.266 1.563" />
                                </svg>
                                <span style="padding-left: 9px;" class="key-spec-name">Design</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;"
                                class="key-spec-value fw-semibold"><?= $row['design']; ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    stroke="currentColor" class="bi bi-earbuds" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6.825 4.138c.596 2.141-.36 3.593-2.389 4.117a4.4 4.4 0 0 1-2.018.054c-.048-.01.9 2.778 1.522 4.61l.41 1.205a.52.52 0 0 1-.346.659l-.593.19a.55.55 0 0 1-.69-.34L.184 6.99c-.696-2.137.662-4.309 2.564-4.8 2.029-.523 3.402 0 4.076 1.948zm-.868 2.221c.43-.112.561-.993.292-1.969-.269-.975-.836-1.675-1.266-1.563s-.561.994-.292 1.969.836 1.675 1.266 1.563m3.218-2.221c-.596 2.141.36 3.593 2.389 4.117a4.4 4.4 0 0 0 2.018.054c.048-.01-.9 2.778-1.522 4.61l-.41 1.205a.52.52 0 0 0 .346.659l.593.19c.289.092.6-.06.69-.34l2.536-7.643c.696-2.137-.662-4.309-2.564-4.8-2.029-.523-3.402 0-4.076 1.948m.868 2.221c-.43-.112-.561-.993-.292-1.969.269-.975.836-1.675 1.266-1.563s.561.994.292 1.969-.836 1.675-1.266 1.563" />
                                </svg>
                                <span style="padding-left: 9px;" class="key-spec-name">Type</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;"
                                class="key-spec-value fw-semibold"><?= $row['type'] ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-headset"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">Buit-in Mic</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;"
                                class="key-spec-value fw-semibold"><?= $row['built-in_mic'] == "1" ? "Yes" : "No" ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-battery-half"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">Battery Life</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 37px;"
                                class="key-spec-value fw-semibold"><?= $row['battery_life'] ?></span>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="d-flex align-items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                                    viewBox="0 0 24 24" height="21">
                                    <path
                                        d="M12,14c-1.1,0-2-.9-2-2s.9-2,2-2,2,.9,2,2-.9,2-2,2Zm0-3c-.55,0-1,.45-1,1s.45,1,1,1,1-.45,1-1-.45-1-1-1Zm-7.78,8.78C-.07,15.49-.07,8.51,4.22,4.22l-.71-.71C-1.16,8.19-1.16,15.81,3.51,20.49l.71-.71ZM20.49,3.51l-.71,.71c4.29,4.29,4.29,11.27,0,15.56l.71,.71c4.68-4.68,4.68-12.29,0-16.97ZM7.76,16.24c-2.34-2.34-2.34-6.15,0-8.49l-.71-.71c-1.32,1.32-2.05,3.08-2.05,4.95s.73,3.63,2.05,4.95l.71-.71ZM16.95,7.05l-.71,.71c2.34,2.34,2.34,6.15,0,8.49l.71,.71c2.73-2.73,2.73-7.17,0-9.9Z" />
                                </svg>
                                <span style="padding-left: 9px;" class="key-spec-name">Connectivity</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 45px;"
                                class="key-spec-value fw-semibold"><?= $row['connectivity'] ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <i class="bi bi-droplet"></i>
                                <span style="padding-left: 9px;" class="key-spec-name">Water Resistant</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 40px;"
                                class="key-spec-value fw-semibold"><?= $row['water_resistant'] == "1" ? "Yes" : "No" ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <svg height="21" xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M83 384c-13-33-35-93.37-35-128C48 141.12 149.33 48 256 48s208 93.12 208 208c0 34.63-23 97-35 128"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <path
                                        d="M108.39 270.13l-13.69 8h0c-30.23 17.7-31.7 72.41-3.38 122.2s75.87 75.81 106.1 58.12h0l13.69-8a16.16 16.16 0 005.78-21.87L130 276a15.74 15.74 0 00-21.61-5.87zM403.61 270.13l13.69 8h0c30.23 17.69 31.74 72.4 3.38 122.19s-75.87 75.81-106.1 58.12h0l-13.69-8a16.16 16.16 0 01-5.78-21.87L382 276a15.74 15.74 0 0121.61-5.87z"
                                        fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                </svg>
                                <span style="padding-left: 8px;" class="key-spec-name">Driver Unit</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 40px;"
                                class="key-spec-value fw-semibold"><?= $row['driver'] ?></span>
                        </div>
                        <div class="row pt-md-2 ">
                            <div class="d-flex align-items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M4.516 21c-2.951-.61-4.516-3.09-4.516-5.5 0-2.615 1.731-5.198 5.283-5.5-1.415 1.591-2.283 3.708-2.283 6 0 1.782.618 3.6 1.516 5zm19.484-5.5c0 2.409-1.55 4.889-4.5 5.5.897-1.4 1.5-3.218 1.5-5 0-2.292-.868-4.409-2.283-6 3.552.303 5.283 2.886 5.283 5.5zm-5.074-7.487c.942.084 1.782.294 2.529.601-1.27-4.388-4.666-7.614-9.455-7.614-4.786 0-8.173 3.225-9.442 7.607.744-.303 1.582-.512 2.52-.595 1.347-2.538 3.842-4.04 6.922-4.034 3.081-.006 5.578 1.496 6.926 4.035zm-6.926.987c-3.865 0-7 3.134-7 7s3.135 7 7 7 7-3.134 7-7-3.135-7-7-7zm-2 11v-8l6 4-6 4"
                                        stroke="black" fill="none" />
                                </svg>
                                <span style="padding-left: 7px;" class="key-spec-name">Headset Controls</span>
                            </div>
                        </div>
                        <div class="row">
                            <span style="padding-left: 42px;"
                                class="key-spec-value fw-semibold"><?= $row['control_features'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- complete features -->
    <div class="container bg-light p-3 mb-3">
        <h5 class="fw-bold pb-2"><?= $row['product_name'] ?> Full Specifications</h5>
        <div class="category">
            <h3 class="">General (7)
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
                            <?= $row['brand_name'] ?>
                        </td>
                    </tr>
                    <th>
                        Model
                    </th>
                    <td>
                        <?= $row['model'] ?>
                    </td>
                    </tr>
                    <tr>
                        <th>
                            Type
                        </th>
                        <td>
                            <?= $row['type'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Design
                        </th>
                        <td>
                            <?= $row['design'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Connectivity
                        </th>
                        <td>
                            <?= $row['connectivity'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Box Contents
                        </th>
                        <td>
                            <?= $row['in_the_box'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Sound Features (2) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Driver Unit
                        </th>
                        <td>
                            <?= $row['driver'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Frequency Response
                        </th>
                        <td>
                            <?= $row['frequency_response'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>General Features (6) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Bluetooth
                        </th>
                        <td>
                            <?= $row['bluetooth'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Controls
                        </th>
                        <td>
                            <?= $row['controls'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Control Features
                        </th>
                        <td>
                            <?= $row['control_features'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Buit-in Mic
                        </th>
                        <td>
                            <?= $row['built-in_mic'] == 1 ? "Yes" : "No" ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Water Resistant
                        </th>
                        <td>
                            <?= $row['water_resistant'] == 1 ? "Yes" : "No" ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Additional Features
                        </th>
                        <td>
                            <?= $row['additional_features'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="category">
            <h3>Battery & Charging (3) <span class="icon"><i class="bi bi-chevron-down"></i></span></h3>
            <table>
                <tbody>
                    <tr>
                        <th>
                            Battery Life
                        </th>
                        <td>
                            <?= $row['battery_life'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Charging Port
                        </th>
                        <td>
                            <?= $row['charging_port'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Charging Time
                        </th>
                        <td>
                            <?= $row['charging_time'] ?>
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
                        $('#review_content').html('<h3 class="text-center mt-4">No reviews yet!!</h3>');
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

</script>