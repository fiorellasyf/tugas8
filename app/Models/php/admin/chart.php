<?php 
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('location:../login.php');
        exit;
    }
?>
<html>
  <head>
<title></title>
    <?php

    include '../database.php';
    include 'template.php';
    $result = mysqli_query($koneksi, "SELECT tbl_divisi.divisi, COUNT( * ) AS total FROM karyawan JOIN tbl_divisi on karyawan.kd_divisi = tbl_divisi.id_divisi GROUP BY kd_divisi ");
        $num_results = mysqli_num_rows($result);
        if( $num_results > 0){
    ?>
 
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
                    ['Divisi', 'Jumlah Anggota'],
                    <?php
                    while( $row = mysqli_fetch_array($result) ){
                        extract($row);
                        echo "['{$divisi}', {$total}],";
                    }
                    ?>
 
        ]);
 
        var options = {
          title: 'Persebaran Divisi Karyawan'
        };
 
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }

    </script>
  </head>
  <body>
    <div class="container mt-3">
        <div class="main">
          <div id="piechart" style="width: 700px; height: 300px;"></div>
        </div>
    </div>
  </body>
</html>
    <?php
 
    }else{  ?>
        <div class="container mt-3">
          <div class="main">
            <p class="text-center">Data tidak ditemukan</p>
          </div>
        </div>
    <?php
    }
    ?>
    <html>
  <head>
    <?php
    $result = mysqli_query($koneksi, "SELECT posisi.jabatan, COUNT( * ) AS total FROM karyawan JOIN posisi on karyawan.kd_posisi = posisi.id_posisi GROUP BY kd_posisi ");
        $num_results = mysqli_num_rows($result);
        if( $num_results > 0){
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
                    ['posisi', 'Jumlah Anggota'],
                    <?php
                    while( $row = mysqli_fetch_array($result) ){
                        extract($row);
                        echo "['{$jabatan}', {$total}],";
                    }
                    ?>
 
        ]);
        var options = {
          title: 'Persebaran posisi karyawan',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div class="container mt-3">
      <div class="main">
        <div id="donutchart" style="width: 700px; height: 300px;"></div>
      </div>
    </div>
  </body>
</html>
<?php
 
    }else{  ?>
        <div class="container mt-3">
          <div class="main">
            <p class="text-center">Data tidak ditemukan</p>
          </div>
        </div>
    <?php
    }
    ?>