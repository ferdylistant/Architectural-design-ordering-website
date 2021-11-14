<?= $this->extend('Template/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-lg-12">
  <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger alert-slide-up" role="alert">
              <?php echo session()->getFlashdata('error'); ?>
            </div>
          <?php endif; ?>
          <figure class="card card-body text-center" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
						<blockquote class="blockquote">
              Selamat datang, <?php echo session('nama_admin'); ?>!
              <figcaption class="blockquote-footer">
            Anda login sebagai administrator. Anda memiliki akses penuh terhadap sistem.
						</figcaption>
						</blockquote>
					</figure>
  </div>
</div>
<br>
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-cube text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Paket</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0"><?php echo $total_paket ?></h3>
            </div>
          </div>
        </div>
      </div>
      <a href="<?php echo base_url() ?>sistem/menu" class="btn btn-inverse-dark btn-fw"><i class="fa fa-eye menu-icon"> </i>Selengkapnya</a>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-receipt text-warning icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pemesanan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0"><?php echo $total_order ?></h3>
            </div>
          </div>
        </div>
      </div>
      <a href="<?php echo base_url() ?>/order" class="btn btn-inverse-dark btn-fw"><i class="fa fa-eye menu-icon"> </i>Selengkapnya</a>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Terjual</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0"><?php echo $total_terjual ?></h3>
            </div>
          </div>
        </div>
      </div>
      <a href="<?php echo base_url() ?>/sold-report" class="btn btn-inverse-dark btn-fw"><i class="fa fa-eye menu-icon"> </i>Selengkapnya</a>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-location text-info icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pelanggan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0"><?php echo $total_client ?></h3>
            </div>
          </div>
        </div>
      </div>
      <a href="/client" class="btn btn-inverse-dark btn-fw"><i class="fa fa-eye menu-icon"> </i>Selengkapnya</a>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>