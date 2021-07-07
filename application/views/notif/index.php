<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        border-color: #006fe6;
        color: #fff;
        padding: 0 10px;
        margin-top: .31rem;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Push Notification</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Push Notifikasi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- alert goes here -->
        <?php if ($this->session->flashdata("gagal")) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal : </strong> <?= $this->session->flashdata("gagal") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>

        <?php if ($this->session->flashdata("sukses")) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses : </strong> <?= $this->session->flashdata("sukses") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importData">
                            Kirim Notifikasi Global
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#notifPersonal">
                            Kirim Notifikasi Personal
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="table" class="table table-bordered table-hover display responsive" width="100%">
                            <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th width="15%">Gambar</th>
                                    <th width="15%">Target</th>
                                    <th width="20%">Judul</th>
                                    <th width="35%">Isi Notifikasi</th>
                                    <th width="20%">Waktu Kirim</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($notif) : ?>
                                    <?php $no = 1;
                                    foreach ($notif as $data) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php if (empty($data->image_notifikasi)) : ?>
                                                    <img class="img-fluid p-0" style="height: 80px" id="imgprev" src="<?= base_url("assets/img/no-img.jpg") ?>" alt="">
                                                <?php else : ?>
                                                    <img class="img-fluid p-0" style="height: 80px" id="imgprev" src="<?= $data->image_notifikasi ?>" alt="">
                                                <?php endif ?>
                                            </td>
                                            <td><?= isset($data->user) ? $data->user->nama_user : "Umum" ?></td>
                                            <td><?= $data->title_notifikasi ?></td>
                                            <td><?= $data->message_notifikasi ?></td>
                                            <td><?= $data->created_at ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Import Barang -->
<div class="modal fade" id="importData">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="<?= base_url("notif/kirim") ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Kirim Notifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Judul Notifikasi</label>
                        <input required type="text" class="form-control" placeholder="Judul Notifikasi" name="title_notifikasi">
                    </div>

                    <div class="form-group">
                        <label for="">Isi Notifikasi</label>
                        <textarea required class="form-control" name="message_notifikasi" placeholder="Isi Notifikasi"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Gambar (Opsional)</label>
                        <input type="file" name="image_notifikasi" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="notifPersonal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="<?= base_url("notif/kirim_personal") ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Kirim Notifikasi Personal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Target User</label>
                        <select name="id_user[]" required multiple="multiple" class="select2" data-placeholder="Pilih Target User" style="width: 100%;">
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u["id_user"] ?>" <?= $u["token_user"] ? "" : "disabled" ?>><?= $u["nama_user"] ?> <?= $u["token_user"] ? "" : "(Tidak ada Token Device)" ?> (<?= $u["nohp_user"] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Judul Notifikasi</label>
                        <input required type="text" class="form-control" placeholder="Judul Notifikasi" name="title_notifikasi">
                    </div>

                    <div class="form-group">
                        <label for="">Isi Notifikasi</label>
                        <textarea required class="form-control" name="message_notifikasi" placeholder="Isi Notifikasi"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Gambar (Opsional)</label>
                        <input type="file" name="image_notifikasi" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>