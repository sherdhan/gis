
<?php
error_reporting(1);
?>
<!DOCTYPE html>
<html lang="en">
<?php
$today = date("j-n-Y");
$cbulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$cnobl  = array("01","02","03","04","05","06","07","08","09","10","11","12");
$nthm = date("Y") - 10;
$ntha = date("Y") + 10;
$nthini = date("Y");
$ntgini = date("j") -1 ;
?>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>GIS Pemetaan Longsor :: Admin</title>   
    
    <!-- data table -->
   
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

     <link href="../vendors/cropper/dist/cropper.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDisfmbUBn-cleAtfgxWopPMprklqRvE"></script>

    <script>
      var marker;
      var im = 'http://www.robotwoods.com/dev/misc/bluecircle.png';
      var start1, start2;
      var end1, end2;

      function initialize(position){

        var infoWindow = new google.maps.InfoWindow;
        var mapOptions = {
          mapTypeId:google.maps.MapTypeId.ROADMAP,
          zoom:15
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var bounds = new google.maps.LatLngBounds();
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          map: map
        });

        <?php
        $a= $_GET['des'];
        $kon= mysqli_connect("localhost","root","");
              mysqli_select_db($kon,"15650078");
            $query = mysqli_query($kon,"SELECT * FROM data_location where des='$a'");
            while ($data = mysqli_fetch_array($query))
            {
                $lat = $data['lat'];
                $lon = $data['lon'];
                echo ("addMarker($lat, $lon);");                        
            }
          ?>        

        
        function addMarker(lat, lng){
          var lokasi = new google.maps.LatLng(lat, lng);
          end1 = lat;
          end2 = lng;
          bounds.extend(lokasi);
          var marker = new google.maps.Marker({
            map:map,
            position:lokasi
          });
          map.fitBounds(bounds);
        }

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            start1 = position.coords.latitude;
            start2 = position.coords.longitude;
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var lokasi = new google.maps.LatLng(pos);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
              map:map,
              position:lokasi,
              icon: im
            });
            map.fitBounds(bounds);
            infoWindow.open(map);

            calculateAndDisplayRoute(directionsService, directionsDisplay, start1, start2, end1, end2);
          });
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay, start1, start2, end1, end2) {
          directionsService.route({
            origin: new google.maps.LatLng(start1, start2),
            destination: new google.maps.LatLng(end1, end2),
            travelMode: google.maps.TravelMode.DRIVING
          }, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });
        }
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>

  <body class="nav-md" onload="initialize()">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../index.php" class="site_title"><i class="fa fa-laptop"></i> <span>GISPL</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../images/img.jpg"  class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Sherdhan Syarif</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="home.php"><i class="fa fa-home"></i>Home<span></span></a>   
                  </li>
                  <li>
                    <a href="manage_data.php"><i class="fa fa-edit"></i>Manage Data</a>
                    <!-- <ul class="nav child_menu">
                      <li>
                        <a href="#">Text<span></span></a>
                      </li>
                    </ul> -->
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a> -->
              <a title="Logout" href="../index.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              

            </div>
            <div class="row">
            <div class="col-md-12 col-xs-12">
            <!-- page anggota -->
              <?php if ($_GET['page']=='daftarmakanan') {
              ?>

              <?php } elseif ($_GET['page']=='daftarpromo') {
              ?>
              <?php              
              include('page/stock_masuk.php');
              ?>
               <?php } elseif ($_GET['page']=='deskripsi') {
              ?>
              <?php              
              include('page/desk_lok.php');
              ?>
              <?php } else {
              ?>
                <!-- page home -->
                  <!-- top tiles -->
                  <div class="row tile_count">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">Map UIN Maliki Kampus 3 <strong><?php echo $a ?></strong>  </div>
                <div class="panel-body">
                    <div id="map-canvas" style="width: 100%; height: 518px"></div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">Deskripsi Tempat <strong><?php echo $a ?></strong></div>
                <div class="panel-body">          
                      <table>
                      <tr>
                        <td>
                          <?php 
                          $a=$_GET['des'];
                            $kon= mysqli_connect("localhost","root","");
                              mysqli_select_db($kon,"15650078");
                            $query = mysqli_query($kon,"SELECT * FROM data_location where des='$a'");
                            while ($data = mysqli_fetch_array($query))
                            {
                          ?>
                           <center><img src="<?php echo "../images/".$data['gambar'] ?>" style="float: left; width: 50% ; height: 30%; "></center><br><br>
                          <p style="font-size: 20px;"><?php echo $data['ket']; ?></p>

                          <!-- <video controls autoplay style="width: 100%; height: 100%">
                            <source src="../video/kunjunganfix.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                          </video>
                          <video controls autoplay style="width: 100%; height: 100%">
                            <source src="../video/keretaku.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                          </video> -->


                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                      </table>

                          
                </div>
              </div>
            </div>  
                  </div>  

                  </div>
                  </div>
                  <!-- /top tiles -->
                  
              <?php }
              ?>
              <!-- /page content -->

<!--  -->


    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Dropzone.js -->
    <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
        <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.js"></script>
      
   
    
    <script>
    var $jnoc = jQuery.noConflict();
    $jnoc(function() {
      $jnoc('#example1').dataTable();
      });
    </script>

  </body>
</html>