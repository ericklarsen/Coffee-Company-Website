<?php
$this->load->view('utama/include/header');
?>

<!-- ---- LOCAL CSS ------ -->
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-store-detail.css">
<link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-menu-mid.css">
<script src="<?= base_url() . 'assets_home/sweet-alert/sweetalert2.all.min.js'; ?>"></script>

<style>
    .detail-image img {
        width: 100%;
        height: 450px;
        object-fit: cover;
    }
</style>

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: bc9abcdefb6ecc5c865718b8396e1bc6"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $provinsi = json_decode($response, true);
}
?>

<section class="detail">
    <div class="container">
        <div class="detail-wrap">
            <div class="detail-image">
                <div class="detail-image-title">
                    <span>Kopi</span>
                    <h1>RACIK KOPI ANDA!</h1>

                </div>
                <img src="<?= base_url() . 'assets_upload/background/' . $background[7]['cover_background']; ?>" alt="" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-once="true">
                <div class="detail-image-price">
                    <span class="price-disc">aaaa</span>
                    <span>vasas</span>
                </div>
            </div>
            <div class="detail-info">
                <div class="detail-info-content" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
                    <span>Kopi</span>
                    <h1>RACIK KOPI ANDA!</h1>
                </div>
                <form action="<?= base_url() . 'utama/kopi/pesan' ?>" method="POST" id="toko-form">
                    <div class="detail-info-form">
                        <div class="form-short" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                            <label for="">Biji Kopi</label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'biji_kopi', 'id' => 'biji_kopi', 'class' => 'form-input'),
                                $biji
                            );
                            ?>
                            <input type="hidden" name="name_biji_kopi" id="name_biji_kopi">
                        </div>


                        <div class="form-short" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                            <label for="">Penyajian Kopi</label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'penyajian_kopi', 'id' => 'penyajian_kopi', 'class' => 'form-input'),
                                $penyajian
                            );
                            ?>
                            <input type="hidden" name="name_penyajian_kopi" id="name_penyajian_kopi">
                        </div>

                        <div class="form-short" id="biji-note">
                        </div>

                        <div class="form-short" id="penyajian-note">
                        </div>

                        <div class="form-short" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                            <label for="">Volume Kopi (gram)</label>
                            <input type="number" name="volume_kopi" id="volume_kopi" class="form-input" placeholder="gram" min="0" value="">
                        </div>

                        <div class="form-short" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                            <label for="">Brewing Method</label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'brewing_method', 'id' => 'brewing_method', 'class' => 'form-input'),
                                $brewing
                            );
                            ?>
                            <input type="hidden" name="name_brewing_method" id="name_brewing_method">
                        </div>

                        <div class="form-short">
                        </div>  

                        <div class="form-short" id="brewing-note">
                        </div>

                        <div class="form-long" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                            <label for="">Roasted Level</label>
                            <?php
                            $item4[''] = 'Pilih Roasted level';
                            $item4['Ya, Saya Pilih Medium to Light Roast'] = 'Ya, Saya Pilih Medium to Light Roast';
                            $item4['Tidak, Saya Punya Permintaan Khusus'] = 'Tidak, Saya Punya Permintaan Khusus';
                            echo form_dropdown(
                                array('name' => 'roasted_level', 'id' => 'roasted_level', 'class' => 'form-input'),
                                $roasted
                            );
                            ?>
                            <input type="hidden" name="name_roasted_level" id="name_roasted_level">
                        </div>

                        <!-- <div class="form-short" id="roasted_level-note">
                        </div> -->

                        <div id="roasted_level-note" class="form-long">
                            <input type="hidden" name="roasted_level_note" value="">
                        </div>

                        <div class="form-long" id="opsiPesanan-form2">
                            <label for="">Pilih Opsi Pesanan</label>
                            <select class="form-input" name="opsiPesanan2" id="opsiPesanan2">
                                <option value="none">Pilih Opsi</option>
                                <option value="0">Pesan Untuk Sendiri</option>
                                <option value="1">Pesan Untuk Orang Lain</option>
                            </select>
                        </div>

                        <div class="form-button-small">
                            <button type="button" id="check-btn2">Check Out</button>
                        </div>

                        <div class="form-data-small" id="pesanSendiri-sm">
                            <div class="form-long">
                                <h5>Form Detail Pemesanan</h5>
                                <small>Semua produk kopi mahal akan dikirim dari Provinsi Aceh dengan koordinasi terlebih dahulu dari admin pengiriman kepada pemesan.</small>
                                <span>Harap diisi dengan teliti</span>
                            </div>
                            <div class="form-short">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama_pemesan2" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Telp<small><i>(Aktif)</i></small></label>
                                <input type="text" name="telp2" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">WhatsApp<small><i>(Aktif)</i></small></label>
                                <input type="text" name="whatsapp2" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Email<small><i>(Aktif)</i></small></label>
                                <input type="text" name="email2" class="form-input">
                            </div>

                            <div class="form-long">
                                <label for="">Catatan</label>
                                <textarea class="form-input" name="catatan2"></textarea>
                            </div>
                            <div class="form-long">
                                <label for="">Alamat</label>
                                <textarea class="form-input" name="alamat2"></textarea>
                            </div>

                            <div class="form-short">
                                <label for="">Kelurahan</label>
                                <input type="text" name="kelurahan2" class="form-input">
                            </div>

                            <div class="form-short">
                                <label for="">Kecamatan</label>
                                <input type="text" name="kecamatan2" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Provinsi</label>
                                <select class="form-input" name="provinsi_penerima2" id="provinsi_penerima2">
                                    <option value="">Pilih Provinsi</option>
                                    <?php
                                    if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                        foreach ($provinsi['rajaongkir']['results'] as $row) {
                                            echo '<option value=' . $row['province_id'] . '>' . $row['province'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-short">
                                <label for="">Kota</label>
                                <select class="form-input" name="kota_penerima2" id="kota_penerima2">
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>

                            <input type="hidden" name="name_kota_penerima2" id="name_kota_penerima2">
                            <input type="hidden" name="name_provinsi_penerima2" id="name_provinsi_penerima2">

                            <div class="form-long">
                                <label for="">Ekspedisi</label>
                                <select class="form-input" name="ekspedisi2" id="ekspedisi2">
                                    <option value="">Pilih Ekspedisi</option>
                                    <?php
                                    $eks = ['jne', 'pos'];
                                    for ($i = 0; $i < count($eks); $i++) {
                                        echo '<option value=' . $eks[$i] . ' ' . ($eks[$i] == $this->input->post('ekspedisi') ? 'selected' : '') . '>' . $eks[$i] . '</option>';
                                    } ?>
                                </select>
                            </div>

                            <div class="form-ekspedisi" id="data-ekspedisi2">
                            </div>

                            <div class="form-button-small2">
                                <button type="button" class="mr-3" onclick="proses2()">cek ongkir</button>
                                <button type="button" onclick="submitBtn('pesan')">pesan</button>
                            </div>
                            <div class="form-button-small2 mt-3">
                                <button type="button" onclick="backBtnSm()">Back</button>
                            </div>

                        </div>

                        <div class="form-data-small" id="pesanOrangLain-sm">
                            <div class="form-long">
                                <h5>Form Detail Pemesanan</h5>
                                <small>Semua produk kopi mahal akan dikirim dari Provinsi Aceh dengan koordinasi terlebih dahulu dari admin pengiriman kepada pemesan.</small>
                            </div>
                            <div class="form-short">
                                <label for="">Nama Pengirim</label>
                                <input type="text" name="nama_pengirim4" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Telp<small><i>(Aktif)</i></small></label>
                                <input type="text" name="telp_pengirim4" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">WhatsApp<small><i>(Aktif)</i></small></label>
                                <input type="text" name="whatsapp_pengirim4" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Email<small><i>(Aktif)</i></small></label>
                                <input type="text" name="email_pengirim4" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan4" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Telp<small><i>(Aktif)</i></small></label>
                                <input type="text" name="telp4" class="form-input">
                            </div>
                            <div class="form-long">
                                <label for="">Catatan</label>
                                <textarea class="form-input" name="catatan4"></textarea>
                            </div>
                            <div class="form-long">
                                <label for="">Alamat</label>
                                <textarea class="form-input" name="alamat4"></textarea>
                            </div>

                            <div class="form-short">
                                <label for="">Kelurahan</label>
                                <input type="text" name="kelurahan4" class="form-input">
                            </div>

                            <div class="form-short">
                                <label for="">Kecamatan</label>
                                <input type="text" name="kecamatan4" class="form-input">
                            </div>
                            <div class="form-short">
                                <label for="">Provinsi</label>
                                <select class="form-input" name="provinsi_penerima4" id="provinsi_penerima4">
                                    <option value="">Pilih Provinsi</option>
                                    <?php
                                    if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                        foreach ($provinsi['rajaongkir']['results'] as $row) {
                                            echo '<option value=' . $row['province_id'] . '>' . $row['province'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-short">
                                <label for="">Kota</label>
                                <select class="form-input" name="kota_penerima4" id="kota_penerima4">
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>

                            <input type="hidden" name="name_kota_penerima4" id="name_kota_penerima4">
                            <input type="hidden" name="name_provinsi_penerima4" id="name_provinsi_penerima4">

                            <div class="form-long">
                                <label for="">Ekspedisi</label>
                                <select class="form-input" name="ekspedisi4" id="ekspedisi4">
                                    <option value="">Pilih Ekspedisi</option>
                                    <?php
                                    $eks = ['jne', 'pos'];
                                    for ($i = 0; $i < count($eks); $i++) {
                                        echo '<option value=' . $eks[$i] . ' ' . ($eks[$i] == $this->input->post('ekspedisi') ? 'selected' : '') . '>' . $eks[$i] . '</option>';
                                    } ?>
                                </select>
                            </div>

                            <div class="form-ekspedisi" id="data-ekspedisi4">
                            </div>

                            <div class="form-button-small2">
                                <button type="button" class="mr-3" onclick="proses4()">cek ongkir</button>
                                <button type="button" onclick="submitBtn('pesan')">pesan</button>
                            </div>
                            <div class="form-button-small2 mt-3">
                                <button type="button" onclick="backBtnSm()">Back</button>
                            </div>

                        </div>

                        <div class="form-button">
                            <button type="button">pesan</button>
                            <input type="checkbox" id="check-btn" class="check-btn">
                            <div class="form-info-client" id="myModal">
                                <div class="form-content">
                                    <div class="form-header">
                                        <div class="word">
                                            <h4>Form Pesanan</h4>
                                            <p>Semua produk kopi mahal akan dikirim dari Provinsi Aceh dengan koordinasi terlebih dahulu dari admin pengiriman kepada pemesan.</p>
                                        </div>
                                        <img src="<?= base_url() . 'assets_home/'; ?>img/logokopimahal-01.svg" alt="">
                                    </div>

                                    <div class="form-data" id="opsiPesanan-form">
                                        <div class="form-long">
                                            <label for="">Pilih Opsi</label>
                                            <select class="form-input" name="opsiPesanan" id="opsiPesanan">
                                                <option value="none">Pilih Opsi</option>
                                                <option value="0">Pesan Untuk Sendiri</option>
                                                <option value="1">Pesan Untuk Orang Lain</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div id="pesanSendiri">
                                        <div class="form-data">
                                            <div class="form-x-short">
                                                <label for="">Nama Lengkap</label>
                                                <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-input">
                                            </div>

                                            <div class="form-x-short">
                                                <label for="">No. Telp</label>
                                                <input type="text" name="telp" id="telp" class="form-input">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">No. WhatsApp</label>
                                                <input type="text" name="whatsapp" id="whatsapp" class="form-input">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Email</label>
                                                <input type="text" class="form-input" name="email" id="email">
                                            </div>

                                            <div class="form-long">
                                                <label for="">Catatan</label>
                                                <textarea class="form-input" name="catatan" id="catatan"></textarea>
                                            </div>
                                            <div class="form-short">
                                                <label for="">Alamat</label>
                                                <textarea class="form-input" name="alamat" id="alamat"></textarea>
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Kelurahan</label>
                                                <input type="text" name="kelurahan" class="form-input" id="kelurahan">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Kecamatan</label>
                                                <input type="text" name="kecamatan" class="form-input" id="kecamatan">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Provinsi</label>
                                                <select class="form-input" name="provinsi_penerima" id="provinsi_penerima">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php
                                                    if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                                        foreach ($provinsi['rajaongkir']['results'] as $row) {
                                                            echo '<option value=' . $row['province_id'] . '>' . $row['province'] . '</option>';
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Kota</label>
                                                <select class="form-input" name="kota_penerima" id="kota_penerima">
                                                    <option value='null'>Pilih Kota</option>
                                                </select>
                                            </div>

                                            <input type="hidden" name="name_kota_penerima" id="name_kota_penerima">
                                            <input type="hidden" name="name_provinsi_penerima" id="name_provinsi_penerima">

                                            <div class="form-x-short">
                                                <label for="">Ekspedisi</label>
                                                <select class="form-input" name="ekspedisi" id="ekspedisi">
                                                    <option value="">Pilih Ekspedisi</option>
                                                    <?php
                                                    $eks = ['jne', 'pos'];
                                                    for ($i = 0; $i < count($eks); $i++) {
                                                        echo '<option value=' . $eks[$i] . ' ' . ($eks[$i] == $this->input->post('ekspedisi') ? 'selected' : '') . '>' . $eks[$i] . '</option>';
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="form-x-short">
                                                <label for="">Klik cek ongkir</label>
                                                <button type="button" onclick="proses()">cek ongkir</button>

                                            </div>

                                            <div class="form-loading">
                                                <img src="<?= base_url() . 'assets_home/img/loading3.gif' ?>" style="width: 100px;" alt="">
                                            </div>

                                            <div class="form-ekspedisi" id="data-ekspedisi">
                                            </div>

                                            <div class="form-button">
                                                <button type="button" onclick="backBtn()" class="mr-2">Back</button>
                                                <button type="button" onclick="closeBtn()" class="mr-2">close</button>
                                                <button type="button" onclick="submitBtn('pesan')">pesan</button>
                                            </div>

                                        </div>

                                    </div>


                                    <div id="pesanOrangLain">
                                        <div class="form-data">
                                            <div class="form-x-short">
                                                <label for="">Nama Pengirim</label>
                                                <input type="text" name="nama_pengirim3" id="nama_pengirim" class="form-input">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Telp. pengirim<small><i>(Aktif)</i></small></label>
                                                <input type="text" name="telp_pengirim3" id="telp_pengirim" class="form-input">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">WhatsApp<small><i>(Aktif)</i></small></label>
                                                <input type="text" name="whatsapp_pengirim3" id="whatsapp_pengirim" class="form-input">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Email<small><i>(Aktif)</i></small></label>
                                                <input type="text" class="form-input" name="email_pengirim3" id="email_pengirim">
                                            </div>

                                            <div class="form-x-short">
                                                <label for="">Nama Pemesan</label>
                                                <input type="text" class="form-input" name="nama_pemesan3" id="nama_pemesan">
                                            </div>

                                            <div class="form-x-short">
                                                <label for="">Telp. Pemesan <small><i>(Aktif)</i></small></label>
                                                <input type="text" class="form-input" name="telp3" id="telp">
                                            </div>

                                            <div class="form-short">
                                                <label for="">Catatan</label>
                                                <textarea class="form-input" name="catatan3" id="catatan"></textarea>
                                            </div>

                                            <div class="form-short">
                                                <label for="">Alamat</label>
                                                <textarea class="form-input" name="alamat3" id="alamat"></textarea>
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Kelurahan</label>
                                                <input type="text" name="kelurahan3" class="form-input" id="kelurahan">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Kecamatan</label>
                                                <input type="text" name="kecamatan3" class="form-input" id="kecamatan">
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Provinsi</label>
                                                <select class="form-input" name="provinsi_penerima3" id="provinsi_penerima3">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php
                                                    if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                                        foreach ($provinsi['rajaongkir']['results'] as $row) {
                                                            echo '<option value=' . $row['province_id'] . '>' . $row['province'] . '</option>';
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-x-short">
                                                <label for="">Kota</label>
                                                <select class="form-input" name="kota_penerima3" id="kota_penerima3">
                                                    <option value='null'>Pilih Kota</option>
                                                </select>
                                            </div>

                                            <input type="hidden" name="name_kota_penerima3" id="name_kota_penerima3">
                                            <input type="hidden" name="name_provinsi_penerima3" id="name_provinsi_penerima3">

                                            <div class="form-x-short">
                                                <label for="">Ekspedisi</label>
                                                <select class="form-input" name="ekspedisi3" id="ekspedisi3">
                                                    <option value="">Pilih Ekspedisi</option>
                                                    <?php
                                                    $eks = ['jne', 'pos'];
                                                    for ($i = 0; $i < count($eks); $i++) {
                                                        echo '<option value=' . $eks[$i] . ' ' . ($eks[$i] == $this->input->post('ekspedisi') ? 'selected' : '') . '>' . $eks[$i] . '</option>';
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="form-x-short">
                                                <label for="">Klik cek ongkir</label>
                                                <button type="button" onclick="proses3()">cek ongkir</button>

                                            </div>

                                            <div class="form-loading3">
                                                <img src="<?= base_url() . 'assets_home/img/loading3.gif' ?>" style="width: 100px;" alt="">
                                            </div>

                                            <div class="form-ekspedisi" id="data-ekspedisi3">
                                            </div>

                                            <div class="form-button">
                                                <button type="button" onclick="backBtn()" class="mr-2">Back</button>
                                                <button type="button" onclick="closeBtn()" class="mr-2">close</button>
                                                <button type="button" onclick="submitBtn('pesan')">pesan</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>

            </div>

        </div>
    </div>
</section>


<section class="shop">
    <div class="shop-header">
        <h2>Rekomendasi</h2>
        <a href="<?= base_url() . 'utama/toko'; ?>" class="sheet-link" href="">KEMBALI KE ETALASE&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
    </div>
    <div class="shop-stack container">
        <?php foreach ($rekomendasi as $row) : ?>
            <div class="shop-stack-item" >
                <img src="<?= base_url() . 'assets_upload/cover_item/' . $row->cover_item ?>" alt="">
                <div class="shop-stack-item-content">
                    <p class="shop-stack-title"><?= $row->name ?></p>
                    <h4 class="shop-stack-product"><?= $row->name_item ?></h4>
                    <p class="shop-stack-price">FROM <?= $row->price_item ?></p>
                    <a href="<?= base_url() . 'utama/toko/detail/' . $row->id_item; ?>" class="shop-stack-btn" href="">BELI</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>


<script>
    window.onload = function start() {
        formHide();
    }

    function formHide() {
        document.getElementById("pesanSendiri").style.display = "none";
        document.getElementById("pesanOrangLain").style.display = "none";
        document.getElementById("pesanSendiri-sm").style.display = "none";
        document.getElementById("pesanOrangLain-sm").style.display = "none";
    }

    var modal = document.getElementById("myModal");
    var modal2 = document.getElementById("myModal2");
    const checkBtn = document.querySelector('.check-btn');
    const checkBtn2 = document.querySelector('.check-btn2');
    const form = document.querySelector('.form-info-client');
    const form2 = document.querySelector('.form-data-small');
    const form3 = document.querySelector('.form-button-small');
    const body = document.querySelector('.bodys');

    // data


    checkBtn.addEventListener('click', function() {
        var volume_kopi = document.getElementById("volume_kopi").value;
        var biji_kopi = document.getElementById("biji_kopi").value;
        var penyajian_kopi = document.getElementById("penyajian_kopi").value;
        var brewing_method = document.getElementById("brewing_method").value;
        var roasted_level = document.getElementById("roasted_level").value;

        if (volume_kopi === "" || biji_kopi === "" || penyajian_kopi === "" || brewing_method === "" || roasted_level === "") {
            Swal.fire({
                icon: 'error',
                title: '<h3>Gagal</h3>',
                html: '<small> Harap melengkapi seluruh form data! </small>',
            })
        } else {
            form.classList.toggle('show-up');
            body.classList.toggle('overflow-on');
        }
    });

    // checkBtn2.addEventListener('click', function() {
    //     form2.classList.toggle('show');
    //     form3.classList.toggle('none');
    //     document.getElementById("opsiPesanan-form2").style.display = "flex";
    // });

    window.onclick = function(event) {
        if (event.target == modal) {
            form.classList.remove("show-up");
            body.classList.remove("overflow-on");
            document.getElementById("check-btn").checked = false;
        }
    }

    function closeBtn() {
        form.classList.remove("show-up");
        body.classList.remove("overflow-on");
    }

    function backBtn() {
        document.getElementById("pesanSendiri").style.display = "none";
        document.getElementById("pesanOrangLain").style.display = "none";
        document.getElementById("opsiPesanan-form").style.display = "flex";
        document.getElementById("opsiPesanan").value = 'none';
        document.getElementById("nama_pemesan").value = '';
        document.getElementById("telp").value = '';
        document.getElementById("whatsapp").value = '';
        document.getElementById("email").value = '';
        document.getElementById("catatan").value = '';
        document.getElementById("alamat").value = '';
        document.getElementById("kelurahan").value = '';
        document.getElementById("kecamatan").value = '';
        document.getElementById("provinsi_penerima").value = '';
        document.getElementById("kota_penerima").value = '';
        document.getElementById("ekspedisi").value = '';
        document.getElementById('data-ekspedisi').innerHTML = '';
    }

    function backBtnSm() {
        document.getElementById("pesanSendiri-sm").style.display = "none";
        document.getElementById("pesanOrangLain-sm").style.display = "none";
        document.getElementById("opsiPesanan-form2").style.display = "flex";
        document.querySelector(".form-button-small").style.display = "flex";
        document.getElementById("opsiPesanan").value = 'none';
        document.getElementById("nama_pemesan").value = '';
        document.getElementById("telp").value = '';
        document.getElementById("whatsapp").value = '';
        document.getElementById("email").value = '';
        document.getElementById("catatan").value = '';
        document.getElementById("alamat").value = '';
        document.getElementById("kelurahan").value = '';
        document.getElementById("kecamatan").value = '';
        document.getElementById("provinsi_penerima").value = '';
        document.getElementById("kota_penerima").value = '';
        document.getElementById("ekspedisi").value = '';
        document.getElementById('data-ekspedisi').innerHTML = '';
    }

    document.getElementById('provinsi_penerima').addEventListener('change', function() {
        fetch("<?= base_url() . 'utama/kota/'; ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('kota_penerima').innerHTML = data
                document.getElementById("name_provinsi_penerima").value = $('#provinsi_penerima option:selected').text()
            })
    })

    document.getElementById('kota_penerima').addEventListener('change', function() {
        document.getElementById("name_kota_penerima").value = $('#kota_penerima option:selected').text()
    })

    function proses() {
        var kota = 59;
        var kota_penerima = $('#kota_penerima').val();
        var berat = $('#volume_kopi').val();
        var ekspedisi = $('#ekspedisi').val();

        const form = document.querySelector('.form-loading');
        form.classList.toggle('show');


        fetch("<?= base_url() . 'utama/cost/'; ?>" + kota + "/" + kota_penerima + "/" + berat + "/" + ekspedisi, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                form.classList.remove('show');
                console.log(data)
                document.getElementById('data-ekspedisi').innerHTML = data
            })
    }


    document.getElementById('provinsi_penerima2').addEventListener('change', function() {
        fetch("<?= base_url() . 'utama/kota/'; ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('kota_penerima2').innerHTML = data
                document.getElementById("name_provinsi_penerima2").value = $('#provinsi_penerima2 option:selected').text()
            })
    })

    document.getElementById('kota_penerima2').addEventListener('change', function() {
        document.getElementById("name_kota_penerima2").value = $('#kota_penerima2 option:selected').text()
    })

    function proses2() {
        var kota = 59;
        var kota_penerima = $('#kota_penerima2').val();
        var berat = $('#volume_kopi').val();
        var ekspedisi = $('#ekspedisi2').val();

        fetch("<?= base_url() . 'utama/cost/'; ?>" + kota + "/" + kota_penerima + "/" + berat + "/" + ekspedisi, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('data-ekspedisi2').innerHTML = data
            })
    }

    document.getElementById('provinsi_penerima3').addEventListener('change', function() {
        fetch("<?= base_url() . 'utama/kota/'; ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('kota_penerima3').innerHTML = data
                document.getElementById("name_provinsi_penerima3").value = $('#provinsi_penerima3 option:selected').text()
            })
    })

    document.getElementById('kota_penerima3').addEventListener('change', function() {
        document.getElementById("name_kota_penerima3").value = $('#kota_penerima3 option:selected').text()
    })

    function proses3() {
        var kota = 59;
        var kota_penerima = $('#kota_penerima3').val();
        var berat = $('#volume_kopi').val();
        var ekspedisi = $('#ekspedisi3').val();

        const form = document.querySelector('.form-loading3');
        form.classList.toggle('show');

        fetch("<?= base_url() . 'utama/cost/'; ?>" + kota + "/" + kota_penerima + "/" + berat + "/" + ekspedisi, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                form.classList.remove('show');
                console.log(data)
                document.getElementById('data-ekspedisi3').innerHTML = data
            })
    }

    document.getElementById('provinsi_penerima4').addEventListener('change', function() {
        fetch("<?= base_url() . 'utama/kota/'; ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('kota_penerima4').innerHTML = data
                document.getElementById("name_provinsi_penerima4").value = $('#provinsi_penerima4 option:selected').text()
            })
    })

    document.getElementById('kota_penerima4').addEventListener('change', function() {
        document.getElementById("name_kota_penerima4").value = $('#kota_penerima4 option:selected').text()
    })

    function proses4() {
        var kota = 59;
        var kota_penerima = $('#kota_penerima4').val();
        var berat = $('#volume_kopi').val();
        var ekspedisi = $('#ekspedisi4').val();

        fetch("<?= base_url() . 'utama/cost/'; ?>" + kota + "/" + kota_penerima + "/" + berat + "/" + ekspedisi, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('data-ekspedisi4').innerHTML = data
            })
    }
</script>

<?php
$this->load->view('utama/include/footer');
?>