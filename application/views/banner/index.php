<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Master Data Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Master Data Banner</li>
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
                        <a href="<?= base_url() ?>banner/tambah_banner" class="btn btn-primary">Tambah Banner &nbsp;<i class="fa fa-plus text-sm"></i></a>
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
                                    <th>Foto Banner</th>
                                    <th>Status</th>
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
                                            <td style="max-width: 100px"><img style="max-width: 50%; height : auto;" id="imgprev" src="<?= base_url() ?>assets/banner/<?= $row->foto_banner ?>" alt=""></td>
                                            <td><?= ($row->status_banner == 1) ? "Aktif" : "Non Aktif" ?></td>
                                            <td>
                                                <a href="<?= base_url() ?>banner/edit_banner/<?= $row->id_banner ?>" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                                <a href="<?= base_url() ?>banner/delete_banner/<?= $row->id_banner ?>" class="btn btn-danger" onclick="return confirm('Hapus data banner ini?');"><i class="fa fa-trash"></i></a>
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