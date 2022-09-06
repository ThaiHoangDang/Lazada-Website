<?php
    session_start();

    // Required file
    require_once("data.php");

    // Read order file
    $allOrders = readcsv("../../data/Order.csv");

    $orderInfo = explode(",",$_COOKIE["Order_info"]);
    $orderItems = explode(",", $_COOKIE["Order_items"]);

    // New order info
    $order_id = "O" . count($allOrders)+1;
    $customer = $orderInfo[0];
    $time = $orderInfo[1];
    $date = $orderInfo[2];
    $distribution_Hub = $orderInfo[3];


    $newOrder = [$order_id, $customer, $time, $date, $distribution_Hub, "Active"];

    // Write new order to database
    $orderFile = fopen("../../data/Order.csv", "a");
    fputcsv($orderFile, $newOrder);
    fclose($orderFile);

    // Write new order items to database
    $orderItemsFile = fopen("../../data/OrderItem.csv", "a");
    foreach ($orderItems as $item) {
        if ($item != null) {
            $temp = explode("-", $item);
            fputcsv($orderItemsFile, [$order_id, $temp[0], $temp[1]]);
        }
    }
    fclose($orderItemsFile);

    // relocate to Success page
    header("location: ../pages/success/success.html");
?>


