<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>barang">Data Barang</a></li>
                        <li class="breadcrumb-item active">Edit Barang</li>
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
                            <a href="<?= isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : base_url() ?>barang"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="<?= base_url('barang/proses_update_barang') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="imgInp">Foto Barang</label>
                                        <div class="media" style="max-height: 360px;margin-bottom: 20px;">
                                            <div class="social-profile">
                                                <?php if ($data['foto_masterbarang']) : ?>
                                                    <img class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/barang/<?= $data['foto_masterbarang'] ?>" alt="">
                                                <?php else : ?>
                                                    <img class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                                                <?php endif ?>
                                                <div class="profile-hvr m-t-15 ">
                                                    <div class="image-upload">
                                                        <label for="imgInp">
                                                            <i for="imgInp" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                        </label>
                                                        <input id="imgInp" type="file" name="foto_masterbarang" accept="image/*">
                                                        <input type="hidden" name="foto_lama" value="<?= $data['foto_masterbarang'] ?>">
                                                        <i id="imgdel" class="fa fa-trash c-pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <b>Catatan : </b>Ukuran gambar maksimal 2MB
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="id_masterbarang">Kode Barang</label>
                                            <input required type="text" class="form-control" id="id_masterbarang" placeholder="Masukkan kode Barang" name="kode_barang" value="<?= $data['kode_barang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input required type="text" class="form-control" id="namabarang" placeholder="Masukkan Nama Barang" name="nama_masterbarang" value="<?= $data['nama_masterbarang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="hargajual">Harga Jual</label>
                                            <input required type="number" class="form-control" id="hargajual" placeholder="Masukkan Harga Jual" name="hargajual_masterbarang" value="<?= $data['hargajual_masterbarang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select required class="form-control select2bs4" name="kategori_masterbarang">
                                                <?php if ($kategori_barang) : ?>
                                                    <?php foreach ($kategori_barang as $kategori) : ?>
                                                        <option <?= $data['id_kategori_barang'] == $kategori->id_kategori_barang ? "selected" : "" ?> value="<?= $kategori->id_kategori_barang ?>"><?= $kategori->nama_kategori_barang ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                <option <?= $data['id_kategori_barang'] == null ? "selected" : "" ?> value="">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan Barang (pisahkan dengan koma)</label>
                                            <textarea name="keterangan_barang" class="form-control" rows="2" placeholder="Masukan keterangan barang untuk mempermudah pencarian di aplikasi"><?= $data['keterangan_barang'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <input type="hidden" name="id_masterbarang" value="<?= $data['id_masterbarang'] ?>">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>