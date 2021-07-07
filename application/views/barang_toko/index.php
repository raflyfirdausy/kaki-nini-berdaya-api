<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Master Barang per Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Master Barang per Toko</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- alert goes here -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Silahkan Pilih Toko Terlebih Dahulu
                    </div>
                    <div class="card-body">
                        <div class="card-body table-responsive">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Toko</th>
                                        <th>Alamat</th>
                                        <th>No Toko</th>
                                        <th>Jenis Toko</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($toko as $row) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->nama_toko ?></td>
                                            <td><?php $limited_word = word_limiter($row->alamat_toko, 7);
                                                echo $limited_word; ?></td>
                                            <td><?= $row->no_toko ?></td>
                                            <td><?= $row->jenis_toko ?></td>
                                            <td>
                                                <a href="<?= base_url("barang_toko/detail/" . $row->id_toko) ?>" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>