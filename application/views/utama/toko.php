<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-store.css">


<div class="store">
    <div class="container">
        <div class="store-header" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
            <h1>ETALASE</h1>
            <p>Temukan berbagai promo menarik gratis ongkos kirim dengan berbelanja produk kami. </p>
        </div>

        <div class="store-filter">
            <label for=""><b>filter product</b></label>
            <form action="">
                <?php
                echo form_dropdown(
                    array('name' => 'filter', 'id' => 'filter', 'class' => 'store-filter-item'),
                    $itemKind,
                    $filter
                );
                ?>
            </form>
        </div>

        <div class="store-wrap">
            <?php foreach ($item as $row) : ?>
                <div class="store-wrap-stack" data-aos="zoom-out" data-aos-duration="1000" data-aos-once="true">
                    <img src="<?= base_url() . 'assets_upload/cover_item/' . $row->cover_item; ?>" alt="">
                    <div class="store-wrap-content">
                        <p class="store-wrap-title"><?= $row->name; ?></p>
                        <a href="<?= base_url() . 'toko/detail/' . $row->id_item; ?>"><h4><?= $row->name_item; ?></h4></a>
                        <p class="store-wrap-price">FROM <?= $row->price_item; ?></p>
                        <?php if ($row->stock_item == 'Available') { ?>
                            <a href="<?= base_url() . 'toko/detail/' . $row->id_item; ?>" class="store-wrap-btn"><b>beli</b></a>
                        <?php } else { ?>
                            <a href="<?= base_url() . 'toko/detail/' . $row->id_item; ?>" class="store-wrap-btn-po"><b>P.O</b></a>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <?= $this->pagination->create_links(); ?>

        <!-- <div class="store-page">
            <a href="">
                <i class="fa fa-caret-left" aria-hidden="true"></i>
            </a>
            <a href="" class="active">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">4</a>
            <a href="">
                <i class="fa fa-caret-right" aria-hidden="true"></i>
            </a>
        </div> -->
    </div>
</div>

<?php
$this->load->view('utama/include/footer');
?>