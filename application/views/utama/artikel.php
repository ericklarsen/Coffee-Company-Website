<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-blog.css">


<section class="blog">
    <?php if ($artikel_top) { ?>
        <div class="blog-header">
            <div class="blog-header-content" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                <div class="blog-header-content-data">
                    <p data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"><?= $artikel_top->name; ?></p>
                    <h1 data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"><?= $artikel_top->title; ?></h1>
                    <p class="mt-1" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"><?= date('d F Y', strtotime($artikel_top->date)); ?> | <?= $artikel_top->write_by; ?></p>
                    <h2 data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                        <?php
                        if (strlen($artikel_top->short_description) > 103) {
                            echo ucwords(strtolower(substr($artikel_top->short_description, 0, 103))) . ' . . . .';
                        } else {
                            echo $artikel_top->short_description;
                        }
                        ?>
                    </h2>
                    <a href="<?= base_url() . 'artikel/detail/' . $artikel_top->id_artikel; ?>">READ MORE&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="blog-header-img" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                <img src="<?= base_url() . 'assets_upload/cover_artikel/' . $artikel_top->cover_artikel; ?>" alt="">
            </div>
        </div>
    <?php } ?>

    <div class="container blog-content">
        <div class="blog-filter">
            <!-- <form action="">
                <div class="form-group">
                    <label for=""><b>Filter Article</b></label>
                    <?php
                    echo form_dropdown(
                        array('name' => 'filter', 'id' => 'filter', 'class' => 'blog-filter-item'),
                        $artikelKind
                    );
                    ?>
                </div>
            </form> -->
        </div>
        <div class="blog-post">
            <?php foreach ($artikel as $row) : ?>
                <div class="blog-post-item" data-aos="zoom-out" data-aos-duration="1000" data-aos-once="true">
                    <img src="<?= base_url() . 'assets_upload/cover_artikel/' . $row->cover_artikel; ?>" alt="">
                    <span><?= $row->name; ?></span>
                    <a href="<?= base_url() . 'artikel/detail/' . $row->id_artikel; ?>">
                        <h5><?= $row->title; ?></h5>
                    </a>
                    <span><?= date('d F Y', strtotime($row->date)); ?> | <?= $row->write_by; ?></span>
                    <p>
                        <?php
                        if (strlen($row->short_description) > 173) {
                            echo ucwords(strtolower(substr($row->short_description, 0, 173))) . ' . . . .';
                        } else {
                            echo $row->short_description;
                        }
                        ?>
                    </p>
                    <a href="<?= base_url() . 'artikel/detail/' . $row->id_artikel; ?>">Read More&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
            <?php endforeach ?>
        </div>

        <?= $this->pagination->create_links(); ?>

    </div>
</section>

<?php
$this->load->view('utama/include/footer');
?>