<!-- clear user's data -->
<?php
session_start();
unset($_SESSION["user_data"]);
header("location: login.php");
?>