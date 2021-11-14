<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
  <div class="col-12">
    <span class="d-block d-md-flex align-items-center text-center " style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
      <ul class="breadcrumb py-0">
        <li>

          <a href="<?php echo base_url();?>/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
          <i class="mdi mdi-arrow-right"></i>
        </li>
        <li>
          <span class="mt-2 text-dark text-muted">Semua Pemesanan</span>
        </li>
      </ul></span> 
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
          <h4 class="card-title"><i class="menu-icon fa fa-shopping-cart"></i>&nbsp;SEMUA PEMESANAN</h4>
          <p class="card-description">

            <hr>
          </p>
          <table class="table table-striped table-bordered table-hover" id="table" >
            <thead>
              <tr>
                <th class="text-center">No</th>               
                <th class="text-center">Kode Pemesanan</th>               
                <th class="text-center">Nama Pemesan</th>
                <th class="text-center">Tanggal Pemesanan</th>
                <th class="text-center">Batas Pembayaran</th>
                <th class="text-center">Status</th>
                <th class="text-center">Rincian</th>       
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              
              foreach ($order as $tampil) { ?>
                <tr>
                  <td class="text-center"><?php echo $no;?></td>
                  <td class="text-center">
                    kd<?php echo $tampil['id_order'];?>dsn
                    <input type="hidden" name="id_order" value="<?= $tampil['id_order']?>">
                  </td>
                  <td class="text-center"><?php echo $tampil['nama_client'];?></td>
                  <td class="text-center"><?php echo format_hari_tanggal_jam($tampil['tgl_order']);?></td>
                  <td class="text-center"><?php if ($tampil['status_order'] == '2' || $tampil['status_order'] == '3' || $tampil['status_order'] == '4') { ?>
                    -
                    <?php } else { ?>
                    <?php echo format_hari_tanggal_jam($tampil['deadline_pembayaran']);?>
                  <?php } ?>
                    </td>
                  <td class="text-center"><?php
                  if ($tampil['status_order']=='0') { ?>
                    <span  class="badge badge-warning text-dark">waiting payment</span>
                  <?php } elseif ($tampil['status_order']=="1") { ?>
                    <span class="badge badge-info">DP received</span>
                  <?php } elseif ($tampil['status_order']=="2") { ?>
                    <span class="badge badge-success">payment received</span>
                  <?php } elseif ($tampil['status_order']=="3") {?>
                    <span class="badge badge-primary">in progress</span>
                  <?php } elseif ($tampil['status_order']=="4") { ?>
                  <span class="badge badge-secondary text-dark">completed</span>
                  <?php } elseif ($tampil['status_order']=="5") { ?>
                    <span class="badge badge-dark">rejected</span>
                  <?php } elseif ($tampil['status_order']=="5") { ?>
                    <span class="badge badge-danger">expired</span>
                  <?php } ?>
                </td>
                <td>
                  <a  class="badge badge-primary" href="<?php echo base_url('/order/detail?o='.base64_encode($tampil['id_order']).'&c='.base64_encode($tampil['id_client']));?>">Nota</a>
                  <?php if ($tampil['status_order']=='1' || $tampil['status_order']=='2' || $tampil['status_order']=='3' || $tampil['status_order']=='4') { ?>
                    <a  class="badge badge-success" href="<?= base_url('/payment/detail?o='.base64_encode($tampil['id_order']).'&c='.base64_encode($tampil['id_client']))?>">Pembayaran</a>
                  <?php } elseif ($tampil['status_order']=='407') { ?>
                    <a class="btn btn-outline-danger hapus-pesanan" href="<?php echo base_url();?>sistem/pesanan_delete/<?php echo $tampil['id_order'];?>"> <i class="fa fa-times"></i></a>
                  <?php } ?>
                </td>
              </tr>
              <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ;?>