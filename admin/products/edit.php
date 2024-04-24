<?php
session_start();
require '../../dbcon.php';
$title = "Update Product";
require '../inc/header.php';
require '../functions/logic.php';

$productId = isset($_GET['id']) ? sanitize_data($_GET['id']) : 0;

// Fetch product details for the given product ID
$fetchProductQuery = "SELECT * FROM products WHERE product_id = '$productId'";
$productResult = mysqli_query($con, $fetchProductQuery);
$product = mysqli_fetch_assoc($productResult);

$fetchCategoriesQuery = "SELECT * FROM categories";
$categoriesResult = mysqli_query($con, $fetchCategoriesQuery);

$fetchBrandsQuery = "SELECT * FROM brands";
$brandsResult = mysqli_query($con, $fetchBrandsQuery);

if (isset($_POST['update'])) {
    $categoryId = sanitize_data($_POST['category_id']);
    $brandId = sanitize_data($_POST['brand_id']);
    $productName = sanitize_data($_POST['product_name']);
    $price = sanitize_data($_POST['price']);
    $releaseDate = sanitize_data($_POST['release_date']);
    $targetDir = '../images/products/';
    $fileName = $_FILES['product_image']['name'];
    $targetFile = $targetDir . basename($fileName);
    
    
    

    // Update product details in the database
    $updateQuery = "UPDATE products SET category_id = '$categoryId', brand_id = '$brandId', product_name = '$productName', price = '$price', release_date = '$releaseDate' WHERE product_id = '$productId'";
    $updateResult = mysqli_query($con, $updateQuery);


    if (empty($_FILES['product_image']['name']) && $updateResult) {
    $_SESSION['success_msg'] = "Product updated successfully";
    echo '<script>window.location.href = "index.php";</script>';
    exit(0);
    }
    else if (file_exists($targetFile)) {
            $_SESSION['fail_msg'] = "File already exists. Please choose a different file.";
            ?><script>window.location.href = "edit.php?id=<?=$productId?>";</script><?php
            exit(0);
        } 
    else if(!file_exists($targetFile) && $updateResult) {
        $allowedImageTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
        if (!in_array($_FILES['product_image']['type'], $allowedImageTypes) || $_FILES['product_image']['size'] > 500000) {
            $_SESSION['fail_msg'] = "Sorry, only JPG, JPEG, PNG & GIF files under 500KB are allowed.";
            ?><script>window.location.href = "edit.php?id=<?=$productId?>";</script><?php
            exit(0);
        }
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
            $updateImageQuery = "UPDATE products SET product_image = '$fileName' WHERE product_id = '$productId'";
            $updateImageResult = mysqli_query($con, $updateImageQuery);
            $_SESSION['success_msg'] = "Product updated successfully<br>";
            echo '<script>window.location.href = "index.php";</script>';
            exit(0);
        }
    }
    else if(!file_exists($targetFile) && !$updateResult) {
        $allowedImageTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
        if (!in_array($_FILES['product_image']['type'], $allowedImageTypes) || $_FILES['product_image']['size'] > 500000) {
            $_SESSION['fail_msg'] = "Sorry, only JPG, JPEG, PNG & GIF files under 500KB are allowed.";
            ?><script>window.location.href = "edit.php?id=<?=$productId?>";</script><?php
            exit(0);
        }
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
            $updateImageQuery = "UPDATE products SET product_image = '$fileName' WHERE product_id = '$productId'";
            $updateImageResult = mysqli_query($con, $updateImageQuery);
            $_SESSION['success_msg'] = "Product image updated successfully<br>";
            echo '<script>window.location.href = "index.php";</script>';
            exit(0);
        }
    }
    else {
        $_SESSION['fail_msg'] = "Failed to update product";
        echo '<script>window.location.href = "edit.php?id=' . $productId . '";</script>';
        exit(0);
    }
}

// Display status message
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
                        <h1>Update Product</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li><a href="index.php">Products</a></li>
                            <li class="active">Update Product</li>
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
                        <strong class="card-title">Update Product</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= $_SERVER['PHP_SELF'] . '?id=' . $productId ?>" method="POST" enctype="multipart/form-data">
                            <!-- Your existing HTML form fields with modified values -->
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" disabled>Select Category</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($categoriesResult)) {
                                        $selected = ($row['cat_id'] == $product['category_id']) ? 'selected' : '';
                                        echo '<option value="' . $row['cat_id'] . '" ' . $selected . '>' . $row['cat_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="" disabled>Select Brand</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($brandsResult)) {
                                        $selected = ($row['brand_id'] == $product['brand_id']) ? 'selected' : '';
                                        echo '<option value="' . $row['brand_id'] . '" ' . $selected . '>' . $row['brand_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" value="<?= $product['product_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" value="<?= $product['price'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="release_date">Release Date</label>
                                <input type="date" name="release_date" id="release_date" class="form-control" value="<?= $product['release_date'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="product_image">Update Image (optional)</label>
                                <input type="file" name="product_image" id="product_image" class="form-control">
                                <!-- You can display the existing image or provide an option to upload a new one -->
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require '../inc/footer.php';
?>

<script>
    $('#category_id').on('change', function() {
        var mainselection = this.value; // get the selection value
        $.ajax({
            type: "POST", // method of sending data
            url: "getBrands.php", // name of PHP script
            data: 'selection=' + mainselection, // parameter name and value
            success: function(result) { // deal with the results
                $("#brand_id").html(result); // insert in div above
            }
        });
    });
</script>