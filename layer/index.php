<?php
session_start();
if (empty($_SESSION['username']) OR empty($_SESSION['username'])) {
  header("Location: ../index.html");
} else {
  ?>
  <html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <title>SISJARI</title>
    <style>
        .text {
            border: 0px solid black; /* Memberikan batas 1px solid berwarna hitam pada teks */
            padding: 0px; /* Memberikan padding 5px pada teks */
            text-transform: capitalize;
            font-size: 12pt;
        }
        table {
            border-collapse: collapse;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
            padding: 200px;
        }
        .rounded-cell-atas {
          border-radius: 20px 20px 0 0; /* Mengatur radius sudut menjadi 10 piksel */
          font-family: Times News Roman, sans-serif; /* Mengatur jenis font */
          font-size: 24px; /* Mengatur ukuran font */
          color: blue;
          background-color: #FFFFFF;
          padding-top: 20px;    /* Padding atas */
          padding-right: 20px;  /* Padding kanan */
          padding-bottom: 10px;  /* Padding bawah */
          padding-left: 20px;   /* Padding kiri */
          /* border: 1px solid black; */
        }
        .rounded-cell-bawah {
          border-radius: 0 0 20px 20px; /* Mengatur radius sudut menjadi 10 piksel */
          font-family: Arial, sans-serif; /* Mengatur jenis font */
          font-size: 18px; /* Mengatur ukuran font */
          padding: 20px;
          background-color: #FFFFFF;
          padding-top: 0px;    /* Padding atas */
          padding-right: 20px;  /* Padding kanan */
          padding-bottom: 20px;  /* Padding bawah */
          padding-left: 20px;   /* Padding kiri */
          /* border: 1px solid black; */
        }
    </style>
  </head>
  <body>
    <div class="hero_area">
      <!-- header section strats -->
      <header class="header_section">
        <div class="container">
          <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <!--<img src="images/logo.png" alt="" />-->
            <span>
              <h1 style="color: yellow; font-size: 20pt;">SISJARI</h1>
              <p class="text">Sistem Informasi Spasial Jaringan Irigasi</p>
            </span>
          </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php"> Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="peta.php"> Peta </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profil.php"> Profil </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../logout.php"> Logout </a>
                  </li>
                  <!--
                  <li>
                    <a class="nav-link" href="login/logout.php">Logout</a>
                  </li>
                  -->
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->
      <!-- slider section -->
      <!-- end slider section -->
      <div>
      <?php
      // Membuat tabel HTML
      echo '<table>';
      echo '<tr>';
        echo '<td class="rounded-cell-atas">';
          echo '
          Selamat Datang 
          ';
          echo $_SESSION['username'];
          echo ' di Website SISJARI Kabupaten Bantul';
        echo '</td>';
      echo '</tr>';
      echo '<tr>';
        echo '<td class="rounded-cell-bawah">';
          echo '
          Sistem Informasi Spasial Jaringan Irigasi menampilkan kondisi dari jaringan irigasi beserta bangunan dan atribut lainnya secara up to date <br><br> Yang Dihasilkan aplikasi SISJARI berbasis web ini yaitu sebagal media yang dapat digunakan secara efektif dan efesien agar dapat memberikan dukungan dan memperbaiki sistem penyampaian informasi tentang jaringan irigasi pada Kabupaten Bantul <br><br> Selain itu data yang didapat tidak lagi statis tetapi menjadi lebih dinamis karena telah berhubung dengan database. sistem ini juga dapat diakses dengan mudah kapan dan dimana saja, karena terkoneksi dengan internet.
          ';
        echo '</td>';
      echo '</tr>';
      echo '</table>';
      ?>
      </div>
    </div>

    <!-- footer section -->
    <section class="container-fluid footer_section">
      <p>&copy; Kelompok 3 SIG</p>
    </section>
    <!-- footer section -->
  </body>
  </html>
<?php } ?>