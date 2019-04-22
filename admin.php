<?php
    session_start();
    include "connect.php";

    if(isset($_SESSION["username"]) && !empty($_SESSION["username"])){
       $username = $_SESSION["username"];
   } else {
       header("location: login.php");
   }

   if(isset($_POST["submit"])){
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        $prodi = $_POST['prodi'];

        $query = "INSERT INTO mhs(nim, nama, gender, prodi) VALUES ('$nim', '$nama','$gender', '$prodi')";
        if($conn->query($query)){
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            header("location: admin.php");
        } else {
            echo "Error : ".$conn->error;
        }
   }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator</title>
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
                <th>Aksi</th>
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
                    <td>
                        <!-- Ini bikin hlm buat edit data -->
                        <a href="edit_data.php?id=<?= $row['id'];?>" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#my_modal"
                            data-mhs-id="<?= $row['id'];?>">Delete</button>
                    </td>
                </tr>
                <?php
                        }
        }
    ?>
            </tbody>
        </table>

        <br>
        <!-- Sekalian bikin hlm buat tambah data ya :) -->
        <a href="#addMahasiswaModal" class="btn btn-primary" data-toggle="modal">Tambah Data</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a id="btn_delete" class="btn btn-primary">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div id="addMahasiswaModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Tambah Mahasiswa</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>NIM</label>
							<input type="text" name="nim" id="nim" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Gender</label>
							<select name="gender" class="form-control form-control-sm">
                                <option>---Select Gender--</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
						</div>
						<div class="form-group">
							<label>Prodi</label>
							<input type="text" name="prodi" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" name="cancel" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $('#my_modal').on('show.bs.modal', function (e) {
            var mhsId = $(e.relatedTarget).data('mhs-id');
            $(e.currentTarget).find('button[name="delete"]').val(mhsId);
            var deleteButton = document.getElementById('btn_delete');
            deleteButton.setAttribute('href', 'delete_mhs.php?id=' + mhsId);
            // console.log(messageId);
            // console.log(deleteButton);
        });
    </script>
</body>

</html>