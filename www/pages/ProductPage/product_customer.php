<?php
session_start();
// Authorize user's permission
if (!isset($_GET["id"])) {
    header("Location: ../404/404.html");
}
// Read data from csv files
require_once("../../functions/data.php");
$products = readcsv("../../../data/product.csv", false);
$product = getproductdata($products);
$images = getimagearray($product);
$page_title = $product["Brand Name"] . " | " . $product["Product Name"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="icon" type="image/x-icon" href="/img/lazadaLogo.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/homepage/header-footer.css">
    <link rel="stylesheet" href="/css/ProductPage/product_page.css">

</head>

<body class="bg-light">
    <!-- HEADER -->
    <?php
    include("../Homepage/header.php");
    include("../../functions/cartFunction.php");
    ?>
    <!-- MAIN CONTENT -->
    <main>
        <div class="container mb-5">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pt-4 fw-bold">
                        <li class="breadcrumb-item"><a href="../../Homepage/homepage.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $product["Product Name"]; ?></li>
                    </ol>
                </nav>
            </div>

            <div class="container py-5 bg-white rounded-1">
                <div class="row px-xl-5">
                    <!-- Product images preview carousel -->
                    <div class="col-lg-5">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                echo "<div class='carousel-item active'>
                                        <img class='d-block' src=" . $images[0] . " alt='Image'>
                                        </div>";
                                for ($i = 1; $i < count($images); $i++) {
                                    echo "<div class='carousel-item'>
                                        <img class='d-block' src=" . $images[$i] . " alt='Image'>
                                        </div>";
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev carousel-dark" type="button" data-bs-target="#product-carousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next carousel-dark" type="button" data-bs-target="#product-carousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- Product details -->
                    <div class="col-lg-7 px-4">
                        <div class="pb-4">
                            <h2 class="font-weight-semi-bold"><?= $product["Product Name"]; ?></h2>
                            <h5 class="font-weight-light text-secondary"><?= $product["Brand Name"]; ?></h5>
                        </div>
                        <h3 class="font-weight-semi-bold mb-4">$<?= $product["Price"]; ?></h3>
                        <?php 
                            if ((isset($_SESSION["user_data"])) && ($_SESSION["user_data"]["role"] = "Customer")) {
                                echo '
                                    <form action="product_customer.php">
                                        <div>
                                            <button id="minus" type="button" class="btn btn-outline-primary minus quantity-btn">
                                                -
                                            </button>
                                            <label>
                                                <input id="quantity" type="number" class="text-center" value="1" min="0" max="100" disabled>
                                            </label>
                                            <button id="plus" type="button" class="btn btn-outline-primary plus quantity-btn">
                                                +
                                            </button>
                                        </div>
                                        <!-- Add to cart & Buy now interact -->
                                        <div class="mt-4">
                                            <button type="button" class="btn btn-outline-dark me-2" name="addToCart" onclick="addToCartEvents()">Add To Cart</button>
                                            <button type="button" class="btn btn-dark mx-2" name="buyNow" onclick="buyNowEvents()">Buy Now</button>
                                        </div>
                                    </form>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="container my-5 py-5 bg-white rounded-1 px-4">
                <h4 class="mb-3">Product Description</h4>
                <?php
                $product_des = explode(" | ", $product["About Product"]);
                foreach ($product_des as $content) {
                    echo "<p>" . $content . "</p>";
                }
                ?>
            </div>
        </div>
    </main>
    <!-- FOOTER -->
    <?php
    include("../Homepage/footer.php")
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/js/Function/changeQuantity.js"></script>
</body>

</html>