<?php
session_start();
require '../../dbcon.php';
$title = "Products";
require '../inc/header.php';

if (!isset($_SESSION['ADMIN_LOGIN'])) {
    $_SESSION['fail_msg'] = "Please login first to access Admin Dashboard";
    ?><script>window.location.href = '../login.php';</script><?php
    exit(0);
}
//inner join of products, brands and categories
$fetch_products = "SELECT products.product_id, products.product_name, products.product_image, products.release_date,
categories.cat_name, brands.brand_name
FROM products
INNER JOIN categories ON products.category_id = categories.cat_id
INNER JOIN brands ON products.brand_id = brands.brand_id";;
$products = mysqli_query($con, $fetch_products);
$products_count = mysqli_num_rows($products);
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
                        <h1>Products</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li class="active">Products</li>
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
            <div class="col-md-12">
                <a href="add.php" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Add Product</a>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Products</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Product Image</th>
                                    <th>Release Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($products_count > 0) {
                                    while ($product = mysqli_fetch_assoc($products)) {
                                        $id = $product['product_id'];
                                        $product_name = $product['product_name'];
                                        $category_name = $product['cat_name'];
                                        $brand_name = $product['brand_name'];
                                        $product_image = $product['product_image'];
                                        $release_date = $product['release_date'];
                                ?>
                                        <tr role="row" class="even">
                                            <td class="sorting_1"><?= $product_name ?></td>
                                            <td><?= $category_name ?></td>
                                            <td><?= $brand_name ?></td>
                                            <td><img src="../images/products/<?= $product_image ?>" alt="" height="50"></td>
                                            <td><?= $release_date ?></td>
                                            <td class="d-flex btn-group">
                                                <a href="edit.php?id=<?= $id ?>" class="btn btn-primary btn-sm">Edit Product</a>
                                                <?php
                                                switch ($category_name) {
                                                    case 'mobiles':
                                                        echo '<a href="../specs/edit/mobile_specs.php?id='. $id.'" class="btn btn-success btn-sm">Edit Specs</a>';
                                                        break;

                                                    case 'laptops':
                                                        echo '<a href="../specs/edit/laptop_specs.php?id='. $id.'" class="btn btn-success btn-sm">Edit Specs</a>';
                                                        break;
                                                        
                                                    case 'headsets':
                                                        echo '<a href="../specs/edit/headset_specs.php?id='. $id.'" class="btn btn-success btn-sm">Edit Specs</a>';
                                                        break;

                                                    case 'smart watches':
                                                        echo '<a href="../specs/edit/smartwatch_specs.php?id='. $id.'" class="btn btn-success btn-sm">Edit Specs</a>';
                                                        break;
                                        
                                                    case 'televisions':
                                                        echo '<a href="../specs/edit/tv_specs.php?id='. $id.'" class="btn btn-success btn-sm">Edit Specs</a>';
                                                        break;

                                                    default:
                                                        echo 'Category does not exist';
                                                        break;
                                                }
                                                ?>
                                                <a href="delete.php?id=<?= $id ?>&image=<?= $product_image ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    echo "No Products Found";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require '../inc/footer.php';
?>