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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url().'staff/menu_orderAnother/add_action'?>" method="POST">
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
                            <div class="form-group col-lg-6">
                                <label for="">Item</label>
                                <?php
                                echo form_dropdown(
                                    array('name' => 'id_item', 'id' => 'id_item', 'class' => 'form-control'),
                                    $item,
                                );
                                ?>
                            </div>

                            <input type="hidden" name="name" value="Merchandise">
                            <input type="hidden" name="name_item" value="Gokil">

                            <div class="form-group col-lg-6">
                                <label for="">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control">
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
