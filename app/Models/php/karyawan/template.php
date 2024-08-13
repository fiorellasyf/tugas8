<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script src="https://kit.fontawesome.com/d2832f72f5.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../css.php">

<div class="sidenav" style="position: absolute;">
  <a href="../chart/chart.php">Chart</a>
  <a href="karyawan.php">Karyawan</a>
  <a href="../divisi/divisi.php">Divisi</a>
  <a href="../posisi/posisi.php">Posisi</a>
  <a href="../logout.php" onclick="return confirm('Apakah anda yakin ingin logout?');">Logout (<?= $_SESSION['nama']; ?>)</a>
</div>
