<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;

// Post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = DB::connect();
    $idtoedit = $_POST['id'];
    $fname = $conn->escape_string($_POST['name']);
    $error = false;

    if (!$error) {
        // Update the 'category' table with the 'name' column
        $editquery = "UPDATE categories SET name='{$fname}' WHERE id='{$idtoedit}' LIMIT 1";
        $conn->query($editquery);

        if ($conn->affected_rows) {
            $_SESSION['message'] = "Category Updated Successfully";
            header("location: categories.php");
        } else {
            $message = "ERROR!!";
        }

        $conn->close();
    }
}
// Get method
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    $conn = DB::connect();
    $query = "SELECT * FROM categories WHERE id={$id}";
    $result = $conn->query($query);

    if (!$result->num_rows) {
        echo "No category Data Found!!!";
        exit;
    }

    $row = $result->fetch_assoc();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Categories</title>
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
                    <h3>Category Update</h3>
                </div>
                <form class="mx-1 mx-md-4" action="categoryEdit.php?id=<?= $id; ?>" method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="name" id="form3Example1c" class="form-control" value="<?= $row['name'] ?>" />
                            <label class="form-label" for="form3Example1c"> Name</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" class="fs-5 px-4 btn btn-block btn-lg btn-gradient-primary">Update Category</button>
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