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
        $jumlahdata = count(read("SELECT * from tbl_divisi join posisi on posisi.id_divisi = tbl_divisi.id_divisi
             where divisi like '%$keyword%' or jabatan like '%$keyword%' or tanggal_edit like '%$keyword%' or oleh like '%$keyword%' or sts like '%$keyword%'"));
        $jumlahhal = ceil($jumlahdata / $page);
        if (isset($_GET['hal'])) {
            $halaktif = $_GET['hal'];
        }else {
            $halaktif = 1;
        }

        $awaldata = ($page * $halaktif) - $page;
        if(!empty($keyword)){

            $whrSQL = "WHERE (divisi like '%$keyword%' or jabatan like '%$keyword%' or tanggal_edit like '%$keyword%' or oleh like '%$keyword%' or sts like '%$keyword%')";
        }
        
        $hasil = mysqli_query($koneksi, "SELECT * from tbl_divisi join posisi on posisi.id_divisi = tbl_divisi.id_divisi $whrSQL order by id_posisi desc limit $awaldata, $page");

    }else{
        $page = 5; 
        $jumlahdata = count(read("SELECT * from tbl_divisi join posisi on posisi.id_divisi = tbl_divisi.id_divisi"));
        $jumlahhal = ceil($jumlahdata / $page);
        if (isset($_GET['hal'])) {
            $halaktif = $_GET['hal'];
        }else {
            $halaktif = 1;
        }

        $awaldata = ($page * $halaktif) - $page;

        $hasil = mysqli_query($koneksi, "SELECT * from tbl_divisi join posisi on posisi.id_divisi = tbl_divisi.id_divisi order by id_posisi desc limit $awaldata, $page");


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
            <h1>Tampil Data Posisi</h1>
            <nav class="navbar navbar-light bg-light justify-content-between mt-3">
                <form class="form-inline" action="" method="get">
                <input class="form-control mr-sm-2 " type="search" name="keyword" placeholder="Search" value="<?php echo $keyword; ?>" aria-label="Search" size="40" autofocus autocomplete="off">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
            </form>
                <div class="table-responsive" id="table">
                    <?php if($hasil->num_rows > 0){ ?>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Posisi</th>
                                <th>Nama Divisi</th>
                                <th>Terakhir diubah</th>
                                <th>Diubah oleh</th>
                                <th>Status</th>
                            </tr>
                      </thead>
                        <?php 
                        $no = $awaldata + 1;
                        while($row = $hasil->fetch_assoc()){
                            $divisi = !empty($keyword)?highlightWords($row['divisi'], $keyword):$row['divisi'];
                            $jabatan = !empty($keyword)?highlightWords($row['jabatan'], $keyword):$row['jabatan'];
                            $tanggal_edit = !empty($keyword)?highlightWords($row['tanggal_edit'], $keyword):$row['tanggal_edit'];
                            $oleh = !empty($keyword)?highlightWords($row['oleh'], $keyword):$row['oleh'];
                            $sts = !empty($keyword)?highlightWords($row['sts'], $keyword):$row['sts'];
                        ?>
                      <tbody>
                        <tr>
                            <th scope="row"><?php echo $no++; ?></th>
                                <td><?php echo $jabatan; ?></td>
                                <td><?php echo $divisi; ?></td>
                                <td><?php echo $tanggal_edit; ?></td>
                                <td><?php echo $oleh ?></td>
                                <td><?php if ($sts == 1){ ?>
                                    <p class="text-success">Aktif</p>
                                    <?php }elseif($sts == 0){ ?>
                                    <p class="text-danger">Tidak Aktif</p>
                                    <?php } ?></td>
                        </tr>
                      </tbody>
                    <?php }  ?>
                    </table>
                </div>
                <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($halaktif > 1): ?>
                    <a class="page-link" href="?hal=<?= (isset($_GET["keyword"])) ? ($halaktif-1).'&'.'keyword='.$_GET["keyword"].'&'.'search=' : ($halaktif-1); ?>">Previous</a>
                    <?php endif ?>
                </li>

                <?php  for($i = 1; $i <= $jumlahhal; $i++) : ?>
                <?php if($i == $halaktif) : ?>
                <li class="page-item active">
                    <a class="page-link" href="?hal=<?= (isset($_GET["keyword"])) ? $i.'&'.'keyword='.$_GET["keyword"].'&'.'search=' : $i; ?>"> <span class="sr-only">(current)</span><?= $i; ?></a>
                </li>

                <?php else : ?>
                <li class="page-item"><a class="page-link" href="?hal=<?= (isset($_GET["keyword"])) ? $i.'&'.'keyword='.$_GET["keyword"].'&'.'search=' : $i;  ?>"><?= $i; ?></a></li>
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