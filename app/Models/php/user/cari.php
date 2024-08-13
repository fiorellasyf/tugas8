<?php 
  include '../database.php';
 $result = read("select * from karyawan");
 echo $result['nama'];


 ?>
