<?php
session_start();
// echo __DIR__;
require __DIR__ . '/../../vendor/autoload.php';


use App\DB\Database as DB;

if (isset($_GET['id'])) {
    $conn = DB::connect();
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    $sq = "SELECT
    p.*,
    GROUP_CONCAT(i.name) AS images
FROM
    products p
  
LEFT JOIN
    images i ON p.id = i.product_id
where p.id= {$id}  
GROUP BY
    p.id, p.name, p.details";
    $sqr = $conn->query($sq);
    if ($sqr->num_rows) {
        $row = $sqr->fetch_assoc();
    }
}
?>
<?php
$title = $row['name'];
$style = "../../assets/css/style.css";
$img = "../../assets/images/cart.svg";
include "../../shared/navbar.php" ?>

<main>
    <div class="container my-5">
        <div class="card details-card p-0">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?php
                    $imageFilenames = explode(',', $row['images']);
                    if (!empty($imageFilenames[0])) {
                        $filename = trim($imageFilenames[0]);
                        $imageUrl = '../../../assets/products/' . $filename;
                        echo '<img class="img-fluid" src="' . $imageUrl . '" alt="' . $filename . '">';
                    } else {
                        echo 'No image available';
                    }
                    ?>
                </div>
                <div class="col-md-6 col-sm-12 description-container p-5">
                    <div class="main-description">
                        <p class="product-category mb-0"><?= $row['tags'] ?></p>
                        <h3><?= $row['name'] ?></h3>
                        <h5> Stock - <?= $row['quantity'] ?></h5>
                        <hr>
                        <p class="product-price">Price- $<?= $row['sprice'] ?></p>
                        <form class="add-inputs" method="post">
                            <input type="number" class="form-control" id="cart_quantity" name="cart_quantity" value="1" min="1" max="10">

                        </form>
                        <form class="add-inputs d-flex gap-3 mt-3" method="post">
                            <button name="add_to_cart" type="submit" class="btn btn-primary btn-lg fs-6">Add to cart</button>
                            <button name="add_to_cart" type="submit" class="btn btn-primary btn-lg fs-6">Add to Wishlist</button>
                        </form>
                        <div style="clear:both"></div>

                        <hr>


                        <p class="product-title mt-4 mb-1">About this product</p>
                        <p class="product-description mb-4">
                            <?= $row["details"] ?>
                        </p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php $img = "../../assets/images/sofa.png";
include "../../shared/footer.php" ?>