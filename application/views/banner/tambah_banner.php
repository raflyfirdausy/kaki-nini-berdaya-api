<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Data Banner</li>
                        <li class="breadcrumb-item active">Tambah Banner</li>
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
                            <a href="<?= base_url() ?>banner"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="<?= base_url('banner/proses_simpan_banner') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="media">
                                        <div class="banner-area">
                                            <img class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/banner/banner1.jpg" alt="">
                                            <div class="banner-hvr m-t-15 ">
                                                <div class="image-upload">
                                                    <label for="imgInp">
                                                        <i for="imgInp" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                    </label>
                                                    <input id="imgInp" required type="file" name="foto_banner" accept="image/*">
                                                    <i id="imgdel" class="fa fa-trash c-pointer"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select required class="form-control" name="status_banner">
                                                <option value="1">Aktif</option>
                                                <option value="">Non Aktif</option>
                                            </select>
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