<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $app_name ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url(); ?>assets/img/DoomuIcon.png" type="image/png" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Login V1 -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/login_v1/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/login_v1/css/main.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic">
                    <img src="<?= base_url() ?>assets/img/doomuLogo_green.png" alt="Doomu Logo" class="brand-image" style="width: 100%;">
                </div>

                <form class="login100-form" method="POST" action="<?= base_url('auth/proses_login') ?>">
                    <span class="login100-form-title .d-none .d-sm-block .d-md-none">
                        LOGIN..
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Isikan Username">
                        <input class="input100" type="text" name="username" placeholder="Username" required autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Isikan Passowrd">
                        <input class="input100" type="password" name="password" required placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Login V1 -->
    <script src="<?= base_url() ?>assets/plugins/login_v1/js/main.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000
            });

            <?php if ($this->session->flashdata("gagal")) : ?>
                Toast.fire({
                    title: 'Gagal : ',
                    type: 'error',
                    text: "<?= $this->session->flashdata("gagal") ?>",
                })
            <?php endif ?>
        });
    </script>
</body>

</html>