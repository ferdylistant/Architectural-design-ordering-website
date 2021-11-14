         
<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="col-12 stretch-card">
  <div class="card">
    <div class="card-body"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
      <h4 class="card-title"><i class="fa fa-edit"></i> Ubah Password</h4>
      <p class="card-description">
        <hr>
      </p>
      <?php
          if (session()->getFlashdata('error')) {
              echo "<div class='alert alert-danger alert-slide-up'>
              <span>".session()->getFlashdata('error')."</span>  
              </div>";
        } ?>
      <?php echo form_open('/profile/update_password/', 'class="forms-sample"'); ?>
      <div class="form-group row">
        <label for="inputPassLama" class="col-sm-3 col-form-label">Current Password</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="password_lama" id="inputPassLama" placeholder="Current Password">
          <span id="password_lama"  class="required"></span>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputNpass" class="col-sm-3 col-form-label">New Password</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="password_baru" id="inputNpass" placeholder="New Password">
          <span id="password_baru"  class="required"></span>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputCpass" class="col-sm-3 col-form-label">Confirm Password</label>
        <div class="col-sm-9">
         <input type="password" class="form-control" name="password_konfirmasi" id="inputCpass" placeholder="Confirm New Password">
         <span id="konfirmasi_password"  class="required"></span>
       </div>

     </div>

     <input type="submit" name="submit" class="btn btn-success mr-2" value="Change">
     <butoon type="button" class="btn btn-dark" onclick="goBack()">Cancel</butoon>


     <?php echo form_close();?>

   </div>
 </div>
</div>
<?= $this->endSection() ;?>