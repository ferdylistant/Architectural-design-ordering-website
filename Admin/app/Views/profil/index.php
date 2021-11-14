<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup" >
	<div class="col-12" >
		<span class="d-block d-md-flex align-items-center text-center" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
			<ul class="breadcrumb py-0">
				<li>
					<a href="<?php echo base_url();?>/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
					<i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<span class="mt-2 text-dark text-muted">Profil Administrator</span>
				</li>
			</ul></span>
		</div>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
					<h4 class="card-title"><i class="fa fa-user"></i>&nbsp;Profil Administrator</h4>
                    <?php
                    if (session()->getFlashdata('success')) {
                        echo "<div class='alert alert-success alert-slide-up'>
                        <span>".session()->getFlashdata('success')."</span>  
                        </div>";
                    } elseif (session()->getFlashdata('error')) {
                        echo "<div class='alert alert-danger alert-slide-up'>
                        <span>".session()->getFlashdata('error')."</span>  
                        </div>";
                     } ?>
					<div class="row">
                        <div class="col-md-3">
                            <div class="card ">
                                <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                  <center>
                                    <img width="125" class="img-thumbnail" src="<?php echo base_url()?>/assets/admin/images/auth/user.jpg" alt="PICT">
                                <br><br>
                                <h5 class="profile-name"><?= $admin['nama_admin']; ?></h5>
                                  <small class="text-muted">Administrator</small>
                                  <span class="status-indicator online"></span>
                                  <br>
                                  <span><?= session()->get('ip_address')?></span>
                          </center>
                      </div>
                  </div>
              </div>
              <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Profil</h5>
                    </div>
                    <?php $id_admin = session()->get('id_admin'); ?>
                    <div class="card-body">
                       <?php echo form_open('/profile/update');?>
                       <input type="hidden" name="id_admin" value="<?php echo $id_admin;?>"/>
                       <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama_admin" class="form-control" value="<?= $admin['nama_admin'] ?>" placeholder="Nama Lengkap" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Telepon</label>
                            <input type="number" name="telp_admin" value="<?= $admin['telp_admin'] ?>" class="form-control" placeholder="Telepon" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Email</label>
                            <input type="email" name="email_admin" value="<?= $admin['email_admin'] ?>" class="form-control" placeholder="Telepon" required="">
                        </div>

                    </div>
                    <hr>
                    <button type='submit' class="btn btn-primary"><i class="feather icon-save"></i> Simpan</button>
                    <a href="<?php echo base_url()?>/profile/change-password" class="btn btn-info"><i class="feather icon-lock"></i> Ubah Password</a>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
<?= $this->endSection() ;?>