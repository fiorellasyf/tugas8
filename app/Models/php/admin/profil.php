<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include 'template.php';
	include '../database.php';

	$email = isset($_POST['email']) ? $_POST['email'] : '';
	
	$id = $_SESSION['id'];
	$dt = read("select * from karyawan where id = $id ")[0];

	$cek_email="SELECT email FROM karyawan WHERE email = '$email' && id <> '$id'";
	$cek_email_proses= mysqli_query($koneksi,$cek_email);
	$data_email = mysqli_fetch_array($cek_email_proses, MYSQLI_NUM);

	if (isset ($_POST['submit'])) {
		if($data_email>0){
			?>
			<div class="container">
				<div class="main">
					<div class="alert alert-danger" role="alert">
  					Alamat e-mail sudah digunakan, silahkan menggunakan alamat e-mail yang lain
  					</div>
				</div>
			</div>
			<?php  		
		}elseif(update_profil($_POST) > 0){
			echo "<script>document.location.href = 'karyawan.php';</script>";

		}else{
			echo "<script>document.location.href = 'karyawan.php';</script>";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container mt-3">
		<div class="main">
		<h1>Update Profil</h1>
		<form action="" method="post">
			<input type="hidden" name="id" value="<?= $dt['id']; ?>" >
		  <div class="form-group row mt-3">
		    <label class="col-sm-2 col-form-label">Nama</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="nama" value="<?= $dt['nama']; ?>" placeholder="Masukkan Nama Lengkap" required>
		    </div>
		  </div>
		  <div class="form-group row">
		  	<label class="col-sm-2 col-form-label">Alamat</label>
		      <div class="col-sm-4">
		      	<textarea type="text" class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat" required><?= $dt['alamat']; ?></textarea>
		      </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Email</label>
		      <div class="col-sm-4">
		        <input type="email" class="form-control" name="email" placeholder="Masukkan Email yang valid" value="<?= $dt['email']; ?>" required>
		      </div>
		  </div>
		  	<div class="form-group row">
		  		<label class="col-sm-2 col-form-label"></label>
		      	<div class="col-sm-4">
 					<button type="submit" name="submit" class="btn btn-primary">Save</button>
					<a href="karyawan.php" class="btn btn-secondary ml-3" role="button" aria-pressed="true">Cancel</a>
		     	</div>
		  </div>
		</form>
	</div>
</div>

</body>
</html>