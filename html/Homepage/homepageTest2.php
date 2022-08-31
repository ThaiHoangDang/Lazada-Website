<?php
    session_start();
    require_once("../../php/function.php");
    
    // if (!isset($_SESSION["user_data"]) || $_SESSION["user_data"]["role"] != "Customer") {
    //     header('location: ../login/login.php');
    // }

    $products = readcsv("../../data/product.csv");
    include("../Homepage/header.html");
    include("../Homepage/slider.html");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/homepage/homepageTest2.css">
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row">
                <h2 class="col-8 px-4">Featured Products</h2>
                <!-- <div class="col-4 px-4 float-end" style="width:150px;">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Filter</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div> -->
            </div>
            <div class="grid-container">
                <?php 
                    for ($i = 0; $i < 18; $i++) {
                        echo('
                            <a href="/html/productpage/product_customer.php/get?id='.$products[$i]["Product ID"].'">
                                <div class="coll-4 coll-s-6">
                                    <a href="/html/productpage/product_customer.php/get?id='.$products[$i]["Product ID"].'" style="text-decoration: none" >
                                        <div class="card mx-auto">
                                            <div class="container ratio ratio-1x1"> 
                                                <img src="'. $products[$i]["Image"].'" class="card-img-top p-4 ratio ratio-1x1" alt="...">
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
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>

<?php 
    include("../Homepage/footer.html")
?>