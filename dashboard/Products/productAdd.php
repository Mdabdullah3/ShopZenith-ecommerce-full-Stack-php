<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;

$conn = DB::connect();
// Function to generate a custom filename (append timestamp)
function generateCustomFilename($original_filename)
{
    $file_info = pathinfo($original_filename);
    $timestamp = time(); // Current timestamp
    $custom_filename = $file_info['filename'] . '_' . $timestamp . '.' . $file_info['extension'];
    return $custom_filename;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->escape_string($_POST['name']);
    $sku = $conn->escape_string($_POST['sku']);
    $details = $conn->escape_string($_POST['details']);
    $shortdesc = $conn->escape_string($_POST['shortdesc']);
    $tags = $conn->escape_string($_POST['tags']);
    // var_dump($tags);
    // exit;
    $vat = $conn->escape_string($_POST['vat']);
    $op1 = $conn->escape_string($_POST['op1']);
    $op2 = $conn->escape_string($_POST['op2']);
    // Check if 'category_id' is set and is a valid integer
    if (isset($_POST['category_id']) && is_numeric($_POST['category_id'])) {
        $category_id = intval($_POST['category_id']);
        // Check if the category_id exists in the 'categories' table
        $categoryExistsQuery = "SELECT COUNT(*) as total FROM categories WHERE id = $category_id";
        $result = $conn->query($categoryExistsQuery);

        if ($result && $result->fetch_assoc()['total']) {
            // 'category_id' is valid, proceed with other form data
            $quantity = $conn->escape_string($_POST['quantity']);
            $pprice = $conn->escape_string($_POST['pprice']);
            $sprice = $conn->escape_string($_POST['sprice']);
            $status = $conn->escape_string($_POST['status']);
            $insertQuery = "INSERT INTO products (name, sku, details, shortdesc, category_id, quantity, pprice, sprice, tags, vat, status, op1, op2) 
                            VALUES ('$name', '$sku', '$details', '$shortdesc', '$category_id', '$quantity', '$pprice', '$sprice', '$tags', '$vat', '$status', '$op1', '$op2')";
            if ($conn->query($insertQuery)) {
                $id = $conn->insert_id;
                // image upload
                if (isset($_FILES['images'])) {
                    $errors = [];
                    $uploadDir = '../../assets/products/'; // Create a directory to store uploaded files

                    // Loop through the uploaded files
                    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                        $file_name = $_FILES['images']['name'][$key];
                        $file_tmp = $_FILES['images']['tmp_name'][$key];
                        echo "MIME:" . $_FILES['images']['type'] . "<br>";

                        // Generate a custom filename
                        $custom_filename = generateCustomFilename($file_name);

                        // Check if the file already exists
                        if (file_exists($uploadDir . $custom_filename)) {
                            $errors[] = "File $custom_filename already exists.";
                        }

                        // Check file size and allowed file types
                        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // Add more allowed file types as needed
                        $file_info = pathinfo($file_name);
                        $file_ext = strtolower($file_info['extension']);

                        if (!in_array($file_ext, $allowed_types)) {
                            $errors[] = "File $file_name has an invalid file type.";
                        }

                        // Check for errors and move the file if no errors
                        if (empty($errors)) {
                            if (move_uploaded_file($file_tmp, $uploadDir . $custom_filename)) {
                                //image resize code here 
                                $iiq = "insert into images values(null,'{$id}','{$custom_filename}',null,null)";
                                $conn->query($iiq);
                                if (!$conn->insert_id) {
                                    echo "ERROR!!";
                                    exit;
                                }
                            }
                        }
                    }
                    // Display upload status
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo $error . "<br>";
                        }
                    } else {
                        //echo "All files were successfully uploaded.";
                    }
                }
                // image upload end
                $_SESSION['message'] = "Product Added Successfully";
                header("location: products.php");
                exit;
            } else {
                $message = "Error adding product: " . $conn->error;
            }
        } else {
            // Invalid category_id, handle accordingly
            $message = "Invalid Category ID";
        }
    } else {
        // Handle the case where 'category_id' is not set or not a valid integer
        $message = "Invalid Category ID";
    }

    $conn->close();
}


