<?php
$this->load->view('include/header_css');
$this->load->view('include/header_sidebar');
$this->load->view('include/header_topbar'); 
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <?php $this->load->view('include/header_breadcumb'); ?>
    <a href="<?php echo base_url() . 'staff/menu_kopiOption/add'; ?>" type="button" class="btn btn-primary mb-1">Add Option</a>
    <br>
    <br>
    <?php echo $this->session->flashdata('message'); ?>


    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Option</th>
                                <th>Short Description</th>
                                <th>Artikel</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->


<?php $this->load->view('include/header_footer'); ?>
<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('staff/kopiOption/pagination'); ?>",
                "type": "POST"
            },
            "order": [],
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            "responsive": false,
            "order": [
            [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        }); // ID From dataTable 
    });
</script>