<?php
// Include the database connection file
include '../database.php';
 
if (isset($_POST['divisiId']) && !empty($_POST['divisiId'])) {
	$idDiv = $_POST['divisiId'];
 

 $query = "SELECT * FROM posisi WHERE id_divisi = $idDiv and sts = '1'";
 $result = $koneksi->query($query);
 
 if ($result->num_rows > 0) {
 echo '<option value="">Pilih Posisi</option>';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row['id_posisi'].'">'.$row['jabatan'].'</option>';
 }
 } else {
 echo '<option value="">Posisi tidak tersedia</option>';
 }
}
?>