
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <img src="/img/lazadaLogoNoBG.svg" class="nav-logoimg" alt="logo">
        <h2 class="nav-logo">Lazada</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <?php
              if (!isset($_SESSION["user_data"])) {
                echo "<a class='nav-link' href='/html/homepage/homepage.php'>Home</a>";
              } else {
                if ($_SESSION["user_data"]["role"] == "Shipper") {
                  echo "<a class='nav-link' href='/html/Shipper/shipper.php'>Home</a>";
                } elseif ($_SESSION["user_data"]["role"] == "Vendor") {
                  echo "<a class='nav-link' href='/html/Vendor/vendorHomepage.php'>Home</a>";
                } else {
                  echo "<a class='nav-link' href='/html/homepage/homepage.php'>Home</a>";
                }
              }
              ?>

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
                            </li>';
              }

              echo '<li class="nav-item">
                    <a class="nav-link" href="/html/myaccount/myaccount.php">My account</a>
                    </li>';
            }
            ?>
          </ul>
          <?php
          if (!isset($_SESSION["user_data"]) || $_SESSION["user_data"]["role"] == "Customer") {
          echo "<form action='/html/Homepage/searchResult.php' class='d-flex nav-searchtool'>
            <input class='form-control me-1' placeholder='Search' name='search'>
            <button class='btn btn-outline-light' type='submit'>Search</button>
          </form>";
          }
          ?>

        </div>
      </div>
    </nav>
