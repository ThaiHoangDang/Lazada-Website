<?php
    session_start();
    require_once("../../php/function.php");
    
    if (!isset($_SESSION["user_data"]) || $_SESSION["user_data"]["role"] != "Vendor") {
        header('location: ../login/login.php');
    }

    $allProducts = readcsv("../../data/product.csv");
    $vendorProducts = array();
    foreach ($allProducts as $product){
        if ($product["Brand Name"]==$_SESSION['user_data']['name']){
            $vendorProducts[] = $product;
        }
    }
    $categories = array();
    foreach ($allProducts as $product){
        $categories[] = $product["Category"];
    }
    $categories = array_unique($categories);
    include("../Homepage/header.php");

    if (isset($_POST['act'])) {
        $id = "P" . count($allProducts) + 1;
        $name = $_POST["name"];
        $cat = $_POST["category"];
        $brand = $_SESSION["user_data"]["name"];
        $price = $_POST["price"];
        $description = implode(" | ", preg_split('#(\r\n?|\n)+#',$_POST["description"]));
        
        $product_imgs = $_FILES["img-file"];
        $patharr = array();
        for ($i = 0; $i < count($product_imgs['name']); $i++){
            $exten = pathinfo($product_imgs['name'][$i], PATHINFO_EXTENSION);
            $file_name = $id . "_" . $i . "." . $exten;
            $upload_destination = '../../data/media/products/' . $file_name;
            $path = '/data/media/products/' . $file_name;
            move_uploaded_file($product_imgs["tmp_name"][$i],$upload_destination);
            $patharr[] = $path;
        }
        $imglist = implode("|", $patharr);
        $headers = array();
        foreach ($allProducts[0] as $header => $field) {
            $headers[] = $header;
        }
        $newProductFields = [$id, $name, $brand, $cat, $price, $description, $imglist];
        $newProduct = [];
        for ($i = 0; $i < count($headers); $i++) {
            $newProduct[$headers[$i]] = $newProductFields[$i];
        }
        $allProducts[] = $newProduct;
        writecsv("../../data/product.csv", $allProducts);
        header("location: vendorHomepage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/homepage/homepage.css">
        <link rel="stylesheet" href="/css/Vendor/vendorpage.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="row row-cols-auto">
                        <h2>Your Products</h2>
                        <button type="button" class="btn btn-outline-primary h-75" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New</button>
                </div>
                <div class="grid-container ">
                    <?php 
                        for ($i = 0; $i < count($vendorProducts); $i++) {
                            echo('
                                <a href="/html/productpage/product_customer.php/get?id='.$vendorProducts[$i]["Product ID"].'" class="d-block">
                                    <div class="coll-4 coll-s-6">
                                        <div class="card mx-auto">
                                            <div class="container ratio ratio-1x1"> 
                                                <img src="'. explode("|", $vendorProducts[$i]["Image"])[0].'" class="card-img-top p-4 ratio ratio-1x1" alt="...">
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
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id ="addProduct" enctype="multipart/form-data" method="post" action="vendorHomepage.php">
                            <div class="mb-3">
                                <label for="Product Name" class="form-label required">Product name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="Product Name" class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand" id="brand" placeholder=<?=$_SESSION['user_data']['name']?> disabled>
                            </div>
                            <div class="mb-3">
                                <label for="Price" class="form-label required">Price</label>
                                <input type="number" class="form-control" name="price" id="pric" placeholder="Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="Category" class="form-label required">Category</label>
                                <select class="form-select" aria-label="Default select example" name="category" id="category">
                                    <?php
                                        foreach ($categories as $cat){
                                            echo ('
                                            <option value="' . $cat . '">' . $cat . '</option>
                                            ');
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product-image" class="form-label required">Product Images</label>
                                <input class="form-control" type="file" name="img-file[]" accept="image/*" onchange="loadFile(event)" multiple required>
                            </div>
                            <div class="mb-3">
                                <label for="Product Description" class="form-label required">Product Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="addProduct" class="btn btn-primary" name="act">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 
    include("../Homepage/footer.html");
?>