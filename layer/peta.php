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
    <link rel="stylesheet" href="css/leaflet.css" />
    <link rel="stylesheet" href="css/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="css/qgis2web.css" />
    <link rel="stylesheet" href="css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="css/leaflet-search.css" />
    <link rel="stylesheet" href="css/leaflet-control-geocoder.Geocoder.css" />
    <link rel="stylesheet" href="css/leaflet-measure.css" />
    <style>
      #map {
        width: 100%;
        height: 75.3%;
      }
      .text {
            border: 0px solid black; /* Memberikan batas 1px solid berwarna hitam pada teks */
            padding: 0px; /* Memberikan padding 5px pada teks */
            text-transform: capitalize;
            font-size: 12pt;
      }
    </style>
  </head>

  <body class="sub_page">
    <div class="hero_area">
      <!-- header section strats -->
      <header class="header_section">
        <div class="container">
          <nav class="navbar navbar-expand-lg custom_nav-container">
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
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php"> Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="peta.php"> Peta </a>
                  </li>
                  <li class="nav-item">
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
    <div id="map"></div>

    <!-- footer section -->
    <section class="container-fluid footer_section">
      <p>&copy; Kelompok 3 SIG</p>
    </section>
    <!-- footer section -->

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script src="js/qgis2web_expressions.js"></script>
    <script src="js/leaflet.js"></script>
    <script src="js/L.Control.Locate.min.js"></script>
    <script src="js/leaflet.rotatedMarker.js"></script>
    <script src="js/leaflet.pattern.js"></script>
    <script src="js/leaflet-hash.js"></script>
    <script src="js/Autolinker.min.js"></script>
    <script src="js/rbush.min.js"></script>
    <script src="js/labelgun.min.js"></script>
    <script src="js/labels.js"></script>
    <script src="js/leaflet-control-geocoder.Geocoder.js"></script>
    <script src="js/leaflet-measure.js"></script>
    <script src="js/leaflet-search.js"></script>
    <script src="data/Saluran_bantul_all_1.js"></script>
    <script src="data/ADMINISTRASI_LN_25K_2.js"></script>
    <script src="data/Bangunan_bantul_all_3.js"></script>
    <script src="data/Sawah_4.js"></script>
    <script>
      var highlightLayer;
      function highlightFeature(e) {
        highlightLayer = e.target;

        if (e.target.feature.geometry.type === "LineString") {
          highlightLayer.setStyle({
            color: "#ffff00",
          });
        } else {
          highlightLayer.setStyle({
            fillColor: "#ffff00",
            fillOpacity: 1,
          });
        }
        highlightLayer.openPopup();
      }
      var map = L.map("map", {
        zoomControl: true,
        maxZoom: 28,
        minZoom: 1,
      }).fitBounds([
        [-7.987942550106123, 110.2284909588771],
        [-7.790575743678359, 110.5959172535837],
      ]);
      var hash = new L.Hash(map);
      map.attributionControl.setPrefix(
        '<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>'
      );
      var autolinker = new Autolinker({ truncate: { length: 30, location: "smart" } });
      L.control.locate({ locateOptions: { maxZoom: 19 } }).addTo(map);
      var measureControl = new L.Control.Measure({
        position: "topleft",
        primaryLengthUnit: "meters",
        secondaryLengthUnit: "kilometers",
        primaryAreaUnit: "sqmeters",
        secondaryAreaUnit: "hectares",
      });
      measureControl.addTo(map);
      document.getElementsByClassName("leaflet-control-measure-toggle")[0].innerHTML = "";
      document.getElementsByClassName("leaflet-control-measure-toggle")[0].className += " fas fa-ruler";
      var bounds_group = new L.featureGroup([]);
      function setBounds() {}
      map.createPane("pane_GoogleMaps_0");
      map.getPane("pane_GoogleMaps_0").style.zIndex = 400;
      var layer_GoogleMaps_0 = L.tileLayer("https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
        pane: "pane_GoogleMaps_0",
        opacity: 1.0,
        attribution: "",
        minZoom: 1,
        maxZoom: 28,
        minNativeZoom: 0,
        maxNativeZoom: 19,
      });
      layer_GoogleMaps_0;
      map.addLayer(layer_GoogleMaps_0);
      function pop_Saluran_bantul_all_1(feature, layer) {
        layer.on({
          mouseout: function (e) {
            for (i in e.target._eventParents) {
              e.target._eventParents[i].resetStyle(e.target);
            }
            if (typeof layer.closePopup == "function") {
              layer.closePopup();
            } else {
              layer.eachLayer(function (feature) {
                feature.closePopup();
              });
            }
          },
          mouseover: highlightFeature,
        });
        var popupContent =
          '<table>\
                    <tr>\
                        <th scope="row">fid</th>\
                        <td>' +
          (feature.properties["fid"] !== null ? autolinker.link(feature.properties["fid"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Id</th>\
                        <td>' +
          (feature.properties["Id"] !== null ? autolinker.link(feature.properties["Id"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Klas_sal</th>\
                        <td>' +
          (feature.properties["Klas_sal"] !== null ? autolinker.link(feature.properties["Klas_sal"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">UPT</th>\
                        <td>' +
          (feature.properties["UPT"] !== null ? autolinker.link(feature.properties["UPT"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nama_DI</th>\
                        <td>' +
          (feature.properties["Nama_DI"] !== null ? autolinker.link(feature.properties["Nama_DI"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Kondisi</th>\
                        <td>' +
          (feature.properties["Kondisi"] !== null ? autolinker.link(feature.properties["Kondisi"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Awal_X</th>\
                        <td>' +
          (feature.properties["Awal_X"] !== null ? autolinker.link(feature.properties["Awal_X"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Awal_Y</th>\
                        <td>' +
          (feature.properties["Awal_Y"] !== null ? autolinker.link(feature.properties["Awal_Y"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Akhir_X</th>\
                        <td>' +
          (feature.properties["Akhir_X"] !== null ? autolinker.link(feature.properties["Akhir_X"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Akhir_Y</th>\
                        <td>' +
          (feature.properties["Akhir_Y"] !== null ? autolinker.link(feature.properties["Akhir_Y"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Pasangan</th>\
                        <td>' +
          (feature.properties["Pasangan"] !== null ? autolinker.link(feature.properties["Pasangan"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Panjang</th>\
                        <td>' +
          (feature.properties["Panjang"] !== null ? autolinker.link(feature.properties["Panjang"].toLocaleString()) : "") +
          "</td>\
                    </tr>\
                </table>";
        layer.bindPopup(popupContent, { maxHeight: 400 });
      }

      function style_Saluran_bantul_all_1_0() {
        return {
          pane: "pane_Saluran_bantul_all_1",
          opacity: 1,
          color: "rgba(152,125,183,1.0)",
          dashArray: "",
          lineCap: "square",
          lineJoin: "bevel",
          weight: 1.0,
          fillOpacity: 0,
          interactive: true,
        };
      }
      map.createPane("pane_Saluran_bantul_all_1");
      map.getPane("pane_Saluran_bantul_all_1").style.zIndex = 401;
      map.getPane("pane_Saluran_bantul_all_1").style["mix-blend-mode"] = "normal";
      var layer_Saluran_bantul_all_1 = new L.geoJson(json_Saluran_bantul_all_1, {
        attribution: "",
        interactive: true,
        dataVar: "json_Saluran_bantul_all_1",
        layerName: "layer_Saluran_bantul_all_1",
        pane: "pane_Saluran_bantul_all_1",
        onEachFeature: pop_Saluran_bantul_all_1,
        style: style_Saluran_bantul_all_1_0,
      });
      bounds_group.addLayer(layer_Saluran_bantul_all_1);
      map.addLayer(layer_Saluran_bantul_all_1);
      function pop_ADMINISTRASI_LN_25K_2(feature, layer) {
        layer.on({
          mouseout: function (e) {
            for (i in e.target._eventParents) {
              e.target._eventParents[i].resetStyle(e.target);
            }
            if (typeof layer.closePopup == "function") {
              layer.closePopup();
            } else {
              layer.eachLayer(function (feature) {
                feature.closePopup();
              });
            }
          },
          mouseover: highlightFeature,
        });
        var popupContent =
          '<table>\
                    <tr>\
                        <th scope="row">KARKTR</th>\
                        <td>' +
          (feature.properties["KARKTR"] !== null ? autolinker.link(feature.properties["KARKTR"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">STSBTS</th>\
                        <td>' +
          (feature.properties["STSBTS"] !== null ? autolinker.link(feature.properties["STSBTS"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">FCODE</th>\
                        <td>' +
          (feature.properties["FCODE"] !== null ? autolinker.link(feature.properties["FCODE"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">KELAS</th>\
                        <td>' +
          (feature.properties["KELAS"] !== null ? autolinker.link(feature.properties["KELAS"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">UUPP</th>\
                        <td>' +
          (feature.properties["UUPP"] !== null ? autolinker.link(feature.properties["UUPP"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">LOKASI</th>\
                        <td>' +
          (feature.properties["LOKASI"] !== null ? autolinker.link(feature.properties["LOKASI"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">REMARK</th>\
                        <td>' +
          (feature.properties["REMARK"] !== null ? autolinker.link(feature.properties["REMARK"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">NAMOBJ</th>\
                        <td>' +
          (feature.properties["NAMOBJ"] !== null ? autolinker.link(feature.properties["NAMOBJ"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">ADMIN1</th>\
                        <td>' +
          (feature.properties["ADMIN1"] !== null ? autolinker.link(feature.properties["ADMIN1"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">ADMIN2</th>\
                        <td>' +
          (feature.properties["ADMIN2"] !== null ? autolinker.link(feature.properties["ADMIN2"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">SRS_ID</th>\
                        <td>' +
          (feature.properties["SRS_ID"] !== null ? autolinker.link(feature.properties["SRS_ID"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">LCODE</th>\
                        <td>' +
          (feature.properties["LCODE"] !== null ? autolinker.link(feature.properties["LCODE"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">METADATA</th>\
                        <td>' +
          (feature.properties["METADATA"] !== null ? autolinker.link(feature.properties["METADATA"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WAKLD1</th>\
                        <td>' +
          (feature.properties["WAKLD1"] !== null ? autolinker.link(feature.properties["WAKLD1"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WAKLD2</th>\
                        <td>' +
          (feature.properties["WAKLD2"] !== null ? autolinker.link(feature.properties["WAKLD2"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WADKC1</th>\
                        <td>' +
          (feature.properties["WADKC1"] !== null ? autolinker.link(feature.properties["WADKC1"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WADKC2</th>\
                        <td>' +
          (feature.properties["WADKC2"] !== null ? autolinker.link(feature.properties["WADKC2"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WAKBK1</th>\
                        <td>' +
          (feature.properties["WAKBK1"] !== null ? autolinker.link(feature.properties["WAKBK1"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WAKBK2</th>\
                        <td>' +
          (feature.properties["WAKBK2"] !== null ? autolinker.link(feature.properties["WAKBK2"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WAPRO1</th>\
                        <td>' +
          (feature.properties["WAPRO1"] !== null ? autolinker.link(feature.properties["WAPRO1"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">WAPRO2</th>\
                        <td>' +
          (feature.properties["WAPRO2"] !== null ? autolinker.link(feature.properties["WAPRO2"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TIPTBT</th>\
                        <td>' +
          (feature.properties["TIPTBT"] !== null ? autolinker.link(feature.properties["TIPTBT"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">PJGBTS</th>\
                        <td>' +
          (feature.properties["PJGBTS"] !== null ? autolinker.link(feature.properties["PJGBTS"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">KLBADM</th>\
                        <td>' +
          (feature.properties["KLBADM"] !== null ? autolinker.link(feature.properties["KLBADM"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TIPLOK</th>\
                        <td>' +
          (feature.properties["TIPLOK"] !== null ? autolinker.link(feature.properties["TIPLOK"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">SHAPE_Leng</th>\
                        <td>' +
          (feature.properties["SHAPE_Leng"] !== null ? autolinker.link(feature.properties["SHAPE_Leng"].toLocaleString()) : "") +
          "</td>\
                    </tr>\
                </table>";
        layer.bindPopup(popupContent, { maxHeight: 400 });
      }

      function style_ADMINISTRASI_LN_25K_2_0() {
        return {
          pane: "pane_ADMINISTRASI_LN_25K_2",
          opacity: 1,
          color: "rgba(229,182,54,1.0)",
          dashArray: "",
          lineCap: "square",
          lineJoin: "bevel",
          weight: 1.0,
          fillOpacity: 0,
          interactive: true,
        };
      }
      map.createPane("pane_ADMINISTRASI_LN_25K_2");
      map.getPane("pane_ADMINISTRASI_LN_25K_2").style.zIndex = 402;
      map.getPane("pane_ADMINISTRASI_LN_25K_2").style["mix-blend-mode"] = "normal";
      var layer_ADMINISTRASI_LN_25K_2 = new L.geoJson(json_ADMINISTRASI_LN_25K_2, {
        attribution: "",
        interactive: true,
        dataVar: "json_ADMINISTRASI_LN_25K_2",
        layerName: "layer_ADMINISTRASI_LN_25K_2",
        pane: "pane_ADMINISTRASI_LN_25K_2",
        onEachFeature: pop_ADMINISTRASI_LN_25K_2,
        style: style_ADMINISTRASI_LN_25K_2_0,
      });
      bounds_group.addLayer(layer_ADMINISTRASI_LN_25K_2);
      map.addLayer(layer_ADMINISTRASI_LN_25K_2);
      function pop_Bangunan_bantul_all_3(feature, layer) {
        layer.on({
          mouseout: function (e) {
            for (i in e.target._eventParents) {
              e.target._eventParents[i].resetStyle(e.target);
            }
            if (typeof layer.closePopup == "function") {
              layer.closePopup();
            } else {
              layer.eachLayer(function (feature) {
                feature.closePopup();
              });
            }
          },
          mouseover: highlightFeature,
        });
        var popupContent =
          '<table>\
                    <tr>\
                        <th scope="row">fid</th>\
                        <td>' +
          (feature.properties["fid"] !== null ? autolinker.link(feature.properties["fid"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nama_bang</th>\
                        <td>' +
          (feature.properties["Nama_bang"] !== null ? autolinker.link(feature.properties["Nama_bang"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">UPT</th>\
                        <td>' +
          (feature.properties["UPT"] !== null ? autolinker.link(feature.properties["UPT"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nama_DI</th>\
                        <td>' +
          (feature.properties["Nama_DI"] !== null ? autolinker.link(feature.properties["Nama_DI"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Posisi_Sal</th>\
                        <td>' +
          (feature.properties["Posisi_Sal"] !== null ? autolinker.link(feature.properties["Posisi_Sal"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Kondisi</th>\
                        <td>' +
          (feature.properties["Kondisi"] !== null ? autolinker.link(feature.properties["Kondisi"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Koord_X</th>\
                        <td>' +
          (feature.properties["Koord_X"] !== null ? autolinker.link(feature.properties["Koord_X"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Koord_Y</th>\
                        <td>' +
          (feature.properties["Koord_Y"] !== null ? autolinker.link(feature.properties["Koord_Y"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">No</th>\
                        <td>' +
          (feature.properties["No"] !== null ? autolinker.link(feature.properties["No"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Foto</th>\
                        <td>' +
          (feature.properties["Foto"] !== null ? autolinker.link(feature.properties["Foto"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Indeks</th>\
                        <td>' +
          (feature.properties["Indeks"] !== null ? autolinker.link(feature.properties["Indeks"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">UPT_1</th>\
                        <td>' +
          (feature.properties["UPT_1"] !== null ? autolinker.link(feature.properties["UPT_1"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TYPE</th>\
                        <td>' +
          (feature.properties["TYPE"] !== null ? autolinker.link(feature.properties["TYPE"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">layer</th>\
                        <td>' +
          (feature.properties["layer"] !== null ? autolinker.link(feature.properties["layer"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">path</th>\
                        <td>' +
          (feature.properties["path"] !== null ? autolinker.link(feature.properties["path"].toLocaleString()) : "") +
          "</td>\
                    </tr>\
                </table>";
        layer.bindPopup(popupContent, { maxHeight: 400 });
      }

      function style_Bangunan_bantul_all_3_0() {
        return {
          pane: "pane_Bangunan_bantul_all_3",
          radius: 4.0,
          opacity: 1,
          color: "rgba(35,35,35,1.0)",
          dashArray: "",
          lineCap: "butt",
          lineJoin: "miter",
          weight: 1,
          fill: true,
          fillOpacity: 1,
          fillColor: "rgba(125,139,143,1.0)",
          interactive: true,
        };
      }
      map.createPane("pane_Bangunan_bantul_all_3");
      map.getPane("pane_Bangunan_bantul_all_3").style.zIndex = 403;
      map.getPane("pane_Bangunan_bantul_all_3").style["mix-blend-mode"] = "normal";
      var layer_Bangunan_bantul_all_3 = new L.geoJson(json_Bangunan_bantul_all_3, {
        attribution: "",
        interactive: true,
        dataVar: "json_Bangunan_bantul_all_3",
        layerName: "layer_Bangunan_bantul_all_3",
        pane: "pane_Bangunan_bantul_all_3",
        onEachFeature: pop_Bangunan_bantul_all_3,
        pointToLayer: function (feature, latlng) {
          var context = {
            feature: feature,
            variables: {},
          };
          return L.circleMarker(latlng, style_Bangunan_bantul_all_3_0(feature));
        },
      });
      bounds_group.addLayer(layer_Bangunan_bantul_all_3);
      map.addLayer(layer_Bangunan_bantul_all_3);
      function pop_Sawah_4(feature, layer) {
        layer.on({
          mouseout: function (e) {
            for (i in e.target._eventParents) {
              e.target._eventParents[i].resetStyle(e.target);
            }
            if (typeof layer.closePopup == "function") {
              layer.closePopup();
            } else {
              layer.eachLayer(function (feature) {
                feature.closePopup();
              });
            }
          },
          mouseover: highlightFeature,
        });
        var popupContent =
          '<table>\
                    <tr>\
                        <th scope="row">fid</th>\
                        <td>' +
          (feature.properties["fid"] !== null ? autolinker.link(feature.properties["fid"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">OBJECTID</th>\
                        <td>' +
          (feature.properties["OBJECTID"] !== null ? autolinker.link(feature.properties["OBJECTID"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nama_DI</th>\
                        <td>' +
          (feature.properties["Nama_DI"] !== null ? autolinker.link(feature.properties["Nama_DI"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">TK_jar</th>\
                        <td>' +
          (feature.properties["TK_jar"] !== null ? autolinker.link(feature.properties["TK_jar"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nama_ambil</th>\
                        <td>' +
          (feature.properties["Nama_ambil"] !== null ? autolinker.link(feature.properties["Nama_ambil"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Type_ambil</th>\
                        <td>' +
          (feature.properties["Type_ambil"] !== null ? autolinker.link(feature.properties["Type_ambil"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">UPT</th>\
                        <td>' +
          (feature.properties["UPT"] !== null ? autolinker.link(feature.properties["UPT"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Sumber_Air</th>\
                        <td>' +
          (feature.properties["Sumber_Air"] !== null ? autolinker.link(feature.properties["Sumber_Air"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">X_center</th>\
                        <td>' +
          (feature.properties["X_center"] !== null ? autolinker.link(feature.properties["X_center"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">y_center</th>\
                        <td>' +
          (feature.properties["y_center"] !== null ? autolinker.link(feature.properties["y_center"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Lokasi</th>\
                        <td>' +
          (feature.properties["Lokasi"] !== null ? autolinker.link(feature.properties["Lokasi"].toLocaleString()) : "") +
          '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Luas</th>\
                        <td>' +
          (feature.properties["Luas"] !== null ? autolinker.link(feature.properties["Luas"].toLocaleString()) : "") +
          "</td>\
                    </tr>\
                </table>";
        layer.bindPopup(popupContent, { maxHeight: 400 });
      }

      function style_Sawah_4_0() {
        return {
          pane: "pane_Sawah_4",
          opacity: 1,
          color: "rgba(35,35,35,1.0)",
          dashArray: "",
          lineCap: "butt",
          lineJoin: "miter",
          weight: 1.0,
          fill: true,
          fillOpacity: 1,
          fillColor: "rgba(48,207,24,1.0)",
          interactive: true,
        };
      }
      map.createPane("pane_Sawah_4");
      map.getPane("pane_Sawah_4").style.zIndex = 404;
      map.getPane("pane_Sawah_4").style["mix-blend-mode"] = "normal";
      var layer_Sawah_4 = new L.geoJson(json_Sawah_4, {
        attribution: "",
        interactive: true,
        dataVar: "json_Sawah_4",
        layerName: "layer_Sawah_4",
        pane: "pane_Sawah_4",
        onEachFeature: pop_Sawah_4,
        style: style_Sawah_4_0,
      });
      bounds_group.addLayer(layer_Sawah_4);
      map.addLayer(layer_Sawah_4);
      var osmGeocoder = new L.Control.Geocoder({
        collapsed: true,
        position: "topleft",
        text: "Search",
        title: "Testing",
      }).addTo(map);
      document.getElementsByClassName("leaflet-control-geocoder-icon")[0].className += " fa fa-search";
      document.getElementsByClassName("leaflet-control-geocoder-icon")[0].title += "Search for a place";
      var baseMaps = {};
      L.control
        .layers(baseMaps, {
          '<img src="legend/Sawah_4.png" /> Sawah': layer_Sawah_4,
          '<img src="legend/Bangunan_bantul_all_3.png" /> Bangunan_bantul_all': layer_Bangunan_bantul_all_3,
          '<img src="legend/ADMINISTRASI_LN_25K_2.png" /> ADMINISTRASI_LN_25K': layer_ADMINISTRASI_LN_25K_2,
          '<img src="legend/Saluran_bantul_all_1.png" /> Saluran_bantul_all': layer_Saluran_bantul_all_1,
          "Google Maps": layer_GoogleMaps_0,
        })
        .addTo(map);
      setBounds();
      map.addControl(
        new L.Control.Search({
          layer: layer_Bangunan_bantul_all_3,
          initial: false,
          hideMarkerOnCollapse: true,
          propertyName: "Nama_DI",
        })
      );
      document.getElementsByClassName("search-button")[0].className += " fa fa-binoculars";
    </script>
  </body>
</html>
<?php } ?>