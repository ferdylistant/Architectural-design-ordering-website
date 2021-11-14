<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
  <div class="col-12">
    <span class="d-block d-md-flex align-items-center text-center "style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
      <ul class="breadcrumb py-0">
        <li>
         <a href="/" class="mt-2 text-dark" >
          <i class="mdi mdi-home"></i> Home
        </a>
        <i class="mdi mdi-arrow-right"></i>
      </li>
      <li>
       <a href="/client" class="mt-2 text-dark">Daftar Client</a>
     </li>
   </ul>
 </span>           					
</div>				
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">	
      <h4 class="card-title"><i class="fa fa-users"></i>&nbsp;DETAIL CLIENT</h4>
        <div class="row">
          <div class="col-md-3">
            <div class="thumbnail" >            
              <div class="isotope-item" style="box-shadow:111.35s;" >
                <?php if (empty($detail['pict_client'])) { ?>
                <a class="btn-show-gallery" href="http://web.desainrumah.com/assets/img/user.jpg" data-lightbox="menu">
                  <img src="http://web.desainrumah.com/assets/img/user.jpg" alt="<?= $detail['nama_client'];?>" class="img-fluid img-thumbnail" style="height: 215px;margin-top: 5px">
                </a>
                <?php } else { ?>
                <a class="btn-show-gallery" href="http://web.desainrumah.com/uploads/profile/<?php echo $detail['pict_client'] ?>" data-lightbox="menu">
                  <img src="http://web.desainrumah.com/uploads/profile/<?php echo $detail['pict_client']?>" alt="<?php echo $detail['nama_client'];?>" class="img-responsive img-thumbnail" style="height: 215px;margin-top: 5px">
                </a>
                <?php } ?>
              </div>
            </div> 
          </div>
          <div class="col-lg-9">
            <table class="table table-striped table-bordered table-hover" id="table" style="width: 100%;height: 210px">
              <tr>
                <td><strong>Nama</strong></td>
                <td><?php echo $detail['nama_client'];?></td>
              </tr>
              <tr>
                <td><strong>Email</strong></td>
                <td><?php echo $detail['email_client'];?></td>
              </tr>
              <tr>
                <td><strong>Alamat</strong></td>
                <td><?php echo $detail['alamat_client'];?></td>
              </tr>
              <tr>
                <td><strong>Telepon</strong></td>
                <td><?php echo $detail['telp_client'];?></td>
              </tr>
            </table>
          </div>
        </div>
           <br><hr style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
          <div class="row">
            <div class="col-lg-12">
              <label for="Riwayat Pemesanan"><i class="fa fa-shopping-cart"></i>&nbsp;Riwayat Pemesanan</label>
              <div class="table-responsive">
              <table class="table table-striped table-hover" id="table" style="width:100%;">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Email Tujuan</th>
                    <th class="text-center">Tanggal Pemesanan</th>
                    <th class="text-center">Deadline Pembayaran</th>
                    <th class="text-center">Total Pemesanan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Ket</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $key=0; ?>
                  <?php if (empty($order)) { ?>
                  <tr>
                    <td colspan="7" class="alert alert-info bg-white text-danger"><h5 align="center">client belum melalukan pemesanan</h5></td>
                  </tr>
                  <?php } else { ?>
                  <?php foreach ($order as $tampil) { ?>
                  <tr>
                    <td class="text-center"><?php echo $key+=1; ?></td>
                    <td class="text-center"><?php echo($tampil['email_client']); ?></td>
                    <td class="text-center"><?php echo format_hari_tanggal_jam($tampil['tgl_order']); ?></td>
                    <td class="text-center">
                      <?php if ($tampil['status_order'] == '3' || $tampil['status_order'] == '4') { ?>
                        -
                        <?php } else { ?>
                        <?php echo format_hari_tanggal_jam($tampil['deadline_pembayaran']); ?>
                      <?php } ?>
                      
                    </td>
                    <td class="text-center"><?php echo rupiah($tampil['total_order']) ?></td>
                    <td class="text-center"><?php
                    if ($tampil['status_order']=='0') { ?>
                    <span  class="badge badge-warning text-dark">waiting payment</span>
                    <?php } elseif ($tampil['status_order']=="1") { ?>
                    <span class="badge badge-info">down payment</span>
                    <?php } elseif ($tampil['status_order']=="2") { ?>
                    <span class="badge badge-success">payment received</span>
                    <?php } elseif ($tampil['status_order']=="3") { ?>
                    <span class="badge badge-primary">in progress</span>
                    <?php } elseif ($tampil['status_order']=="4") { ?>
                    <span class="badge badge-secondary text-dark">completed</span>
                    <?php } elseif ($tampil['status_order']=="5") { ?>
                    <span class="badge badge-danger">rejected</span>
                    <?php } elseif ($tampil['status_order']=="6") { ?>
                    <span class="badge badge-danger">expired</span>
                    <?php } ?>
                  </td>
                  <td class="text-center">
                    <?php if (empty($tampil['ket_tolak'])) { ?>
                      -
                      <?php } else { ?>
                      <?= $tampil['ket_tolak'];?>
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>
                <?php }?>
              </tbody>
            </table>
              </div>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>
<?= $this->endSection() ;?>