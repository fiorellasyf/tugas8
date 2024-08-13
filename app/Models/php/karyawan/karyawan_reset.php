<?php 

 session_start();
    
    if(!isset($_SESSION['login'])){
        header('location:../login.php');
        exit;
    }

	include '../database.php';
	include 'template.php';

	$id = $_GET['id'];
	$dt = read("select * from karyawan where id = $id ")[0];


if(isset($_POST['submit'])){
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

			if($password !== $password2){ ?>
				<div class="container">
					<div class="main">
						<div class="alert alert-danger" role="alert">
  						Konfirmasi password tidak sesuai.
  						</div>
					</div>
				</div>
			<?php
			}elseif(reset_pw($_POST) > 0){
				$password = password_hash($password, PASSWORD_DEFAULT);

				echo "<script>alert('Password berhasil diubah');
				document.location.href = 'karyawan.php';
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
		<h1>Reset Password</h1>
		<form action="" method="post">
		  <div class="form-group row">
		  	<input type="hidden" name="id" value="<?= $dt['id']; ?>" >
		    <label class="col-sm-2 col-form-label">Password Baru</label>
		      <div class="col-sm-4">
		        <input type="password" class="form-control" name="password" placeholder="Masukkan Password Baru" required>
		      </div>
		  </div>
		  <div class="form-group row">
		  	<label class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
		      <div class="col-sm-4">
		        <input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password Baru" required>
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