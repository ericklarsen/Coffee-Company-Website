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
                    <form enctype="multipart/form-data" action="<?= base_url().'staff/menu_artikel/add_action'?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Type</label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'id_artikelKind', 'id' => 'id_artikelKind', 'class' => 'form-control'),
                                $artikelKind
                            );
                            ?>
                        </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Short Description <small><i>(Harap tidak memasukkan gambar, cukup text saja)</i></small></label>
                            <textarea class="form-control" name="short_description" rows="10"></textarea>
                        </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Content</label>
                            <textarea class="form-control" name="content_artikel" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Cover Photo</label>
                            <input type="file" name="cover_artikel" class="form-control" accept="image/*" onchange="loadFile(event)">
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
    
    CKEDITOR.replace('content_artikel');
    // CKEDITOR.replace('short_description');

</script>

<?php $this->load->view('include/header_footer'); ?>