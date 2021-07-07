<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>toko">Data Toko</a></li>
                        <li class="breadcrumb-item active">Edit Toko</li>
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
                            <a href="<?= base_url() ?>toko"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="<?= base_url() ?>toko/proses_update_toko">
                            <div class="card-body">
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
                                            <input type="text" class="form-control" data-inputmask="'mask': ['+62999-9999-99999', '+62 99 99 99999']" data-mask="" im-insert="true" required placeholder="Masukkan no telp toko" name="no_toko" id="no_toko" value="<?= $data['no_toko'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Toko</label>
                                            <select name="jenis_toko" class="form-control select2" style="width: 100%;">
                                                <?php foreach ($jenis_toko as $jt) : ?>
                                                    <option value="<?= $jt["kode"] ?>" <?= $jt["kode"] == $data["jenis_toko"] ? "selected" : "" ?>><?= $jt["nama"] ?></option>
                                                <?php endforeach ?>
                                            </select>
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
                                                    <label for="ongkirtambahan">Ongkir Tambahan Toko</label>
                                                    <input required type="text" class="form-control" id="ongkirtambahan" placeholder="Masukkan Ongkir Tambahan Toko" name="ongkirtambahan_toko" value="<?= $data['ongkirtambahan_toko'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir">Fee Antre Toko</label>
                                                    <input required type="number" class="form-control" id="fee_toko" placeholder="Isi 0 jika tidak ada fee" name="fee_toko" required value="<?= $data['fee_toko'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir_tambahan">Parkir Toko</label>
                                                    <input required type="number" class="form-control" id="parkir_toko" placeholder="Isi 0 jika tidak ada parkir" name="parkir_toko" value="<?= $data['parkir_toko'] ?>">
                                                </div>
                                            </div>
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