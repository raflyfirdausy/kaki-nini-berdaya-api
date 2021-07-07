<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Voucher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Data Voucher</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

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
                        <a href="<?= base_url("voucher/tambah") ?>" class="btn btn-success">
                            + Tambah Voucher
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="table" class="table table-bordered nowrap table-hover displays" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Gambar</th>
                                    <th>Kode Voucher</th>
                                    <th>Tanggal Berlaku</th>
                                    <th>Stock</th>
                                    <th>Max</th>
                                    <th>Keterangan</th>
                                    <th>Min Order</th>
                                    <th>Diskon Barang</th>
                                    <th>Diskon Ongkir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($voucher as $v) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center">
                                            <a href="<?= $v["image"] ?>" target="_blank" rel="noopener noreferrer">
                                                <img style="height: 50px;" src="<?= $v["image"] ?>" alt="">
                                            </a>
                                        </td>
                                        <td><b><?= $v["kode_voucher"] ?></b></td>
                                        <td><b><?= longdate_indo($v["tanggal_berlaku"]) . "</b> s.d <b>" . longdate_indo($v["tanggal_berakhir"]) ?></b></td>
                                        <td><?= $v["stock"] ?></td>
                                        <td><?= $v["max_dapat"] ?></td>
                                        <td><?= strlen($v["keterangan"]) > 20 ? (substr($v["keterangan"], 0, 20) . "...") : $v["keterangan"] ?></td>
                                        <td>Rp <?= Rupiah3($v["min_order"]) ?></td>
                                        <td><b><?= $v["barang_tipe"] == "NOMINAL" ? ("Rp " . Rupiah3($v["barang_diskon"])) : ($v["barang_diskon"] . " %") ?></b> (Max Rp <?= Rupiah3($v["barang_max"]) ?>) </td>
                                        <td><b><?= $v["ongkir_tipe"] == "NOMINAL" ? ("Rp " . Rupiah3($v["ongkir_diskon"])) : ($v["ongkir_diskon"] . " %") ?></b> (Max Rp <?= Rupiah3($v["ongkir_max"]) ?>) </td>
                                        <td>
                                            <a href="<?= base_url("voucher/edit/" . $v["id"]) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="<?= base_url("voucher/delete/" . $v["id"]) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data voucher ini?');"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>