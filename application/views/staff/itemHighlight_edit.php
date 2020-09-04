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
                    <form enctype="multipart/form-data" action="<?= base_url() . 'staff/menu_itemHighlight/edit_action' ?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Type</label>
                            <input type="text" name="type" class="form-control" value="<?= $data->type; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Item</label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'id_item', 'id' => 'id_item', 'class' => 'form-control'),
                                $item,
                                $data->id_item
                            );
                            ?>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="id_itemHighlight" value="<?= $data->id_itemHighlight; ?>">
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