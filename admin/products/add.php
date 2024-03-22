<?php
session_start();
require '../../dbcon.php';
$title = "Add Product";
require '../inc/header.php';

require '../functions/logic.php';

$fetchCategoriesQuery = "SELECT * FROM categories";
$categoriesResult = mysqli_query($con, $fetchCategoriesQuery);

$fetchBrandsQuery = "SELECT * FROM brands";
$brandsResult = mysqli_query($con, $fetchBrandsQuery);

if(isset($_POST['submit'])) {
    $categoryId = sanitize_data($_POST['category_id']);
    $brandId = sanitize_data($_POST['brand_id']);
    $productName = sanitize_data($_POST['product_name']);
    $price = sanitize_data($_POST['price']);
    $releaseDate = sanitize_data($_POST['release_date']);
    $targetDir = '../images/products/';
    $fileName = $_FILES['product_image']['name'];
    $targetFile = $targetDir . basename($fileName);
    
    if (file_exists($targetFile)) {
        $_SESSION['fail_msg'] = "File already exists. Please choose a different file.";
        ?><script>window.location.href = "add.php";</script><?php
        exit(0);
    } else {
        $allowedImageTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif", "image/webp"];
        if (!in_array($_FILES['product_image']['type'], $allowedImageTypes) || $_FILES['product_image']['size'] > 500000) {
            $_SESSION['fail_msg'] = "Sorry, only JPG, JPEG, PNG & GIF files under 500KB are allowed.";
            ?><script>window.location.href = "add.php";</script><?php
            exit(0);
        }
    }
    
    if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
        $sql = "INSERT INTO products(category_id, brand_id, product_name, price, release_date, product_image) VALUES('$categoryId', '$brandId', '$productName', '$price', '$releaseDate', '$fileName')";
        $insertProductResult = mysqli_query($con, $sql);
        if ($insertProductResult) {
            $_SESSION['success_msg'] = "Product added successfully";
            $lastInsertedId = mysqli_insert_id($con);
            ?>
            <script>
            var categoryId = <?= json_encode(sanitize_data($_POST['category_id'])) ?>;
            var productId = <?= json_encode($lastInsertedId) ?>;

            switch (categoryId) {
                case '1':
                    window.location.href = "../specs/mobile_specs_form.php?product_id=" + productId;
                    break;
                case '2':
                    window.location.href = "../specs/laptop_specs_form.php?product_id=" + productId;
                    break;
                case '3':
                    window.location.href = "../specs/headset_specs_form.php?product_id=" + productId;
                    break;
                case '4':
                    window.location.href = "../specs/smartwatch_specs_form.php?product_id=" + productId;
                    break;
                case '5':
                    window.location.href = "../specs/tv_specs_form.php?product_id=" + productId;
                    break;
                default:
                    window.location.href = "index.php";
                    break;
            }
        </script>
        <?php
            exit(0);
        }
    } else {
        $_SESSION['fail_msg'] = "Sorry, there was an error uploading your file.";
        ?><script>window.location.href = "add.php";</script><?php
        exit(0);
    }
}
if (isset($_SESSION['success_msg']) || isset($_SESSION['fail_msg'])) {
    if (isset($_SESSION['success_msg'])) {
        echo '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        ' . $_SESSION['success_msg'] . '</div>';
        unset($_SESSION['success_msg']);
    }
    else {
        echo '<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        ' . $_SESSION['fail_msg'] . '</div>';
        unset($_SESSION['fail_msg']);
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Product</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Product</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($categoriesResult)) {
                                        ?>
                                        <option value="<?= $row['cat_id'] ?>"><?= $row['cat_name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control py-3">
                                    <option value="" selected disabled>Select Brand</option>
                                   <?php
                                    while ($row = mysqli_fetch_assoc($brandsResult)) {
                                        ?>
                                        <option value="<?= $row['brand_id'] ?>"><?= $row['brand_name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="release_date">Release Date</label>
                                <input type="date" name="release_date" id="release_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="product_image">Product Image</label>
                                <input type="file" name="product_image" id="product_image" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "../inc/footer.php";
?>