$selectQ = "select id,name from categories where 1";
$sr = $conn->query($selectQ);
// var_dump($sr);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Product Add</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css" />
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-scroller">
        <?php $img = "../../assets/images/face4.jpg";
        include "../inc/Header.php" ?>
        <div class="container-fluid page-body-wrapper">
            <?php $img = "../../assets/images/face1.jpg";
            include "../inc/sidebar.php" ?>
            <!-- Main  -->
            <main class="main-panel mt-5 mx-5">
                <h5 class="text-center my-3">Product Insert Form</h5>

                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Message = </strong> <?= $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php

                }
                ?>
                <form class="mx-1 mx-md-4" action="productAdd.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example1c">Product Name</label>

                                    <input type="text" name="name" id="form3Example1c" class="form-control" required value="<?= isset($name) ? $name : ""; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example1c">Product Sku</label>

                                    <input type="text" name="sku" id="form3Example1c" class="form-control" required value="<?= isset($sku) ? $sku : ""; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="details">Your Product Details</label>
                                    <!-- <input type="text" name="details" id="form3Example3c" class="form-control" required value="<?= isset($details) ? $details : ""; ?>" /> -->
                                    <textarea required name="details" id="details" class="form-control"><?= isset($details) ? $details : ""; ?></textarea>

                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="shortdesc">Your Product short Details</label>
                                    <textarea required name="shortdesc" id="shortdesc" class="form-control"><?= isset($shortdesc) ? $shortdesc : ""; ?></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="images">Product Images</label>
                                    <input class="form-control" type="file" name="images[]" id="images" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <!-- <input type="number" name="category_id" id="form3Example3c" class="form-control" required value="<?= isset($category_id) ? $category_id : ""; ?>" /> --><label class="form-label" for="category_id">Your Product Category</label>
                                    <select name="category_id" id="category_id" class="form-select">

                                        <option value="-1" selected disabled>Select Category</option>
                                        <?php
                                        $html = "";
                                        if ($sr->num_rows) {
                                            while ($row = $sr->fetch_assoc()) {
                                                $s = isset($category_id) && $category_id == $row['id'] ? "selected" : "";
                                                $html .= '<option value="' . $row['id'] . '" ' . $s . '>' . $row['name'] . '</option>';
                                            }
                                            echo $html;
                                        }
                                        ?>

                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example3c">Product Quantity </label>
                                    <input type="number" name="quantity" id="form3Example3c" class="form-control" required value="<?= isset($quantity) ? $quantity : ""; ?>" />

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example3c">'your Product Purches price </label>
                                    <input type="number" name="pprice" id="form3Example3c" class="form-control" required value="<?= isset($pprice) ? $pprice : ""; ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example3c">Product Sell Price
                                    </label>
                                    <input type="number" name="sprice" id="form3Example3c" class="form-control" required value="<?= isset($sprice) ? $sprice : ""; ?>" />

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example3c">Product tags </label>
                            <input type="text" name="tags" id="form3Example3c" class="form-control" required value="<?= isset($tags) ? $tags : ""; ?>" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example3c">Products Vat </label>
                                    <input type="number" name="vat" id="form3Example3c" class="form-control" required value="<?= isset($vat) ? $vat : ""; ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="role">Product Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="-1" disabled>Select</option>
                                        <option value="1" <?= isset($status) && $status == 1 ? "selected" : "" ?>>Stock</option>
                                        <option value="0" <?= isset($status) && $status == 0 ? "selected" : "" ?>>Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example3c">Option 1 </label>
                                    <input type="text" name="op1" id="form3Example3c" class="form-control" value="<?= isset($op1) ? $op1 : ""; ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example3c">Option 2 </label>
                                    <input type="text" name="op2" id="form3Example3c" class="form-control" value="<?= isset($op2) ? $op2 : ""; ?>" />

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" class="fs-5 px-4 btn btn-primary btn-lg">Add New Product</button>
                    </div>

                </form>
            </main>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../../assets/js/dashboard.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>