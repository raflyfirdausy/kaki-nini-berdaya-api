<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Master Data Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Master Data Admin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- asdad -->
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= base_url() ?>admin/tambah_admin" class="btn btn-primary">Tambah Admin &nbsp;<i class="fa fa-plus text-sm"></i></a>
                        <!-- &nbsp;atau&nbsp;
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importData">
                            Import Admin <i class="fa fa-upload text-sm"></i>
                        </button> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="table" class="table table-bordered table-hover display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Admin</th>
                                    <th>Level</th>
                                    <th>Toko</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) :
                                    $no = 1;

                                    foreach ($data as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->nama_admin ?></td>
                                            <td><?= ($row->level_admin == 0) ? "Superadmin" : "Admin" ?></td>
                                            <td>
                                                <?php foreach ($data_toko as $row2) { ?>
                                                    <?= ($row2->id_toko == $row->id_toko) ? $row2->nama_toko : "" ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url() ?>admin/edit_admin/<?= $row->id_admin ?>" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                                <a href="<?= base_url() ?>admin/delete_admin/<?= $row->id_admin ?>" class="btn btn-danger" onclick="return confirm('Hapus data admin ini?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Import Admin -->
<div class="modal fade" id="importData">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Import Data Admin</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="<?= base_url() ?>admin/upload_dataadmin" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unggah Data Admin (.xlsx/.xls/.csv)</label>
                        <input type="file" name="userfile" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Data</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>

        </div>
    </div>
</div>