<?php
    session_start();
    require_once("function.php");

    $allOrders = readcsv("../data/Order.csv");

    $orderInfo = explode(",",$_COOKIE["Order_info"]);
    $orderItems = explode(",", $_COOKIE["Order_items"]);

    $order_id = "O" . count($allOrders)+1;
    $customer = $orderInfo[0];
    $time = $orderInfo[1];
    $date = $orderInfo[2];
    $distribution_Hub = $orderInfo[3];


    $newOrder = [$order_id, $customer, $time, $date, $distribution_Hub, "Active"];

    $orderFile = fopen("../data/Order.csv", "a");
    fputcsv($orderFile, $newOrder);
    fclose($orderFile);


    $orderItemsFile = fopen("../data/OrderItem.csv", "a");
    foreach ($orderItems as $item) {
        if ($item != null) {
            $temp = explode("-", $item);
            fputcsv($orderItemsFile, [$order_id, $temp[0], $temp[1]]);
        }
    }
    fclose($orderItemsFile);

    setcookie("Order_info", "", time() - 3600);
    setcookie("Order_items", "", time() - 3600);

    
    header("location: ../html/success/success.html");
?>


