<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include 'template.php';
	include '../database.php';

	$email = isset($_POST['email']) ? $_POST['email'] : '';
	
	$id = $_GET['id'];
	$dt = read("select * from karyawan where id = $id ")[0];
	$div = $dt['kd_divisi'];

	$cek_email="SELECT email FROM karyawan WHERE email = '$email' && id !='$id'";
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
		}elseif(update_karyawan($_POST) > 0){
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
		<h1>Update Data Karyawan</h1>
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
		    <label class="col-sm-2 col-form-label">Divisi</label>
		      <div class="col-sm-4">

		      	<select name="divisi" class="form-control" id="divisi">
				<option value="">Pilih Divisi</option>
				 <?php
				 $query = "SELECT * FROM tbl_divisi where status = '1'";
				 $result = $koneksi->query($query);
				 if ($result->num_rows > 0) {
				 while ($row = $result->fetch_assoc()) { ?>
				 <option value="<?= $row['id_divisi']; ?>"<?php if($dt['kd_divisi'] == $row['id_divisi']){echo "selected";} ?>><?= $row['divisi'] ?></option>
				 <?php
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
				 	<?php
					 $query = "SELECT * FROM posisi where sts ='1' and id_divisi = '$div'";
					 $result = $koneksi->query($query);
					 if ($result->num_rows > 0) {
			 		 while ($row = $result->fetch_assoc()) { ?>
					 <option value="<?= $row['id_posisi']; ?>"<?php if($dt['kd_posisi'] == $row['id_posisi']){echo "selected";} ?>><?= $row['jabatan'] ?></option>';
					<?php } } ?>
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