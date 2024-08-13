<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include  '../database.php';
	$id_divisi = $_GET["id_divisi"];
	if(delete_divisi($id_divisi) > 0){
		echo "<script>alert('Data berhasil dihapus');
			document.location.href = 'divisi.php';
			</script>";	
	}else{
		echo "<script>alert('Data gagal dihapus');
			document.location.href = 'divisi.php';
			</script>";	
	}
?>