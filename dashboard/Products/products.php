<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;
use App\Auth as Auth;

Auth::AdminCheck();
$conn = DB::connect();
$query = "select * from products where 1";
$result = $conn->query($query);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Products</title>
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
                <!-- <?php include "inc/message.php"; ?> -->
                <div class="d-flex justify-content-between my-4">
                    <h3>Products Management</h3>
                    <a class="btn btn-outline-primary px-3 pb-2" href="productAdd.php"> Add <i class="bi bi-plus fs-5"></i></a>
                </div>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Products Name</th>
                            <th>Quantity</th>
                            <th>Purches Price</th>
                            <th>Sell Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['sprice']}</td>
                        <td>{$row['pprice']}</td>
                        <td>" . ($row['status'] == 1 ? 'In Stock' : 'Sold Out') . "</td>
                        <td>{$row['created']}</td>
                        <td>
                        <a href='productEdit.php?id={$row['id']}' title='edit'><i class='bi bi-pencil-square'></i></a> | 
                        <a onclick=\"return confirm('Are you sure?')\" href='productDelete.php?id={$row['id']}' title='delete'><i class='bi bi-trash'></i></a>
                        </td>
                        </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
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
</body>

</html>