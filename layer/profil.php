<?php
session_start();
if (empty($_SESSION['username']) OR empty($_SESSION['username'])) {
  header("Location: ../index.html");
} else {
  ?>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SISJARI</title>

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
      background-color: #7f7f31;    
      padding-top: 20px;    /* Padding atas */    
      padding-right: 20px;  /* Padding kanan */    
      padding-bottom: 10px;  /* Padding bawah */    
      padding-left: 20px;   /* Padding kiri */    
      /* border: 1px solid black; */    
    }
    .rounded-cell-bawah {
      border-radius: 0 0 20px 20px; /* Mengatur radius sudut menjadi 10 piksel */
      font-family: Arial, sans-serif; /* Mengatur jenis font */
      font-size: 14px; /* Mengatur ukuran font */    
      padding: 20px;
      color: white;    
      background-color: #7f7f31;    
      padding-top: 0px;    /* Padding atas */    
      padding-right: 20px;  /* Padding kanan */    
      padding-bottom: 20px;  /* Padding bawah */    
      padding-left: 20px;   /* Padding kiri */    
      /* border: 1px solid black; */    
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
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
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">
                    Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="peta.php"> Peta </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="profil.php"> Profil </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../logout.php"> Logout </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <div class="isi">
    <?php
      // Membuat tabel HTML
    echo '<table>';
      echo '<tr>';
        echo '<td class="rounded-cell-atas">';
          echo '
          Profil Kabupaten Bantul
          ';
        echo '</td>';
      echo '</tr>';
      echo '<tr>';
        echo '<td class="rounded-cell-bawah">';
          echo '
          Kabupaten Bantul terletak di sebelah Selatan Propinsi Daerah Istimewa Yogyakarta, berbatasan dengan : <br><br>
          Sebelah Utara: Kota Yogyakarta dan Kabupaten Sleman <br><br>
          Sebelah Selatan: Samudera Indonesia <br><br>
          Sebelah Timur Kabupaten Gunung Kidul Sebelah Barat: Kabupaten Kulon Progo Kabupaten Bantul terletak antara 07 44 04-08 00 27" Lintang Selatan dan 110 12 34-110 31 08" <br><br>
          Bujur Timur. <br><br>
          Seperti pada tahun sebelumnya di tahun 2008 sektor pertanian masih memberikan kontribus terbesar terhadap PDRB Bantul, yaitu mencapai 24,33%. Akan tetapi kontribusi tersebut menurun 0.15% dibandingkan tahun 2007. Hal tersebut dikarenakan adanya alih fungsi lahan dari sektor pertanian menjadi sektor perindustrian. Selain itu untuk pemanfaatan lahan sawah di tahun 2008 juga mengalami penurunan, luas sawah beririgasi maupun tadah hujan sebesara 16.148.790 Ha atau mengalami penurunan dari 16.252.571 Ha. Penurunan ini disebabkan karena adanya ah fungsi pemanfaatan lahan dari pertanian menjadi non-pertanian, seperti untuk permukiman dan tempat usaha. Penurunan luas areal sawah tadah hujan disebabkan adanya pembangunan sarana irigasi halk berupa bangunan saluran irigasi maupun pompanisasi areal tersebut.
          ';
        echo '</td>';
      echo '</tr>';
    echo '</table>';
    ?>
  </div>

  <!-- footer section -->
    <section class="container-fluid footer_section">
      <p>&copy; Kelompok 3 SIG</p>
    </section>
    <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <script>
    // This example adds a marker to indicate the position of Bondi Beach in Sydney,
    // Australia.
    function initMap() {
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 11,
        center: {
          lat: 40.645037,
          lng: -73.880224
        }
      });

      var image = "images/maps-and-flags.png";
      var beachMarker = new google.maps.Marker({
        position: {
          lat: 40.645037,
          lng: -73.880224
        },
        map: map,
        icon: image
      });
    }
  </script>
  <!-- google map js -->

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap">
  </script>
  <!-- end google map js -->

  <script>
    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
  </script>
</body>
</html>
<?php } ?>