<?php
// echo __DIR__;

require __DIR__ . '/../../vendor/autoload.php';

use App\DB\Database as DB;
use App\Auth as Auth;

$user = Auth::User();
$conn = DB::connect();
$query = "select id,name from categories where 1";
$result = $conn->query($query);
// echo $result->num_rows;
$pq = "SELECT
p.*,
GROUP_CONCAT(i.name) AS images
FROM
products p
LEFT JOIN
images i ON p.id = i.product_id
GROUP BY
p.id, p.name, p.details";
$pqr = $conn->query($pq);
$conn->close();
// Dynamic Url 
require_once(__DIR__ . '/../../DynamicUrlGenerator.php');
$urlGenerator = new DynamicUrlGenerator();
?>
<div class="product-section">
    <div class="container">
        <div class="row">
            <!-- Start Column 1 -->
            <div class="col-3">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header text-white fs-5" style="background-color: #3b5d50;">Categories</div>
                                <div class="list-group list-group-flush">
                                    <?php
                                    if ($result->num_rows) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <a href="index.php?category=<?= $row['id'] ?>" class="list-group-item list-group-item-action"><?= $row['name'] ?></a>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="cart.html">
                    <img src="images/product-1.png" class="img-fluid product-thumbnail" />
                    <h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>

                    <span class="icon-cross">
                        <img src="images/cross.svg" class="img-fluid" />
                    </span>
                </a>
            </div> -->
            <div class="col-9" style="margin-top: 100px;">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    if ($pqr->num_rows) {
                        while ($row = $pqr->fetch_assoc()) {
                            $images = explode(",", $row['images']);
                    ?>
                            <div class="col" style="margin-top: -80px;">
                                <div class="h-75 card">
                                    <img class="img-fluid product-thumbnail h-50" src="assets/products/<?= strlen($images[0]) ? $images[0] : "noimage.png" ?>" alt="...">
                                    <div class="card-body">
                                        <a class="" href='<?php echo $urlGenerator->generateLink('/src/pages/Products/ProductDetails.php') . '?id=' . $row['id']; ?>'>
                                            <h5 class="product-title "><?= $row['name']; ?></h5>
                                        </a>
                                        <p class="text-muted mb-2"><?= $row["shortdesc"] ?></p>
                                        <p class="product-price">$<?= $row['sprice'] ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>