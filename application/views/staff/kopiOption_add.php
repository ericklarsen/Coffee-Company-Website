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
                    <form enctype="multipart/form-data" action="<?= base_url() . 'staff/menu_kopiOption/add_action' ?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Option Type</label>
                            <?php
                            $option['biji'] = 'Biji Kopi';
                            $option['penyajian'] = 'Penyajian';
                            $option['brewing'] = 'Brewing';
                            $option['roasted'] = 'Roasted Level';
                            echo form_dropdown(
                                array('name' => 'option', 'id' => 'option', 'class' => 'form-control'),
                                $option
                            );
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Short Description</label>
                            <textarea class="form-control" name="desc_kopiOption" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Artikel</label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'id_artikel', 'id' => 'id_artikel', 'class' => 'form-control'),
                                $artikel
                            );
                            ?>
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
    CKEDITOR.replace('desc_kopiOption');
</script>

<?php $this->load->view('include/header_footer'); ?>