<?php
$this->load->view('include/header_css');
$this->load->view('include/header_sidebar');
$this->load->view('include/header_topbar');
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <?php $this->load->view('include/header_breadcumb'); ?>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data</h6>
                </div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?= base_url() . 'staff/menu_email/edit_action' ?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <input type="text" class="form-control" value="<?= $data->keterangan; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" class="form-control" value="<?= $data->email; ?>">
                        </div>

                        <?php if ($data->keterangan == 'smtp') { ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password" class="form-control" value="<?= $data->password; ?>">
                            </div>
                        <?php }else{ ?> 
                        <input type="hidden" name="password" value="">
                        <?php } ?>

                        <input type="hidden" name="id_email" value="<?= $data->id_email; ?>">

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