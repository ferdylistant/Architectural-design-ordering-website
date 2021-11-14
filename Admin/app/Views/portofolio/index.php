<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
    <div class="col-12">
        <span class="d-block d-md-flex align-items-center text-center" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <ul class="breadcrumb py-0">
            <li>
            <a href="<?php echo base_url();?>/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
            <i class="mdi mdi-arrow-right"></i>
            </li>
            <li>
            <span class="mt-2 text-dark text-muted">Portofolio</span>
            </li>
        </ul>
        </span>
    </div>
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                <h4 class="card-title"><i class="fa fa-archive"></i>&nbsp;PORTOFOLIO</h4>
                <p class="card-description">
						<a class="btn btn-success btn-block" href="/portfolio/add">Add<i class="mdi mdi-plus"></i>
						</a>
						<hr>
					</p>
                <?php
                if (session()->getFlashdata('error')) {
                    echo "<div class='alert alert-danger alert-slide-up'>
                    <span>".session()->getFlashdata('error')."</span>  
                    </div>";
                } ?>
                <div id="gallery" class="tm-content-box">                        
                    <div class="grid tm-gallery">
                        <?php foreach ($pict as $item) { ?>
                        <figure class="effect-bubba">
                            <img src="<?= base_url('/uploads/portofolio/'.$item['gambar_portofolio'])?>" alt="<?= $item['nama_portofolio']?>" class="img-fluid">
                            <figcaption>
                                <h2><span><?= $item['nama_portofolio']?></span></h2>
                                <h6><?= $item['nama_kategori_portofolio']?></h6>
                                <p><?= $item['keterangan']?></p>
                                <a href="<?= base_url()?>/uploads/portofolio/<?= $item['gambar_portofolio']?>">View more</a>
                            </figcaption>
                        </figure>
                        <?php } ?>                               
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ;?>