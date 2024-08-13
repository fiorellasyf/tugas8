<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}

	include  '../database.php';
	$id = $_GET["id"];
	if(delete($id) > 0){
		echo "<script>alert('Data berhasil dihapus');
			document.location.href = 'read.php';
			</script>";	
	}else{
		echo "<script>alert('Data gagal dihapus');
			document.location.href = 'read.php';
			</script>";	
	}
?>