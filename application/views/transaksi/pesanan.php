<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php if ($this->uri->segment(2) == "pesanan_masuk") : ?>
                        <h1>Transaksi Masuk</h1>
                    <?php elseif ($this->uri->segment(2) == "pesanan_diproses") : ?>
                        <h1>Transaksi Diproses</h1>
                    <?php elseif ($this->uri->segment(2) == "pesanan_selesai") : ?>
                        <h1>Transaksi Selesai</h1>
                    <?php elseif ($this->uri->segment(2) == "pesanan_dibatalkan") : ?>
                        <h1>Transaksi Dibatalkan</h1>
                    <?php endif ?>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item">Transaksi</li>
                        <?php if ($this->uri->segment(2) == "pesanan_masuk") : ?>
                            <li class="breadcrumb-item active">Transaksi Masuk</li>
                        <?php elseif ($this->uri->segment(2) == "pesanan_diproses") : ?>
                            <li class="breadcrumb-item active">Transaksi Diproses</li>
                        <?php elseif ($this->uri->segment(2) == "pesanan_selesai") : ?>
                            <li class="breadcrumb-item active">Transaksi Selesai</li>
                        <?php elseif ($this->uri->segment(2) == "pesanan_dibatalkan") : ?>
                            <li class="breadcrumb-item active">Transaksi Dibatalkan</li>
                        <?php endif ?>
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
                    <!-- <div class="card-header">
                        
                    </div> -->
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="tabel_pesanan" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Merchant</th>
                                    <th>Pemesan</th>
                                    <th>Alamat Transaksi</th>
                                    <th>No HP</th>
                                    <th>Tanggal</th>
                                    <th>Detail</th>
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
                                            <td><?= $row->kode_transaksi ?></td>
                                            <td><?= $row->toko->nama_toko ?></td>
                                            <td><?= $row->user->nama_user ?></td>
                                            <td><?php $limited_word = word_limiter($row->alamat_transaksi, 9);
                                                echo $limited_word; ?></td>
                                            <td><?= $row->nohp_transaksi ?></td>
                                            <td><?= $row->created_at ?></td>
                                            <td>
                                                <a href="<?= base_url() ?>transaksi/detail_pesanan/<?= $row->id_transaksi ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                            </td>
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