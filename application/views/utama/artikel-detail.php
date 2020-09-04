<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-blog-detail.css">

<section class="blog-detail">
    <div class="container">
        <div class="page-header" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
            <p data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"><?= $artikel->name; ?></p>
            <h1 data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"><?= $artikel->title; ?></h1>
            <p data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"><?= date('d F Y', strtotime($artikel->date)); ?> | <?= $artikel->write_by; ?></p>
        </div>
        <img data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="page-header-img" src="<?= base_url() . 'assets_upload/cover_artikel/' . $artikel->cover_artikel; ?>" alt="">
        <div class="page-data" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
            <?= $artikel->content; ?>
        </div>
    </div>
    <div class="page-recom" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
        <?php for ($i = 0; $i < count($rekomendasi); $i++) { ?>
            <?php if ($i == 0) : ?>
                <div class="page-recom-right">
                    <div class="page-nav right">
                        <a href="<?= base_url() . 'artikel/detail/' . $rekomendasi[$i]['id_artikel'] ?>"><i class="fa fa-caret-left" aria-hidden="true"></i>&nbspPrevious</a>
                        <h4>
                            <?= $rekomendasi[$i]['title'] ?>
                        </h4>
                    </div>
                    <img src="<?= base_url() . 'assets_upload/cover_artikel/' . $rekomendasi[$i]['cover_artikel']; ?>" alt="">
                </div>
            <?php endif ?>

            <?php if ($i == 1) : ?>
                <div class="page-recom-left">
                    <div class="page-nav left">
                        <a href="<?= base_url() . 'artikel/detail/' . $rekomendasi[$i]['id_artikel'] ?>">Next&nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        <h4>
                            <?= $rekomendasi[$i]['title'] ?>
                        </h4>
                    </div>
                    <img src="<?= base_url() . 'assets_upload/cover_artikel/' . $rekomendasi[$i]['cover_artikel']; ?>" alt="">
                </div>
            <?php endif ?>
        <?php } ?>


    </div>
</section>

<?php
$this->load->view('utama/include/footer');
?>