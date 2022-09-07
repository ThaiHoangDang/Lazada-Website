<?php
session_start();

// require file
require_once("../../functions/data.php");

// read products data
$products = readcsv("../../../data/product.csv");

// get min and max price 
$min = $_GET['min'];
$max = $_GET['max'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/homepage/header-footer.css">
    <link rel="stylesheet" href="/css/homepage/homepage.css">
</head>

<body class="bg-light">
    <!-- HEADER -->
    <?php
    include("../Homepage/header.php");
    include("../Homepage/slider.html");
    ?>

    <!-- MAIN CONTENT -->
    <div class="container py-5">
        <div class="row">
            <div class="py-2">
                <h1>Filtered Result</h1>
                <h5 class="font-weight-light text-secondary">Between $<?= $min ?> and $<?= $max ?></h5>
            </div>
            <div class="grid-container bg-white rounded-1 px-5 py-4">
                <?php
                $count = 0;
                for ($i = count($products) - 1; $i > -1; $i--) {
                    // loop through products list and find matching result
                    if ($min <= $products[$i]["Price"] && $products[$i]["Price"] <= $max) {
                        $count++;
                        echo ('
                                <div class="coll-4 coll-s-6">
                                    <a class="text-decoration-none" href="/pages/productpage/product_customer.php/get?id=' . $products[$i]["Product ID"] . '">
                                        <div class="card mx-auto">
                                            <div class="container ratio ratio-1x1"> 
                                                <img src="' . explode("|", $products[$i]["Image"])[0] . '" class="card-img-top p-4 ratio ratio-1x1" alt="' . $products[$i]["Product Name"] . '">
                                            </div>
                                            <div class="card-body text-bg-light rounded-2">
                                            <h5 class="card-title">' . $products[$i]["Product Name"] . '</h5>
                                            <p class="card-text"><small class="text-muted">' . $products[$i]["Brand Name"] . '</small></p>
                                            <p class="card-text">$' . $products[$i]["Price"] . '</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            ');
                    }
                }
                // display if there is no product matching the input
                if ($count == 0) {
                    echo "Cannot find products";
                }

                ?>
            </div>
        </div>
    </div>

    <?php
    include("../Homepage/footer.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>