<?php
    session_start();
    require_once("../../php/function.php");
    
    // if (!isset($_SESSION["user_data"]) || $_SESSION["user_data"]["role"] != "Vendor") {
    //     header('location: ../login/login.php');
    // }

    $allProducts = readcsv("../../data/product.csv");
    $vendorProducts = array();
    foreach ($allProducts as $product){
        if ($product["Brand Name"]==$_SESSION['user_data']['name']){
            $vendorProducts[] = $product;
        }
    }
    include("../Homepage/header.html")
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
            <div class="row row-cols-auto">
                    <h2 class="">Your Products</h2>
                    <button type="button" class="btn btn-outline-primary h-75">Add</button>
            </div>
            <div class="grid-container ">
                <?php 
                    for ($i = 0; $i < count($vendorProducts); $i++) {
                        echo('
                            <a href="/html/productpage/product_customer.php/get?id='.$vendorProducts[$i]["Product ID"].'" class="d-block">
                                <div class="coll-4 coll-s-6">
                                    <div class="card mx-auto">
                                        <div class="container ratio ratio-1x1"> 
                                            <img src="'. $vendorProducts[$i]["Image"].'" class="card-img-top p-4 ratio ratio-1x1" alt="...">
                                        </div>
                                        <div class="card-body text-bg-light rounded-2">
                                        <h5 class="card-title">'. $vendorProducts[$i]["Product Name"] .'</h5>
                                        <p class="card-text"><small class="text-muted">'. $vendorProducts[$i]["Brand Name"].'</small></p>
                                        <p class="card-text">$'. $vendorProducts[$i]["Price"].'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        ');
                    }
                ?>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>

<?php 
    include("../Homepage/footer.html");
?> 