<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <?php if ($data->status_transaksi == BELUM_DIPROSES) : ?>
                            <li class="breadcrumb-item">Transaksi Masuk</li>
                        <?php elseif ($data->status_transaksi == SEDANG_DIPROSES) : ?>
                            <li class="breadcrumb-item">Transaksi Diproses</li>
                        <?php elseif ($data->status_transaksi == SELESAI_TERKIRIM) : ?>
                            <li class="breadcrumb-item">Transaksi Selesai</li>
                        <?php elseif ($data->status_transaksi == DIBATALKAN) : ?>
                            <li class="breadcrumb-item">Transaksi Dibatalkan</li>
                        <?php endif ?>
                        <li class="breadcrumb-item active">Detail Pesanan</li>
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
                        <?php if ($data->status_transaksi == BELUM_DIPROSES) : ?>
                            <a href="<?= base_url() ?>transaksi/pesanan_masuk"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <?php elseif ($data->status_transaksi == SEDANG_DIPROSES) : ?>
                            <a href="<?= base_url() ?>transaksi/pesanan_diproses"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <?php elseif ($data->status_transaksi == SELESAI_TERKIRIM) : ?>
                            <a href="<?= base_url() ?>transaksi/pesanan_selesai"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <?php elseif ($data->status_transaksi == DIBATALKAN) : ?>
                            <a href="<?= base_url() ?>transaksi/pesanan_dibatalkan"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <?php endif ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="info-box-text text-muted"><b>Kode Transaksi</b></span>
                                        <span class="text-muted mb-2"><?= $data->kode_transaksi ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="info-box-text text-muted"><b>Nama Pemesan</b></span>
                                        <span class="text-muted"><?= $data->user->nama_user ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <?php $no_hp = preg_replace("/[+]/", "", $data->nohp_transaksi); ?>
                                        <span class="info-box-text text-muted pt-2"><b>No HP Pemesan</b> <a href="https://wa.me/<?= $no_hp ?>" target="_blank">(Hubungi via WA)</a></span>
                                        <span class="text-muted"><?= $data->nohp_transaksi ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="info-box-text text-muted pt-2"><b>Waktu Pemesanan</b></span>
                                                <span class="text-muted mb-2"><?= $data->created_at ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="info-box-text text-muted pt-2"><b>Nama Merchant</b> <a href="https://wa.me/<?= $data->toko->no_toko ?>" target="_blank">(Hubungi via WA)</a></span>
                                                <span class="text-muted mb-2"><?= $data->toko->nama_toko ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6">
                                        <span class="info-box-text text-muted"><b>Alamat Merchant </b> <a target="_blank" href="http://maps.google.com/maps?daddr=<?= $data->toko->latitude_toko ?>,<?= $data->toko->longitude_toko ?>">(lihat di maps)</a></span>
                                        <span class="text-muted"><?= $data->toko->alamat_toko ?></span>
                                    </div>
                                    <div class="col-md-4 pt-sm-2">
                                        <span class="info-box-text text-muted"><b>Alamat Pengiriman </b> <a target="_blank" href="https://www.google.com/maps/dir/<?= $data->toko->alamat_toko ?>/<?= $data->alamat_transaksi ?>">(lihat di maps)</a></span>
                                        <span class="text-muted mb-2"><?= $data->alamat_transaksi ?></span>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-md-4 col-sm-4">
                                        <span class="info-box-text text-muted"><b>Catatan Pesanan</b></span>
                                        <span class="text-muted mb-0"><?= $data->alamatdetail_transaksi ?: "Tidak ada catatan Khusus" ?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <span class="info-box-text text-muted"><b>Metode Pembayaran</b></span>
                                        <span class="text-muted mb-0">
                                            <h4 style="font-size: 100%;" class="badge badge-success"><?= $data->pembayaran->nama_pembayaran ?></h4>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <span class="info-box-text text-muted"><b>Status Pemesanan</b></span>
                                        <span class="text-muted mb-0">
                                            <?php if ($data->status_transaksi == BELUM_DIPROSES) : ?>
                                                <h4 style="font-size: 100%;" class="badge badge-primary">Belum dikonfirmasi</h4>
                                            <?php elseif ($data->status_transaksi == SEDANG_DIPROSES) : ?>
                                                <h4 style="font-size: 100%;" class="badge badge-warning">Sedang diproses (kemas dan kirim)</h4>
                                            <?php elseif ($data->status_transaksi == SELESAI_TERKIRIM) : ?>
                                                <h4 style="font-size: 100%;" class="badge badge-success">Selesai / Sudah dikirim</h4>
                                            <?php elseif ($data->status_transaksi == DIBATALKAN) : ?>
                                                <h4 style="font-size: 100%;" class="badge badge-danger">Dibatalkan</h4>
                                            <?php endif ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col-md-4 col-sm-4">
                                        <span class="info-box-text text-muted"><b>Voucher</b></span>
                                        <span class="text-muted mb-0">
                                            <?php if ($data->kode_voucher) : ?>
                                                <h4 style="font-size: 100%;" class="badge badge-success"><?= $data->kode_voucher ?></h4>
                                            <?php else : ?>
                                                <h4 style="font-size: 100%;" class="badge badge-info">Tidak Menggunakan Voucher</h4>
                                            <?php endif ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">Detail Pesanan</label>
                        <div class="table-responsive">
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
                                    $detail_data = $data->detail_transaksi;
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
                                                        <del>Rp <?= Rupiah3($detail->hargajual_barang) ?></del>&nbsp;<?= Rupiah3($detail->hargadiskon_barang) ?>
                                                    <?php else : ?>
                                                        <?= "Rp " . Rupiah3($detail->hargajual_barang) ?>
                                                    <?php endif ?>

                                                </td>
                                                <td><?= $detail->banyak_barang ?>&nbsp;item</td>
                                                <td>Rp <?= Rupiah3($rpTotal) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <label for="ongkir">Ongkos Kirim</label>
                                <input id="ongkir" class="form-control" type="text" value="Rp <?= $data->diskon_voucher_ongkir > 0 ? Rupiah3($data->ongkir_transaksi - $data->diskon_voucher_ongkir) . " (diskon ongkir " . Rupiah3($data->diskon_voucher_ongkir) . ")"  : Rupiah3($data->ongkir_transaksi) ?>" readonly>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="total_harga">Total Harga</label>
                                <input id="total_harga" class="form-control" type="text" value="Rp <?= Rupiah3($sum) ?>" readonly>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="total_harga">Diskon Voucher Belanja</label>
                                <input id="diskon_voucher" class="form-control" type="text" value="Rp <?= Rupiah3($data->diskon_voucher_belanja) ?>" readonly>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="bayar">Total Bayar</label>
                                <input id="bayar" class="form-control" type="text" value="Rp <?= Rupiah3($sum + $data->ongkir_transaksi - $data->ongkir_diskon_transaksi - $data->diskon_voucher_belanja - $data->diskon_voucher_ongkir) ?>" readonly>
                            </div>
                        </div>
                        <form id="formProses" method="POST" action="<?= base_url() ?>transaksi/proses_pesanan">
                        </form>
                        <form id="formTolak" method="POST" action="<?= base_url() ?>transaksi/tolak_pesanan">
                        </form>
                        <input type="hidden" form="formTolak" name="id_transaksi" value="<?= $data->id_transaksi ?>">
                        <input type="hidden" form="formProses" name="id_transaksi" value="<?= $data->id_transaksi ?>">
                    </div>
                    <div class="card-footer text-right">
                        <?php if ($data->status_transaksi == BELUM_DIPROSES) : ?>
                            <button type="submit" form="formTolak" class="btn btn-danger mr-2">Tolak Pesanan</button>

                            <input type="hidden" name="id_transaksi" value="<?= $data->id_transaksi ?>">
                            <button type="submit" form="formProses" class="btn btn-primary">Proses Pesanan</button>


                        <?php elseif ($data->status_transaksi == SEDANG_DIPROSES) : ?>

                            <button type="submit" form="formProses" class="btn btn-primary">Pesanan Telah Terkirim</button>

                        <?php elseif ($data->status_transaksi == SELESAI_TERKIRIM) : ?>
                            <a href="<?= base_url() ?>transaksi/pesanan_selesai" class="btn btn-primary">Kembali</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>