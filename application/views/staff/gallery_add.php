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
                    <form enctype="multipart/form-data" action="<?= base_url() . 'staff/menu_gallery/add_action' ?>" method="POST">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Type</label>
                            <?php
                            $item[''] = 'Select Type';
                            $item['Video'] = 'Video';
                            $item['Photo'] = 'Photo';
                            echo form_dropdown(
                                array('name' => 'kind', 'id' => 'kind', 'class' => 'form-control'),
                                $item,
                            );
                            ?>
                        </div>

                        <div class="form-group" id="data-desc">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description_gallery" rows="5"></textarea>
                        </div>

                        <div class="form-group" id="data-photo">
                            <label for="">URL Photo</label>
                            <input type="text" name="cover_galleryPhoto" id="cover_galleryPhoto" class="form-control" value="">
                            <br><img id="output" width="300px"><br>
                        </div>

                        <div class="form-group" id="data-video">
                            <label for="">URL Youtube</label>
                            <input type="text" name="cover_galleryVideo" id="cover_galleryVideo" class="form-control" value="">
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
    CKEDITOR.replace('description_gallery');

    document.getElementById('data-photo').style.display = 'none';
    document.getElementById('data-video').style.display = 'none';
    document.getElementById('data-desc').style.display = 'none';

    document.getElementById('cover_galleryPhoto').addEventListener('keyup', function() {
        document.getElementById('output').src = this.value;
    })

    document.getElementById('kind').addEventListener('change', function() {
        var kind = document.getElementById('kind').value;
        // alert(kind)
        if (kind == 'Video') {
            document.getElementById('data-photo').style.display = 'none';
            document.getElementById('data-video').style.display = 'flex';
            document.getElementById('data-video').style.flexDirection = 'column';
            document.getElementById('data-desc').style.display = 'none';
        } else if (kind == 'Photo') {
            document.getElementById('data-photo').style.display = 'flex';
            document.getElementById('data-photo').style.flexDirection = 'column';
            document.getElementById('data-desc').style.display = 'flex';
            document.getElementById('data-desc').style.flexDirection = 'column';
            document.getElementById('data-video').style.display = 'none';
        }
    })
</script>
<?php $this->load->view('include/header_footer'); ?>