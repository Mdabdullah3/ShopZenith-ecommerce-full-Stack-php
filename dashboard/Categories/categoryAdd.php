<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;

//  adding a new category
function handleAddCategory()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newCategoryName'])) {
        $conn = DB::connect();
        $newCategoryName = $conn->escape_string($_POST['newCategoryName']);

        if (!empty($newCategoryName)) {
            $insertQuery = "insert into categories values(null,'{$newCategoryName}',null,null)";
            if ($conn->query($insertQuery)) {
                $_SESSION['message'] = "New Category Added Successfully";
                header("location: categories.php");
            } else {
                $_SESSION['message'] = "Error Adding New Category";
            }
        } else {
            $_SESSION['message'] = "Category Name cannot be empty";
        }

        $conn->close();
    }
}

if (isset($_POST['newCategoryName'])) {
    handleAddCategory();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Categories Add</title>
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
                <form class="mx-1 mx-md-4 mt-5" action="categoryAdd.php" method="post">
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-plus-circle fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="newCategoryName" id="form3Example1c" class="form-control" placeholder="New Category Name" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" class="fs-5 px-4 btn btn-block btn-lg btn-gradient-primary">Add New Category</button>
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
</body>

</html>