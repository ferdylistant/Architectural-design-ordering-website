<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?> | Administrator</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/jqueryui/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/alert/css/sweetalert.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/vendor/lightbox2/css/lightbox.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/portofolio/css/templatemo-style.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url()?>/assets/admin/images/auth/Administrator.png" />
  <script>
		var baseurl = "<?php echo base_url();?>/"; // Buat variabel baseurl untuk nanti di akses pada file config.js
	</script>
</head>

<body>
  <div class="container-scroller" id="fullScreen">

    <!-- partial:partials/_navbar -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="/">
          <img style="height: 60px" src="<?= base_url()?>/assets/logo.png" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
            <?php $this->order = new \App\Models\OrderModel();
            $noTIF = $this->order->getNotifikasi();
            $tot = $this->order->getOrder();
            if (!empty($noTIF)) { ?>
              <span class="count"><?= count($noTIF)?></span>
            <?php } ?>
            </a>

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">

              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have <?= count($tot)?> total orders
                </p>
                <a href="<?php echo base_url() ?>/order" class="badge badge-info badge-pill float-right">View all</a>
              </div>
              <?php foreach ($noTIF as $ntf) { ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="<?= base_url('/order/detail?o='.base64_encode($ntf['id_order']).'&c='.base64_encode($ntf['id_client']))?>">
                
                <div class="preview-thumbnail">
                  <?php if (empty($nft['pict_client'])) { ?>
                  <img src="<?= base_url()?>/assets/admin/images/auth/user.jpg" alt="" class="profile-pic">
                  <?php } else { ?>
                  <img src="http://web.desainrumah.com/uploads/profile/<?= $nft['pict_profile']?>" alt="" class="profile-pic">
                  <?php } ?>
                </div>
                
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"><?= $ntf['nama_client']?>
                  </h6>
                  <p class="preview-subject font-weight-light small-text"><?= waktu_lalu($ntf['update_status'])?></p>
                  <?php if ($ntf['status_order'] == '0') { ?>
                  <span class="badge badge-warning badge-pill font-weight-light small-text" style="margin-left: -1px">waiting payment</span>
                  <?php } elseif ($ntf['status_order'] == '1') { ?>
                  <span class="badge badge-info badge-pill font-weight-light small-text" style="margin-left: -1px">down payment</>
                  <?php } elseif ($ntf['status_order'] == '2') { ?>
                  <span class=" badge badge-success badge-pill font-weight-light small-text" style="margin-left: -1px">payment received</span>
                  <?php } ?>
                </div>
                <?php } ?>
              </a>
            </div>

          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, <?php echo session()->get('nama_admin'); ?></span>

              <img class="img-xs rounded-circle" src="<?= base_url()?>/assets/admin/images/auth/user.jpg" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a href="<?php echo base_url(); ?>/profile" class="dropdown-item">
                Profil
              </a>
              <a href="<?php echo base_url(); ?>/profile/change-password" class="dropdown-item">
                Change Password
              </a>
              <a href="/logout" class="dropdown-item" id="keluar">
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- End navbar -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">

                  <img class="img-xs rounded-circle" src="<?= base_url()?>/assets/admin/images/auth/user.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">

                  <p class="profile-name"><?php echo session('nama_admin'); ?></p>
                  <div>
                    <small class="designation text-muted"><?php echo session('email_admin'); ?></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>

            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">
              <i class="menu-icon fa fa-dashboard"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/client">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-title">Daftar Client</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Master Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="master">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>/paket">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-title">Paket</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url();?>/portfolio">
                    <i class="menu-icon fa fa-archive"></i>
                    <span class="menu-title">Portofolio</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>/portfolio/category">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-title">Kategori Portofolio</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/rekening">
                    <i class="menu-icon fa  fa-credit-card-alt"></i>
                    <span class="menu-title">Rekening</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/company">
                    <i class="menu-icon fa fa-building"></i>
                    <span class="menu-title">Perusahaan</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#transaksi" aria-expanded="false" aria-controls="transaksi">
              <i class="menu-icon fa fa-barcode"></i>
              <span class="menu-title">Transaksi</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transaksi">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>/order">
                    <i class="menu-icon fa fa-shopping-cart"></i>
                    <span class="menu-title">Pemesanan</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>/payment">
                  <i class="menu-icon fa fa-money"></i>
                  <span class="menu-title">Pembayaran</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
              <i class="menu-icon fa fa-file-o"></i>
              <span class="menu-title">Laporan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="laporan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>/sold-report" class="nav-link">
                    <i class="menu-icon fa fa-file-pdf-o"></i>
                    <span class="menu-title">Laporan Transaksi</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">


        <div class="content-wrapper">
          <div class="row purchace-popup">
            <div class="col-12">
              <?= $this->renderSection('content'); ?>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021
              <a href="http://www.bootstrapdash.com/" target="_blank">CV. Karina</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Karina Property & Consultant
              <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->

  <script src="<?php echo base_url()?>/assets/admin/jqueryui/jquery-ui.js"></script>
  <script src="<?php echo base_url()?>/assets/admin/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url()?>/assets/admin/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  <script>
    var ckeditor = CKEDITOR.replace('ckeditor', {
      height: '600px'
    });

    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline('editable');
  </script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url()?>/assets/admin/js/off-canvas.js"></script>
  <script src="<?php echo base_url()?>/assets/admin/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url()?>/assets/admin/js/chart.js"></script>
  <script src="<?php echo base_url()?>/assets/admin/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="<?php echo base_url()?>/assets/admin/pages/scripts/form-validation.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url()?>/assets/admin/pages/scripts/table-advanced.js"></script>
  <script src="<?php echo base_url()?>/assets/admin/pages/scripts/table-editable.js"></script>
  <script src="<?php echo base_url()?>/assets/alert/js/sweetalert.min.js"></script>
  <script src="<?php echo base_url()?>/js/panggil_sweetalert.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>/assets/vendor/lightbox2/js/lightbox.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#table').DataTable({
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        responsive: true
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() { // Ketika halaman selesai di load

      $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
      $('#filter').change(function() { // Ketika user memilih filter
        if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
          $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
          $('#form-tanggal').show(); // Tampilkan form tanggal
        } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
          $('#form-tanggal').hide(); // Sembunyikan form tanggal
          $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
        } else { // Jika filternya 3 (per tahun)
          $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
          $('#form-tahun').show(); // Tampilkan form tahun
        }
        $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
      })
    })
  </script>
  <!-- <script type="text/javascript">
    function getMessageCount1(){
      $.ajax({
        type: 'POST',
        url: '<?php ?>',
        data: { NumberOfAlerts: "<?php ?>" },
        success: function(response){
          $('#alertsfrommydb').html(response);
        }
      });
    }
  </script> -->
  <script type="text/javascript">
    $(function() {
      $("#stts").change(function() {
        if ($(this).val() == "5") {
          $("#tolak").show();

        } else {
          $("#tolak").hide();
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url() ?>apiongkir/provinsi',
        success: function(hasil) {
          $("select[name=provinsi]").html(hasil);
        }
      });
      $("select[name=provinsi]").on("change", function() {
        // mendapatkan id_provinsi yg dipillih
        var id_provinsi_terpilih = $(this).val();
        // mendapatkan isi atribut nama, dari option yang dipilih
        var nama_provinsi = $("option:selected").attr("nama");
        // menaruh di input yg bernama nama_provinsi
        $("input[name=nama_provinsi]").val(nama_provinsi);
        $.ajax({
          url: '<?php echo base_url() ?>apiongkir/update_kota',
          type: 'POST',
          data: 'id_provinsi=' + id_provinsi_terpilih,
          success: function(hasil) {
            $("select[name=kota]").html(hasil);
          }
        });
      })
    })
  </script>
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah')
            .attr('src', e.target.result)
            .width(150)
            .height(200);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <script>
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).width(150)
            .height(150).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.imageJS');
    });
});
  </script>
  <script>
    function myFunction() {
      var dots = document.getElementById("dots");
      var moreText = document.getElementById("more");
      var btnText = document.getElementById("myBtn");

      if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
      } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
      }
    }
  </script>

  <script>
    function goBack() {
      window.history.back()
    }
  </script>
  <script>
    // Magnific pop up
    $('.tm-gallery').magnificPopup({
              delegate: 'a', // child items selector, by clicking on it popup will open
              type: 'image',
              gallery: {enabled:true}
              // other options
            });
  </script>
  <script>
    jQuery(document).ready(function() {
      Metronic.init(); // init metronic core components
      Layout.init(); // init current layout
      QuickSidebar.init(); // init quick sidebar
      Demo.init(); // init demo features // initlayout and core plugins
      Index.init();
      Index.initJQVMAP(); // init index page's custom scripts
      Index.initCalendar(); // init index page's custom scripts
      Index.initCharts(); // init index page's custom scripts
      Index.initChat();
      Index.initMiniCharts();
      Index.initDashboardDaterange();
      Tasks.initDashboardWidget();
      TableEditable.init();
      ComponentsPickers.init();
      FormValidation.init();
      DataTables.init();
    });
  </script>
  <script type="text/javascript">
    $(".alert-slide-up").alert().delay(3000).slideUp('slow');
  </script>
  <!-- END JAVASCRIPTS -->
</body>

</html>