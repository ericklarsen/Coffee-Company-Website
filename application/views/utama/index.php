<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-menu-mid.css">
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-carousel.css">
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-carousel-text.css">

<section class="slideshow">
	<div id="slider">
		<input type="radio" name="slider" id="slide1">
		<input type="radio" name="slider" id="slide2">
		<input type="radio" name="slider" id="slide3">
		<input type="radio" name="slider" id="slide4">
		<div id="slides">
			<div id="overflow">
				<div class="inner">
					<?php
					$index = 1;
					foreach ($carousel as $row) : ?>
						<div class="slide slide_<?= $index;
												$index++; ?>">
							<div class="slide-content">
								<img src="<?= base_url() . 'assets_upload/slideshow/' . $row->cover_slideshow; ?>" alt="">
								<div class="slide-text" data-aos="fade" data-aos-duration="1000">
									<h2><?= $row->title; ?></h2>
									<p>
										<?= $row->description; ?>
									</p>
									<?php if ($row->id_artikel) : ?>
										<a href="<?= base_url() . 'artikel/detail/' . $row->id_artikel; ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
									<?php endif ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<div id="bullets">
			<label for="slide1"></label>
			<label for="slide2"></label>
			<label for="slide3"></label>
			<label for="slide4"></label>
		</div>
	</div>
</section>


<section class="shop">
	<div class="shop-header" data-aos="fade" data-aos-duration="1000" data-aos-once="true">
		<h2>REKOMENDASI KAMI!</h2>
		<a href="<?= base_url() . 'toko'; ?>" class="sheet-link" href="">CEK ETALASE&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
	</div>
	<div class="shop-stack container" data-aos="fade-up" data-aos-duration="600" data-aos-once="true">
		<?php foreach ($itemHighlight as $row) : ?>
			<div class="shop-stack-item">
				<img src="<?= base_url() . 'assets_upload/cover_item/' . $row->cover_item; ?>" alt="">
				<div class="shop-stack-item-content">
					<p class="shop-stack-title"><?= $row->type; ?></p>
					<a href="<?= base_url() . 'toko/detail/' . $row->id_item; ?>" class="shop-stack-item-content-a">
						<h4 class="shop-stack-product"><?= $row->name_item; ?></h4>
					</a>
					<p class="shop-stack-price">FROM <?= $row->price_item; ?></p>
					<a href="<?= base_url() . 'toko/detail/' . $row->id_item; ?>" class="shop-stack-btn" href="">BELI</a>
				</div>
			</div>
		<?php endforeach ?>
		<?php foreach ($shop as $row) : ?>
			<div class="shop-stack-item">
				<img src="<?= base_url() . 'assets_upload/cover_item/' . $row->cover_item; ?>" alt="">
				<div class="shop-stack-item-content">
					<p class="shop-stack-title">Recently Post</p>
					<a href="<?= base_url() . 'toko/detail/' . $row->id_item; ?>" class="shop-stack-item-content-a">
						<h4 class="shop-stack-product"><?= $row->name_item; ?></h4>
					</a>
					<p class="shop-stack-price">FROM <?= $row->price_item; ?></p>
					<a href="<?= base_url() . 'toko/detail/' . $row->id_item; ?>" class="shop-stack-btn" href="">BELI</a>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</section>

<section class="testimoni">
	<div id="slideer">
		<input type="radio" name="slideer" id="slidee1" checked>
		<input type="radio" name="slideer" id="slidee2">
		<input type="radio" name="slideer" id="slidee3">
		<input type="radio" name="slideer" id="slidee4">
		<div id="slidees">
			<div id="overflow">
				<div class="inner">
					<div class="slidee slidee_1">
						<div class="slidee-content">
							<div class="slidee-text" data-aos="fade" data-aos-duration="1000" data-aos-once="true">
								<p class="slidee-testi">
									<?= $testimoni[0]['description']; ?>
								</p>
								<p class="slidee-name">
									<?= $testimoni[0]['name']; ?>
								</p>
							</div>
						</div>
					</div>
					<div class="slidee slidee_2">
						<div class="slidee-content">
							<div class="slidee-text">
								<p class="slidee-testi">
									<?= $testimoni[1]['description']; ?>
								</p>
								<p class="slidee-name">
									<?= $testimoni[1]['name']; ?>
								</p>
							</div>
						</div>
					</div>
					<div class="slidee slidee_3">
						<div class="slidee-content">
							<div class="slidee-text">
								<p class="slidee-testi">
									<?= $testimoni[2]['description']; ?>
								</p>
								<p class="slidee-name">
									<?= $testimoni[2]['name']; ?>
								</p>
							</div>
						</div>
					</div>
					<div class="slidee slidee_4">
						<div class="slidee-content">
							<div class="slidee-text">
								<p class="slidee-testi">
									<?= $testimoni[3]['description']; ?>
								</p>
								<p class="slidee-name">
									<?= $testimoni[3]['name']; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="bullets2">
			<label for="slidee1"></label>
			<label for="slidee2"></label>
			<label for="slidee3"></label>
			<label for="slidee4"></label>
		</div>
	</div>
