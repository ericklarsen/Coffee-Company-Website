<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-contact.css">
<script src="<?= base_url() . 'assets_home/sweet-alert/sweetalert2.all.min.js'; ?>"></script>

<?php if ($this->session->flashdata('message')) { ?>
    <script type="text/javascript">
        Swal.fire(
            '<h3>Pesan Berhasil Dikirim!</h3>',
            '<small>Terima kasih telah menggunakan fitur ini, Harap menunggu balasan admin melalui WhatsApp</small>',
            'success'
        )
    </script>
<?php } elseif ($this->session->flashdata('error')) { ?>
    <script type="text/javascript">
        Swal.fire(
            '<h3>Pesan Gagal!</h3>',
            '<small>Harap mengisi seluruh form dengan lengkap!</small>',
            'error'
        )
    </script>
<?php } ?>

<section class="contact">
    <div class="container">
        <div class="page-header" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
            <h1 data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">Kontak Kami</h1>
            <p data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                Berminat menjadi mitra, atau ada kendala dalam melakukan orderan, mohon diinformasikan bagaimana kami bisa membantu anda.
            </p>
        </div>
        <div class="page-content">
            <div class="form-bar">
                <form action="<?= base_url() . 'kontak-kami/kirim' ?>" method="POST">
                    <div class="row" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                        <div class="form-group col-lg-6 col-sm-6">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                        <div class="form-group col-lg-6 col-sm-6">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                        <div class="form-group col-lg-6 col-sm-6">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group col-lg-6 col-sm-6">
                            <label for="">WhatsApp</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group col-lg-12 col-sm-12">
                            <label for="">Message</label>
                            <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                            <button class="btn-form"><b>Send</b></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="side-bar" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                <div class="side-bar-section">
                    <h4>Email</h4>
                    <p>biji@kopimahal.com</p>
                </div>
                <div class="side-bar-section">
                    <h4>Lokasi</h4>
                    <p>
                        Desa Wih Pesam
                        Kecamatan Bukit
                        Kabupaten Bener Meriah
                        Provinsi Aceh, Indonesia
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('utama/include/footer');
?>