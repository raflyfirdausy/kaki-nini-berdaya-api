<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <?php if ($this->userData->level_admin == LEVEL_SUPER_ADMIN) : ?>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pengguna</span>
                <span class="info-box-number"><?= $jumlahUser ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Transaksi</span>
                <span class="info-box-number"><?= $totalTrans ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        <?php endif ?>
        <?php if ($this->userData->level_admin == LEVEL_ADMIN) : ?>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang Yang Dijual</span>
                <span class="info-box-number"><?= $jumlahBarang ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Transaksi</span>
                <span class="info-box-number"><?= $totalTrans ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        <?php endif ?>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Transaksi Selesai</span>
              <span class="info-box-number"><?= $jumlahTrans ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Transaksi Batal</span>
              <span class="info-box-number"><?= $jumlahBatal ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-4">
          <!-- PRODUCT LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Produk Terbaru <?= isset($this->userData->toko->nama_toko) ? "di " . $this->userData->toko->nama_toko : "" ?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php
                if ($barangBaru) :
                  $no = 1;
                  foreach ($barangBaru as $barbar) :
                    if ($level == LEVEL_SUPER_ADMIN) :
                      $foto = $barbar->foto_masterbarang;
                      $nama = $barbar->nama_masterbarang;
                      $harga = $barbar->hargajual_masterbarang;
                    else :
                      $foto = $barbar->foto_barang;
                      $nama = $barbar->nama_barang;
                      $harga = $barbar->hargajual_barang;
                    endif;
                ?>
                    <li class="item">
                      <div class="product-img">
                        <?php if ($foto) : ?>
                          <img src="<?= base_url() ?>assets/barang/<?= $foto ?>" alt="Product Image" class="img-size-50">
                        <?php else : ?>
                          <img src="<?= base_url() ?>assets/img/no-img.jpg" alt="Product Image" class="img-size-50">
                        <?php endif ?>
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title"><?= $nama ?>
                          <span class="badge badge-warning text float-right"><?= $harga ?></span></a>
                        <span class="product-description">
                          <?= (isset($barbar->kategori)) ? $barbar->kategori->nama_kategori_barang : "Lainnya" ?>
                        </span>
                      </div>
                    </li>
                    <!-- item -->
                  <?php endforeach ?>
                <?php else : ?>
                  <li class="item text-center">
                    Belum Ada Barang Terbaru
                  </li>
                <?php endif ?>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="<?= base_url('barang') ?>" class="uppercase">Lihat Semua Produk</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <!-- PRODUCT LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Produk Terlaris <?= isset($this->userData->toko->nama_toko) ? "di " . $this->userData->toko->nama_toko : "" ?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php
                if (isset($terlaris)) :
                  $no = 1;
                  foreach ($terlaris as $laris) :
                    $foto = $laris->barang->foto_barang;
                    $nama = $laris->barang->nama_barang;
                    $harga = $laris->barang->hargajual_barang;
                    $JmlhTerjual = $laris->banyak_barang;
                ?>
                    <li class="item">
                      <div class="product-img">
                        <?php if ($foto) : ?>
                          <img src="<?= base_url() ?>assets/barang/<?= $foto ?>" alt="Product Image" class="img-size-50">
                        <?php else : ?>
                          <img src="<?= base_url() ?>assets/img/no-img.jpg" alt="Product Image" class="img-size-50">
                        <?php endif ?>
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title"><?= $nama ?> (x<?= $JmlhTerjual ?>)
                          <!-- <span class="badge badge-warning text float-right"><?= $harga ?></span> -->
                          </a>
                        <span class="product-description">
                          <?= (isset($laris->kategori)) ? $laris->kategori->nama_kategori_barang : "Lainnya" ?>
                        </span>
                      </div>
                    </li>
                    <!-- item -->
                  <?php endforeach ?>
                <?php else : ?>
                  <li class="item text-center">
                    Belum Ada Barang Terlaris
                  </li>
                <?php endif ?>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="<?= base_url('barang') ?>" class="uppercase">Lihat Semua Produk</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Transaksi Dalam Sebulan (Bukan Realtime)</h5>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <?php
            $total_barang = 0;
            $barang_sebulan = 0;
            if ($transaksi_sebulan) :
              foreach ($transaksi_sebulan as $row) :
                $data_sebulan = $row->detail_transaksi;
                if ($data_sebulan) :
                  if ($row->status_transaksi == SELESAI_TERKIRIM) :
                    foreach ($data_sebulan as $sbln2) :
                      $barang_sebulan += $sbln2->banyak_barang;
                    endforeach;
                  endif;
                  foreach ($data_sebulan as $sbln) :
                    $total_barang += $sbln->banyak_barang;
                  endforeach;
                endif;
              endforeach;
            endif;
            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>Transaksi yang terjadi</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Barang Selesai Dikirim</span>
                    <span class="float-right"><b><?= ($barang_sebulan) ? $barang_sebulan : 0 ?></b>/<?= ($total_barang) ? $total_barang : 0 ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: <?= ($barang_sebulan || $total_barang) ? $barang_sebulan / $total_barang * 100 : 0; ?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    <span class="progress-text">Transaksi Selesai</span>
                    <span class="float-right"><b><?= ($trans_selesai_sebulan) ? $trans_selesai_sebulan : 0 ?></b>/<?= ($banyak_trans_sebulan) ? $banyak_trans_sebulan : 0 ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: <?= ($trans_selesai_sebulan || $banyak_trans_sebulan) ? $trans_selesai_sebulan / $banyak_trans_sebulan * 100 : 0; ?>%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Pesanan Batal</span>
                    <span class="float-right"><b><?= ($trans_batal_sebulan) ? $trans_batal_sebulan : 0 ?></b>/<?= ($banyak_trans_sebulan) ? $banyak_trans_sebulan : 0 ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: <?= ($trans_batal_sebulan || $banyak_trans_sebulan) ? $trans_batal_sebulan / $banyak_trans_sebulan * 100 : 0; ?>%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Pesanan Sedang Diproses</span>
                    <span class="float-right"><b><?= ($trans_diproses_sebulan) ? $trans_diproses_sebulan : 0 ?></b>/<?= ($banyak_trans_sebulan) ? $banyak_trans_sebulan : 0 ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: <?= ($trans_diproses_sebulan || $banyak_trans_sebulan) ? $trans_diproses_sebulan / $banyak_trans_sebulan * 100 : 0; ?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">

          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Transaksi Terbaru <?= isset($this->userData->toko->nama_toko) ? "di " . $this->userData->toko->nama_toko : "" ?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Kode Transaksi</th>
                      <th>Pemesan</th>
                      <?php if ($this->userData->level_admin == LEVEL_SUPER_ADMIN) : ?>
                        <th>Toko</th>
                      <?php endif ?>
                      <th>Jumlah Item</th>
                      <th>Total Harga</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($TransBaru) :
                      $no = 1;
                      foreach ($TransBaru as $trans) :
                    ?>
                        <tr>
                          <td><?= $trans->kode_transaksi ?></td>
                          <td><?= $trans->user->nama_user ?></td>
                          <?php if ($this->userData->level_admin == LEVEL_SUPER_ADMIN) : ?>
                            <td><?= $trans->toko->nama_toko ?></td>
                          <?php endif ?>
                          <?php
                          $detail_data = $trans->detail_transaksi;
                          if ($detail_data) :
                            $no = 1;
                            $sum = 0;
                            $rpTotal = 0;
                            $jmlh = 0;
                            foreach ($detail_data as $detail) :
                              $jmlh += $detail->banyak_barang;
                              if (isset($detail->hargadiskon_barang) == null) :
                                $rpTotal = $detail->hargajual_barang * $detail->banyak_barang;
                                $sum += $detail->hargajual_barang * $detail->banyak_barang;
                              else :
                                $rpTotal = $detail->hargadiskon_barang * $detail->banyak_barang;
                                $sum += $detail->hargadiskon_barang * $detail->banyak_barang;
                              endif;
                          ?>
                            <?php endforeach ?>
                          <?php endif ?>
                          <td><?= $jmlh ?></td>
                          <td><?= $sum ?></td>
                          <td><?= $trans->created_at ?></td>
                          <td>
                            <?php if ($trans->status_transaksi == BELUM_DIPROSES) : ?>
                              <span class="badge badge-info">Belum diproses</span>
                            <?php elseif ($trans->status_transaksi == SEDANG_DIPROSES) : ?>
                              <span class="badge badge-warning">Sedang diproses</span>
                            <?php elseif ($trans->status_transaksi == SELESAI_TERKIRIM) : ?>
                              <span class="badge badge-success">Selesai</span>
                            <?php else : ?>
                              <span class="badge badge-danger">Dibatalkan</span>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    <?php else : ?>
                      <tr><td colspan="6" class="text-center">Belum Ada Transaksi</td></tr>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->

            <?php if ($level == LEVEL_ADMIN) : ?>
              <div class="card-footer clearfix">
                <a href="<?= base_url('transaksi/pesanan_masuk') ?>" class="btn btn-sm btn-secondary float-right">Lihat Semua Transaksi</a>
              </div>
              <!-- /.card-footer -->
            <?php endif ?>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->


      </div>
      <!-- /.row -->
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->