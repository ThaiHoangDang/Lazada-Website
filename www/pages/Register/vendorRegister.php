<?php
session_start();

// Include files
require_once("../../functions/data.php");
require_once("../../functions/validateInput.php");

if (isset($_POST['act'])) {

    // Get uset input
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Variables for save profile image
    $profile_img_file = $_FILES["profile-img"]["tmp_name"];
    $exten = pathinfo($_FILES["profile-img"]["name"], PATHINFO_EXTENSION);
    $save_file_name = $username . "." . $exten;
    $upload_destination = '../../img/users/' . $save_file_name;
    $unique_account;

    // Validate input at the server side
    if (
        validate_length($username, 8, 20) &&
        validate_password($password) &&
        validate_length($name, 5) &&
        validate_length($address, 5)
    ) {
        // Check if the username is unique
        $users = readcsv("../../../data/accounts.db");
        $headers;
        foreach ($users[0] as $header => $field) {
            $headers[] = $header;
        }

        $unique_account = true;
        for ($index = 0; $index < count($users); $index++) {
            if ($username == $users[$index]["username"] || ($users[$index]["role"] == "Vendor" && ($name == $users[$index]["name"] || $address == $users[$index]["address"]))) {
                $unique_account = false;
                break;
            }
        }

        // Add new user to the database
        if ($unique_account) {
            $hashed_pwd = password_hash($password, PASSWORD_BCRYPT);

            $newUserFields = [$username, $hashed_pwd, "Vendor", $name, $email, $phone, $address, null, $save_file_name];
            $newUser = [];
            for ($index = 0; $index < count($headers); $index++) {
                $newUser[$headers[$index]] = $newUserFields[$index];
            }
            $users[] = $newUser;
            writecsv("../../../data/accounts.db", $users);

            // Save the uploaded the profile image 
            move_uploaded_file($profile_img_file, $upload_destination);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="icon" type="image/x-icon" href="/img/lazadaLogo.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/homepage/header-footer.css">
    <link rel="stylesheet" href="/css/Account/account.css">
</head>

<body class="bg-light">
    <!-- HEADER -->
    <?php
    include("../Homepage/header.php");
    ?>
    <!-- MAIN CONTENT -->
    <main class="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../Homepage/homepage.php">Home</a></li>
                <li class="breadcrumb-item"><a href="pickRegister.php">Register</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vendor Register</li>
            </ol>
            <div class="p-5 bg-white rounded-1">
                <form class="row g-3 needs-validation" enctype="multipart/form-data" method="post" action="vendorRegister.php" novalidate>
                    <h2 class="text-center">Register as vendor</h2>
                    <div class="col-12 d-flex justify-content-center">
                        <div class="my-4 profile-picture">
                            <label for="img-file">
                                <span>Change Image</span>
                            </label>
                            <input type="file" id="img-file" name="profile-img" onchange="loadFile(event)" required />
                            <img id="img-output" src="../../img/default_profile.jpeg" alt="profile picture" />
                            <div class="invalid-feedback">
                                Please choose the profile image
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label required">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" pattern="[A-Za-z\d]{8,15}$" required>
                        <div class="invalid-feedback">
                            Username must be from 8 to 15 charactes with only letters (lowercase or uppercase) and digits,
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label required">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,20}$" required>
                        <div class="invalid-feedback" id="password-feedback">
                            Password must be from 8 to 20 characters with appropriate characters, contain at least 1 lowercase character, 1 uppercase letter, 1 digit, and 1 special character: !@#$%^&*
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="name" class="form-label required">Business name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Business name" minlength="5" required>
                        <div class="invalid-feedback">
                            Input must be at least 5 characters
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label required">Business address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Business Address" minlength="5" required>
                        <div class="invalid-feedback">
                            Input must be at least 5 characters
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Business email </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Business phone number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number">
                    </div>
                    <div class="col-12">
                        <button class="mt-2 w-100 btn btn-primary" type="submit" name="act">Register</button>
                    </div>

                    <!-- Redirect user to the login page -->
                    <?php
                    if (isset($_POST["act"])) {
                        if ($unique_account) {
                            echo "<p class='text-success my-0'>Register successfully</p>";
                            echo "<p class='my-0'>You will be redirected in <span id='counter'>10</span> second(s).</p>";
                            echo "<script src='../../js/Register/redirectRegister.js'></script>";
                        } else {
                            echo "<p class='text-danger'> The username or the business name or the business address is not unique</p>";
                        }
                    }
                    ?>

                </form>
            </div>
        </div>
    </main>
    <!-- FOOTER -->
    <?php
    include("../Homepage/footer.php");
    ?>

    <script src="/js/Common/common.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>