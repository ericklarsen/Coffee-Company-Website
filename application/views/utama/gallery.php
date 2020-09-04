<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-about.css">
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-galeri.css">

<div class="divider"></div>
<section class="about">
	<div class="about-header">
		<div class="about-header-border"></div>
		<img class="" src="<?= base_url() . 'assets_upload/background/' . $background[5]['cover_background']; ?>" alt="">
		<div class="about-content container">
			<div class="about-content-title">
				<div class="line" data-aos="zoom-out-left" data-aos-duration="1000" data-aos-once="true"></div>
				<h1 data-aos="zoom-out-down" data-aos-duration="1000" data-aos-once="true">Galeri</h1>
				<div class="line" data-aos="zoom-out-right" data-aos-duration="1000" data-aos-once="true"></div>
			</div>
			<p data-aos="fade" data-aos-duration="1000" data-aos-once="true">Ikuti perjalanan kami dari hulu hingga hilir, informasi berupa gambar dan video.</p>
		</div>
	</div>
</section>

<section class="galeri">
	<div class=" container">
		<div class="galeri-container">
			<?php foreach ($gallery as $row) : ?>
				<?php if ($row->kind == 'Photo') { ?>
					<div class="galeri-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
						<div class="galeri-item">
							<img src="<?= $row->cover_gallery ?>" alt="">
						</div>
						<div class="galeri-hover" id="galeri-hover-1">
							<div class="galeri-text">
								<h4><?= $row->title; ?></h4>
								<p>
									<?= $row->description; ?>
								</p>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="galeri-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
						<div class="galeri-item">
							<iframe width="442px" height="400px" src="<?= $row->cover_gallery?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				<?php } ?>
			<?php endforeach ?>

		</div>
	</div>
</section>

<?php
$this->load->view('utama/include/footer');
?>