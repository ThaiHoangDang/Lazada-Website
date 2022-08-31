<?php
    session_start();
    if (!isset($_GET["id"])){
        header("Location: ../404/404.html");
    }
    require_once("../../php/function.php");
    $products = readcsv("../../data/product.csv", false);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <style>
    <?php include '../../css/ProductPage/product_page.css'; ?>
    </style>
    <title><?=$page_title?></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid bg-light mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Product Details</h1>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <?php
                            echo "<div class='carousel-item active'>
                                <img class='d-block' src=" . $images[0] . " alt='Image'>
                                </div>";
                        for ($i=1; $i<count($images); $i++){
                            echo "<div class='carousel-item'>
                                <img class='d-block' src=" . $images[$i] . " alt='Image'>
                                </div>";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#product-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#product-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?=$product["Product Name"]; ?></h3>
                <h2 class="font-weight-light">Brand: <?=$product["Brand Name"]; ?></h2>
                <h3 class="font-weight-semi-bold mb-4">$<?=$product["Price"]; ?></h3>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Quantity</span>
                    <input type="text" class="form-control" placeholder="Quantity" aria-label="Quantity" aria-describedby="basic-addon1">
                    <button class="btn btn-primary px-3">Add To Cart</button>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <h4 class="mb-3">Product Description</h4>
                <?php
                    $product_des = explode(" | ", $product["About Product"]);
                    foreach ($product_des as $content){
                        echo "<p>" . $content . "</p>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>