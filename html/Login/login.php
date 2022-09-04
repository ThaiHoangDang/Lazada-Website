<?php
session_start();

// Include files
require_once("../../php/function.php");
include("../Homepage/header.php");

if (isset($_SESSION["user_data"])) {
    header('location: ../myAccount/myAccount.php');
}

if (isset($_POST['signin'])) {
    $data = readcsv("../../data/users.csv");
    for ($index = 0; $index < count($data); $index++) {
        if ($_POST['username'] == $data[$index]["username"] && password_verify($_POST['password'], $data[$index]["password"])) {
            $user_data = [
                "username" => $data[$index]["username"],
                "password" => $data[$index]["password"],
                "role" => $data[$index]["role"],
                "name" => $data[$index]["name"],
                "email" => $data[$index]["email"],
                "phone" => $data[$index]["phone"],
                "address" => $data[$index]["address"],
                "distribution_hub" => $data[$index]["Distribution hub"],
                "profile_img" => $data[$index]["Image"]
            ];
            $_SESSION["user_data"] = $user_data;
            if ($user_data["role"] == "Customer") {
                header('location: ../myAccount/myAccount.php');
            } elseif ($user_data["role"] == "Vendor") {
                header('location: ../Vendor/vendorHomepage.php');
            } elseif ($user_data["role"] == "Shipper") {
                header('location: ../Shipper/shipper.php');
            }
        }
    }

    $status = 'Invalid username/password';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Account/account.css">
</head>

<body class="bg-light">
    <main class="page-content">
        <div class="container">
            <div class="dialogue-signin">
                <div class="p-5 bg-white rounded-1 d-flex justify-content-center">
                    <form class="w-100 text-center" method="post" action="login.php">
                        <h3 class="mb-3">Please sign in</h3>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="pass">Password</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" onclick="togglePasswordVisibility()">
                            <label>Show password</label>
                        </div>
                        <button class="mt-3 w-75 btn btn-lg btn-primary" type="submit" name="signin">Sign in</button>
                        <div class="mt-2 mb-3">
                            <a href="../Register/pickRegister.php" class="link-secondary">Sign up for new account</a>
                        </div>

                        <?php
                        if (isset($status)) {
                            echo "<h4 class=\"text-danger\">$status</h4>";
                        }
                        ?>
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/Common/common.js" async></script>
</body>

</html>
<?php
include("../Homepage/footer.php");
?>