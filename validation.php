<?php
session_start();
include "connect.php";

$username = $_POST["username"];
$password = $_POST["password"];

$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
if($data = mysqli_num_rows($query) > 0) {
    $_SESSION["username"] = $username;
    header("location: admin.php");
} else {
    header("location: login.php");
}

?>
