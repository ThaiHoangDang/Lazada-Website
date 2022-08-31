<?php
// Include files
require_once("../../php/function.php");

session_start();

if (!isset($_SESSION["user_data"])) {
    header('location: ../Login/login.php');
}

if (isset($_POST['saveImg'])) {

    $new_img_file = $_FILES["profile-img"]["tmp_name"];
    $exten = pathinfo($_FILES["profile-img"]["name"], PATHINFO_EXTENSION);
    $save_file_name = $_SESSION["user_data"]["username"] . "." . $exten;
    $upload_destination = '../../data/media/' . $save_file_name;

    // Check if the file name already exists
    $old_file_path = "../../data/media" . $_SESSION["user_data"]["profile_img"];
    if (file_exists($old_file_path)) {
        chmod($old_file_path, 0755);
        unlink($old_file_path);
    }
    move_uploaded_file($new_img_file, $upload_destination);

    $_SESSION["user_data"]["profile_img"] = $save_file_name;

    // Write data back to the database
    $data = readcsv("../../data/users.csv");
    for ($index = 0; $index < count($data); $index++) {
        if ($data[$index]["username"] == $_SESSION["user_data"]["username"]) {
            $data[$index]["Image"] = $save_file_name;
        }
    }
    writecsv("../../data/users.csv", $data);
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
                            <li class="list-group-item"><label>Name:</label>
                                <?= $_SESSION["user_data"]["name"]; ?>
                            </li>

                            <li class="list-group-item"><label>Email:</label>
                                <?= $_SESSION["user_data"]["email"]; ?>
                            </li>
                            <li class="list-group-item"><label>Phone Number:</label>
                                <?= $_SESSION["user_data"]["phone"]; ?>
                            </li>
                            <?php
                                if ($_SESSION["user_data"]["role"] == "Shipper") {
                                    echo "<li class='list-group-item'><label>Distribution Hub:</label> {$_SESSION["user_data"]["distribution_hub"]}</li>";
                                } else {
                                    echo "<li class='list-group-item'><label>Address:</label> {$_SESSION["user_data"]["address"]}</li>";
                                }
                            ?>

                        </ul>
                    </article>
                    <div class="col-md-5">
                        <article class="py-2 d-flex justify-content-center">
                            <form enctype="multipart/form-data" method="post" action="customerMyAccount.php">
                                <div class="profile-picture">
                                    <label for="img-file">
                                        <span>Change Image</span>
                                    </label>
                                    <input id="img-file" name="profile-img" type="file" onchange="loadFile(event)" />
                                    <img id="img-output" src="<?php echo "../../data/media/" . (empty($_SESSION["user_data"]["profile_img"]) ? "default.jpeg" : $_SESSION["user_data"]["profile_img"]); ?>" alt="profile picture" />
                                </div>
                                <div class="mt-3 text-center">
                                    <button type="submit" name="saveImg" class="btn btn-secondary">Save image</button>
                                </div>

                                <?php
                                if (isset($_POST['saveImg'])) {
                                    if (isset($new_img_file)) {
                                        echo "<p class='text-success mb-0'>Change profile image successfully!</p>";
                                    }
                                }
                                ?>
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