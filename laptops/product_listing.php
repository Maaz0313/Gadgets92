<?php
session_start();
require '../dbcon.php';
require '../inc/functions.inc.php';

// Handle adding/removing products from comparison
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $productId = $_POST['productId'];

    if (!isset($_SESSION['compare'])) {
        $_SESSION['compare'] = [];
    }

    if ($action == 'add') {
        $categoryId = $_POST['categoryId'];
        if (empty($_SESSION['compare'])) { // If the comparison array is empty 
            $_SESSION['compare']['products'] = [$productId];
            $_SESSION['compare']['category'] = $categoryId;
            // Fetch and add product details to the session
            $productDetails = getProductDetails([$productId]);
            $_SESSION['compare']['productData'] = $productDetails;
            echo json_encode([
                'success' => 'Product added.',
                'productName' => $productDetails[$productId]['product_name'], // Add product data to response
                'productImage' => $productDetails[$productId]['product_image'],
                'price' => $productDetails[$productId]['price']
            ]);
            exit;
        } else {
            // Check if the category matches the session category
            if (isset($_SESSION['compare']['category']) && $_SESSION['compare']['category'] != $categoryId) {
                echo json_encode(['error' => 'You can only compare products from the same category.']);
                exit;
            }

            if (in_array($productId, $_SESSION['compare']['products'])) {
                echo json_encode(['error' => 'Product already added.']);
                exit;
            } elseif (count($_SESSION['compare']['products']) >= 3) {
                echo json_encode(['error' => 'You can only compare 3 products at a time.']);
                exit;
            } else {
                $_SESSION['compare']['products'][] = $productId;
                $_SESSION['compare']['category'] = $categoryId;
                // Fetch and add product details to the session
                $productDetails = getProductDetails([$productId]);
                $_SESSION['compare']['productData'] += $productDetails;
                echo json_encode([
                    'success' => 'Product added.',
                    'productName' => $productDetails[$productId]['product_name'], // Add product data to response
                    'productImage' => $productDetails[$productId]['product_image'],
                    'price' => $productDetails[$productId]['price']
                ]);
                exit;
            }
        }
    } elseif ($action == 'remove') {
        if (($key = array_search($productId, $_SESSION['compare']['products'])) !== false) {
            unset($_SESSION['compare']['products'][$key],$_SESSION['compare']['productData'][$productId]);
        }
        echo json_encode([
            'success' => 'Product removed.'
    ]);
        exit;
    }
    exit;
}