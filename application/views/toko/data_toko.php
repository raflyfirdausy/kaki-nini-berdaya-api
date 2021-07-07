<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1></h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Pengaturan Data Toko</li>
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
                        <!-- <div class="card-header">
                            <a href="<?= base_url() ?>toko"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h3 class="text-primary"><?= $data['nama_toko'] ?></h3>
                            <p class="text-muted">No Telp <b class="d-block"><?= $data['no_toko'] ?></b></p>
                            <p class="text-muted">Alamat <b class="d-block"><?= $data['alamat_toko'] ?></b></p>
                            <p class="text-muted">On Maps <b class="d-block"><?= $data['latitude_toko'] ?>, <?= $data['longitude_toko'] ?></b></p>
                            
                            <div class="text-muted">
                                <p>Jarak Minimal Ongkir (Km)
                                    <b class="d-block"><?= $data['min_km_toko'] ?></b>
                                </p>
                                <p>Ongkir Toko
                                    <b class="d-block"><?= $data['ongkir_toko'] ?></b>
                                </p>
                                <p>Ongkir Tambahan Toko
                                    <b class="d-block"><?= $data['ongkirtambahan_toko'] ?></b>
                                </p>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!-- right column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card">
                        <!-- <div class="card-header">
                            <a href="<?= base_url() ?>toko"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div> -->
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="<?= base_url() ?>toko/proses_update_toko">
                            <div class="card-body">
                                <h3>Edit Toko</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_toko">Nama Toko</label>
                                            <input required type="text" class="form-control" id="nama_toko" placeholder="Masukkan nama toko" name="nama_toko" value="<?= $data['nama_toko'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_toko">Alamat Lengkap</label>
                                            <textarea required name="alamat_toko" id="alamat_toko" class="form-control" cols="30" rows="5"><?= $data['alamat_toko'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_toko">No Telp Toko</label>
                                            <input type="text" class="form-control" data-inputmask="'mask': ['+62999-9999-9999', '+62 99 99 9999']" data-mask="" im-insert="true" required placeholder="Masukkan no telp toko" name="no_toko" id="no_toko" value="<?= $data['no_toko'] ?>" minlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="latitude">Latitude Toko</label>
                                                    <input required type="text" class="form-control" id="latitude" placeholder="Masukkan Latitude Toko" name="latitude_toko" value="<?= $data['latitude_toko'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="longitude">Longitude Toko</label>
                                                    <input required type="text" class="form-control" id="longitude" placeholder="Masukkan Longitude Toko" name="longitude_toko" value="<?= $data['longitude_toko'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ongkir_km">Jarak Minimal (Km) Ongkir Toko</label>
                                            <input required type="text" class="form-control" id="ongkir_km" placeholder="Masukkan Jarak Minimal (Km) Ongkir Toko" name="min_km_toko" value="<?= $data['min_km_toko'] ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir">Ongkir Toko</label>
                                                    <input required type="text" class="form-control" id="ongkir" placeholder="Masukkan Ongkir Toko" name="ongkir_toko" value="<?= $data['ongkir_toko'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkirtambahan">Ongkir Tambahan</label>
                                                    <input required type="text" class="form-control" id="ongkirtambahan" placeholder="Masukkan Ongkir Tambahan Toko" name="ongkirtambahan_toko" value="<?= $data['ongkirtambahan_toko'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir">Jam Buka Toko</label>
                                                    <input type="text" class="form-control" data-inputmask="'mask': ['99:99', '99:99']" data-mask="" im-insert="true" required placeholder="Masukkan Jam Buka Toko" name="jambuka_toko" id="jambuka_toko" value="<?= $data['jambuka_toko'] ?>" minlength="4">                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkirtambahan">Jam Tutup Toko</label>
                                                    <input type="text" class="form-control" data-inputmask="'mask': ['99:99', '99:99']" data-mask="" im-insert="true" required placeholder="Masukkan Jam Tutup Toko" name="jamtutup_toko" id="jamtutup_toko" value="<?= $data['jamtutup_toko'] ?>" minlength="4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <input type="hidden" name="id_toko" value="<?= $data['id_toko'] ?>">
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