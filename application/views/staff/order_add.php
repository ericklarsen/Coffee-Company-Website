<?php
$this->load->view('include/header_css');
$this->load->view('include/header_sidebar');
$this->load->view('include/header_topbar');
?>

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

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <?php $this->load->view('include/header_breadcumb'); ?>


    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() . 'staff/menu_order/add_action' ?>" method="POST">
                    <!-- <form action="" method="POST"> -->
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="exampleInputEmail1">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan" class="form-control">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="exampleInputEmail1">No. Telp</label>
                                <input type="text" name="telp" class="form-control">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="exampleInputEmail1">No. WhatsApp</label>
                                <input type="text" name="whatsapp" class="form-control">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Tanggal Paket Diterima</label>
                                <input type="date" name="paket_diterima" class="form-control">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Provinsi Pengirim</label>
                                <select class="form-control" name="provinsi" id="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    <?php if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                        foreach ($provinsi['rajaongkir']['results'] as $row) {
                                            echo '<option value=' . $row['province_id'] . '>' . $row['province'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Kota Asal Pengirim</label>
                                <select class="form-control" name="kota" id="kota">
                                    <?php
                                    $curl = curl_init();

                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=" . $this->input->post('provinsi'),
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
                                        $kota = json_decode($response, true);

                                        if ($kota['rajaongkir']['status']['code'] == '200') {
                                            echo '<option>Pilih Kota</option>';
                                            foreach ($kota['rajaongkir']['results'] as $row) {
                                                echo '<option value=' . $row['city_id'] . '>' . $row['city_name'] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="exampleInputEmail1">Provinsi Penerima</label>
                                <select class="form-control" name="provinsi_penerima" id="provinsi_penerima">
                                    <option value="">Pilih Provinsi</option>
                                    <?php
                                    if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                        foreach ($provinsi['rajaongkir']['results'] as $row) {
                                            echo '<option value=' . $row['province_id'] . '>' . $row['province'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="exampleInputEmail1">Kota Asal Penerima</label>
                                <select class="form-control" name="kota_penerima" id="kota_penerima">
                                    <option value="">Pilih Provinsi Dulu</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-2">
                                <label for="exampleInputEmail1">Ekspedisi</label>
                                <select class="form-control" name="ekspedisi" id="ekspedisi">
                                    <option value="">Pilih Ekspedisi</option>
                                    <?php
                                    $eks = ['jne', 'pos', 'tiki'];
                                    for ($i = 0; $i < count($eks); $i++) {
                                        echo '<option value=' . $eks[$i] . ' ' . ($eks[$i] == $this->input->post('ekspedisi') ? 'selected' : '') . '>' . $eks[$i] . '</option>';
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-2">
                                <label for="exampleInputEmail1">Berat (gram)</label>
                                <input type="text" name="berat" id="berat" class="form-control" placeholder="gram" value="<?= $this->input->post('berat') ?>">
                            </div>

                            <div class="form-group col-lg-12">
                                <button type="button" onclick="proses()" class="btn btn-primary mb-2">Proses</button>
                            </div>

                            <div class="form-group col-lg-12" id="data-ekspedisi" >
                                <?php
                                if(!empty($ongkir)){
                                $biaya = json_decode($ongkir, true);
                                if ($biaya['rajaongkir']['status']['code'] == '200') {
                                    foreach ($biaya['rajaongkir']['results'][0]['costs'] as $row) {
                                ?>
                                        <h4><?= $row['service']; ?></h4>
                                        <p><?= $row['description']; ?></p>
                                        <p>Rp. <?= number_format($row['cost'][0]['value'], 0, ',', '.'); ?></p>
                                        <p>Estimasi pengiriman : <?= $row['cost'][0]['etd']; ?> hari</p>
                                <?php
                                    }
                                }
                            }
                                ?>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Alamat</label>
                                <textarea class="form-control" name="alamat"></textarea>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Catatan</label>
                                <textarea class="form-control" name="catatan"></textarea>
                            </div>
                        </div>


                        <br>
                        <h6 class="m-0 font-weight-bold text-primary">Detail Pemesanan</h6>
                        <br>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="">Biji Kopi</label>
                                <?php
                                $item1['Arabica Gayo Grade 1'] = 'Arabica Gayo Grade 1';
                                $item1['Fine Robusta'] = 'Fine Robusta';
                                echo form_dropdown(
                                    array('name' => 'biji_kopi', 'id' => 'biji_kopi', 'class' => 'form-control'),
                                    $item1,
                                );
                                ?>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="">Penyajian Kopi <small>(ada note)</small></label>
                                <?php
                                $item2[''] = 'Pilih Penyajian';
                                $item2['Green Bean Coffee'] = 'Green Bean Coffee';
                                $item2['Roasted Bean Coffee'] = 'Roasted Bean Coffee';
                                echo form_dropdown(
                                    array('name' => 'penyajian_kopi', 'id' => 'penyajian_kopi', 'class' => 'form-control'),
                                    $item2,
                                );
                                ?>
                            </div>

                            <div id="penyajian-note" class="col-lg-12"></div>

                            <div class="form-group col-lg-6">
                                <label for="">Volume Kopi</label>
                                <input type="text" name="volume_kopi" class="form-control">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="">Brewing Method</label>
                                <?php
                                $item3['Manual'] = 'Manual';
                                $item3['Mesin'] = 'Mesin';
                                echo form_dropdown(
                                    array('name' => 'brewing_method', 'id' => 'brewing_method', 'class' => 'form-control'),
                                    $item3,
                                );
                                ?>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="">Roasted Level <small>(ada note)</small></label>
                                <?php
                                $item4['Ya, Saya Pilih Medium to Light Roast'] = 'Ya, Saya Pilih Medium to Light Roast';
                                $item4['Tidak, Saya Punya Permintaan Khusus'] = 'Tidak, Saya Punya Permintaan Khusus';
                                echo form_dropdown(
                                    array('name' => 'roasted_level', 'id' => 'roasted_level', 'class' => 'form-control'),
                                    $item4,
                                );
                                ?>
                            </div>

                            <div id="roasted_level-note" class="col-lg-12">
                                <input type="hidden" name="roasted_level_note" value="">
                            </div>

                        </div>



                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!--Row-->

</div>
<!---Container Fluid-->

<?php $this->load->view('include/header_footer'); ?>