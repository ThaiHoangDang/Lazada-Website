<?php
    session_start();
    require_once("../../php/function.php");
    
    $products = readcsv("../../data/product.csv");
    include("../Homepage/header.php");
    include("../Homepage/slider.html");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/homepage/homepage.css">
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="py-2">
                    <h1>Featured Products</h1>
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter by Price
                            </button>
                            <ul class="dropdown-menu">
                                <form action="filteredHomepage.php" class="text-center">
                                    <input class="dropdown-item" type="number" placeholder="min" name="min">
                                    <input class="dropdown-item" type="number" placeholder="max" name="max">
                                    <input class="btn btn-outline-dark mt-2" type="submit">
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="grid-container bg-white rounded-1 px-5 py-4">
                    <?php 
                        for ($i = count($products)-1; $i > count($products)-19; $i--) {
                            echo('
                                <a href="/html/productpage/product_customer.php/get?id='.$products[$i]["Product ID"].'">
                                    <div class="coll-4 coll-s-6">
                                        <a href="/html/productpage/product_customer.php/get?id='.$products[$i]["Product ID"].'" style="text-decoration: none" >
                                            <div class="card mx-auto">
                                                <div class="container ratio ratio-1x1"> 
                                                    <img src="'. explode("|", $products[$i]["Image"])[0].'" class="card-img-top p-4 ratio ratio-1x1" alt="ProductImg">
                                                </div>
                                                <div class="card-body text-bg-light rounded-2">
                                                <h5 class="card-title">'. $products[$i]["Product Name"] .'</h5>
                                                <p class="card-text"><small class="text-muted">'. $products[$i]["Brand Name"].'</small></p>
                                                <p class="card-text">$'. $products[$i]["Price"].'</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            ');
                        }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>

<?php 
    include("../Homepage/footer.php");
?>