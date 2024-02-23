<?php
session_start();
include "loginSystem/connect.php";

if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: DashboardPetugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: DashboardAdmin/index.php");
    exit;
  }
}


if (isset($_POST['btn-login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


  // Query to check user credentials
  $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = $connect->query($query);

  if (mysqli_num_rows($result) === 1) {
    $_SESSION['username'] = true;
    $rows = mysqli_fetch_assoc($result);
    if ($rows['sebagai'] == 'petugas') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['nama'] = $rows['nama'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: DashboardPetugas/index.php");

      if (isset($_SESSION['username'])) {
        header("Location: DashboardPetugas/index.php");
        exit;
      }
    } elseif ($rows['sebagai'] == 'admin') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['nama'] = $rows['nama'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: DashboardAdmin/index.php");

      if (isset($_SESSION['username'])) {
        header("Location: DashboardAdmin/index.php");
        exit;
      }
    }
  } else {
    // Login failed
    echo "Invalid username or password";
  }
}
$connect->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fapus</title>
  <link rel="stylesheet" href="js_css/style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="icon" type="png" href="images/p.png">
</head>

<body>
  <div class="content">
    <div class="text">
      Login Admin
    </div>
    <form action="" method="POST">
      <div class="field">
        <input type="text" name="username" placeholder="Masukan Nama" />
        <span class="fas fa-user"></span>
        <label>Name</label>
      </div>
      <div class="field">
        <input type="password" name="password" placeholder="Masukan Password" />
        <span class="fas fa-lock"></span>
        <label>Password</label>
      </div>
      <button class="btn btn-primary" type="submit" name="btn-login">Masuk</button>
      <button onclick="window.location.href='index.php'" class="btn btn-primary" type="button">Kembali Ke Hlmn Utama</button>
    </form>
  </div>

  <?php if (isset($error)) : ?>
    <div class="alert alert-danger mt-2" role="alert">Nama atau Password Salah!</div>
  <?php endif; ?>
  </div>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
</body>

</html>
<!-- partial -->

</body>

</html>