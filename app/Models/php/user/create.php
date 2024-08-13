<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}
	
	include 'template.php';
	include  '../database.php';

	$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
	$tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
	$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
	$no_telepon = isset($_POST['no_telepon']) ? $_POST['no_telepon'] : '';
	$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';

	$cek_email="SELECT email FROM data WHERE email = '$email'";
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
		}elseif(create($_POST) > 0){
			echo "<script>document.location.href = 'read.php';</script>";

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
		<h1>Insert Data</h1>
		<form action="" method="post">
		  <div class="form-group row mt-3">
		    <label class="col-sm-2 col-form-label">Nama</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="nama" value="<?= $nama; ?>" placeholder="Masukkan Nama Lengkap" required>
		    </div>
		  </div>
		  <fieldset class="form-group">
		    <div class="row">
		      <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
		      <div class="col-sm-4">
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki laki" <?php if($jenis_kelamin == 'laki laki'){echo "checked";} ?>>
		          <label class="form-check-label">
		            Laki-Laki
		          </label>
		        </div>
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" <?php if($jenis_kelamin == 'perempuan'){echo "checked";} ?>>
		          <label class="form-check-label">
		            Perempuan
		          </label>
		        </div>
		  </fieldset>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
		    <div class="col-sm-4">
		      <input type="date" class="form-control" name="tanggal_lahir" value="<?= $tanggal_lahir; ?>" placeholder="Masukkan Tanggal lahir" required>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">No Telepon</label>
		      <div class="col-sm-4">
		        <input type="text" class="form-control" name="no_telepon" value="<?= $no_telepon; ?>"value="<?= $dt['no_telepon']; ?>" placeholder="Masukkan No Telepon yang valid" pattern="[0-9]{11,14}" title="Masukkan hanya angka (11-14 karakter) " required>
		      </div>
		  </div>
		  <div class="form-group row">
		  	<label class="col-sm-2 col-form-label">Alamat</label>
		      <div class="col-sm-4">
		      	<textarea type="text" class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat" required><?= $alamat; ?></textarea>
		      </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Email</label>
		      <div class="col-sm-4">
		        <input type="email" class="form-control" name="email" placeholder="Masukkan Email yang valid" required>
		      </div>
		  </div>
		  <div class="form-group row">
		    <button type="submit" name="submit" class="btn btn-primary">Save</button>
			<a href="read.php" class="btn btn-secondary ml-3" role="button" aria-pressed="true">Cancel</a>
		  </div>
		</form>
	</div>
</div>

</body>
</html>