<?php
session_start();
include "loginSystem/connect.php";
if (isset($_POST['nisn']) && isset($_POST['nama'])) {
    // Get user input
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Query to check user credentials
    $query = "SELECT * FROM member WHERE nisn='$nisn' AND nama='$nama' AND password='$password'";
    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        // Login successful
        $_SESSION['nama'] = $nama;
        $_SESSION['nisn'] = $nisn;
        $_SESSION['password'] = $password;
        header("Location: DashboardMember/dashboard.php"); // Redirect to dashboard or any other page
    } else {
        // Login failed
        echo "<script>alert('NISN atau Nama Anda Salah. Silahkan coba lagi!')</script>";
    }
}
$connect->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <link rel="stylesheet" href="js_css/style.css">
    <link rel="website icon" type="png" href="images/p.png">
</head>

<body>
    <!-- partial:index.partial.html -->

    <body>
        <section class="container">
            <div class="login-container">
                <div class="circle circle-one"></div>
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                    <h1 class="opacity">LOGIN</h1>
                    <form action="" method="POST">
                        <input type="text" name="nama" placeholder="MASUKAN USERNAME" />
                        <input type="text" name="nisn" placeholder="MASUKAN NISN" />
                        <input type="password" name="password" placeholder="MASUKAN PASSWORD" />
                        <button type="submit" name="signIn" class="opacity">MASUK</button>
                        <button onclick="window.location.href='index.php'" type="button">KEMBALI</button>
                    </form>
                    <div class="opacity" style="text-align: center;">
                        <p class="copyright_text">BELUM PUNYA AKUN ? <a href="register.php">REGISTER</a></p>
                        <p class="copyright_text">ANDA ADMIN ? <a href="admin.php">MASUK</a></p>
                    </div>
                </div>
                <div class="circle circle-two"></div>
            </div>
            <div class="theme-btn-container"></div>
        </section>
    </body>

    <!-- partial -->

</body>

</html>