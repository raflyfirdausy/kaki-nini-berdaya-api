<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $app_name ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= asset("plugins/fontawesome-free/css/all.min.css") ?>">
    <link rel="stylesheet" href="<?= asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= asset("dist/css/adminlte.min.css") ?>">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width: 400px;">
        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1"><b>Doomu</b> Admin</a>
            </div>
            <div class="card-body">
                <center>
                    <img class="img-responsive" style="max-height: 10vh;  margin: auto;" src="<?= asset("img/doomuLogo_green.png") ?>" alt="">
                </center>
                <p class="login-box-msg mt-2">Silahkan masuk untuk masuk ke dashboard</p>
                <?php if ($this->session->flashdata("gagal")) : ?>
                    <div class="alert bg-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal !</strong> <?= $this->session->flashdata("gagal") ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata("sukses")) : ?>
                    <div class="alert bg-success alert-dismissible fade show" role="alert">
                        <strong>Sukses !</strong> <?= $this->session->flashdata("sukses") ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url("auth/proses_login") ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="username" name="username" class="form-control" placeholder="Username atau Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= asset("plugins/jquery/jquery.min.js") ?>"></script>
    <script src="<?= asset("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= asset("dist/js/adminlte.min.js") ?>"></script>
</body>

</html>