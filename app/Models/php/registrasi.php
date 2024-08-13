<?php 
 
	include 'template.php';
	include 'database.php';

	$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
	$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

	$cek_email="SELECT email FROM karyawan WHERE email = '$email'";
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
			}elseif($password !== $password2){ ?>
				<div class="container">
					<div class="main">
						<div class="alert alert-danger" role="alert">
  						Konfirmasi password tidak sesuai.
  						</div>
					</div>
				</div>
				?>
			<?php
			}elseif(registrasi($_POST) > 0){
				echo "<script>alert('User berhasil ditambahkan');
				document.location.href = 'login.php';
				</script>";	
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
		<h1>Halaman Registrasi</h1>
		<form action="" method="post">
		  <div class="form-group row mt-3">
		    <label class="col-sm-2 col-form-label" for="nama">Nama</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="nama" value="<?= $nama; ?>" placeholder="Masukkan Nama Lengkap" required>
		    </div>
		  </div>
		  <div class="form-group row">
		  	<label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
		      <div class="col-sm-4">
		      	<textarea type="text" class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat" required><?= $alamat; ?></textarea>
		      </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label" for="email">Email</label>
		      <div class="col-sm-4">
		        <input type="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Masukkan Email yang valid" required>
		      </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label" for="password">Password</label>
		      <div class="col-sm-4">
		        <input type="password" class="form-control" name="password" placeholder="Buat password untuk login" required>
		      </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label" for="password2">Konfirmasi Password</label>
		      <div class="col-sm-4">
		        <input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password Anda" required>
		      </div>
		  </div>
<!-- 		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Divisi</label>
		      <div class="col-sm-4">
		        <select name="divisi" class="selectpicker form-control" data-live-search="true">
		        	<option disabled>pilih divisi</option>
		        	<?php 
  						$sql=read("SELECT * FROM tbl_divisi where status = 1");
  						foreach ($sql as $data) {

 					?>
 					<option value="<?php echo $data['id_divisi'];?>"><?php echo $data['divisi'];?></option> 
 					<?php
  					}
 					?>
    			</select>
		      </div>
		  </div> -->
		  <div class="form-group row">
		    <button type="submit" name="submit" class="btn btn-primary">Register</button>
			<a href="login.php" class="btn btn-secondary ml-3" role="button" aria-pressed="true">Cancel</a>
		  </div>
		</form>
	</div>
</div>

</body>
</html>