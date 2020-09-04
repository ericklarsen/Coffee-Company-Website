<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url() . 'assets/'; ?>img/logo/logo.png" rel="icon">
    <title>RuangAdmin - Login</title>
    <link href="<?php echo base_url() . 'assets/'; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() . 'assets/'; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() . 'assets/'; ?>css/ruang-admin.min.css" rel="stylesheet">

    <style>
        #align {
            margin-top: 100px;
        }
    </style>
</head>

<body class="bg-gradient-login" id="align">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <?php echo $this->session->flashdata('message'); ?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <?php
                                    $username = '';
                                    $passwords = '';
                                    if (isset($_COOKIE['username'])) {
                                        $username = $_COOKIE['username'];
                                    }
                                    if (isset($_COOKIE['password'])) {
                                        $passwords = $_COOKIE['password'];
                                    }
                                    ?>
                                    <form method="POST" action="<?php echo base_url() . 'auth/login'; ?>" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $passwords; ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck" <?php if (isset($_COOKIE['username'])) echo 'checked'; ?>>
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="<?php echo base_url() . 'assets/'; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() . 'assets/'; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() . 'assets/'; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url() . 'assets/'; ?>js/ruang-admin.min.js"></script>
</body>

</html>