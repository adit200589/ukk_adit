<?php
// Start the session
session_start();

// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
  header("Location: ../login.php");
  exit();
}

if (!isset($_SESSION['nisn'])) {
  header("Location: ../login.php");
  exit();
}

require "../config/config.php";
// Tangkap id buku dari URL (GET)
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
//Menampilkan data siswa yg sedang login
$nisnSiswa = $_SESSION['nisn'];
$dataSiswa = queryReadData("SELECT * FROM member WHERE nisn = $nisnSiswa");
$admin = queryReadData("SELECT * FROM user where sebagai='petugas'");

// Peminjaman 
if (isset($_POST["pinjam"])) {

  if (pinjamBuku($_POST) > 0) {
    echo "<script>
    alert('Buku berhasil dipinjam');
    </script>";
  } else {
    echo "<script>
    alert('Buku gagal dipinjam!');
    </script>";
  }
} ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <!-- Custom fonts for this template -->
  <link href="../assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../assets2/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../assets2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="../css2/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" type="text/css" href="../css2/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="../css2/responsive.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css2/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="website icon" type="png" href="../images/p.png">
  <title>Fapus</title>
</head>

<body>
  <!-- Topbar -->
  <div class="header_section">
    <div class="container-fluid">
      <n class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#page"><img src="../images/logof.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#">Daftar Buku</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="daftar_pinjam.php">Peminjaman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#.php">History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Kembali</a>
            </li>
          </ul>
        </div>
        </nav>
    </div>
  </div>
  <!-- End of Topbar -->

  <div class="container-xxl p-4 my-0">
    <div class="">
      <div class="alert alert-dark" role="alert">Form Peminjaman Buku</div>
      <!-- Default box -->
      <div class="card mb-auto">
        <h5 class="card-header">Data lengkap Buku</h5>
        <div class="row" style="padding: 10px;">
          <?php foreach ($query as $item) : ?>
            <!-- img -->
            <div class="col-md-3 d-flex justify-content-center mb-3">
              <img src="../imgDB/<?= $item["cover"]; ?>" width="190px" style="width: 300px; aspect-ratio: 8/12; border-radius: 10px;">
            </div>
            <!-- description -->
            <div class="col-md-9 col-12" style="width: 100%;">
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">ID Buku</span>
                    <input type="text" class="form-control" placeholder="id buku" aria-label="Username" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Kategori</span>
                    <input type="text" class="form-control" placeholder="kategori" aria-label="kategori" aria-describedby="basic-addon1" value="<?= $item["kategori"]; ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Judul</span>
                <input type="text" class="form-control" placeholder="judul" aria-label="judul" aria-describedby="basic-addon1" value="<?= $item["judul"]; ?>" readonly>
              </div>

              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Pengarang</span>
                    <input type="text" class="form-control" placeholder="pengarang" aria-label="pengarang" aria-describedby="basic-addon1" value="<?= $item["pengarang"]; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Penerbit</span>
                    <input type="text" class="form-control" placeholder="penerbit" aria-label="penerbit" aria-describedby="basic-addon1" value="<?= $item["penerbit"]; ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Tahun Terbit</span>
                    <input type="date" class="form-control" placeholder="tahun_terbit" aria-label="tahun_terbit" aria-describedby="basic-addon1" value="<?= $item["thn_terbit"]; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Jumlah Halaman</span>
                    <input type="number" class="form-control" placeholder="jumlah halaman" aria-label="jumlah halaman" aria-describedby="basic-addon1" value="<?= $item["jml_halaman"]; ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="form-floating">
                <textarea class="form-control" placeholder="deskripsi singkat buku" id="floatingTextarea2" style="height: 100px" readonly><?= $item["deskripsi"]; ?></textarea>
                <label for="floatingTextarea2">Deskripsi Buku</label>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="card mt-4">
          <h5 class="card-header">Data lengkap Siswa</h5>
          <div class="card-body d-flex flex-wrap gap-4 justify-content-center">
            <p><img src="../assets/user.png" width="150px"></p>
            <form action="" method="post" class="w-100">
              <?php foreach ($dataSiswa as $item) : ?>

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">NISN</span>
                      <input type="number" class="form-control" placeholder="nisn" aria-label="nisn" aria-describedby="basic-addon1" value="<?= $item["nisn"]; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Nama</span>
                      <input type="text" class="form-control" placeholder="nama" aria-label="nama" aria-describedby="basic-addon1" value="<?= $item["nama"]; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Kelas</span>
                      <input type="text" class="form-control" placeholder="kelas" aria-label="kelas" aria-describedby="basic-addon1" value="<?= $item["kelas"]; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Jurusan</span>
                      <input type="text" class="form-control" placeholder="jurusan" aria-label="jurusan" aria-describedby="basic-addon1" value="<?= $item["jurusan"]; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Alamat</span>
                  <input type="text" class="form-control" placeholder="no tlp" aria-label="no tlp" aria-describedby="basic-addon1" value="<?= $item["alamat"]; ?>" readonly>
                </div>
              <?php endforeach; ?>
            </form>
          </div>
        </div>

        <div class="alert alert-danger mt-4" role="alert">Silahkan periksa kembali data diatas, pastikan sudah benar sebelum meminjam buku! jika ada kesalahan data harap hubungi petugas.</div>

        <div class="card mt-4">
          <h5 class="card-header">Form Pinjam Buku</h5>
          <div class="card-body">
            <form action="" method="post">
              <!--Ambil data id buku-->
              <?php foreach ($query as $item) : ?>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">ID Buku</span>
                  <input type="text" name="id_buku" class="form-control" placeholder="id buku" aria-label="id_buku" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
                </div>
              <?php endforeach; ?>
              <!-- Ambil data NISN user yang login-->
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">NISN</span>
                <input type="number" name="nisn" class="form-control" placeholder="nisn" aria-label="nisn" aria-describedby="basic-addon1" value="<?php echo htmlentities($_SESSION["nisn"]); ?>" readonly>
              </div>
              <!--Ambil data id admin-->
              <select name="id_user" class="form-select" aria-label="Default select example" required>
                <option value="" selected>Pilih ID Petugas</option>
                <?php foreach ($admin as $item) : ?>
                  <option value="<?= $item["id"]; ?>"><?= $item["username"]; ?></option>
                <?php endforeach;
                $sekarang  = date("Y-m-d");
                ?>
              </select>
              <div class="input-group mb-3 mt-3">
                <span class="input-group-text" id="basic-addon1">Tanggal pinjam</span>
                <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="<?= $sekarang; ?>" placeholder="tgl_pinjam" aria-label="tgl_pinjam" aria-describedby="basic-addon1" required>
              </div>
              <div class="input-group mb-3 mt-3">
                <span class="input-group-text" id="basic-addon1">Tanggal akhir peminjaman</span>
                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" placeholder="tgl_kembali" aria-label="tgl_kembali" aria-describedby="basic-addon1" required>
              </div>

              <a class="btn btn-danger" href="dashboard.php"> Batal</a>
              <button type="submit" class="btn btn-success" name="pinjam">Pinjam</button>
            </form>
          </div>
        </div>

      </div>
      <!-- /.card -->
    </div>
  </div>
  </div>

  <!--JAVASCRIPT -->
  <script src="../style/js/script.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets2/vendor/jquery/jquery.min.js"></script>
  <script src="../assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets2/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets2/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../assets2/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../assets2/js/demo/datatables-demo.js"></script>

</body>

</html>