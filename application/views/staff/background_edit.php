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
                    <form enctype="multipart/form-data" action="<?= base_url().'staff/menu_background/edit_action'?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" value="<?= $data->name;?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Cover Photo</label>
                            <input type="file" name="cover_background" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <input type="hidden" name="cover_background_old" value="<?= $data->cover_background;?>">
                            <input type="hidden" name="id_background" value="<?= $data->id_background;?>">
                            <br><img id="output" width="300px" src="<?= base_url().'assets_upload/background/'.$data->cover_background;?>"><br>

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

<script type="text/javascript">
    CKEDITOR.replace('description_slideshow');
</script>

<?php $this->load->view('include/header_footer'); ?>