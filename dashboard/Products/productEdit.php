<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;
use App\Url;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = DB::connect();

    $idtoedit = $_POST['id'];
    $name = $conn->escape_string($_POST['name']);
    $sku = $conn->escape_string($_POST['sku']);
    $details = $conn->escape_string($_POST['details']);
    $shortdesc = $conn->escape_string($_POST['shortdesc']);
    $category_id = $conn->escape_string($_POST['category_id']);
    $quantity = $conn->escape_string($_POST['quantity']);
    $pprice = $conn->escape_string($_POST['pprice']);
    $sprice = $conn->escape_string($_POST['sprice']);
    $tags = $conn->escape_string($_POST['tags']);
    $vat = $conn->escape_string($_POST['vat']);
    $status = $conn->escape_string($_POST['status']);
    $op1 = $conn->escape_string($_POST['op1']);
    $op2 = $conn->escape_string($_POST['op2']);

    $editquery = "UPDATE products SET name='{$name}', sku='{$sku}', details='{$details}', shortdesc='{$shortdesc}', category_id='{$category_id}', quantity='{$quantity}', pprice='{$pprice}', sprice='{$sprice}', tags='{$tags}', vat='{$vat}', status='{$status}', op1='{$op1}', op2='{$op2}' WHERE id='{$idtoedit}' LIMIT 1";

    if ($conn->query($editquery)) {
        $_SESSION['message'] = "Product Updated Successfully";
        header("location: products.php");
    } else {
        $message = "ERROR!!";
    }

    $conn->close();
}

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    $conn = DB::connect();
    $query = "SELECT * FROM products WHERE id={$id}";
    $result = $conn->query($query);

    if (!$result->num_rows) {
        echo "No product data found!!!";
        exit;
    }

    $row = $result->fetch_assoc();

    $iquery = "select * from images where product_id={$id}";
    $iresult = $conn->query($iquery);
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Products</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../../assets/css/mystyle.css" />
    <link href="../../assets/css/lightbox.css" rel="stylesheet" />
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
                <form class="mx-1 mx-md-4" action="productEdit.php?id=<?= $id; ?>" method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="row">
                        <div class="col-6">
                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="name" id="form3Example1c" class="form-control" value="<?= $row['name'] ?>" />
                            <label class="form-label" for="form3Example1c">name</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="sku" id="form3Example1c" class="form-control" value="<?= $row['sku'] ?>" />
                            <label class="form-label" for="form3Example1c">sku</label>
                        </div>
                    </div>
                        </div>
                        <div class="col-6 picontainer">
                            <?php
    if($iresult->num_rows){
        while($irow = $iresult->fetch_assoc()){
            echo "<div class='d-inline-block position-relative'><span data-id='".$irow['id']."' class='deleteimage position-absolute translate-middle badge rounded-pill bg-danger'> &times;<span class='visually-hidden'>delete image</span></span><a href='".Url::link('assets/products/'.$irow['name'])."' data-lightbox='p".$irow['product_id']."'><img src='".Url::link('assets/products/'.$irow['name'])."' width='200px' /></a></div>";
    }
}
                            ?>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="details" id="form3Example3c" class="form-control" value="<?= $row['details'] ?>" />
                            <label class="form-label" for="form3Example3c">Your Product Details</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="shortdesc" id="form3Example3c" class="form-control" value="<?= $row['shortdesc'] ?>" />
                            <label class="form-label" for="form3Example3c">Your Product short Details</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="shortdesc" id="form3Example3c" class="form-control" value="<?= $row['shortdesc'] ?>" />
                            <label class="form-label" for="form3Example3c">Your Product short Details</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="category_id" id="form3Example3c" class="form-control" value="<?= $row['category_id'] ?>" />
                            <label class="form-label" for="form3Example3c">Your Product Category</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="number" name="quantity" id="form3Example3c" class="form-control" value="<?= $row['quantity'] ?>" />
                            <label class="form-label" for="form3Example3c">Product Quantity </label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="number" name="pprice" id="form3Example3c" class="form-control" value="<?= $row['pprice'] ?>" />
                            <label class="form-label" for="form3Example3c">'your Product Purches price </label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="number" name="sprice" id="form3Example3c" class="form-control" value="<?= $row['sprice'] ?>" />
                            <label class="form-label" for="form3Example3c">Product Sell Price
                            </label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="tags " id="form3Example3c" class="form-control" value="<?= $row['tags'] ?>" />
                            <label class="form-label" for="form3Example3c">Product tags </label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="vat" id="form3Example3c" class="form-control" value="<?= $row['vat'] ?>" />
                            <label class="form-label" for="form3Example3c">Products Vat </label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <select name="status" id="status" class="form-select">
                                <option value="-1" disabled>Select</option>
                                <option value="0" <?= $row['status'] == 0 ? "selected" : "" ?>>Stock</option>
                                <option value="1" <?= $row['status'] == 1 ? "selected" : "" ?>>Sold Out</option>
                            </select>
                            <label class="form-label" for="role">Product Status</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="op1" id="form3Example3c" class="form-control" value="<?= $row['op1'] ?>" />
                            <label class="form-label" for="form3Example3c">Option 1 </label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" name="op2" id="form3Example3c" class="form-control" value="<?= $row['op2'] ?>" />
                            <label class="form-label" for="form3Example3c">Option 2 </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" class="fs-5 px-4 btn btn-block btn-lg btn-gradient-primary">Update Product</button>
                    </div>

                </form>
            </main>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
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
    <script src="../../assets/js/lightbox.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let url = '<?= Url::link(""); ?>';
        function deleteimage(n){
            
           }

        function removeimage(n){
           

        }   

        $(document).ready(function(){
            $(".deleteimage").click(function(){
                $t = $(this);
                let n = $t.data('id');
                let r = confirm("are you sure you want to delete?");
            if(!r) return;
            $.post(url + "/dashboard/Images/deleteimage.php",{iid:n},function(data){
                data = JSON.parse(data);
                console.log(data);
                Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: data.message,
  showConfirmButton: false,
  timer: 1500
});
                $t.parent().remove();
            });
            });
        });

    </script>
</body>

</html>