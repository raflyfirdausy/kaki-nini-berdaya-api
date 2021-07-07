<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Data Admin</li>
                        <li class="breadcrumb-item active">Edit Admin</li>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url() ?>admin"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="<?= base_url() ?>admin/proses_update_admin">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaadmin">Nama Admin</label>
                                            <input type="text" class="form-control" id="namaadmin" placeholder="Masukkan Nama Admin" name="nama_admin" value="<?= $data->nama_admin ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username Admin</label>
                                            <input type="text" class="form-control" id="username" placeholder="Masukkan Username Admin" name="username_admin" value="<?= $data->username_admin ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Password">Password Admin</label>
                                            <input type="password" class="form-control" id="Password" placeholder="Jangan diisi jika tidak ingin mengganti password" name="password_admin_baru">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="level_admin">Posisi</label>
                                            <select name="level_admin" id="level_admin" class="form-control" required>
                                                <option value="1" <?= ($data->level_admin == 1) ? "selected" : "" ?>>Admin</option>
                                                <option value="0" <?= ($data->level_admin == 0) ? "selected" : "" ?>>SuperAdmin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_toko">Toko</label>
                                            <select name="id_toko" id="id_toko" class="form-control">
                                                <option value="">-- Pilih Toko --</option>
                                                <?php if ($data_toko) :
                                                    foreach ($data_toko as $row) : ?>
                                                        <option value="<?= $row->id_toko ?>" <?= ($row->id_toko == $data->id_toko) ? "selected" : "" ?>>
                                                            <?= $row->nama_toko ?>
                                                        </option>
                                                <?php
                                                    endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <input type="hidden" name="id_admin" value="<?= $data->id_admin ?>">
                            <input type="hidden" name="password_admin" value="<?= $data->password_admin ?>">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>