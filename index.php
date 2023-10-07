<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="favicon.png" />

  <meta name="description" content="" />
  <meta name="keywords" content="bobootstrap4" />

  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link href="assets/css/tiny-slider.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <title></title>
</head>

<body>
  <!-- Start Header/Navigation -->
  <?php
  include "shared/navbar.php"
  ?>

  <!-- Start Hero Section -->
  <?php include "src/Home/Banner.php" ?>
  <!-- End Hero Section -->

  <!-- Start Product Section -->
  <?php include "src/Products/Products.php" ?>
  <!-- End Product Section -->

  <!-- Start Why Choose Us Section -->
  <div class="why-choose-section">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-6">
          <h2 class="section-title">Why Choose Us</h2>
          <p>
            Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet
            velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
          </p>

          <div class="row my-5">
            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/truck.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>Fast &amp; Free Shipping</h3>
                <p>
                  Donec vitae odio quis nisl dapibus malesuada. Nullam ac
                  aliquet velit. Aliquam vulputate.
                </p>
              </div>
            </div>

            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/bag.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>Easy to Shop</h3>
                <p>
                  Donec vitae odio quis nisl dapibus malesuada. Nullam ac
                  aliquet velit. Aliquam vulputate.
                </p>
              </div>
            </div>

            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/support.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>24/7 Support</h3>
                <p>
                  Donec vitae odio quis nisl dapibus malesuada. Nullam ac
                  aliquet velit. Aliquam vulputate.
                </p>
              </div>
            </div>

            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/return.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>Hassle Free Returns</h3>
                <p>
                  Donec vitae odio quis nisl dapibus malesuada. Nullam ac
                  aliquet velit. Aliquam vulputate.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="img-wrap">
            <img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Why Choose Us Section -->

  <!-- Start Popular Product -->
  <div class="popular-product">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="product-item-sm d-flex">
            <div class="thumbnail">
              <img src="images/product-1.png" alt="Image" class="img-fluid" />
            </div>
            <div class="pt-3">
              <h3>Nordic Chair</h3>
              <p>
                Donec facilisis quam ut purus rutrum lobortis. Donec vitae
                odio
              </p>
              <p><a href="#">Read More</a></p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="product-item-sm d-flex">
            <div class="thumbnail">
              <img src="images/product-2.png" alt="Image" class="img-fluid" />
            </div>
            <div class="pt-3">
              <h3>Kruzo Aero Chair</h3>
              <p>
                Donec facilisis quam ut purus rutrum lobortis. Donec vitae
                odio
              </p>
              <p><a href="#">Read More</a></p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="product-item-sm d-flex">
            <div class="thumbnail">
              <img src="images/product-3.png" alt="Image" class="img-fluid" />
            </div>
            <div class="pt-3">
              <h3>Ergonomic Chair</h3>
              <p>
                Donec facilisis quam ut purus rutrum lobortis. Donec vitae
                odio
              </p>
              <p><a href="#">Read More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Testimonial Slider -->
  <?php include "src/Home/Testimonial.php"  ?>

  <!-- Start Footer Section -->
  <?php $img = "assets/images/sofa.png";
  include  "shared/footer.php";
  ?>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/tiny-slider.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>