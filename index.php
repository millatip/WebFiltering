<?php
    include "connect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      body {
        padding-top: 20px;
      }
    </style>
</head>

<body>

    <div class="container">
        <form action="" method="POST">
            <select name="gender" id="gender">
                <option></option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
            <input class="btn btn-primary" type="submit" name="search" value="Filter">
        </form>

        <br>

    <table class="table table-hover">
        <thead class="thead-dark">
            <th>NIM</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Prodi</th>
        </thead>
        <tbody>
            <?php
                    if(isset($_POST['search'])){
                        $gender = $_POST['gender'];
                        $query = "SELECT * FROM mhs where gender like '%$gender%'";
                    } else {
                        $query = "SELECT * FROM mhs";
                    }
                    $result = $conn->query($query);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){?>
            <tr>
                <td><?= $row["nim"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["gender"]; ?></td>
                <td><?= $row["prodi"]; ?></td>
            </tr>
            <?php
                        }
        }
    ?>
        </tbody>
    </table>


    </div>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
