<?php
    include "connect.php";

    $id = $_GET['id'];
    $query = "DELETE FROM mhs WHERE id = $id";
    if($conn->query($query)){
        header("location: admin.php");
    } else {
        echo "Error : ".$conn->error;
    }
?>
