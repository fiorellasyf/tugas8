<?php 
 
	$koneksi = mysqli_connect("localhost", "root", "", "oop_php");

	function read($query){
		global $koneksi;
		$result = mysqli_query($koneksi, $query);
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		return $rows;
	}
	function create($data){
		global $koneksi;

		$nama = htmlspecialchars($data['nama']);
		$jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
		$tanggal_lahir = htmlspecialchars($data['tanggal_lahir']);
		$no_telepon = htmlspecialchars($data['no_telepon']);
		$alamat = htmlspecialchars($data['alamat']);
		$email = htmlspecialchars($data['email']);


		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$query = "insert into data
				values ('','$nama','$jenis_kelamin','$tanggal_lahir','$no_telepon','$alamat','$email')";	

				mysqli_query($koneksi, $query);	
      	}
		
		return mysqli_affected_rows($koneksi);
	}
	function delete($id){
		global $koneksi;
		mysqli_query($koneksi, " delete from data where id = $id");

		return mysqli_affected_rows($koneksi);
	}
	function update($data){
		global $koneksi;
		$id = $data["id"];
		$nama = htmlspecialchars($data['nama']);
		$jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
		$tanggal_lahir = htmlspecialchars($data['tanggal_lahir']);
		$no_telepon = htmlspecialchars($data['no_telepon']);
		$alamat = htmlspecialchars($data['alamat']);
		$email = htmlspecialchars($data['email']);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        	$query = "update data set
					nama = '$nama', 
					jenis_kelamin = '$jenis_kelamin', 
					tanggal_lahir = '$tanggal_lahir', 
					no_telepon = '$no_telepon', 
					alamat = '$alamat',
					email ='$email' where id = '$id'";

			mysqli_query($koneksi, $query);
		}

		return mysqli_affected_rows($koneksi);
	}

	function highlightWords($text, $word){
    	$text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $text);
    	return $text;
	}

	function create_karyawan($data){
		global $koneksi;
		$nama = htmlspecialchars($data['nama']);
		$alamat = htmlspecialchars($data['alamat']);
		$email = htmlspecialchars($data['email']);
		$password = mysqli_real_escape_string($koneksi, $data['password']);
		$password2 = mysqli_real_escape_string($koneksi, $data['password2']);
		$divisi = htmlspecialchars($data['divisi']);
		$posisi = htmlspecialchars($data['posisi']);
		$password = password_hash($password, PASSWORD_DEFAULT);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$query = "insert into karyawan values ('','$nama','$alamat','$email','$password','$divisi','$posisi')";	

				mysqli_query($koneksi, $query);	
      	}	
		return mysqli_affected_rows($koneksi);
	}
	function update_karyawan($data){
		global $koneksi;
		$id = $data["id"];

		$nama = htmlspecialchars($data['nama']);
		$alamat = htmlspecialchars($data['alamat']);
		$email = htmlspecialchars($data['email']);
		$divisi = htmlspecialchars($data['divisi']);
		$posisi = htmlspecialchars($data['posisi']);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        	$query = "update karyawan set
					nama = '$nama', 
					alamat = '$alamat',
					email ='$email',
					kd_divisi ='$divisi', kd_posisi ='$posisi'
					where id = '$id'";

			mysqli_query($koneksi, $query);
		}
		return mysqli_affected_rows($koneksi);
	}
	function delete_karyawan($id){
		global $koneksi;
		mysqli_query($koneksi, " delete from karyawan where id = $id");

		return mysqli_affected_rows($koneksi);
	}
	function create_divisi($data){
		global $koneksi;

		$divisi = htmlspecialchars($data['divisi']);
		$status = htmlspecialchars($data['status']);
		$siapa = htmlspecialchars($_SESSION['nama']);
		date_default_timezone_set('Asia/Jakarta');
		$tanggal = date("Y-m-d H:i:s");

				$query = "insert into tbl_divisi
				values ('','$divisi','$tanggal', '$siapa','$status')";	

				mysqli_query($koneksi, $query);	
		
		return mysqli_affected_rows($koneksi);
	}
	function update_divisi($data){
		global $koneksi;
		$id_divisi = $data["id_divisi"];

		$divisi = htmlspecialchars($data['divisi']);
		date_default_timezone_set('Asia/Jakarta');
		$tanggal = date("Y-m-d H:i:s");
		$siapa = htmlspecialchars($_SESSION['nama']);
		$status = htmlspecialchars($data['status']);

        $query = "update tbl_divisi set
				divisi = '$divisi', tanggal = '$tanggal', siapa = '$siapa', status ='$status' where id_divisi = '$id_divisi'";

		mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);
	}
		function delete_divisi($id_divisi){
		global $koneksi;
		mysqli_query($koneksi, " delete from tbl_divisi where id_divisi = $id_divisi");

		return mysqli_affected_rows($koneksi);
	}
	function registrasi($data){
		global $koneksi;

		$nama = htmlspecialchars($data['nama']);
		$alamat = htmlspecialchars($data['alamat']);
		$email = htmlspecialchars($data['email']);
		$password = mysqli_real_escape_string($koneksi, $data['password']);
		$password2 = mysqli_real_escape_string($koneksi, $data['password2']);
		// $divisi = htmlspecialchars($data['divisi']);


		//enkripsi password
		$password = password_hash($password, PASSWORD_DEFAULT);

		//tambahkan user baru ke database
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			mysqli_query ($koneksi, "insert into karyawan values ('','$nama','$alamat','$email','$password','','')");	
		}
		return mysqli_affected_rows($koneksi);

	}
	function update_profil($data){
		global $koneksi;
		$id = $data["id"];

		$nama = htmlspecialchars($data['nama']);
		$alamat = htmlspecialchars($data['alamat']);
		$email = htmlspecialchars($data['email']);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        	$query = "update karyawan set
					nama = '$nama', 
					alamat = '$alamat',
					email ='$email'
					where id = '$id'";

			mysqli_query($koneksi, $query);
		}
		return mysqli_affected_rows($koneksi);
	}
	function reset_pw($data){
		global $koneksi;
		$id = $data["id"];

		$password = mysqli_real_escape_string($koneksi, $data['password']);
		$password2 = mysqli_real_escape_string($koneksi, $data['password2']);

		$password = password_hash($password, PASSWORD_DEFAULT);

        	$query = "update karyawan set
				password = '$password' where id = '$id'";

			mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);

	}
		function create_posisi($data){
		global $koneksi;
		$posisi = htmlspecialchars($data['posisi']);
		$divisi = htmlspecialchars($data['divisi']);
		date_default_timezone_set('Asia/Jakarta');
		$tanggal_edit = date("Y-m-d H:i:s");
		$oleh = htmlspecialchars($_SESSION['nama']);
		$sts = htmlspecialchars($data['sts']);

			$query = "insert into posisi values ('','$posisi','$divisi','$tanggal_edit','$oleh','$sts')";	

				mysqli_query($koneksi, $query);		
		return mysqli_affected_rows($koneksi);
	}
	function update_posisi($data){
		global $koneksi;
		$id_posisi = $data["id_posisi"];
		$posisi = htmlspecialchars($data['posisi']);
		$divisi = htmlspecialchars($data['divisi']);
		date_default_timezone_set('Asia/Jakarta');
		$tanggal_edit = date("Y-m-d H:i:s");
		$oleh = htmlspecialchars($_SESSION['nama']);
		$sts = htmlspecialchars($data['sts']);

		$query = "update posisi set
					jabatan = '$posisi', 
					id_divisi = '$divisi',
					tanggal_edit ='$tanggal_edit',
					oleh ='$oleh',
					sts ='$sts'
					where id_posisi = '$id_posisi'";

				mysqli_query($koneksi, $query);		
		return mysqli_affected_rows($koneksi);
	}
	function delete_posisi($id_posisi){
		global $koneksi;
		mysqli_query($koneksi, " delete from posisi where id_posisi = $id_posisi");

		return mysqli_affected_rows($koneksi);
	}

 ?>