<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include 'template.php';
	include '../database.php';

	$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
	$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$divisi = isset($_POST['id_divisi']) ? $_POST['id_divisi'] : '';
	$posisi = isset($_POST['id_posisi']) ? $_POST['id_posisi'] : '';
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
		}elseif(create_karyawan($_POST) > 0){
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
		<h1>Tambah Data Karyawan</h1>
		<form action="" method="post">
		  <div class="form-group row mt-3">
		    <label class="col-sm-2 col-form-label">Nama</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="nama" value="<?= $nama; ?>" placeholder="Masukkan Nama Lengkap" required>
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
		    <label class="col-sm-2 col-form-label" for="password">Password</label>
		      <div class="col-sm-4">
		        <input type="password" class="form-control" name="password" placeholder="Buat Password" required>
		      </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label" for="password2">Konfirmasi Password</label>
		      <div class="col-sm-4">
		        <input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password" required>
		      </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label" for="divisi">Divisi</label>
		      <div class="col-sm-4">
		      	<select name="divisi" class="form-control" id="divisi">
				<option value="">Pilih Divisi</option>
				 <?php
				 $query = "SELECT * FROM tbl_divisi where status = '1'";
				 $result = $koneksi->query($query);
				 if ($result->num_rows > 0) {
				 while ($row = $result->fetch_assoc()) {
				 echo '<option value="'.$row['id_divisi'].'">'.$row['divisi'].'</option>';
				 }
				 }else{
				 echo '<option value="">divisi tidak tersedia</option>';
				 }
				 ?>
				 </select>
				</div>
			</div>	
			<div class="form-group row">
				 <label class="col-sm-2 col-form-label" for="divisi">Posisi</label>
				 <div class="col-sm-4">
				 	<select name="posisi" class="form-control" id="posisi">
				 	<option value="">Pilih Posisi</option>
				 	</select>
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
<script type="text/javascript">
  $(document).ready(function(){
    // divisi dependent ajax
    $("#divisi").on("change",function(){
      var divisiId = $(this).val();
      $.ajax({
        url :"ajax_insert.php",
        type:"POST",
        cache:false,
        data:{divisiId:divisiId},
        success:function(data){
          $("#posisi").html(data);
        }
      });
    });
  });
</script>