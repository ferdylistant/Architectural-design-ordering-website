
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | Administrator</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/admin/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/admin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/admin/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url()?>/assets/admin/images/auth/Administrator.png" />
</head>

<body>

  <div class="container-scroller">

    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">

      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">

        <div class="row w-100">

          <div class="col-lg-4 mx-auto">

            <div class="auto-form-wrapper">
              <div class="form-group" style="text-align: center">
                <img class="img-fluid" src="<?php echo base_url()?>/assets/logo.png" alt="">
              </div>

              <!-- <div class="alert alert-danger">
                <span>Username atau Password kosong!</span>
                <button type="button" class="close" data-dismiss="alert">×</button>
              </div> -->
              <?php echo form_open('/login/process', 'class="login-form"') ?>
              <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger alert-slide-up" role="alert">
                <?php echo session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
              <div class="form-group has-feedback">
                <label class="label" for="email_admin">Email</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="emId" name="email_admin" placeholder="example@mail.com" required>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <span class="mdi mdi-check-circle-outline input-group-addon" id="emIcon"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="label" for="password_admin">Password</label>
                <div class="input-group">
                  <input type="password" id="psId" oninput="passwordFunction()" class="form-control" autocomplete="off" name="password_admin" placeholder="*********" required>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <span class="mdi mdi-check-circle-outline input-group-addon" id="psIcon"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group d-flex justify-content-center">
                <div class="form-check form-check-flat mt-0">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remember_me"> Remember me
                  </label>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-primary submit-btn btn-block" type="submit">Login</button>
              </div>
              <?php echo form_close(); ?>
              
            </div>
            <p class="footer-text text-center">copyright © 2021 CV. Karina. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  

  <!-- plugins:js -->
  <script src="<?= base_url()?>/assets/admin/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= base_url()?>/assets/admin/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  
  <!-- inject:js -->
  <script src="<?= base_url()?>/assets/admin/js/off-canvas.js"></script>
  <script src="<?= base_url()?>/assets/admin/js/misc.js"></script>
  <!-- endinject -->
  <script>
    // function emailFunction() {
    //   var x = document.getElementById("usId").value;
    //   if (x.length < '5') {
    //     document.getElementById("unIcon").style.color = "red";      
    //   }
    //   else{
    //     document.getElementById("unIcon").style.color = "#63bc46";
    //   }
    // }
    function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
    }

    function validate() {
      const $result = $("#emIcon");
      const email = $("#emId").val();

      if (validateEmail(email)) {
        $result.css("color", "#63bc46");
      } else {
        $result.css("color", "red");
      }
      return false;
    }

    $("#emId").on("input", validate);
    function passwordFunction() {
      var x = document.getElementById("psId").value;
      if (x.length < '5') {
        document.getElementById("psIcon").style.color = "red";      
      }
      else{
        document.getElementById("psIcon").style.color = "#63bc46";
      }
    }
  </script>
  <script type="text/javascript">
    $(".alert-slide-up").alert().delay(3000).slideUp('slow');
  </script>
</body>

</html>