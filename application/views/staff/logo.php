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
                    <h6 class="m-0 font-weight-bold text-primary">Ganti Logo</h6>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?= base_url().'staff/logo/edit_action'?>" method="POST">
                         <div class="form-group">
                            <label for="exampleInputEmail1">Upload Logo <small><i>(Mohon upload logo dengan ukuran - Width : 150px & Height : 130px)</i></small></label>
                            <input type="file" name="cover_logo" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <input type="hidden" name="id_logo" value="1">
                            <input type="hidden" name="cover_logo_old" value="<?=$data->cover_logo;?>">
                            <br><img id="output" width="200px" src="<?= base_url().'assets_upload/background/'.$data->cover_logo;?>"><br>

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