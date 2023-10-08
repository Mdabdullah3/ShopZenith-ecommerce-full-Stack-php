<?php
session_start();
// Echo Dir 
require __DIR__ . '../../vendor/autoload.php';

use App\DB\Database as DB;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = DB::connect();
    $eamil = $_POST["eamil"];
    $password = $_POST["password"];
    $query = "SELECT * FROM users WHERE email='$eamil' limit 1";
    $result = $conn->$query($query);
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == 1) {
                header("location: index.php");
            } elseif ($row['role'] == 2) {
                header("location: dashboard/");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login here</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet" />

</head>

<body>
    <?php include "../../shared/navbar.php" ?>
    <div class="login-page bg-light my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 mt-5">
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="" class="row g-4">
                                        <h4 class="text-center">Login Here</h4>
                                        <div class="col-12">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input id="password" type="text" class="form-control" name="password" placeholder="Enter Password">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                <label class="form-check-label" for="inlineFormCheck">Remember me</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <a href="#" class="float-end text-primary">Forgot Password?</a>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 text-white text-center pt-5" style="background-color: #3b5d50;">
                                    <img src="../../assets/images/product-3.png" class="img-fluid w-50" />
                                    <h2 class="fs-1">Welcome Back !!</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $img = "../../assets/images/sofa.png";
    include "../../shared/footer.php" ?>
</body>

</html>