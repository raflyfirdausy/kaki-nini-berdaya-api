<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Profil Saya</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h3 class="text-primary"><?= $data->nama_admin ?></h3>
                            <p class="text-muted">Username <b class="d-block"><?= $data->username_admin ?></b></p>
                            <p class="text-muted">Level <b class="d-block"><?= ($data->level_admin == 0) ? "Superadmin" : "Admin" ?></b></p>
                            <?php if ($this->userData->level_admin == LEVEL_ADMIN) : ?>
                                <p class="text-muted">Toko <b class="d-block"><?= !empty($data->toko->nama_toko) ? $data->toko->nama_toko : "" ?></b></p>
                            <?php endif ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!-- right column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="<?= base_url() ?>profil/proses_edit_profil">
                            <div class="card-body">
                                <h3>Edit Profil</h3>
                                <div class="form-group">
                                    <label for="nama_admin">Nama</label>
                                    <input required type="text" class="form-control" id="nama_admin" placeholder="Masukkan nama" name="nama_admin" value="<?= $data->nama_admin ?>">
                                </div>
                                <div class="form-group">
                                    <label for="username_admin">Username</label>
                                    <input required type="text" class="form-control" id="username_admin" placeholder="Masukkan username" name="username_admin" value="<?= $data->username_admin ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password_baru">Password</label>
                                    <input type="password" class="form-control" id="password_baru" placeholder="Jangan diisi jika tidak mengganti password" name="password_admin_baru">
                                    <input type="hidden" class="form-control" id="password_admin" name="password_admin" value="<?= $data->password_admin ?>">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <input type="hidden" name="id_admin" value="<?= $data->id_admin ?>">
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>