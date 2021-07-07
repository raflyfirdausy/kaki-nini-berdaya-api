<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Jenis Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Jenis Toko</li>
                        <li class="breadcrumb-item active">Tambah Jenis Toko</li>
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
                            <a href="<?= base_url("jenis_toko") ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <form method="POST" action="<?= base_url('jenis_toko/proses_tambah') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="imgInp">Icon</label>
                                        <div class="media" style="max-height: 150px;margin-bottom: 20px;">
                                            <div class="social-profile">
                                                <img class="img-fluid p-0" id="imgprev" style="max-height: 150px;" src="<?= base_url("assets/img/no-img.jpg") ?>" alt="">
                                                <div class="profile-hvr m-t-15 ">
                                                    <div class="image-upload">
                                                        <label for="imgInp">
                                                            <i for="imgInp" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                        </label>
                                                        <input id="imgInp" type="file" name="icon" accept="image/*">
                                                        <i id="imgdel" class="fa fa-trash c-pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <b>Catatan : </b>Ukuran gambar maksimal 1MB
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="nama">Nama Jenis Toko</label>
                                            <input required type="text" class="form-control" id="nama" placeholder="Masukkan Nama Jenis Toko" name="nama">
                                        </div>                                      
                                    </div>
                                </div>
                            </div>
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