<?php
$this->load->view('include/header_css');
$this->load->view('include/header_sidebar');
$this->load->view('include/header_topbar');
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
<?php $this->load->view('include/header_breadcumb'); ?>


    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data</h6>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?= base_url().'staff/menu_item/edit_action'?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name_item" class="form-control" value="<?php echo $data->name_item;?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Type</label>
                            <?php
                            echo form_dropdown(
                                array('name' => 'id_itemKind', 'id' => 'id_itemKind', 'class' => 'form-control'),
                                $itemKind,
                                $data->id_itemKind
                            );
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input id="rupiah1" type="text" name="price_item" class="form-control" value="<?php echo $data->price_item;?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Discount Price <small><i>(Jika ada bisa diisi)</i></small></label>
                            <input id="rupiah2" type="text" name="disc_item" class="form-control" value="<?php echo $data->disc_item;?>">
                        </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea class="form-control" name="desc_item" id="desc_item" rows="10"><?php echo $data->desc_item;?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Stock Item</label>
                            <?php
                            $item1['Available'] = 'Available';
                            $item1['PO'] = 'PO';
                            echo form_dropdown(
                                array('name' => 'stock_item', 'id' => 'stock_item', 'class' => 'form-control'),
                                $item1,
                                $data->stock_item
                            );
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Weight Item (gram)</label>
                            <input type="number" name="weight_item" class="form-control" value="<?= $data->weight_item;?>">
                        </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Cover Photo</label>
                            <input type="file" name="cover_item" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <input type="hidden" name="cover_item_old" value="<?= $data->cover_item;?>">
                            <input type="hidden" name="id_item" value="<?= $data->id_item;?>">
                            <br><img id="output" width="200px" src="<?= base_url().'assets_upload/cover_item/'.$data->cover_item;?>"><br>

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
    CKEDITOR.replace('desc_item');
</script>

<?php $this->load->view('include/header_footer'); ?>