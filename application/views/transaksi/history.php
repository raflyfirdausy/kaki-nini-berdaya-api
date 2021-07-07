<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Riwayat Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item">Riwayat Transaksi</li>
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
                        <!-- Cetak Data V1 Start -->
                        <form action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tglAwal">Pilih Tanggal Awal</label>
                                        <input type="date" name="tglAwal" id="tglAwal" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tglAkhir">Pilih Tanggal Akhir</label>
                                        <input type="date" name="tglAkhir" id="tglAkhir" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Pilih Toko</label>
                                        <select name="" id="" class="form-control" <?= ($this->userData->level_admin == LEVEL_ADMIN) ? "disabled" : "" ?>>
                                            <option value="">-- Pilih Toko --</option>
                                            <?php if ($data_toko) :
                                                foreach ($data_toko as $row) : ?>
                                                    <option value="<?= $row->id_toko ?>" <?= ($row->id_toko == $this->userData->id_toko) ? "selected" : "" ?>>
                                                        <?= $row->nama_toko ?>
                                                    </option>
                                            <?php
                                                endforeach;
                                            endif; ?>
                                            <!-- Rencanaku kalo admin, bisa milih toko juga, defaultnya all, kalo admin disabled, tapi tetep muncul nama toko admin -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Pilih Aksi</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-primary form-control" name="lihatData"><i class="fa fa-search"></i> Lihat Data</button>
                                                <!-- rencanaku ini buat nampilih data di tabel, defaultnya all -->
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-info form-control" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button>
                                                <!-- rencanaku ini buat cetak data berdasarkan yang diisi. tapi gatau yang dipengin gimana -.- ngatur halaman pdf juga ribet (buatku) -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Cetak Data V1 End -->
                        <!-- Cetak Data V2 Start -->
                        <div class="text-right">
                            <button class="btn btn-info" name="cetakData" data-toggle="modal" data-target="#cetakData"><i class="fa fa-print"></i> Cetak Data</button>
                        </div>
                        <!-- Cetak Data V2 End -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="tabel_pesanan" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Transaksi</th>
                                    <th>Pemesan</th>
                                    <th>Alamat Transaksi</th>
                                    <th>No HP</th>
                                    <th>Status</th>
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
                                            <td><?= $row->user->nama_user ?></td>
                                            <td><?php $limited_word = word_limiter($row->alamat_transaksi, 9);
                                                echo $limited_word; ?></td>
                                            <td><?= $row->nohp_transaksi ?></td>
                                            <td>
                                                <?php if ($row->status_transaksi == 2) : ?>
                                                    Selesai / Sudah dikirimkan
                                                <?php elseif ($row->status_transaksi == 3) : ?>
                                                    Dibatalkan
                                                <?php endif ?>
                                            </td>
                                            <td><?= $row->created_at ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailPesan-<?= $row->id_transaksi ?>"><i class="fa fa-eye text-sm"></i>
                                                </button>
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

<!-- Modal Cetak Data -->
<div class="modal fade" id="cetakData">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cetak Data Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="<?= base_url() ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tglAwal">Pilih Tanggal Awal</label>
                                <input type="date" name="tglAwal" id="tglAwal" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tglAkhir">Pilih Tanggal Akhir</label>
                                <input type="date" name="tglAkhir" id="tglAkhir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Pilih Toko</label>
                                <select name="" id="" class="form-control" <?= ($this->userData->level_admin == LEVEL_ADMIN) ? "disabled" : "" ?>>
                                    <option value="">-- Pilih Toko --</option>
                                    <?php if ($data_toko) :
                                        foreach ($data_toko as $row) : ?>
                                            <option value="<?= $row->id_toko ?>" <?= ($row->id_toko == $this->userData->id_toko) ? "selected" : "" ?>>
                                                <?= $row->nama_toko ?>
                                            </option>
                                    <?php
                                        endforeach;
                                    endif; ?>
                                    <!-- Rencanaku kalo admin, bisa milih toko juga, defaultnya all, kalo admin disabled, tapi tetep muncul nama toko admin -->
                                </select>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button class="btn btn-info" type="submit" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Cetak Data -->

