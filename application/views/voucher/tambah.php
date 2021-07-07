<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Voucher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url("voucher") ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Voucher</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- alert goes here -->

        <div class="row">
            <div class="col-12">
                <form method="POST" action="<?= base_url('voucher/add') ?>" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="<?= base_url("voucher") ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="imgInp">Foto Voucher (Opsional)</label>
                                    <div class="media" style="max-height: 360px;margin-bottom: 20px;">
                                        <div class="social-profile">
                                            <img class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                                            <div class="profile-hvr m-t-15 ">
                                                <div class="image-upload">
                                                    <label for="imgInp">
                                                        <i for="imgInp" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                    </label>
                                                    <input id="imgInp" type="file" name="foto_voucher" accept="image/*">
                                                    <i id="imgdel" class="fa fa-trash c-pointer"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <b>Catatan : </b>Ukuran gambar maksimal 2MB
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Kode Voucher <span class="text-danger"> *</span></label>
                                            <input required onkeyup="validate(this)" type="text" style="text-transform: uppercase;" class="form-control" id="kode_voucher" placeholder="Masukkan Kode Voucher" name="kode_voucher">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Tanggal Mulai <span class="text-danger"> *</span></label>
                                            <input required type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Tanggal Berakhir <span class="text-danger"> *</span></label>
                                            <input required type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Stock Voucher <span class="text-danger"> *</span></label>
                                            <input required type="text" onkeyup="number(this)" class="form-control" id="stock" placeholder="Contoh : 100" name="stock">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Minimal Order (Rp) <span class="text-danger"> *</span></label>
                                            <input type="text" onkeyup="number(this)" class="form-control" id="min_order" name="min_order" placeholder="Contoh : 10000">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Maximal Dipakai <span class="text-danger"> *</span></label>
                                            <input required type="text" onkeyup="number(this)" class="form-control" id="max_dapat" name="max_dapat" placeholder="Contoh : 1">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Tipe Diskon Barang <span class="text-danger"> *</span></label>
                                            <select required class="form-control select2bs4" name="barang_tipe">
                                                <option value="" selected>-- PILIH TIPE DISKON BARANG --</option>
                                                <option value="NOMINAL">NOMINAL</option>
                                                <option value="PERSEN">PERSEN</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Diskon Barang (Rupiah / Persen) <span class="text-danger"> *</span></label>
                                            <input required type="text" onkeyup="number(this)" class="form-control" id="barang_diskon" name="barang_diskon" placeholder="Contoh : 5000">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Diskon Maksimal (Rupiah) <span class="text-danger"> *</span></label>
                                            <input required type="text" onkeyup="number(this)" class="form-control" id="barang_max" name="barang_max" placeholder="Contoh : 5000">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Tipe Diskon Ongkir <span class="text-danger"> *</span></label>
                                            <select required class="form-control select2bs4" name="ongkir_tipe">
                                                <option value="" selected>-- PILIH TIPE DISKON BARANG --</option>
                                                <option value="NOMINAL">NOMINAL</option>
                                                <option value="PERSEN">PERSEN</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="kode_barang">Diskon Ongkir (Rupiah / Persen) <span class="text-danger"> *</span></label>
                                            <input required type="text" onkeyup="number(this)" class="form-control" id="ongkir_diskon" name="ongkir_diskon" placeholder="Contoh : 5000">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Diskon Maksimal (Rupiah) <span class="text-danger"> *</span></label>
                                            <input required type="text" onkeyup="number(this)" class="form-control" id="ongkir_max" name="ongkir_max" placeholder="Contoh : 5000">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Keterangan Voucher (Opsional)</label>
                                            <textarea name="keterangan" class="form-control" rows="2" placeholder="Masukan keterangan Voucher misalnya deskripsi atau yang lainnya"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="<?= base_url("voucher") ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    function validate(element) {
        element.value = element.value.replace(/[^a-zA-Z0-9]/, '');
    };

    function number(element) {
        element.value = element.value.replace(/[^0-9]/, '');
    };
</script>