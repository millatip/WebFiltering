<?php
$host = "localhost";
$username = "root";
$pass = "";
$dbname = "filter_db";

$conn = new mysqli($host, $username, $pass, $dbname);
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

?>