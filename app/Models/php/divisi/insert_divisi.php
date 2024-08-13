<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include 'template.php';
	include '../database.php';
	$divisi = isset($_POST['divisi']) ? $_POST['divisi'] : '';
	$status = isset($_POST['status']) ? $_POST['status'] : '';

	$cek_divisi="SELECT divisi FROM tbl_divisi WHERE divisi = '$divisi'";
	$cek_divisi_proses= mysqli_query($koneksi,$cek_divisi);
	$data_divisi = mysqli_fetch_array($cek_divisi_proses, MYSQLI_NUM);

	if (isset ($_POST['submit'])) {
		if($data_divisi>0){
			?>
			<div class="container">
				<div class="main">
					<div class="alert alert-danger" role="alert">
  					Nama divisi sudah ada, silahkan masukkan nama divisi lain
  					</div>
				</div>
			</div>
			<?php  		
		}elseif(create_divisi($_POST) > 0){
			echo "<script>document.location.href = 'divisi.php';</script>";

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
		<h1>Tambah Divisi</h1>
		<form action="" method="post">
		  <div class="form-group row mt-3">
		  	<label class="col-sm-2 col-form-label">Nama Divisi</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="divisi" value="<?= $divisi; ?>" placeholder="Masukkan Nama Divisi" required>
		    </div>
		  </div> 
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Status</label>
		      <div class="col-sm-4">
		        <select class="form-control" name="status">
		        	<option value="1">Aktif</option> 
		        	<option value="0">Tidak Aktif</option>
    			</select>
		      </div>
		  </div> 
		  <div class="form-group row">
		  <label class="col-sm-2 col-form-label"></label>
		      <div class="col-sm-4">
		        <button type="submit" name="submit" class="btn btn-primary">Save</button>
			<a href="divisi.php" class="btn btn-secondary ml-3" role="button" aria-pressed="true">Cancel</a>
		      </div>
		  </div>
		</form>
	</div>
</div>

</body>
</html>