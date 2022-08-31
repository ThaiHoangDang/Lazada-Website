<?php
  if (($_SESSION["user_data"]["role"] == "Vendor")||($_SESSION["user_data"]["role"] == "Shipper")) {
    ?>
    <style type="text/css">
    #cart {
    display:none;
    }
    </style>
  <?php
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/homepage/header.css ">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/homepage/homepage.css"> 
</head>
  <body>
    <nav>
      <div class="icon">Lazada</div>
      <div class="search_box">
        <input type="search" placeholder="Search">
        <span class="fa fa-search"></span>
      </div>
      <ol>
        <li><a href="#">Home</a></li>
        <li id="cart"><a href="#">Cart</a></li>
        <li><a href="#">My account</a></li>
      </ol>
      <label for="check" class="bar">
        <span class="fa fa-bars" id="bars"></span>
        <span class="fa fa-times" id="times"></span>
      </label>
    </nav>
    <script src="https://kit.fontawesome.com/5ae40473f0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>