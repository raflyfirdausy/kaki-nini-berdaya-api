<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pilih Jenis Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Pilih Jenis Toko</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="50">Icon</th>
                                    <th>Jenis Toko</th>
                                    <th>Kode</th>
                                    <th>Last Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($jenis_toko as $dt) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?php if ($dt["icon"]) : ?>
                                                <img width="50" height="100" class="img-fluid p-0" id="imgprev" src="<?= base_url("assets/jenis_toko/icon/" . $dt["icon"]) ?>" alt="">
                                            <?php else : ?>
                                                <img width="50" height="100" class="img-fluid p-0" id="imgprev" src="<?= base_url("assets/img/no-img.jpg") ?>" alt="">
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $dt["nama"] ?></td>
                                        <td><?= $dt["kode"] ?></td>
                                        <td><?= $dt["updated_at"] ?></td>
                                        <td>
                                            <a href="<?= base_url("kategori_barang/detail/" . $dt["kode"]) ?>" class="btn btn-primary"><i class="fa fa-search"></i> Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>