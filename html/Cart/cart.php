<?php
session_start();

if ((!isset($_SESSION['user_data']))||($_SESSION["user_data"]["role"] !== "Customer")) {
    header('location: ../login/login.php');
}

include("../Homepage/header.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cart</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <div class="container mb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pt-4 fw-bold">
            <li class="breadcrumb-item"><a href="../Homepage/homepage.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
          </ol>
        </nav>
      </div>
      <div class ="container">
          <h1 class="text-start">Cart</h1>
      </div>
      <div class="container bg-white rounded-1">
          <div class="container p-5">
              <div class="row">
                  <div class="col-md-6">
                      <div class="card mb-3">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <div class="container ratio ratio-1x1"> 
                                <img src="../../img/productImage/iphone.png" class="img-fluid rounded-start" alt="...">
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">iPhone</h5>
                                <p class="card-text"><small class="text-muted">$1300</small></p>
                                <button id="minus" type="button" class="btn btn-outline-primary minus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                  -
                                </button>
                                <label>
                                  <input id="input" type="number" class="text-center" value="1" disabled min="0" style="width:50px; height:30px;">
                                </label>
                                <button id="plus" type="button" class="btn btn-outline-primary plus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                  +
                                </button>
                                <div class="row">
                                  <div class="container pt-2">
                                    <button type="button" class="btn btn-outline-danger">Remove</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="card mb-3">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img src="../../img/watch.png" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">iWatch</h5>
                                <p class="card-text"><small class="text-muted">$200</small></p>
                                <button id="minus" type="button" class="btn btn-outline-primary minus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                  -
                                </button>
                                <label>
                                  <input id="input" type="number" class="text-center" value="1" disabled min="0" style="width:50px; height:30px;">
                                </label>
                                <button id="plus" type="button" class="btn btn-outline-primary plus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                  +
                                </button>
                                <div class="row">
                                  <div class="container pt-2">
                                    <button type="button" class="btn btn-outline-danger">Remove</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="card mb-3">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img src="../../img/macbook.jpeg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body container">
                                <h5 class="card-title">Macbook</h5>
                                <p class="card-text"><small class="text-muted">$2000</small></p>
                                <button id="minus" type="button" class="btn btn-outline-primary minus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                  -
                                </button>
                                <label>
                                  <input id="input" type="number" class="text-center" value="1" disabled min="0" style="width:50px; height:30px;">
                                </label>
                                <button id="plus" type="button" class="btn btn-outline-primary plus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                  +
                                </button>
                                <div class="row">
                                  <div class="container pt-2">
                                    <button type="button" class="btn btn-outline-danger">Remove</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="container">
                        <div class="card">
                          <div class="card-header text-center">
                            <h4>Summary</h4> 
                          </div>
                          <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Price
                                <span">$300</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Delivery
                                <span>$10</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total
                                <span>$310</span>
                              </li>
                            </ul>
                          </div>
                          <div class="card-footer text-center">
                            <a href="#" class="btn btn-outline-primary">Place Order</a>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
      <script src="../../js/Cart/cart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
    include("../Homepage/footer.php");
?>