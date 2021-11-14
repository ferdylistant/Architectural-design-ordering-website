<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
  <div class="col-12">
    <span class="d-block d-md-flex align-items-center text-center "style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
      <ul class="breadcrumb py-0">
        <li>
          <a href="/" class="mt-2 text-dark" >
            <i class="mdi mdi-home"></i> Home</a>
            <i class="mdi mdi-arrow-right"></i>
        </li>
        <li>
          <a href="/company" class="mt-2 text-dark">Perusahaan</a>
          <i class="mdi mdi-arrow-right"></i>
        </li>
        <li>
          <span class="mt-2 text-dark text-muted">Edit</span>
        </li>
      </ul>
    </span>                            
  </div>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <h4 class="card-title"><i class="fa fa-building"></i> PERUSAHAAN EDIT</h4>
        <?php
        if (session()->getFlashdata('error')) {
            echo "&nbsp;&nbsp;&nbsp;<div class='alert alert-danger alert-slide-up'>
              <span>".session()->getFlashdata('error')."</span>  
              </div>";
        }
      ?>
          <p class="card-description">
            <hr>

          </p>

          <form method="post" action="/company/update" enctype="multipart/form-data">
        <input type="hidden" name="id_perusahaan" value="<?= $company['id_perusahaan']; ?>">
        <input type="hidden" name="logo" value="<?= $company['logo']; ?>">
            <div class="form-group">
              <label for="nama_perusahaan">Nama Perusahaan</label>
              <input type="text" class="form-control" name="nama_perusahaan" value="<?php echo $company['nama_perusahaan'] ?>" placeholder="Nama Perusahaan Anda">
            </div>
            <div class="form-group">
              <label for="email_perusahaan">Email Perusahaan</label>
              <input type="email" class="form-control" name="email_perusahaan" value="<?php echo $company['email_perusahaan'] ?>" placeholder="perusahaan@example.com">
            </div>
            <div class="form-group">
              <label for="telp_perusahaan">Telepon Perusahaan</label>
              <input type="text" class="form-control" name="telp_perusahaan" value="<?php echo $company['telp_perusahaan']?>" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
              <label for="alamat_perusahaan">Alamat Perusahaan</label>
              <input type="text" class="form-control" name="alamat_perusahaan" value="<?php echo $company['alamat_perusahaan'] ?>" placeholder="Location">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" rows="2"><?php echo $company['deskripsi']?></textarea>
            </div>
            <div class="form-group">
              <label for="wa">WhatsApp</label>
              <input type="text" class="form-control" name="wa" value="<?php echo $company['wa'] ?>" placeholder="url WhatsApp">
            </div>
            <div class="form-group">
              <label for="ig">Instagram</label>
              <input type="text" class="form-control" name="ig" value="<?php echo $company['ig'] ?>" placeholder="url Instagram">
            </div>
            <div class="form-group">
              <label>Logo</label>
              <input type="file" onchange="readURL(this);" name="userfile">
              
            </div>
            <div class="row">
            <?php
              if (empty($company['logo'])) { ?>

              <?php } else { ?>
                
                <img id="blah" class="img-thumbnail" src="/uploads/perusahaan/<?= $company['logo']?>" alt="logo" style="width: 100px">
              <?php } ?>
            </div>
            <div class="row">
            <button type="submit" onclick="return Swal.fire('UPDATE BERHASIL!','' ,'success')" class="btn btn-success mr-2">Update</button>
            <button class="btn btn-dark" onclick="goBack()">Cancel</button>
            </div>
              </form>
      </div>
    </div>
  </div>        
</div>

<?= $this->endSection() ;?>