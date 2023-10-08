<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = DB::connect();

    // First, delete associated images
    $q_delete_images = "DELETE FROM images WHERE product_id='{$id}'";
    $conn->query($q_delete_images);

    // Then, delete the product
    $q_delete_product = "DELETE FROM products WHERE id='{$id}' LIMIT 1";
    $conn->query($q_delete_product);

    if ($conn->affected_rows) {
        $_SESSION['message'] = "Product {$id} deleted successfully";
        header("location: products.php");
    } else {
        echo "Error deleting data";
    }
}
