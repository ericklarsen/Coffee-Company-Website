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
                    <form action="<?= base_url() . 'staff/menu_user/edit_action' ?>" method="POST">
                        <input type="hidden" value="<?= $data->username ?>" name="username" class="form-control" placeholder="Masukkan username">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" value="<?= $data->name ?>" name="name" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" value="<?= $data->password ?>" name="password" class="form-control" >
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