</section>


<section class="mn">
	<div class="container">
		<div class="sheet">
			<div class="sheet-content-wrap" data-aos-once="true" data-aos="fade-right" data-aos-offset="200" data-aos-duration="600" data-aos-easing="ease-in-sine">
				<h4>Etalase</h4>
				<p>
					Temukan berbagai promo menarik gratis ongkos kirim dengan berbelanja produk kami.
				</p>
				<a href="<?= base_url() . 'toko' ?>" class="sheet-link" href=""><b>BELANJA</b>&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
			</div>
			<div class="sheet-image-wrap" data-aos-once="true" data-aos="zoom-in">
				<img src="<?= base_url() . 'assets_upload/background/' . $background[1]['cover_background']; ?>" alt="">
			</div>
		</div>
		<div class="sheet">
			<div class="sheet-content-wrap" data-aos-once="true" data-aos="fade-right" data-aos-duration="600" data-aos-easing="ease-in-sine">
				<h4>Aktivitas</h4>
				<p>
					Ikuti kegiatan yg kami lakukan, rasakan pengalaman baru bersama kami
				</p>
				<a href="<?= base_url() . 'aktivitas' ?>" class="sheet-link" href=""><b>LIHAT</b>&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
			</div>
			<div class="sheet-image-wrap" data-aos-once="true" data-aos="zoom-in">
				<img src="<?= base_url() . 'assets_upload/background/' . $background[2]['cover_background']; ?>" alt="">
			</div>
		</div>

		<div class="sheet">
			<div class="sheet-content-wrap" data-aos-once="true" data-aos="fade-right" data-aos-duration="600" data-aos-easing="ease-in-sine">
				<h4>Artikel</h4>
				<p>
					Tambah pengetahuanmu dgn bacaan singkat tulisan original tentang kopi dari kami

				</p>
				<a href="<?= base_url() . 'artikel' ?>" class="sheet-link" href=""><b>BACA</b>&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
			</div>
			<div class="sheet-image-wrap" data-aos-once="true" data-aos="zoom-in">
				<img src="<?= base_url() . 'assets_upload/background/' . $background[3]['cover_background']; ?>" alt="">
			</div>
		</div>

		<div class="sheet">
			<div class="sheet-content-wrap" data-aos-once="true" data-aos="fade-right" data-aos-duration="600" data-aos-easing="ease-in-sine">
				<h4>Galeri</h4>
				<p>
					Ikuti perjalanan kami dari hulu hingga hilir, informasi berupa gambar dan video
				</p>
				<a href="<?= base_url() . 'galeri' ?>" class="sheet-link" href=""><b>LIHAT</b>&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
			</div>
			<div class="sheet-image-wrap" data-aos-once="true" data-aos="zoom-in">
				<img src="<?= base_url() . 'assets_upload/background/' . $background[4]['cover_background']; ?>" alt="">
			</div>
		</div>
	</div>
</section>

<script>
	window.onload = function start() {
		slide();
		slidee();
	}

	function slide() {
		document.getElementById("slide1").checked = true;
		var num = 1,
			style = document.getElementById('slides').style;
		window.setInterval(function() {
			// increase by num 1, reset to 0 at 4
			num = (num + 1) % 5;

			document.getElementById("slide" + num).checked = true;
		}, 5000);
	}

	function slidee() {
		document.getElementById("slidee1").checked = true;
		var num = 1,
			style = document.getElementById('slidees').style;
		window.setInterval(function() {
			// increase by num 1, reset to 0 at 4
			num = (num + 1) % 5;

			document.getElementById("slidee" + num).checked = true;
		}, 5000);
	}
</script>

<?php
$this->load->view('utama/include/footer');
?>