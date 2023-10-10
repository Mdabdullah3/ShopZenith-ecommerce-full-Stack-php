<?php
$title = "Blogs.";
$style = "../assets/css/style.css";
$img = "../assets/images/cart.svg";
include "../shared/navbar.php" ?>
<section class="h-100 font-monospace" style="background-color: #eee;">
    <div class="container-md h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="https://images.unsplash.com/photo-1622445275463-afa2ab738c34?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8dHNoaXJ0fGVufDB8fDB8fHww&w=1000&q=80" class="img-fluid rounded-3" alt="Cotton T-shirt">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2">Basic T-shirt</p>
                                <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <input id="form1" min="0" name="quantity" value="2" type="number" class="mx-2 form-control form-control-sm" />

                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h5 class="mb-0">$499.00</h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body p-4 d-flex flex-row">
                        <div class="form-outline flex-fill">
                            <input type="text" id="form1" class="form-control form-control-lg" />
                            <label class="form-label" for="form1">Discound code</label>
                        </div>
                        <div class="">
                            <button type="button" class=" ms-4 btn btn-warning btn-block btn-lg">Apply</button>
                        </div>
                    </div>
                </div>

                <div class=" mb-5">
                    <div class="mb-5 card">
                        <div class="card-body">
                            <button type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php $img = "../assets/images/sofa.png";
include  "../shared/footer.php";
?>