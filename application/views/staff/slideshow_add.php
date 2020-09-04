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
                    <form enctype="multipart/form-data" action="<?= base_url().'staff/menu_slideshow/add_action'?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title Slide <small>(Judul singkat untuk ditampilkan ke slideshow)</small></label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Article <small>(Gunakan jika ingin memunculkan artikel ke slideshow)</small></label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'id_artikel', 'id' => 'id_artikel', 'class' => 'form-control'),
                                $artikel
                            );
                            ?>
                        </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Short Description <small>(Maks 100 kata)</small></label>
                            <textarea class="form-control" name="description_slideshow" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Cover Photo</label>
                            <input type="file" name="cover_slideshow" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <br><img id="output" width="200px"><br>

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