<?php
if ($data) :
    $no = 1;
    foreach ($data as $row) : ?>
        <!-- Modal Detail Pesanan -->
        <div class="modal fade" id="detailPesan-<?= $row->id_transaksi ?>">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Data Pesanan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <span class="info-box-text text-muted"><b>Kode Transaksi</b></span>
                                        <span class="text-muted mb-2"><?= $row->kode_transaksi ?></span>

                                        <span class="info-box-text text-muted pt-2"><b>Waktu Pemesanan</b></span>
                                        <span class="text-muted mb-2"><?= $row->created_at ?></span>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <span class="info-box-text text-muted"><b>Nama Pemesan</b></span>
                                        <span class="text-muted"><?= $row->user->nama_user ?></span>

                                        <?php $no_hp = preg_replace("/[+]/", "", $row->nohp_transaksi); ?>
                                        <span class="info-box-text text-muted pt-2"><b>No HP</b> <a href="https://wa.me/<?= $no_hp ?>" target="_blank">(Hubungi via WA)</a></span>
                                        <span class="text-muted"><?= $row->nohp_transaksi ?></span>
                                    </div>
                                    <div class="col-md-4 pt-sm-2">
                                        <span class="info-box-text text-muted"><b>Alamat Pengiriman </b> <a target="_blank" href="https://www.google.com/maps/dir/<?= $row->toko->alamat_toko ?>/<?= $row->alamat_transaksi ?>">(lihat di maps)</a></span>
                                        <span class="text-muted mb-2"><?= $row->alamat_transaksi ?></span>
                                    </div>
                                </div>
                                <div class="pt-2"></div>
                                <div class="row">
                                    <div class="col-md-8 col-sm-8">
                                        <span class="info-box-text text-muted"><b>Catatan Pesanan</b></span>
                                        <span class="text-muted mb-0"><?= $row->alamatdetail_transaksi ?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <span class="info-box-text text-muted"><b>Status Pemesanan</b></span>
                                        <span class="text-muted mb-0">
                                            <?php if ($row->status_transaksi == BELUM_DIPROSES) : ?>
                                                Belum dikonfirmasi
                                            <?php elseif ($row->status_transaksi == SEDANG_DIPROSES) : ?>
                                                Belum diproses (kemas dan kirim)
                                            <?php elseif ($row->status_transaksi == SELESAI_TERKIRIM) : ?>
                                                Selesai / Sudah dikirim
                                            <?php elseif ($row->status_transaksi == DIBATALKAN) : ?>
                                                Dibatalkan
                                            <?php endif ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Detail Pesanan</label>
                                <table id="" class="table table-bordered table-hover table-head-fixed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Harga Satuan</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $detail_data = $row->detail_transaksi;
                                        if ($detail_data) :
                                            $no = 1;
                                            $sum = 0;
                                            $rpTotal = 0;
                                            // d($detail_data);
                                            foreach ($detail_data as $detail) :
                                                if (isset($detail->hargadiskon_barang) == null) :
                                                    $rpTotal = $detail->hargajual_barang * $detail->banyak_barang;
                                                    $sum += $detail->hargajual_barang * $detail->banyak_barang;
                                                else :
                                                    $rpTotal = $detail->hargadiskon_barang * $detail->banyak_barang;
                                                    $sum += $detail->hargadiskon_barang * $detail->banyak_barang;
                                                endif;
                                        ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $detail->barang->nama_barang ?></td>
                                                    <td>
                                                        <?php if (isset($detail->hargadiskon_barang)) : ?>
                                                            <del><?= $detail->hargajual_barang ?></del>&nbsp;<?= $detail->hargadiskon_barang ?>
                                                        <?php else : ?>
                                                            <?= $detail->hargajual_barang ?>
                                                        <?php endif ?>

                                                    </td>
                                                    <td><?= $detail->banyak_barang ?>&nbsp;item</td>
                                                    <td><?= $rpTotal ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <label for="ongkir">Ongkos Kirim</label>
                                <input id="ongkir" class="form-control" type="text" value="<?= $row->ongkir_transaksi ?>" readonly>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label for="bayar">Total Harga</label>
                                <input id="bayar" class="form-control" type="text" value="<?= $sum ?>" readonly>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label for="bayar">Total Bayar</label>
                                <input id="bayar" class="form-control" type="text" value="<?= $sum + $row->ongkir_transaksi ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id_transaksi" value="<?= $row->id_transaksi ?>">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach ?>
<?php endif ?>