<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>toko">Data Toko</a></li>
                        <li class="breadcrumb-item active">Tambah Toko</li>
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
                        <form method="POST" action="<?= base_url() ?>toko/proses_simpan_toko">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_toko">Nama Toko</label>
                                            <input required type="text" class="form-control" id="nama_toko" placeholder="Masukkan nama toko" name="nama_toko" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_toko">Alamat Lengkap</label>
                                            <textarea required name="alamat_toko" id="alamat_toko" class="form-control" cols="30" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_toko">No Telp Toko</label>
                                            <input type="text" class="form-control" data-inputmask="'mask': ['+62999-9999-99999', '+62 99 99 99999']" placeholder="Masukkan no telp toko" name="no_toko" id="no_toko" required data-mask="" im-insert="true">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Toko</label>
                                            <select name="jenis_toko" class="form-control select2" style="width: 100%;">
                                                <?php foreach ($jenis_toko as $jt) : ?>
                                                    <option value="<?= $jt["kode"] ?>"><?= $jt["nama"] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="latitude">Latitude Toko</label>
                                                    <input required type="text" class="form-control" id="latitude" placeholder="Masukkan Latitude Toko" name="latitude_toko" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="longitude">Longitude Toko</label>
                                                    <input required type="text" class="form-control" id="longitude" placeholder="Masukkan Longitude Toko" name="longitude_toko" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="min_km">Jarak Minimal (Km) Ongkir Toko</label>
                                            <input required type="text" class="form-control" id="min_km" placeholder="Masukkan Minimal Ongkir Toko" name="min_km_toko" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir">Ongkir Toko</label>
                                                    <input required type="number" class="form-control" id="ongkir" placeholder="Masukkan Ongkos Kirim Toko" name="ongkir_toko" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir_tambahan">Ongkir Tambahan Toko</label>
                                                    <input required type="number" class="form-control" id="ongkir_tambahan" placeholder="Masukkan Ongkir Tambahan Toko" name="ongkirtambahan_toko">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir">Fee Antre Toko</label>
                                                    <input required type="number" class="form-control" id="fee_toko" placeholder="Isi 0 jika tidak ada fee" name="fee_toko" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir_tambahan">Parkir Toko</label>
                                                    <input required type="number" class="form-control" id="parkir_toko" placeholder="Isi 0 jika tidak ada parkir" name="parkir_toko">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkir">Jam Buka Toko</label>
                                                    <input type="text" class="form-control" data-inputmask="'mask': ['99:99', '99:99']" data-mask="" im-insert="true" required placeholder="Masukkan Jam Buka Toko" name="jambuka_toko" id="jambuka_toko" value="" minlength="4">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ongkirtambahan">Jam Tutup Toko</label>
                                                    <input type="text" class="form-control" data-inputmask="'mask': ['99:99', '99:99']" data-mask="" im-insert="true" required placeholder="Masukkan Jam Tutup Toko" name="jamtutup_toko" id="jamtutup_toko" value="" minlength="4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

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