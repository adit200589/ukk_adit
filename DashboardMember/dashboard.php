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
$nis = $_SESSION['nisn'];

// Now you can use $nis wherever you need it
require "../config/config.php";
// query read semua buku
$buku = queryReadData("SELECT * FROM buku");
//search buku
if (isset($_POST["search"])) {
  $buku = search($_POST["keyword"]);
}
//read buku informatika
if (isset($_POST["informatika"])) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'informatika'");
}
//read buku bisnis
if (isset($_POST["bisnis"])) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'bisnis'");
}
//read buku filsafat
if (isset($_POST["filsafat"])) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'filsafat'");
}
//read buku novel
if (isset($_POST["novel"])) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'novel'");
}
//read buku sains
if (isset($_POST["sains"])) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'sains'");
}


?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fapus</title>
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
</head>

<style media="screen">
  header {
    /* Replace with your image URL */
    background-size: cover;
    background-position: center;
    height: 50vh;
    /* Full viewport height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
  }

  body {
    display: block;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
  }

  h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }

  .layout-card-custom {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
  }

  /* vertical-center */
  .vertical-center {
    min-height: 100%;
    /* Fallback for browsers do NOT support vh unit */
    min-height: 100vh;
    /* These two lines are counted as one :-)       */

    display: flex;
    align-items: center;
  }

  /* thumbnail */
  #wrapThumbnail {
    position: relative;
  }

  #thumbnailCard {
    background-color: rgba(0, 0, 0, 0.7);
    position: absolute;
    top: 0px;
    height: 100%;
    width: 100%;
    text-align: center;
    padding-top: 70%;
    color: white;
    font-size: 20px;
  }

  #thumbnailCard span {
    display: block;
  }

  #thumbnailCard a {
    text-decoration: none;
    color: white;
    display: block;
    width: 100px;
    margin: 0 auto;
    border: 1px solid white;
    padding: 5px;
  }

  #thumbnailCard a:hover {
    background-color: white;
    color: black;
  }

  #wrapThumbnail #thumbnailCard {
    display: none;
  }

  #wrapThumbnail img {
    width: 100%;
    height: auto;
  }

  #wrapThumbnail:hover #thumbnailCard {
    display: block;
  }
