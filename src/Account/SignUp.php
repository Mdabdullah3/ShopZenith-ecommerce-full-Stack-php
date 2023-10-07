<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Here</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .brand {
            color: #3b5d50;
        }

        .sign-container {
            max-width: 470px;
        }

        .icon-height {
            height: 24px;
            width: 24px;
        }

        .right-box {
            background: linear-gradient(#3b5d50, #0DCA78);
        }

        .inputbox {
            border: 1px solid #cfcece;
            outline: none;
        }

        .inputbox:focus {
            border: 2px solid #0DCA78;
        }

        .input-label {
            top: -12px;
            left: 3%;
        }

        .sign-up {
            background: #0DCA78;
            color: #fff;
        }

        .sign-up:hover {
            background: #fff;
            color: #0DCA78;
            border: 1px solid #0DCA78;
        }

        .signin-border {
            width: 60px;
            border: 2px solid #0DCA78;
        }
    </style>
</head>

<body>
    <?php include "../../shared/navbar.php" ?>
    <section class="container">
        <div class="row vh-100">
            <div class="col-md-7 col-12">
                <div class="px-4 sign-container mx-auto">
                    <div class="text-center mt-5">
                        <h4 class="fw-bold brand fs-4 my-4">Sign Up in to Account</h4>
                        <div class="mb-2 mx-auto signin-border"></div>
                        <div class="position-relative my-4">
                            <form class="mx-1 mx-md-4" action="register.php" method="post">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" placeholder="Enter First Name" name="first_name" id="form3Example1c" class="form-control" />
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" placeholder="Enter Last Name" name="last_name" id="form3Example1c" class="form-control mt-4" />
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <input placeholder="Enter E-mail" type="email" name="email" id="form3Example3c" class="form-control mt-4" />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="password" name="pass1" id="form3Example4c" class="form-control" placeholder="Enter Password" />

                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="password" placeholder="Confirm Password" name="pass2" id="form3Example4cd" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-check d-flex justify-content-center mb-5">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                    <label class="form-check-label" for="form2Example3">
                                        I agree all statements in <a href="#!">Terms of service</a>
                                    </label>
                                </div>

                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12 right-box d-flex">
                <div class="text-white text-center m-auto m-5 p-5">
                    <h2 class="fw-bolder fs-1 my-4">Hello, Friend!</h2>
                    <div class="signin-border border border-2 border-white mx-auto"></div>
                    <p class="fs-5 my-4">If You Have An Account Please.</p>
                    <button class="btn fw-bold btn-lg border-white rounded-5 px-5 fs-6 text-white
                    ">Login</button>
                </div>
            </div>
        </div>
    </section>
    <?php $img = "../../assets/images/sofa.png";
    include "../../shared/footer.php" ?>

</body>

</html>