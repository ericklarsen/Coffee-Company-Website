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
                    <form enctype="multipart/form-data" action="<?= base_url().'staff/menu_workshop/edit_action'?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" value="<?= $data->name;?>">
                        </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea class="form-control" name="description_workshop" rows="10"><?= $data->description;?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Cover Workshop</label>
                            <input type="file" name="cover_workshop" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <input type="hidden" name="cover_workshop_old" value="<?= $data->cover_workshop;?>">
                            <input type="hidden" name="id_workshop" value="<?= $data->id_workshop;?>">
                            <br><img id="output" width="200px" src="<?= base_url().'assets_upload/cover_workshop/'.$data->cover_workshop;?>"><br>

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
    CKEDITOR.replace('description_workshop');
</script>

<?php $this->load->view('include/header_footer'); ?>