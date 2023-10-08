<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = DB::connect();
    $q = "delete from categories where id='{$id}' limit 1";
    $conn->query($q);
    if ($conn->affected_rows) {
        $_SESSION['message'] = "Category {$id} deleted Successfully";
        header("location: categories.php");
    } else {
        echo "error deleting data";
    }
}
