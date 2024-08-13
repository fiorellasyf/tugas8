<?php 

	session_start();
	
	if(!isset($_SESSION['login'])){
		header('location:../login.php');
		exit;
	}
	

	include 'template.php';
	include  '../database.php';

	if(isset($_GET['search'])){
		$page = 5; 
		$keyword = $_GET['keyword'];
		$jumlahdata = count(read("select * from data where nama like '%$keyword%' or jenis_kelamin like '%$keyword%' or tanggal_lahir like '%$keyword%'or no_telepon like '%$keyword%'or alamat like '%$keyword%'or email like '%$keyword%'"));
		$jumlahhal = ceil($jumlahdata / $page);
		if (isset($_GET['hal'])) {
			$halaktif = $_GET['hal'];
		}else {
			$halaktif = 1;
		}

		$awaldata = ($page * $halaktif) - $page;
		if(!empty($keyword)){

            $whrSQL = "WHERE (nama like '%$keyword%' or jenis_kelamin like '%$keyword%' or tanggal_lahir like '%$keyword%'or no_telepon like '%$keyword%'or alamat like '%$keyword%'or email like '%$keyword%')";
        }
		
		$hasil = mysqli_query($koneksi, "select * from data $whrSQL order by id desc limit $awaldata, $page");

	}else{
		$page = 5; 
		$jumlahdata = count(read("select * from data"));
		$jumlahhal = ceil($jumlahdata / $page);
		if (isset($_GET['hal'])) {
			$halaktif = $_GET['hal'];
		}else {
			$halaktif = 1;
		}

		$awaldata = ($page * $halaktif) - $page;

		$hasil = mysqli_query($koneksi, "select * from data order by id desc limit $awaldata, $page");


	}
	$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container mt-3">
		<div class="main">
		<h1>Tampil Data</h1>
		<p class="fw-normal">Hello, <b><?= $_SESSION['nama'] ?></b></p>
		<nav class="navbar navbar-light bg-light justify-content-between mt-3">
  			<a href="create.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Data</a>
  			<form class="form-inline" action="" method="get">
    			<input class="form-control mr-sm-2 " type="search" name="keyword" placeholder="Search" value="<?php echo $keyword; ?>" aria-label="Search" size="40" autofocus autocomplete="off">
    			<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
  			</form>
  		<div class="table-responsive">
<!--   			<?php
  			if(isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
			echo "<b>Hasil pencarian : ".$keyword."</b>";
}
  			 ?> -->
  			 <?php if($hasil->num_rows > 0){ ?>
	 		<table class="table mt-3">
			  	<thead>
				    <tr>
				      <th scope="col">No</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Jenis Kelamin</th>
				      <th scope="col">Tanggal Lahir</th>
			<!-- 	      <th scope="col">Usia</th> -->
				      <th scope="col">No Telepon</th>
				      <th scope="col">Alamat</th>
				      <th scope="col">E-mail</th>
				      <th scope="col">Opsi</th>
				    </tr>
			  </thead>
			  	<?php 
			  	$no = $awaldata + 1;
			  	while($row = $hasil->fetch_assoc()){
                            $nama = !empty($keyword)?highlightWords($row['nama'], $keyword):$row['nama'];
                            $jenis_kelamin = !empty($keyword)?highlightWords($row['jenis_kelamin'], $keyword):$row['jenis_kelamin'];
                             $tanggal_lahir = !empty($keyword)?highlightWords($row['tanggal_lahir'], $keyword):$row['tanggal_lahir'];
                            $no_telepon = !empty($keyword)?highlightWords($row['no_telepon'], $keyword):$row['no_telepon'];
                            $alamat = !empty($keyword)?highlightWords($row['alamat'], $keyword):$row['alamat'];
                            $email = !empty($keyword)?highlightWords($row['email'], $keyword):$row['email'];
			  	?>
			  <tbody>
			  	<?php 


			  	 ?>
			  		<tr>
			  			<th scope="row"><?php echo $no++; ?></th>
			  			<td><?php echo $nama; ?></td>
						<td><?php echo $jenis_kelamin; ?></td>
						<td><?php echo $tanggal_lahir; ?></td>
<!-- 
						<td><?php $lahir    =new DateTime($row['tanggal_lahir']);
                        $today        =new DateTime();
                        $umur = $today->diff($lahir);
                        echo $umur->y; echo " Tahun ";
                    	?>
                		</td> -->

						<td><?php echo $no_telepon; ?></td>
						<td><?php echo $alamat; ?></td>
						<td><?php echo $email; ?></td>
						<td>
							<a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm active " role="button" aria-pressed="true">Edit</a>

							<a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah anda yakin?');" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Hapus</a>			
						</td>
			  		</tr>
			  </tbody>
			<?php } ?>
			</table>
		</div>

		<nav aria-label="...">
  			<ul class="pagination">
    			<li class="page-item">
    				<?php if ($halaktif > 1): ?>
      				<a class="page-link" href="?hal=<?= (isset($_GET["keyword"])) ? ($halaktif-1).'&'.'keyword='.$_GET["keyword"].'&'.'search=' : ($halaktif-1); ?>">Previous</a>


      				<!-- ?hal=<?php echo $halaktif - 1 ?>">Previous</a> -->
      				<?php endif ?>
    			</li>

    			<?php  for($i = 1; $i <= $jumlahhal; $i++) : ?>
				<?php if($i == $halaktif) : ?>
				<li class="page-item active">
    				<a class="page-link" href="?hal=<?= (isset($_GET["keyword"])) ? $i.'&'.'keyword='.$_GET["keyword"].'&'.'search=' : $i; ?>"> <span class="sr-only">(current)</span><?= $i; ?></a>

    				<!-- "?hal=<?php echo $i ?>"><?php echo $i; ?> <span class="sr-only">(current)</span></a> -->
				</li>

   	 			<?php else : ?>
    			<li class="page-item"><a class="page-link" href="?hal=<?= (isset($_GET["keyword"])) ? $i.'&'.'keyword='.$_GET["keyword"].'&'.'search=' : $i;  ?>"><?= $i; ?></a></li>

    				<!-- page-link" href="?hal=<?php echo $i ?>"><?php echo $i; ?></a></li> -->
				<?php endif; ?>
				<?php endfor; ?>

				<li class="page-item">
    				<?php if ($halaktif < $jumlahhal): ?>
      				<a class="page-link" href="?hal=<?= (isset($_GET["keyword"])) ? ($halaktif+1).'&'.'keyword='.$_GET["keyword"].'&'.'search=' : ($halaktif+1); ?>">Next</a>
      				<?php endif ?>
    			</li>
  			</ul>
		</nav>	
	<?php }else{ ?>
            <div class="mt-3">                  
                <p>Tidak ada data yang sesuai.</p>
            </div>
            <?php } ?>
		</nav>
	</div>
	</div>
</body>
</html>