<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Auth as Authe;

$user = Authe::User();
?>
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="/New%20projects/index.php">Shop Zenith<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/New%20projects/index.php">Home</a>
                </li>
                <li><a class="nav-link" href="shop.html">Shop</a></li>
                <li><a class="nav-link" href="/New%20projects/src/pages/Blog/Blog.php">Blog</a></li>
                <li><a class="nav-link" href="/New%20projects/dashboard">Dashboard</a></li>
                <li><a class="nav-link" href="/New%20projects/shared/contact.php">Contact us</a></li>
                <?php
                if ($user) {
                ?>
                    <li><a class="nav-link" href="/New%20projects/src/Account/Logout.php">Log Out</a></li>
                <?php } else {
                ?>

                    <li><a class="nav-link" href="/New%20projects/src/Account/Login.php">Login /</a></li>
                    <li><a class="nav-link" style="margin-left: -30px;" href="/New%20projects/src/Account/SignUp.php">Register</a></li>
                <?php
                }
                ?>
                <li>
                    <a class="nav-link" href="cart.html"><img src=<?= $img; ?> /></a>
                </li>
            </ul>
        </div>
    </div>
</nav>