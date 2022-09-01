<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      <?php include '../../css/homepage/header.css'; ?>
    </style>
</head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <h2 class="logo">Lazada</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/html/homepage/homepage.php">Home</a>
            </li>
            <?php
              if (!isset($_SESSION["user_data"])) {
                echo '<li class="nav-item">
                <a class="nav-link" href="/html/login/login.php">Login | Register</a>
                </li>';
              } else {
                  if ($_SESSION["user_data"]["role"] == "Customer") {
                    echo '<li class="nav-item">
                          <a class="nav-link" href="/html/cart/cart.php">Cart</a>
                          </li>';}
                
                  echo '<li class="nav-item">
                  <a class="nav-link" href="/html/myaccount/myaccount.php">My account</a>
                  </li>';
              }
            ?>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </body>
</html>
