<?php
session_start();
require_once("../../functions/data.php");
// Authorize user's permission
if (!isset($_SESSION['user_data']) || $_SESSION["user_data"]["role"] != "Shipper") {
  header('location: ../Login/login.php');
}
// Read data from csv files
$users = readcsv("../../../data/accounts.db");
$user = getuserbyusername($_SESSION["user_data"]["username"], $users);
$allOrders = readcsv("../../../data/Order.csv");
$products = readcsv("../../../data/product.csv");
$orders = array_filter(readcsv("../../../data/Order.csv"), function ($var) use ($user) {
  if (($var["Distribution Hub"] == $user["Distribution hub"])) {
    return true;
  }
  return false;
});
$active_orders = array_filter($orders, function ($var) {
  return ($var["Status"] == "Active");
});
$order_items_list = readcsv("../../../data/OrderItem.csv");
// Change order status and write to csv file
if (isset($_POST['act'])) {
  for ($i = 0; $i < count($allOrders); $i++) {
    if ($allOrders[$i]["Order ID"] == $_POST["changeID"]) {
      $allOrders[$i]["Status"] = $_POST['change'];
    }
  }
  writecsv("../../../data/Order.csv", $allOrders);
  header('location: shipper.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipper Page</title>
  <link rel="icon" type="image/x-icon" href="/img/lazadaLogo.webp">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/homepage/header-footer.css">
  <link rel="stylesheet" href="/css/Shipper/shipper.css">

</head>

<body class="bg-light">
  <!-- HEADER -->
  <?php
  include("../Homepage/header.php");
  ?>
  <!-- MAIN CONTENT -->
  <main>
    <div class="container py-4">
      <h2>Orders List</h2>
      <div>Distribution hub: <?= $user["Distribution hub"] ?></div>
    </div>
    <div class="container bg-white rounded-1 py-4">
      <!-- Generate order preview cards -->
      <?php
      foreach ($active_orders as $order) {
        $customer = getuserbyusername($order["Customer"], $users);
        echo ('
          <div class="card mx-5 my-3 text-start">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-md-10 h5">
                  Order ID: ' . $order['Order ID'] . '
                </div>
                <div class="col-md-2 text-end fw-normal fs-6">
                  <span class="mb-3 px-2 py-1 fw-normal text-success bg-success bg-opacity-10 border border-success border-opacity-10 rounded-2 fs-6">Active</span> 
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul>
                <li class="list-group-item"><label>Customer: </label>
                    ' . $customer["name"] . '
                </li>
                <li class="list-group-item"><label>Created at: </label>
                    ' . $order["Time"] . ' ' . $order["Date"] . '
                </li>
                <li class="list-group-item"><label>Location: </label>
                    ' . $customer["address"] . '
                </li>
              </ul>
              <div class="text-center">
                  <button class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#' . $order["Order ID"] . '">View Order</button>
              </div>
            </div>
          </div>
          ');
      }
      if (count($active_orders)==0){
        echo ('
          <p>There is no active order to be displayed</p>
        ');
      }
      ?>
    </div>
    <!-- Generates modals coresponding to preview cards -->
    <?php
    foreach ($active_orders as $order) {
      $order_items = array();
      $total = 0;
      foreach ($order_items_list as $item) {
        if ($item["Order ID"] == $order["Order ID"]) {
          $order_items[] = $item;
        }
      }
      $customer = getuserbyusername($order["Customer"], $users);
      echo '
        <div class="modal fade" id="' . $order["Order ID"] . '" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Order ' . $order["Order ID"] . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <ul class="list-group list-group-flush info-list">
                  <li class="list-group-item"><label class="fw-semibold">Customer: </label>
                      ' . $customer["name"] . '
                  </li>
                  <li class="list-group-item"><label class="fw-semibold">Created at: </label>
                    ' . $order["Time"] . ' ' . $order["Date"] . '
                  </li>
                  <li class="list-group-item"><label class="fw-semibold">Location: </label>
                    ' . $customer["address"] . '
                  </li>
                  <li class="list-group-item"><label class="fw-semibold">Phone: </label>
                    ' . $customer["phone"] . '
                  </li>
                  <li class="list-group-item"><label class="fw-semibold">Items: </label>
                    <div class="container py-4">
                      <div class="row">
                        <div class="col-md-7">
                        ';
      // Generates items list of the order
      foreach ($order_items as $item) {
        $product = getproductbyid($item["Product ID"], $products);
        $images = getimagearray($product);
        $total = $total + $product["Price"] * $item["Quantity"];
        echo '
          <div class="card mb-3 product-info">
            <div class="row g-0 align-items-center">
              <div class="col-md-4">
                <img src="' . $images[0] . '" class="img-fluid rounded-start p-3 align-middle" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">' . $product["Product Name"] . '</h5>
                  <p class="card-text"><small class="text-muted">$' . $product["Price"] . '</small></p>
                  <p class="card-text">ID: ' . $product["Product ID"] . '</p>
                  <p class="card-text">Quantity: ' . $item["Quantity"] . '</p>
                </div>
              </div>
            </div>
          </div>
          ';
      }
      echo '
                        </div>
                        <div class="col-md-5 product-summary">
                          <div class="container">
                            <div class="card">
                              <div class="card-header text-center">
                                <h4>Summary</h4> 
                              </div>
                              <div class="card-body">
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Price
                                    <span>$' . $total . '</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Delivery
                                    <span>$2</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total
                                    <span>$' . $total + 2 . '</span>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="modal-footer">
                <form method="post" action="shipper.php">
                  <input type="hidden" name="changeID" value="' . $order["Order ID"] . '">
                  <input type="hidden" name="change" value="Canceled">
                  <button type="submit" name="act" class="btn btn-outline-danger">Cancel</button>
                </form>
                <form method="post" action="shipper.php">
                  <input type="hidden" name="changeID" value="' . $order["Order ID"] . '">
                  <input type="hidden" name="change" value="Delivered">
                  <button type="submit" name="act" class="btn btn-success">Delivered</button>
                </form>
              </div>
            </div>
          </div>
        </div>';
    }
    ?>
  </main>
  <!-- FOOTER -->
  <?php
  include("../Homepage/footer.php");
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>