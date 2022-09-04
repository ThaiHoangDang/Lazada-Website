<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/homepage/header-footer.css">
    <link rel="stylesheet" href="/css/Account/account.css">
</head>

<body class="bg-light">

    <?php
    include("../Homepage/header.php");
    ?>

    <main class="page-content">
        <div class="container">
            <div class="p-5 bg-white rounded-1">
                <h1 class="text-center mb-4">Register as ...</h1>
                <div class="row row-cols-3 g-3">
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="../../img/register/customer.jpeg" class="card-img-top img-cover" alt="Customer Illustration">
                            <div class="card-body">
                                <h3 class="card-title">Customer</h3>
                                <p class="card-text">Customers can choose and buy product they prefer in the shopping mall
                                </p>
                                <a href="../../html/Register/customerRegister.php" class="btn btn-primary">Register as customer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="../../img/register/vendor.jpeg" class="card-img-top img-cover" alt="Vendor Illustration">
                            <div class="card-body">
                                <h3 class="card-title">Vendor</h3>
                                <p class="card-text">Vendors upload their products to the shopping mall in order to sell them to the customers
                                </p>
                                <a href="../../html/Register/vendorRegister.php" class="btn btn-primary">Register as vendor</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="../../img/register/shipper.jpeg" class="card-img-top img-cover" alt="Shipper Illustration">
                            <div class="card-body">
                                <h3 class="card-title">Shipper</h3>
                                <p class="card-text">Shippers are responsibe for shipping the product from the distribution hubs to the customers
                                </p>
                                <a href="../../html/Register/shipperRegister.php" class="btn btn-primary">Register as shipper</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include("../Homepage/footer.php");
    ?>
    
</body>

</html>