</style>

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
              <a class="nav-link" href="history.php">History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="signOut.php">Logout</a>
            </li>
          </ul>
        </div>
        </nav>
    </div>
  </div>
  <!-- End of Topbar -->
  <section id="homeSection">
    <div class="d-flex flex-wrap justify-content-center">
      <div class="col mt-2">

        <style>
          @keyframes fadeIn {
            from {
              opacity: 0;
            }

            to {
              opacity: 1;
            }
          }

          @keyframes fadeOut {
            from {
              opacity: 1;
            }

            to {
              opacity: 0;
            }
          }

          .alert-success {
            animation: fadeIn 0.5s ease-in-out forwards;
          }

          .alert-fade-out {
            animation: fadeOut 0.5s ease-in-out forwards;
          }
        </style>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            // Panggil fungsi untuk menampilkan alert
            showWelcomeAlert();

            // Fungsi untuk menampilkan alert dan kemudian menghilangkannya setelah beberapa detik
            function showWelcomeAlert() {
              var welcomeAlert = document.querySelector('.alert-success');
              welcomeAlert.style.display = 'block'; // Menampilkan alert

              // Menghilangkan alert setelah 5 detik dengan animasi
              setTimeout(function() {
                welcomeAlert.classList.add('alert-fade-out'); // Menambahkan kelas untuk animasi fade-out

                // Setelah animasi fade-out selesai, sembunyikan alert
                setTimeout(function() {
                  welcomeAlert.style.display = 'none';
                }, 500); // Tunggu 0.5 detik untuk animasi fade-out selesai
              }, 5000); // Tunggu 5 detik sebelum memulai animasi fade-out
            }
          });
        </script>

        <div class="mt-3 alert alert-success" role="alert" style="display: none;">
          Selamat Datang - <strong class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["nama"]); ?></strong>
        </div>

        <style>
          .layout-card-custom {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
          }
        </style>

        <style>
          /* Basic styling for the search form */
          form {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            /* Align elements to the right */
          }

          /* Style for the search icon */
          i.fa-search {
            margin-right: 10px;
            /* Adjust the spacing between the icon and the input */
          }

          /* Style for the search input */
          input.search-input {
            width: 200px;
            /* Atur lebar input sesuai kebutuhan */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 200px;
          }

          /* Optional: Hover effect for the button */
          button[name="search"]:hover {
            background-color: #0056b3;
            /* Change to the desired hover background color */
          }
        </style>

        <!--Card buku-->
        <form method="POST" action="">
          <i class="fa fa-search"></i>
          <input id="keyword" name="keyword" type="search" class="search-input" value="" placeholder="Search...">
          <button name="search" type="submit"></button>
        </form>

        <div class="layout-card-custom">
          <?php foreach ($buku as $item) : ?>
            <div class="card" style="width: 10rem;">
              <div class="card border-0 mb-8" style="background-color:rgb(255,255,255);box-shadow: 0px 0px 11px 3px rgba(0,0,0,0.07);overflow:hidden;">
                <div id="wrapThumbnail">
                  <img src="../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" style="width: 250px; aspect-ratio: 8/12;">
                  <div id="thumbnailCard">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cek<?= $item["id_buku"]; ?>">Cek Buku</button>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-text" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                    <strong>Judul :</strong> <?php echo (str_word_count($item["judul"]) > 3 ? substr($item["judul"], 0, 25) . "..." : $item["judul"]) ?>
                  </h5>

                  <center>
                    <li class="list-group-item">Kategori :
                      <?= $item["kategori"]; ?>
                    </li>
                  </center>
                </div>
              </div>
            </div>

            <!-- modal-product -->
            <div id="cek<?= $item["id_buku"]; ?>" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Menggunakan modal-lg untuk modal yang lebih besar -->
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-5"> <!-- Menggunakan col-md-5 agar modal tidak terlalu lebar pada layar besar -->
                        <!-- gambar -->
                        <img src="../imgDB/<?= $item["cover"]; ?>" class="img-thumbnail" alt="coverBuku" height="300px">
                      </div>
                      <div class="col-md-7 pl-3">
                        <!-- deskripsi -->
                        <div class="dropdown-divider"></div>
                        <h3 class="pt-1 pb-1">
                          <?= $item["judul"]; ?>
                        </h3>
                        <div class="dropdown-divider"></div>
                        <h5 class="pt-1 pb-1" style="margin: 0;">Kategori :
                          <?= $item["kategori"]; ?>
                        </h5>
                        <div class="dropdown-divider"></div>
                        <p class="pt-1 pb-1" style="margin: 0;">Deskripsi :
                          <?= $item["deskripsi"]; ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="dashboard.php" class="btn btn-danger">Batal</a>
                    <a href="pinjam.php?id=<?= $item['id_buku']; ?>" class="btn btn-success">Pinjam</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
  <br>

  <!-- Footer -->
  <div class="footer_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-6">
          <h3 class="footer_text">Alamat</h3>
          <div class="footer_menu">
            <ul>
              <p class="dummy_text">Jl. Swadaya Rt.02/03 No. 13 Tapos, Kota Depok</p>
              <li class="active"><a href="https://www.google.com/maps/@-6.3974567,106.8825406,3a,75y,144.48h,87.22t/data=!3m6!1e1!3m4!1sj-Nhwbu8vSSKtn0reJKLOQ!2e0!7i16384!8i8192?entry=ttu" target="_blank"><span class="angle_icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.5.5 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103M10 1.91l-4-.8v12.98l4 .8zm1 12.98 4-.8V1.11l-4 .8zm-6-.8V1.11l-4 .8v12.98z" />
                    </svg><i class="bi bi-map" aria-hidden="true"></i></span> Maps</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <h3 class="footer_text">Media Sosial</h3>
          <div class="social_icon">
            <ul>
              <li><a href="https://github.com/tihhptih/" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a></li>
              <li><a href="https://api.whatsapp.com/send/?phone=%2B6285692569477&text&type=phone_number&app_absent=0" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                  </svg><i class="bi bi-whatsapp"></i></i></a></li>
              <li><a href="https://www.instagram.com/mfh_fatt/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-sm-2">
          <div class="footer_main">
            <h3 class="footer_text">Telepon</h3>
            <p class="dummy_text">+6285692569477</p>
            <div class="location_text">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


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

  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/jquery-3.0.0.min.js"></script>
  <script src="../js/plugin.js"></script>
</body>

</html>