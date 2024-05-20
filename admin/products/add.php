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

if (isset($_POST['submit'])) {
    $categoryId = sanitize_data(mysqli_real_escape_string($con, $_POST['category_id']));
    $brandId = sanitize_data(mysqli_real_escape_string($con, $_POST['brand_id']));
    $productName = sanitize_data(mysqli_real_escape_string($con, $_POST['product_name']));
    $slug = sanitize_data(mysqli_real_escape_string($con, $_POST['product_slug']));
    $productDesc = sanitize_data(mysqli_real_escape_string($con, $_POST['product_description']));
    $price = sanitize_data(mysqli_real_escape_string($con, $_POST['price']));
    $releaseDate = sanitize_data(mysqli_real_escape_string($con, $_POST['release_date']));
    $targetDir = '../images/products/';
    $fileName = $_FILES['product_image']['name'];
    $targetFile = $targetDir . basename($fileName);

    if (file_exists($targetFile)) {
        $_SESSION['fail_msg'] = "File already exists. Please choose a different file.";
?><script>
            window.location.href = "add.php";
        </script><?php
                    exit(0);
                } else {
                    $allowedImageTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif", "image/webp"];
                    if (!in_array($_FILES['product_image']['type'], $allowedImageTypes) || $_FILES['product_image']['size'] > 500000) {
                        $_SESSION['fail_msg'] = "Sorry, only JPG, JPEG, PNG , WEBP and GIF files under 500KB are allowed.";
                    ?><script>
                window.location.href = "add.php";
            </script><?php
                        exit(0);
                    }
                }

                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
                    $query = "INSERT INTO products(category_id, brand_id, product_name, product_slug, product_description, price, release_date, product_image) VALUES(?,?,?,?,?,?,?,?)";
                    $params = [$categoryId, $brandId, $productName, $slug, $productDesc, $price, $releaseDate, $fileName];
                    $insertProductResult = mysqli_execute_query($con, $query, $params);
                    if ($insertProductResult) {
                        $_SESSION['success_msg'] = "Product added successfully";
                        $lastInsertedId = mysqli_insert_id($con);
                        ?>
            <script>
                var categoryId = <?= json_encode(sanitize_data($_POST['category_id'])) ?>;
                var productId = <?= json_encode($lastInsertedId) ?>;

                switch (categoryId) {
                    case '1':
                        window.location.href = "../specs/add/mobile_specs.php?product_id=" + productId;
                        break;
                    case '2':
                        window.location.href = "../specs/add/laptop_specs.php?product_id=" + productId;
                        break;
                    case '3':
                        window.location.href = "../specs/add/headset_specs.php?product_id=" + productId;
                        break;
                    case '4':
                        window.location.href = "../specs/add/smartwatch_specs.php?product_id=" + productId;
                        break;
                    case '5':
                        window.location.href = "../specs/add/tv_specs.php?product_id=" + productId;
                        break;
                    default:
                        window.location.href = "index.php";
                        break;
                }
            </script>
        <?php
                        exit(0);
                    } else {
                        $_SESSION['fail_msg'] = "Could not add product b/c " . mysqli_error($con);
        ?><script>
                window.location.href = "add.php";
            </script><?php
                        exit(0);
                    }
                } else {
                    $_SESSION['fail_msg'] = "Sorry, there was an error uploading your file.";
                        ?><script>
            window.location.href = "add.php";
        </script><?php
                    exit(0);
                }
            }

            if (isset($_SESSION['success_msg'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        ' . $_SESSION['success_msg'] . '</div>';
                unset($_SESSION['success_msg']);
            } 

            if (isset($_SESSION['fail_msg'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        ' . $_SESSION['fail_msg'] . '</div>';
                unset($_SESSION['fail_msg']);
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
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
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

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control is-valid" required>
                                <input type="text" class="valid-feedback border-0" id="product_slug" name="product_slug" readonly>
                            </div>
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea name="product_description" id="product_description" class="form-control" required></textarea>
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
    $('#product_name').on('input', function() {
        var productName = $(this).val();
        $.ajax({
            url: 'slugify.php', // Update with your PHP file path
            method: 'POST',
            data: {
                productName: productName
            },
            success: function(data) {
                $('#product_slug').val(data);
            }
        });
    });
</script>