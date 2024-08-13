<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include 'template.php';
	include '../database.php';

	$id_posisi = $_GET['id_posisi'];
	$dt = read("select * from posisi where id_posisi = $id_posisi ")[0];

	$posisi = isset($_POST['posisi']) ? $_POST['posisi'] : '';
	$divisi = isset($_POST['id_divisi']) ? $_POST['id_divisi'] : '';
	$sts = isset($_POST['sts']) ? $_POST['sts'] : '';

	$cek_jabatan="SELECT jabatan FROM posisi WHERE jabatan = '$posisi' && id_posisi != '$id_posisi'";
	$cek_jabatan_proses= mysqli_query($koneksi,$cek_jabatan);
	$data_jabatan = mysqli_fetch_array($cek_jabatan_proses, MYSQLI_NUM);

	if (isset ($_POST['submit'])) {
		if($data_jabatan>0){
			?>
			<div class="container">
				<div class="main">
					<div class="alert alert-danger" role="alert">
  					Nama posisi sudah ada, silahkan masukkan nama posisi lain
  					</div>
				</div>
			</div>
			<?php 		
		}elseif(update_posisi($_POST) > 0){
			echo "<script>document.location.href = 'posisi.php';</script>";

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
		<h1>Update Posisi Divisi</h1>
		<form action="" method="post">
		<input type="hidden" name="id_posisi" value="<?= $dt['id_posisi']; ?>" >
		  <div class="form-group row mt-3">
		  	<label class="col-sm-2 col-form-label">Nama Posisi</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="posisi" value="<?= $dt['jabatan']; ?>" placeholder="Masukkan Nama Posisi" required>
		    </div>
		  </div>

		  <div class="form-group row mt-3">
		  	<label class="col-sm-2 col-form-label">Nama Divisi</label>
		    <div class="col-sm-4">

		      <select name="divisi" class="form-control" id="divisi">
				<option value="">Pilih Divisi</option>
				 <?php
				 $query = "SELECT * FROM tbl_divisi where status = '1'";
				 $result = $koneksi->query($query);
				 if ($result->num_rows > 0) {
				 while ($row = $result->fetch_assoc()) { ?>
				 	<option value="<?= $row['id_divisi']; ?>"<?php if($dt['id_divisi'] == $row['id_divisi']){echo "selected";} ?>><?= $row['divisi'] ?></option>
				 <?php  
				 }
				 }
				 ?>
				 </select>

		    </div>
		  </div> 

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Status</label>
		      <div class="col-sm-4">
		        <select class="form-control" name="sts">
		        	<option value="1" <?php if($dt['sts'] == 1){echo "selected";} ?>>Aktif</option>
		        	<option value="0" <?php if($dt['sts'] == 0){echo "selected";} ?>>Tidak Aktif</option>
    			</select>
		      </div>
		  </div> 
		  <div class="form-group row">
		  <label class="col-sm-2 col-form-label"></label>
		      <div class="col-sm-4">
		        <button type="submit" name="submit" class="btn btn-primary">Save</button>
			<a href="posisi.php" class="btn btn-secondary ml-3" role="button" aria-pressed="true">Cancel</a>
		      </div>
		  </div>
		</form>
	</div>
</div>

</body>
</html>