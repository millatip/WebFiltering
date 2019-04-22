<?php
    session_start();

    //Redirect user to beranda if they already login
    if(isset($_SESSION["username"]) && !empty($_SESSION["username"])){
        $username = $_SESSION["username"];
        header("location: admin.php");
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/floating-form.css" type="text/css">
    <!-- <style>
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro');

        body {
            font-family: 'Source Sans Pro', sans-serif;
        }
    </style> -->

    <title>Login Administrator</title>
</head>

<body>

    <form class="form-signin" action="validation.php" method="POST">
        <div class="text-center mb-4">
            <h1>Login Administrator</h1>
            <h1 class="h3 mb-3 font-weight-normal">Log in</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus
                name="username">
            <label for="inputUsername">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required
                name="password">
            <label for="inputPassword">Password</label>
        </div>

        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Log in" name="login">
    </form>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
