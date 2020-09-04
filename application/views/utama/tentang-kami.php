<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-about.css">
<script src="<?= base_url() . 'assets_home/sweet-alert/sweetalert2.all.min.js'; ?>"></script>

<div class="divider"></div>

<section class="about">
	<div class="about-header">
		<div class="about-header-border"></div>
		<img class="" src="<?= base_url() . 'assets_upload/background/' . $background[6]['cover_background']; ?>" alt="">
		<div class="about-content container">
			<div class="about-content-title">
				<div class="line" data-aos="zoom-out-left" data-aos-duration="1000" data-aos-once="true"></div>
				<h1 data-aos="zoom-out-down" data-aos-duration="1000" data-aos-once="true">Tentang Kami</h1>
				<div class="line" data-aos="zoom-out-right" data-aos-duration="1000" data-aos-once="true"></div>
			</div>
			<p data-aos="fade" data-aos-duration="1000" data-aos-once="true">Berminat menjadi mitra, atau ada kendala dalam melakukan orderan, mohon diinformasikan bagaimana kami bisa membantu anda.</p>
		</div>
	</div>

	<div class="about-wrap">
		<h4 data-aos="fade" data-aos-duration="1000" data-aos-once="true">
			”Cara terbaik mendamaikan dunia yang fana ini yaitu duduk bersama-sama sambil minum <b>KOPI MAHAL</b>.”
		</h4>
		<div class="about-divider" data-aos="zoom-out-right" data-aos-duration="1000" data-aos-once="true"></div>
		<p data-aos="fade" data-aos-duration="1000" data-aos-once="true">
			Para pendiri KOMA dipertemukan pada tahun 2017, berangkat dari obrolan sederhana disalah satu ladang kopi. KOMA berdiri sebagai bentuk UMKM bergerak bidang kopi dengan semangat yang bertujuan untuk menyediakan seduhan kopi segar terbaik untuk para pecinta kopi. KOMA bertujuan untuk tumbuh dengan cepat, kuat, bersaing secara kualitas serta dapat membawa kesejahteraan kehidupan khususnya para petani kopi di sekitar kami.
		</p>
		<p>
			Bersama-sama jaringan para petani & pecinta kopi serta pengalaman, kami menggunakan proses terbaru untuk alat dan campuran biji kopi kami. Langsung dari petani terpilih, biji kopi berkualitas tinggi diproses dan disangrai hingga sempurna oleh kami sendiri lalu diteruskan dgn semangat untuk siap disajikan dalam cangkir kopi anda untuk mendapatkan kebahagiaan serta kepuasan Anda secara khusus.
		</p>

		<div class="about-divider" data-aos="zoom-out-left" data-aos-duration="1000" data-aos-once="true"></div>

		<div class="about-mitra" data-aos="fade" data-aos-duration="1000" data-aos-once="true">
			<h4>
				Sebaran Mitra
			</h4>
			<div class="about-mitra-icon">
				<img src="<?= base_url() . 'assets_home/img/petas.gif'; ?>" width="700px" alt="">
				<!-- <div class="about-mitra-text">
					<span class="title">10</span>
					<span>Provinsi</span>
				</div> -->
			</div>
		</div>
	</div>

</section>

<?php
$this->load->view('utama/include/footer');
?>