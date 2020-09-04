<?php
$this->load->view('include/header_css');
$this->load->view('include/header_sidebar');
$this->load->view('include/header_topbar');
?>

<style>
    .label-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .label-row button {
        border: none;
        background-color: transparent;
        color: red;
    }

    .form-group img {
        margin-top: 15px;
        width: 200px;
        object-fit: cover;
        border: none;
    }
</style>

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
                    <form enctype="multipart/form-data" action="<?= base_url() . 'staff/menu_item/addPhoto_action' ?>" method="POST">
                        <?php if (!empty($photo)) {
                            $index = 1;
                            foreach ($photo as $row) { ?>
                                <div class="form-group" id="photo<?= $index;?>">
                                    <div class="label-row">
                                        <label>- Foto <i><small>(Harap memasukkan URL yang benar)</small></i></label>
                                        <button type="button" onclick="delBtn(<?= $index;?>)">x</button>
                                    </div>
                                    <input type="text" name="url[]" class="form-control" id="url<?= $index; ?>" value="<?= $row->url; ?>">
                                    <input type="hidden" name="id_item" class="form-control" value="<?= $id_item; ?>">
                                    <img id="output<?= $index; ?>" src="<?= $row->url; ?>">
                                    <?php $index++; ?>
                                </div>
                            <?php } ?>
                            <input type="hidden" id="jumlah" value="<?= count($photo); ?>">
                            <input type="hidden" id="jumlah2" value="<?= count($photo); ?>">
                        <?php } else { ?>
                            <div class="form-group" id="photo1">
                                <div class="label-row">
                                    <label>- Foto <i><small>(Harap memasukkan URL yang benar)</small></i></label>
                                    <button type="button" onclick="delBtn(1)">x</button>
                                </div>
                                <input type="text" name="url[]" class="form-control" id="url1">
                                <input type="hidden" name="id_item" class="form-control" value="<?= $id_item; ?>">
                                <img id="output1">
                            </div>
                            <input type="hidden" id="jumlah" value="1">
                            <input type="hidden" id="jumlah2" value="1">
                        <?php } ?>

                        <div id="addPhoto">
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" id="btn-add" onclick="addBtn()">Add</button>
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
    var jml = +document.getElementById('jumlah').value;

    for (let index = 1; index <= jml; index++) {
        document.getElementById('url' + index + '').addEventListener('keyup', function() {
            document.getElementById('output' + index + '').src = $('#url' + index + '').val();
        })

    }

    function delBtn(param) {
        $('#photo' + param).html("");
        var jumlah = +document.getElementById('jumlah').value;
        document.getElementById('jumlah').value = jumlah - 1;

    }

    function addBtn() {
        var jumlah = +document.getElementById('jumlah').value + 1;
        var jumlah2 = +document.getElementById('jumlah2').value + 1;

        if (jumlah - 1 == 5) {
            alert('Maksimal Foto Hanya 5! Harap Hapus Foto Lain Terlebih Dahulu.');
        } else {
            var data = "<div class='form-group' id='photo" + jumlah2 + "'>" +
                "<div class='label-row'>" +
                "<label>- Foto <i><small>(Harap memasukkan URL yang benar)</small></i></label>" +
                "<button type='button' onclick='delBtn(" + jumlah2 + ")'>x</button>" +
                "</div>" +
                "<input type='text' name='url[]' id='url" + jumlah2 + "' class='form-control'>" +
                "<img id='output" + jumlah2 + "'>" +
                "</div>";

            $('#addPhoto').append(data);
            document.getElementById('jumlah').value = jumlah;
            document.getElementById('jumlah2').value = jumlah2;
            document.getElementById('url' + jumlah2).addEventListener('keyup', function() {
                document.getElementById('output' + jumlah2).src = $('#url' + jumlah2).val();
            })
        }
    }
</script>

<?php $this->load->view('include/header_footer'); ?>