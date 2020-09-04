<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url().'assets_home/';?>css/custom-store.css">
<link rel="stylesheet" href="<?= base_url().'assets_home/';?>css/custom-store-detail.css">

<div class="store">
    <div class="container">
        <div class="store-header" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
            <h1>AKTIVITAS</h1>
            <p>Ikuti kegiatan yg kami lakukan, rasakan pengalaman baru bersama kami</p>
        </div>

        <div class="store-filter">
        </div>

        <div class="store-wrap">
            <?php foreach ($workshop as $row): ?>
                <div class="store-wrap-stack" data-aos="zoom-out" data-aos-duration="1000" data-aos-once="true">
                    <img src="<?= base_url().'assets_upload/cover_workshop/'.$row->cover_workshop;?>" alt="">
                    <div class="store-wrap-content" >
                        <h4><?= $row->name;?></h4>
                        <?= $row->description;?>
                        <a href="<?= base_url().'kontak-kami'?>" onclick="showup()" class="store-wrap-btn"><b>Kontak</b></a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php
$this->load->view('utama/include/footer');
?>
