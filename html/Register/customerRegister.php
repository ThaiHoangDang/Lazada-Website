<?php
// Include files
require_once("../../php/function.php");

session_start();

if (isset($_POST['act'])) {

    // Get uset input
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $profile_img_file = $_FILES["profile-img"]["tmp_name"];
    $exten = pathinfo($_FILES["profile-img"]["name"], PATHINFO_EXTENSION);
    $save_file_name = $username . "." . $exten;
    $upload_destination = '../../data/media/' . $save_file_name;


    // Check if the username is unique
    $data = readcsv("../../data/users.csv", true);
    $headers;
    foreach ($data[0] as $header => $field) {
        $headers[] = $header;
    }

    $unique_account = true;
    for ($index = 0; $index < count($data); $index++) {
        if ($_POST['username'] == $data[$index]["username"]) {
            $unique_account == false;
            break;
        }
    }

    // Add new user to the database
    if ($unique_account) {
        $hashed_pwd = password_hash($password, PASSWORD_BCRYPT);

        $newUserFields = [$username, $hashed_pwd, "Customer", $name, $email, $phone, $address, null, $save_file_name];
        $newUser = [];
        for ($index = 0; $index < count($headers); $index++) {
            $newUser[$headers[$index]] = $newUserFields[$index];
        }
        $data[] = $newUser;
        writecsv("../../data/users.csv", $data);

        // Save the uploaded the profile image 
        move_uploaded_file($profile_img_file, $upload_destination);
    } else {
        // Print the error - the username is not unique
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/Profile/profile.css">
</head>

<body class="bg-light">
    <main class="page-content">
        <div class="container">
            <div class="p-5 bg-white rounded-1">
                <form class="row g-3 needs-validation" enctype="multipart/form-data" method="post" action="customerRegister.php" novalidate>
                    <h2 class="text-center">Register as customer</h2>
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
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" minlength="8" maxlength="15" required>
                        <div class="invalid-feedback">
                            Username must be from 8 to 15 charactes
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label required">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,20}$" required>
                        <div class="invalid-feedback" id="password-feedback">
                            Invalid password
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="name" class="form-label required">Customer name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Customer name" minlength="5" required>
                        <div class="invalid-feedback">
                            Input must be at least 5 characters
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label required">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" minlength="5" required>
                        <div class="invalid-feedback">
                            Input must be at least 5 characters
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" minlength="5">
                        <div class="invalid-feedback">
                            Must be an email account with at least 5 characters
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number" minlength="5">
                        <div class="invalid-feedback">
                            Input must be at least 5 characters
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="mt-2 w-100 btn btn-primary" type="submit" name="act">Register</button>
                    </div>

                    <!-- Redirect user to the login page -->
                    <?php
                    if (isset($_POST["act"])) {
                        if ($unique_account) {
                            echo "<p>You will be redirected in <span id='counter'>10</span> second(s).</p>";
                            echo "<script src='../../js/Register/redirectRegister.js'></script>";
                        } else {
                            echo "<p> Can't register</p>";
                        }
                    }
                    ?>

                </form>
            </div>
        </div>
    </main>
    <script src="../../js/Common/common.js"></script>
</body>

</html>