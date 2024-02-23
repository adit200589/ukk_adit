<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <!-- basic -->
  <meta charset="utf-8">
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
  <link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" type="text/css" href="css2/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css2/responsive.css">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- font css -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,800;1,400&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css2/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="website icon" type="png" href="images/p.png">
</head>

<body>
  <div class="header_section">
    <div class="container-fluid">
      <n class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#page"><img src="images/logof.png"></a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->
    </div>
  </div>
  <!-- header section end -->
  <!-- layout_border start -->
  <div class="container-fluid">
    <div class="layout_border">
      <!-- banner section start -->
      <div class="banner_section layout_padding">
        <div class="container-fluid">
          <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="banner_taital_main">
                      <h1 class="banner_taital">Selamat Datang di Fapus</h1>
                      <div class="btn_main">
                        <div class="started_text"><a href="login.php">Login</a></div>
                        <div class="started_text active"><a href="register.php">Register</a></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="banner_img"><img src="images/a.jpeg"></div>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <section id="homeSection" class="p-1">
        <div class="d-flex flex-wrap justify-content-center">
          <div class="col mt-1">
            <?php
            require "config/config.php";
            // query read semua buku
            $buku = queryReadData("SELECT * FROM buku");
            ?>
          </div>
        </div>
      </section>
      <!-- banner section end -->
      <!-- about section start -->
      <div class="about_section layout_padding">
        <div class="container">
          <div class="row"></div>
          <div class="about_section_1"></div>
          <div class="row">
            <div class="col-md-2"></div>
          </div>
        </div>
      </div>
      <!-- about section end -->
      <!-- vagetables section start -->
      <style>
        .layout-card-custom {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
          gap: 1.5rem;
        }
      </style>

      <style>
        .card {
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          transition: box-shadow 0.3s ease;
        }

        .card:hover {
          box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
          height: 100%;
          /* Gambar akan mengisi tinggi kartu */
          object-fit: cover;
          transition: transform 0.3s ease;
        }

        .card-img-top:hover {
          transform: scale(1.1);
        }

        .card-title {
          font-size: 1.2rem;
          margin-top: 10px;
        }

        .list-group-item {
          font-size: 0.9rem;
          margin-top: 5px;
        }
      </style>

      <div class="alert alert-danger text-center" role="alert">
        <strong class="font-weight-bold">Jika Anda Ingin Mencari Buku, Maka Diharuskan Login Terlebih Dahulu</strong>
      </div>

      <br>
      <div class="layout-card-custom">
        <?php foreach ($buku as $item) : ?>
          <div class="card" style="width: 10rem;">
            <a data-bs-toggle="modal" data-bs-target="#myModal<?= $item["id_buku"]; ?>"><img src="imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" style="width: 250px; aspect-ratio: 8/12;"></a>
            <div class="card-body">
              <h6 class="card-title"><?= $item["judul"]; ?></h6>
            </div>
            <ul class="list-group list-group-flush">
              <center>
                <li class="list -group-item">Kategori : <?= $item["kategori"]; ?></li>
              </center>
            </ul>
          </div>

          <!-- The Modal -->
          <div class="modal" id="myModal<?= $item["id_buku"]; ?>">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h5 class="modal-title">Detail Buku</h5>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-4">
                        <img src="imgDB/<?= $item["cover"]; ?>" class="img-thumbnail mb-6" alt="Mobil Image">
                      </div>
                      <div class="col-md-7">
                        <div>
                          <strong class="">Judul: </strong><?php echo $item['judul']; ?>
                        </div>
                        <div>
                          <strong class="">Kategori: </strong><?php echo $item['kategori']; ?>
                        </div>
                        <div>
                          <strong class="">Pengarang: </strong><?php echo $item['pengarang']; ?>
                        </div>
                        <div>
                          <strong class="">Penerbit: </strong><?php echo $item['penerbit']; ?>
                        </div>
                        <div>
                          <strong class="">Tahun Terbit: </strong><?php echo $item['thn_terbit']; ?>
                        </div>
                        <div>
                          <strong class="">Jumlah Halaman: </strong><?php echo $item['jml_halaman']; ?>
                        </div>
                        <div>
                          <strong class="">Deskripsi: </strong><?php echo $item['deskripsi']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <a href="login.php" class="btn btn-success">Pinjam</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- vagetables section end -->
      <!-- contact section start -->
      <!-- contact section end -->
      <!-- testimonial section start -->
      <!-- testimonial section end -->
      <!-- layout_border end -->
    </div>
  </div>
  <!-- footer section start -->
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
  <!-- footer section end -->
  <!-- copyright section start -->
  <div class="copyright_section">
    <div class="container">
      <p class="copyright_text">2023 All Rights Reserved. Design by <a href="#">perpus.com</a></p>
    </div>
  </div>
  <!-- copyright section end -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- Javascript files-->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="js/plugin.js"></script>
</body>

</html>