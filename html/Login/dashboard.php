<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard for admin</title>
</head>

<body>
    <h1>Welcome to the Dashboard <?= $_SESSION['user_data']['username'] ?>, <?= $_SESSION['user_data']['email'] ?></h1>
    <p>Click here to <a href="logout.php"> logout </a></p>
</body>

</html>