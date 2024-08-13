<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include  '../database.php';
	$id_posisi = $_GET["id_posisi"];
	if(delete_posisi($id_posisi) > 0){
		echo "<script>alert('Data berhasil dihapus');
			document.location.href = 'posisi.php';
			</script>";	
	}else{
		echo "<script>alert('Data gagal dihapus');
			document.location.href = 'posisi.php';
			</script>";	
	}
?>