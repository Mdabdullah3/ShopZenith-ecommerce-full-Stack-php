<?php
session_start();

// Include necessary files
require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = DB::connect();
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute the SQL query to fetch the user
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided email exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on user role
            if ($row['role'] == 1) {
                header("location: /New%20projects/index.php");
                exit;
            } elseif ($row['role'] == 2) {
                header("location: dashboard/");
                exit;
            }
        } else {
            $message = "Incorrect Password !!";
        }
    } else {
        $message = "User with this email does not exist !!";
    }
    // Close the database connection
    $stmt->close();
    $conn->close();
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
    <?php $img = "../../assets/images/cart.svg";
    include "../../shared/navbar.php" ?>
    <div class="login-page bg-light my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 mt-5">
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="Login.php" method="post" class="row g-4">
                                        <?php
                                        if (isset($message)) {
                                        ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Error!</strong> <?= $message; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <h4 class="text-center">Login Here</h4>
                                        <div class="col-12">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input id="email" type="email" class="form-control" name="email" required placeholder="Enter Email">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input id="password" type="text" class="form-control" name="password" required placeholder="Enter Password">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>