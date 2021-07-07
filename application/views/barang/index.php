<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= ($level == LEVEL_SUPER_ADMIN) ? "Master Data Barang" : "Data Barang" ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
            <li class="breadcrumb-item active"><?= ($level == LEVEL_SUPER_ADMIN) ? "Master Data Barang" : "Data Barang" ?></li>
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
            <a href="<?= base_url() ?>barang/tambah_barang" class="btn btn-primary">Tambah Barang &nbsp;<i class="fa fa-plus text-sm"></i></a>

            <?php if ($level == LEVEL_SUPER_ADMIN) : ?>
              &nbsp;atau&nbsp;
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importData">
                Import Data Barang &nbsp;<i class="fa fa-upload text-sm"></i>
              </button>
            <?php elseif ($level == LEVEL_ADMIN) : ?>
              &nbsp;atau&nbsp;
              <!-- <a href="<?= base_url() ?>barang/ambil_barang" class="btn btn-info">Ambil Data Barang &nbsp;<i class="fa fa-download text-sm"></i></a> -->
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ambilData">
                Ambil Data Barang &nbsp;<i class="fa fa-download text-sm"></i>
              </button>
            <?php endif ?>

            <div class="card-tools">
              <form action="<?= base_url("barang/1") ?>" method="get">
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="s" class="form-control float-right" placeholder="Cari Nama Barang" value="<?= $this->input->get("s") ?>">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="" class="table table-bordered table-hover display responsive nowrap" width="100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th width="50">Gambar</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga Jual</th>
                  <?= ($level == LEVEL_ADMIN) ? "<th>Harga Diskon</td>" : "" ?>
                  <th>Kategori</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($data) : //CEK DATA NYA DULU KALO ADA BARU DI LOOPING
                  $no = 1;
                  foreach ($data as $row) : ?>

                    <tr>
                      <td><?= $no++ + $start; ?></td>
                      <td>
                        <?php if ($this->userData->level_admin == LEVEL_SUPER_ADMIN) : ?>
                          <?php if ($row->foto_masterbarang) : ?>
                            <img width="50" height="100" class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/barang/<?= $row->foto_masterbarang ?>" alt="">
                          <?php else : ?>
                            <img width="50" height="100" class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                          <?php endif; ?>
                        <?php else : ?>
                          <?php if ($row->foto_barang) : ?>
                            <img width="50" height="100" class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/barang/<?= $row->foto_barang ?>" alt="">
                          <?php else : ?>
                            <img width="50" height="100" class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                          <?php endif; ?>
                        <?php endif ?>
                      </td>
                      <td><?= $row->kode_barang ?></td>
                      <td><?= !isset($row->nama_masterbarang) ? $row->nama_barang : $row->nama_masterbarang ?></td>
                      <td><?= !isset($row->hargajual_masterbarang) ? $row->hargajual_barang : $row->hargajual_masterbarang ?></td>
                      <?= ($level == LEVEL_ADMIN) ? "<td>" . $row->hargadiskon_barang . "</td>" : "" ?>
                      <td><?= (isset($row->kategori)) ? $row->kategori->nama_kategori_barang : "Lainnya" ?>
                      <td><?= $row->keterangan_barang ?>
                      </td>
                      <td>
                        <a href="<?= base_url() ?>barang/edit_barang/<?= empty($row->id_masterbarang) ? $row->id_barang : $row->id_masterbarang ?>" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                        <a href="<?= base_url() ?>barang/delete_barang/<?= empty($row->id_masterbarang) ? $row->id_barang : $row->id_masterbarang ?>" class="btn btn-danger" onclick="return confirm('Hapus data barang ini?');"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>
              </tbody>
            </table>

          </div>

          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right pagination-sm flex-sm-wrap">
              <?= $pagination ?>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<?php if ($this->userData->level_admin == LEVEL_SUPER_ADMIN) : ?>
  <!-- Modal Import Barang -->
  <div class="modal fade" id="importData">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Unggah Data Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="<?= base_url() ?>barang/upload_databarang" enctype="multipart/form-data">
            <div class="form-group">
              <label for="exampleInputEmail1">Pilih Data Barang (.xlsx/.xls/.csv)</label>
              <input type="file" name="userfile" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload Data</button>
          </form>
          <hr>
          <div class="form-group">
            Contoh susunan dalam file excel :
            <img src="<?= base_url() ?>assets/img/contoh2.jpg" alt="" style="width: 100%;">
          </div>
          <div class="row">
            <div class="col-md-2"><b>Catatan :</b></div>
            <div class="col-md-10">
              1. Kode dan Nama Barang tidak boleh kosong. Barang dengan kode atau nama yang kosong tidak akan ikut diunggah.<br>
              2. Pastikan tidak ada data barang yang sama.
              <br>
              3. Harga jual gunakan format number.
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>

      </div>
    </div>
  </div>

<?php endif ?>

<?php if ($this->userData->level_admin == LEVEL_ADMIN) : ?>
  <!-- Modal Import Barang -->
  <div class="modal fade" id="ambilData">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ambil Data Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="<?= base_url() ?>barang/proses_ambil_barang">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <!-- <label>Pilih Barang</label> -->
                  <select class="duallistbox" multiple="multiple" name="kode_barang[]">
                    <?php foreach ($data_barang as $data_barang) : ?>
                      <?php if ($data) : ?>
                        <option value="<?= $data_barang->kode_barang; ?>" <?php foreach ($data as $data_toko) : ?> <?= ($data_toko->kode_barang == $data_barang->kode_barang) ? "selected" : "" ?> <?php endforeach ?>>
                          <?= $data_barang->kode_barang; ?> | <?= $data_barang->nama_masterbarang; ?> | <?= $data_barang->hargajual_masterbarang; ?>
                        </option>
                      <?php else : ?>
                        <option value="<?= $data_barang->kode_barang; ?>">
                          <?= $data_barang->kode_barang; ?> | <?= $data_barang->nama_masterbarang; ?> | <?= $data_barang->hargajual_masterbarang; ?>
                        </option>
                      <?php endif ?>
                    <?php endforeach ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <b>Catatan : </b>Barang yang sudah pernah dipilih tidak dapat dikembalikan
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit Data</button>
          </form>
        </div>

      </div>
    </div>
  </div>

<?php endif ?>

<script>

</script>