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

// Access the NIS from the session
$nisn = $_SESSION['nisn'];

// Now you can use $nis wherever you need it

require "../config/config.php";

// Assuming $id is the specific value you want to match

$peminjaman = queryReadData("SELECT * FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
INNER JOIN user ON peminjaman.id_user = user.id
WHERE peminjaman.nisn = '$nisn' and status = '3 '");

// Replace $id with the actual condition you want to use in the WHERE clause
?>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Fapus</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../css2/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="../css2/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css2/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <!-- font css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,800;1,400&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css2/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="website icon" type="png" href="../images/p.png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

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
                                        <a class="nav-link" href="dashboard.php">Daftar Buku</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="daftar_pinjam.php">Peminjaman</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#.php">History</a>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="mt-3 alert alert-success" role="alert">Riwayat History Buku Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["nama"]); ?></span></div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Daftar Buku</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Cover</th>
                                            <th>ID Buku</th>
                                            <th>Judul Buku</th>
                                            <th>NISN</th>
                                            <th>Nama Pengguna</th>
                                            <th>Nama Petugas</th>
                                            <th>Tgl. Pinjam</th>
                                            <th>Tgl. Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1; // Nomor urut dimulai dari 1
                                        if (isset($peminjaman) && is_array($peminjaman) && count($peminjaman) > 0) {
                                            foreach ($peminjaman as $item) :
                                        ?>
                                                <tr>
                                                    <td align="center"><?php echo $no++ ?></td>
                                                    <td>
                                                        <img src="../imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px" style="border-radius: 5px;">
                                                    </td>

                                                    <td><?= $item["id_buku"]; ?></td>
                                                    <td><?= $item["judul"]; ?></td>
                                                    <td><?= $item["nisn"]; ?></td>
                                                    <td><?= $item["nama"]; ?></td>
                                                    <td><?= $item["username"]; ?></td>
                                                    <td><?= $item["tgl_pinjam"]; ?></td>
                                                    <td><?= $item["tgl_kembali"]; ?></td>
                                                </tr>
                                        <?php endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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