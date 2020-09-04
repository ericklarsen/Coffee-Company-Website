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
                    <form enctype="multipart/form-data" action="<?= base_url() . 'staff/menu_gallery/edit_action' ?>" method="POST">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" value="<?= $data->title; ?>">
                            <input type="hidden" name="id_gallery" class="form-control" value="<?= $data->id_gallery; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Type</label>
                            <?php
                            $item['Video'] = 'Video';
                            $item['Photo'] = 'Photo';
                            echo form_dropdown(
                                array('name' => 'kind', 'id' => 'kind', 'class' => 'form-control', 'disabled' => 'disabled'),
                                $item,
                                $data->kind
                            );
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description_gallery" rows="5"><?= $data->description; ?></textarea>
                        </div>

                        <?php if ($data->kind == 'Photo') { ?>
                            <div class="form-group" id="data-photo">
                                <label for="">URL Photo</label>
                                <input type="text" name="cover_gallery" id="cover_galleryPhoto" class="form-control" value="<?= $data->cover_gallery; ?>">
                                <br><img id="output" width="300px" src="<?= $data->cover_gallery; ?>"><br>
                            </div>
                        <?php } else { ?>
                            <div class="form-group" id="data-video">
                                <label for="">URL Youtube</label>
                                <input type="text" name="cover_gallery" id="cover_galleryVideo" class="form-control" value="<?= $data->cover_gallery; ?>">
                                <br><iframe id="outputVideo" width="300px" src="<?= $data->cover_gallery; ?>"></iframe><br>
                            </div>
                        <?php } ?>

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
    CKEDITOR.replace('description_gallery');

    document.getElementById('cover_galleryVideo').addEventListener('keyup', function() {
        document.getElementById('outputVideo').src = this.value;
    })
</script>

<script>
    document.getElementById('cover_galleryPhoto').addEventListener('keyup', function() {
        document.getElementById('output').src = this.value;
    })
</script>
<?php $this->load->view('include/header_footer'); ?>