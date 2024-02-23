<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Book Store Digital</title>
  <link rel="icon" href="../images/perpus.png" type="png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="../assets/images/icon/perpus-tpm.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- amchart css -->
</head>

<body>
  <center>
    <?php
    include '../config/config.php';

    $idBuku = $_GET["id_buku"];
    $query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
    ?>
    <?php foreach ($query as $item) : ?>
      <div class="d-grid">
        <a href="daftar_pinjam.php" class="btn btn-dark btn-block">Kembali</a>
      </div>
      <embed type="application/pdf" src="../isi-buku/<?php echo $item['isi_buku']; ?>#toolbar=0" width="100%" height="700"></embed>
    <?php
    endforeach;
    ?>
  </center>
</body>

</html>