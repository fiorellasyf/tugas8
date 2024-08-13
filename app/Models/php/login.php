<?php 
	
	session_start();

	if(isset($_SESSION['login'])){
		header('location:chart/chart.php');
	}

	include 'template.php';
	include 'database.php';


	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$result =mysqli_query($koneksi, "select * from karyawan where email = '$email'");

		if(mysqli_num_rows($result) === 1){
			$row = mysqli_fetch_assoc($result);
			// echo json_encode($row);
			if ($row['kd_divisi'] != '0') {
			if(password_verify($password, $row['password'])){
				$_SESSION['id'] = $row['id'];
       			$_SESSION['nama'] = $row['nama'];
       			$_SESSION['alamat'] = $row['alamat'];
       			$_SESSION['email'] = $row['email'];
       			$_SESSION['kd_divisi'] = $row['kd_divisi'];
       			$_SESSION['kd_posisi'] = $row['kd_posisi'];
				$_SESSION['login'] = true;
				if($_SESSION['kd_divisi'] == '1' && $_SESSION['kd_posisi'] == '1'){
          header('location:chart/chart.php');
        }elseif($_SESSION['kd_divisi'] > '1'){
          header('location:admin/chart.php');
        }
				exit;
			}else{
			$error = 'Email/Password tidak sesuai';
		}
			}else{
				$error = 'User belum terverifikasi';
			}
		}else{
			$error = 'Email/Password tidak sesuai';
		}

	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<h1 class="mt-3 ml-3">Halaman Login</h1>
		<?php if (isset($error)):  ?>
			<div class="text-danger ml-3">
        		<i><?= $error ?></i>
      		</div>
		<?php endif ?>
		<form action="" method="post">
		 	<div class="form-group col-sm-4 mt-3">
		    	<label for="email">Email</label>
		    	<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
		  	</div>
		  	<div class="form-group col-sm-4">
		    	<label for="password">Password</label>
		    	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		    	 <span id="mybutton" onclick="change()"><i class="glyphicon glyphicon-eye-open"></i></span>
		  	</div>
		  	<div class="form-group col-sm-4">
		  		<button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
		  	</div>
		  	<div class="form-group col-sm-4">
		  		<a href="registrasi.php" class="btn btn-light btn-block" role="button" aria-pressed="true">Registrasi</a>
		  	</div>

		</form>
	</div>
</body>
</html>