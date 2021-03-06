<?php
$this->load->view('include/header_css');
$this->load->view('include/header_sidebar');
$this->load->view('include/header_topbar');
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <?php $this->load->view('include/header_breadcumb'); ?>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Kode Order</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $detail->id_order_form; ?></h6>
                        </div>

                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Tipe Pemesanan</small>
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php if ($detail->opsiPesanan == '0') {
                                    echo 'Pesan Untuk Sendiri';
                                } else {
                                    echo 'Pesan Untuk Orang Lain';
                                }  ?>
                            </h6>
                        </div>

                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Status</small>
                            <?php if ($detail->status == 'Belum Selesai') { ?>
                                <h6 class="m-0 font-weight-bold text-danger"><?= $detail->status; ?></h6>
                            <?php } else { ?>
                                <h6 class="m-0 font-weight-bold text-success"><?= $detail->status; ?></h6>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        $biji = '';
        $penyajian = '';
        $brewing = '';

        foreach ($kopiOption as $row) {
            if($row->option == 'biji'){
                if($row->id_kopiOption == $detail->biji_kopi){
                    $biji = $row->name;
                }
            }elseif($row->option == 'penyajian'){
                if($row->id_kopiOption == $detail->penyajian_kopi){
                    $penyajian = $row->name;
                }
            }elseif($row->option == 'brewing'){
                if($row->id_kopiOption == $detail->brewing_method){
                    $brewing = $row->name;
                }
            }
        }
        ?>


        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Biji Kopi</small>
                            <h6 class="m-0 font-weight-bold text-primary">
                            <?= $biji; ?>
                            </h6>
                        </div>

                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Penyajian Kopi</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $penyajian; ?></h6>
                        </div>

                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Volume Kopi</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $detail->volume_kopi; ?> gram</h6>
                        </div>

                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Brewing Method</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $brewing; ?></h6>
                        </div>

                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Roasted Level</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $detail->roasted_level; ?></h6>
                        </div>

                        <div class="form-group col-lg-4">
                            <small for="exampleInputEmail1">Roasted Level Note</small>
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php if (empty($detail->roasted_level_note)) {
                                    echo '-';
                                } else {
                                    echo $detail->roasted_level_note;
                                } ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($detail->opsiPesanan == '1') { ?>
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <small for="exampleInputEmail1">Nama Pengirim</small>
                                <h6 class="m-0 font-weight-bold text-primary"><?= $detail->nama_pengirim; ?></h6>
                            </div>

                            <div class="form-group col-lg-3">
                                <small for="exampleInputEmail1">WhatsApp Pengirim</small>
                                <h6 class="m-0 font-weight-bold text-primary"><?= $detail->whatsapp_pengirim; ?></h6>
                            </div>

                            <div class="form-group col-lg-3">
                                <small for="exampleInputEmail1">Telepon Pengirim</small>
                                <h6 class="m-0 font-weight-bold text-primary"><?= $detail->telp_pengirim; ?></h6>
                            </div>

                            <div class="form-group col-lg-3">
                                <small for="exampleInputEmail1">Email Pengirim</small>
                                <h6 class="m-0 font-weight-bold text-primary"><?= $detail->email_pengirim; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <small for="exampleInputEmail1">Nama Pemesan</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $detail->nama_pemesan; ?></h6>
                        </div>

                        <div class="form-group col-lg-3">
                            <small for="exampleInputEmail1">Telepon Pemesan</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $detail->telp; ?></h6>
                        </div>

                        <div class="form-group col-lg-3">
                            <small for="exampleInputEmail1">WhatsApp</small>
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php if (empty($detail->whatsapp)) echo '-';
                                echo $detail->whatsapp; ?>
                            </h6>
                        </div>


                        <div class="form-group col-lg-3">
                            <small for="exampleInputEmail1">Email</small>
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php if (empty($detail->email)) echo '-';
                                echo $detail->email; ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <small for="exampleInputEmail1">Alamat</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $detail->alamat; ?></h6>
                            <small class="m-0  font-weight-bold text-primary"><?= 'Kelurahan ' . $detail->kelurahan . ', Kecamatan ' . $detail->kecamatan; ?></small><br>
                            <small class="m-0 font-weight-bold text-primary"><?= $detail->kota . ', ' . $detail->provinsi; ?></small>
                        </div>

                        <div class="form-group col-lg-6">
                            <small for="exampleInputEmail1">Catatan</small>
                            <h6 class="m-0 font-weight-bold text-primary"><?= $detail->catatan; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!---Container Fluid-->

<?php $this->load->view('include/header_footer'); ?>