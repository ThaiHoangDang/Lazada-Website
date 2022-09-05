<?php
session_start();

if ((!isset($_SESSION['user_data'])) || ($_SESSION["user_data"]["role"] !== "Customer")) {
  header('location: ../login/login.php');
}

require_once("../../functions/data.php");


$products = readcsv("../../../data/product.csv");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="icon" type="image/x-icon" href="/img/lazadaLogo.webp">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/homepage/header-footer.css">
  <link rel="stylesheet" href="/css/decoration/text.css">
  <link rel="stylesheet" href="/css/homepage/homepage.css">
</head>

<body class="bg-light" onload="displayCart()">

  <?php
  include("../Homepage/header.php");
  ?>

  <main>
    <div class="container mb-5">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pt-4 fw-bold">
            <li class="breadcrumb-item"><a href="/pages/Homepage/homepage.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
          </ol>
        </nav>
      </div>
      <div class="container">
        <h1 class="text-start">Cart</h1>
      </div>
      <div class="container bg-white rounded-1">
        <div class="container p-5">
          <div class="row">
            <div class="col-md-7 productTable">
            </div>
            <div class="col-md-5">
              <div class="container">
                <div class="card">
                  <div class="card-header text-center">
                    <h4>Summary</h4>
                  </div>
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Price
                        <span id="productsPrice">$</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Delivery
                        <span id="deliverPrice">$2.00</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total
                        <span id="totalPrice">$</span>
                      </li>
                    </ul>
                  </div>
                  <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary" onclick="placeOrder()">Place Order</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php
  include("../Homepage/footer.php");
  require_once("../../functions/cartDisplay.php");
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>