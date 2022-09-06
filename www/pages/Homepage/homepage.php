<?php
session_start();

// required file
require_once("../../functions/data.php");

// read product file
$products = readcsv("../../../data/product.csv");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="icon" type="image/x-icon" href="/img/lazadaLogo.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/homepage/header-footer.css">
    <link rel="stylesheet" href="../../css/homepage/homepage.css">
</head>

<body class="bg-light">
    <!-- HEADER -->
    <?php
    include("../Homepage/header.php");
    include("../Homepage/slider.html");
    ?>
    
    <!-- MAIN CONTENT -->
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="d-flex">
                    <div class="w-100">
                        <h1>Featured Products</h1>
                    </div>
                    <div class="flex-shrink-1">
                        <!-- Filter products by price -->
                        <div class="dropdown">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter by Price
                            </button>
                            <form class="dropdown-menu text-center" action="filteredHomepage.php">
                                <input class="dropdown-item" type="number" placeholder="min" name="min">
                                <input class="dropdown-item" type="number" placeholder="max" name="max">
                                <input class="btn btn-outline-dark mt-2" type="submit">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- display all items -->
                <div class="grid-container bg-white rounded-1 px-5 py-4">
                    <?php
                    for ($i = count($products) - 1; $i >=0; $i--) {
                        echo ('
                                <div class="coll-4 coll-s-6">
                                    <a class="text-decoration-none" href="/pages/productpage/product_customer.php/get?id=' . $products[$i]["Product ID"] . '">
                                        <div class="card mx-auto">
                                            <div class="container ratio ratio-1x1"> 
                                                <img src="' . explode("|", $products[$i]["Image"])[0] . '" class="card-img-top p-4" alt="ProductImg">
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
                    ?>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php
    include("../Homepage/footer.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>