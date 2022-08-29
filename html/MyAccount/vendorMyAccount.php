<?php
session_start();

if (!isset($_SESSION["user_data"]) || $_SESSION["user_data"]["role"] != "Vendor") {
    header('location: ../Login/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/Profile/profile.css">
</head>

<body class="bg-light">
    <header>

    </header>
    <main>
        <div class="container">
            <ul class="breadcrumb py-4 fw-bold">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">My account</a></li>
            </ul>
        </div>
        <div class="container">
            <h1 class="text-center"> My account</h1>
        </div>
        <div class="container">
            <div class="mt-3 bg-white rounded-1">
                <section class="row px-5 py-4">
                    <article class="col-md-7">
                        <ul class="list-group list-group-flush info-list">
                            <li class="list-group-item"><label>Username:</label>
                                <?= $_SESSION["user_data"]["username"]; ?>
                            </li>
                            <li class="list-group-item"><label>Business Name:</label>
                                <?= $_SESSION["user_data"]["name"]; ?>
                            </li>
                            <li class="list-group-item"><label>Business Address:</label>
                                <?= $_SESSION["user_data"]["address"]; ?>
                            </li>
                            <li class="list-group-item"><label>Email:</label>
                                <?= $_SESSION["user_data"]["email"]; ?>
                            </li>
                            <li class="list-group-item"><label>Phone Number:</label>
                                <?= $_SESSION["user_data"]["phone"]; ?>
                            </li>
                        </ul>
                    </article>
                    <div class="col-md-5">
                        <article class="py-2 d-flex justify-content-center">
                            <form method="post" action="myAccount.php">
                                <div class="profile-picture">
                                    <label for="img-file">
                                        <span>Change Image</span>
                                    </label>
                                    <input id="img-file" type="file" onchange="loadFile(event)" />
                                    <img id="img-output" src="../../img/profile.jpeg" alt="profile picture" />
                                </div>
                                <div class="mt-3 text-center">
                                    <button type="submit" class="btn btn-secondary">Save image</button>
                                </div>
                            </form>
                        </article>

                        <article class="py-2 w-100">
                            <div class="list-group">
                                <a class="list-group-item list-group-item active" href="">My profile</a>
                                <a class="list-group-item list-group-item-action" href="../Login/logout.php">Sign Out</a>
                            </div>
                        </article>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <script src="../../js/Common/common.js" async></script>
</body>

</html>