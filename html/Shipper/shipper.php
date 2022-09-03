<?php
  session_start();
  require_once("../../php/function.php");
  include("../Homepage/header.php");
  if (!isset($_SESSION['user_data']) || $_SESSION["user_data"]["role"] != "Shipper" ) {
      header('location: ../login/login.php');
  }

  $users = readcsv("../../data/users.csv");
  $user = getuserbyusername($_SESSION["user_data"]["username"], $users);
  $allOrders = readcsv("../../data/Order.csv");
  $products = readcsv("../../data/product.csv");
  $orders = array_filter(readcsv("../../data/Order.csv"), function ($var) use ($user){
    if (($var["Distribution Hub"]==$user["Distribution hub"])){
      return true;
    }
    return false;
  });
  $active_orders = array_filter($orders, function ($var){
    return ($var["Status"]=="Active");
  });
  $order_items_list = readcsv("../../data/OrderItem.csv");
  if (isset($_POST['act'])){
    for($i = 0; $i < count($allOrders); $i++){
      if ($allOrders[$i]["Order ID"]==$_POST["changeID"]){
        $allOrders[$i]["Status"] = $_POST['change'];
      }
    }
    writecsv("../../data/Order.csv", $allOrders);
    header('location: shipper.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <div class ="container py-4">
      <h2>Orders List</h2>
    </div>
    <div class="container bg-white rounded-1 py-4">
      <?php
      foreach($active_orders as $order){
        $customer = getuserbyusername($order["Customer"], $users);
        echo('
        <div class="card mx-5 my-3 text-start">
          <h5 class="card-header">
            <div class="row">
              <div class="col-md-10">
                Order ID: ' . $order['Order ID'] . '
              </div>
              <div class="col-md-2 text-end">
                Status: <span class="text-success">Active</span> 
              </div>
            </div>
          </h5>
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
      ?>
      </div>
    </div>
  <?php
    foreach ($active_orders as $order){
      $order_items = array();
      $total = 0;
      foreach ($order_items_list as $item){
        if ($item["Order ID"]==$order["Order ID"]){
          $order_items[]=$item;
        }
      }
      $customer = getuserbyusername($order["Customer"],$users);
      echo '
      <div class="modal fade" id="' . $order["Order ID"] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Order ' . $order["Order ID"] . '</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul class="list-group list-group-flush info-list">
                <li class="list-group-item"><label>Customer: </label>
                    '.$customer["name"].'
                </li>
                <li class="list-group-item"><label>Created at: </label>
                  '.$order["Time"].' '.$order["Date"].'
                </li>
                <li class="list-group-item"><label>Location: </label>
                  '.$customer["address"].'
                </li>
                <li class="list-group-item"><label>Items: </label>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-7">
                      ';
      foreach ($order_items as $item){
        $product = getproductbyid($item["Product ID"], $products);
        $images = getimagearray($product);
        $total = $total + $product["Price"];
        echo '
        <div class="card mb-3" style="min-width: 400px;">
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
        ';}
      echo '
                      </div>
                      <div class="col-md-5" style="min-width: 300px;">
                        <div class="container">
                          <div class="card">
                            <div class="card-header text-center">
                              <h4>Summary</h4> 
                            </div>
                            <div class="card-body">
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Price
                                  <span">$' . $total . '</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Delivery
                                  <span>$10</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Total
                                  <span>$' . $total + 10 .'</span>
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
                <input type="hidden" name="changeID" value="'.$order["Order ID"].'">
                <input type="hidden" name="change" value="Canceled">
                <button type="submit" name="act" class="btn btn-outline-danger">Cancel</button>
              </form>
              <form method="post" action="shipper.php">
                <input type="hidden" name="changeID" value="'.$order["Order ID"].'">
                <input type="hidden" name="change" value="Delivered">
                <button type="submit" name="act" class="btn btn-success">Delivered</button>
              </form>
            </div>
          </div>
        </div>
      </div>';}
  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
<?php 
    include("../Homepage/footer.php");
?>