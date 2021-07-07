<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang Toko <?= $toko["nama_toko"] ?></h1>
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
                        <button data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary">Tambah Barang &nbsp;<i class="fa fa-plus text-sm"></i></button>
                        <a href="<?= base_url("barang_toko/export/" . $toko["id_toko"]) ?>" class="btn btn-danger">Export Data Barang &nbsp;&nbsp;<i class="fa fa-download text-sm"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="card-body table-responsive">
                            <table id="tablex" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Jual</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-tambah" role="dialog">
    <div class="modal-dialog modal-xl">
        <form id="form-tambah" enctype="multipart/form-data" action="<?= base_url("barang_toko/prosesTambahBarang") ?>" method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="imgInp">Foto Barang</label>
                                <div class="media" style="max-height: 360px;margin-bottom: 20px;">
                                    <div class="social-profile">
                                        <img class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                                        <div class="profile-hvr m-t-15 ">
                                            <div class="image-upload">
                                                <label for="imgInp">
                                                    <i for="imgInp" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                </label>
                                                <input id="imgInp" type="file" name="foto_masterbarang" accept="image/*">
                                                <i id="imgdel" class="fa fa-trash c-pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b>Catatan : </b>Ukuran gambar maksimal 2MB
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" placeholder="Masukkan Kode Barang" name="kode_barang">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input required type="text" class="form-control" id="namabarang" placeholder="Masukkan Nama Barang" name="nama_masterbarang">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namabarang">Satuan Barang</label>
                                            <input type="text" class="form-control" id="satuan_barang" placeholder="Contoh : 1 ons / 1 pcs / 250 gr / dll " name="satuan_barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hargajual">Harga Jual</label>
                                            <input required type="number" class="form-control" id="hargajual" placeholder="Masukkan Harga Jual" name="hargajual_masterbarang">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hargadiskon">Harga Diskon (opsional)</label>
                                            <input type="number" class="form-control" id="hargadiskon" placeholder="Masukkan Harga Diskon" name="hargadiskon_barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select required class="form-control select2" name="kategori_masterbarang">
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k->id_kategori_barang ?>"><?= $k->nama_kategori_barang ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan Barang (pisahkan dengan koma)</label>
                                    <textarea name="keterangan_barang" class="form-control" rows="2" placeholder="Masukan keterangan barang untuk mempermudah pencarian di aplikasi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="namabarang">Keterangan Tambahan</label>
                                    <input type="text" class="form-control" id="keterangan_tambahan" placeholder="Contoh : Maximum beli 2 / dll" name="keterangan_tambahan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer ">
                    <input type="hidden" name="id_toko" value="<?= $toko["id_toko"] ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="btnKirim" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-edit" role="dialog">
    <div class="modal-dialog modal-xl">
        <form id="form-edit" enctype="multipart/form-data" action="<?= base_url("barang_toko/prosesEditBarang") ?>" method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="imgInp_edit">Foto Barang</label>
                                <div class="media" style="max-height: 360px;margin-bottom: 20px;">
                                    <div class="social-profile">
                                        <img class="img-fluid p-0" id="imgprev_edit" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                                        <div class="profile-hvr m-t-15 ">
                                            <div class="image-upload">
                                                <label for="imgInp_edit">
                                                    <i for="imgInp_edit" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                </label>
                                                <input id="imgInp_edit" type="file" name="foto_masterbarang" accept="image/*">
                                                <i id="imgdel_edit" class="fa fa-trash c-pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b>Catatan : </b>Ukuran gambar maksimal 2MB
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang_edit" placeholder="Masukkan Kode Barang" name="kode_barang">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input required type="text" class="form-control" id="namabarang_edit" placeholder="Masukkan Nama Barang" name="nama_masterbarang">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namabarang">Satuan Barang</label>
                                            <input type="text" class="form-control" id="satuan_barang_edit" placeholder="Contoh : 1 ons / 1 pcs / 250 gr / dll " name="satuan_barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hargajual">Harga Jual</label>
                                            <input required type="number" class="form-control" id="hargajual_edit" placeholder="Masukkan Harga Jual" name="hargajual_masterbarang">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hargadiskon">Harga Diskon (opsional)</label>
                                            <input type="number" class="form-control" id="hargadiskon_edit" placeholder="Masukkan Harga Diskon" name="hargadiskon_barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select required class="form-control select2" name="kategori_masterbarang" id="kategori_masterbarang_edit">
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k->id_kategori_barang ?>"><?= $k->nama_kategori_barang ?></option>
                                        <?php endforeach ?>
                                        <option value="">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan Barang (pisahkan dengan koma)</label>
                                    <textarea id="keterangan_barang_edit" name="keterangan_barang" class="form-control" rows="2" placeholder="Masukan keterangan barang untuk mempermudah pencarian di aplikasi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="namabarang">Keterangan Tambahan</label>
                                    <input type="text" class="form-control" id="keterangan_tambahan_edit" placeholder="Contoh : Maximum beli 2 / dll" name="keterangan_tambahan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer ">
                    <input type="hidden" name="id_toko" value="<?= $toko["id_toko"] ?>">
                    <input type="hidden" name="id_data" id="id_data">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="btnKirim" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var table_data = $("#tablex").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "scrollX": true,
        "ajax": {
            "url": "<?= base_url('barang_toko/get_barang?id_toko=' . $toko["id_toko"]) ?>",
            "dataSrc": "data",
        },
        "order": [
            [0, "asc"]
        ],
        "columns": [{
            data: null,
            className: "text-center align-top",
            render: function(data, type, row, meta) {
                return meta.row + 1;
            }
        }, {
            data: "id",
            className: "align-top",
            render: function(data, type, row, meta) {
                let result = '<a href="' + row.foto_barang + '" target="_blank" rel="noopener noreferrer">';
                result += '<img style="height: 50px;" src="' + row.foto_barang + '" alt="">';
                result += '</a>';
                return result;
            }
        }, {
            data: "nama_barang",
            className: "align-top"
        }, {
            data: "id",
            className: "align-top",
            render: function(data, type, row, meta) {
                let res = "";
                if (row.hargadiskon_barang != null && row.hargadiskon_barang < row.hargajual_barang) {
                    res = `<del>${row.hargajual_barang}</del> ${row.hargadiskon_barang}`
                } else {
                    res = `${row.hargajual_barang}`
                }
                return "Rp " + res + " / " + row.satuan_barang;
            }
        }, {
            data: "kategori.nama_kategori_barang",
        }, {
            data: "keterangan_barang",
            className: "align-top",
            render: function(data, type, row, meta) {
                return data + "<br><i>" + row.keterangan_tambahan + "</i>"
            }
        }, {
            data: "id_barang",
            className: "align-top",
            render: function(data, type, row, meta) {
                let base_url = "<?= base_url() ?>";
                let buttonJawab = '<button onclick="edit(' + data + ');" type="button" class="btn btn-primary btn-xs" data-toggle="modal"><span class="fa fa-edit"> </span>Edit</button>&nbsp;&nbsp;'
                let result = "";
                result += buttonJawab
                result += '<button onclick="hapus(' + data + ')" class="btn btn-danger btn-xs" data-toggle="modal"><span class="fa fa-edit"> </span>Hapus</button>';
                return result;
            }
        }, ]
    })

    $("#form-tambah").submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Mohon Tunggu Beberapa Saat',
            text: 'Proses menambah data',
            onBeforeOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: "<?= base_url('barang_toko/prosesTambahBarang') ?>",
                    type: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(e) {
                        Swal.close();
                        if (e.status == 200) {
                            $('#modal-tambah').modal('hide');
                            $('#form-tambah').trigger("reset");
                            table_data.ajax.reload(null, true)
                            Swal.fire(
                                'Sukses',
                                e.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Oopss',
                                e.message,
                                'error'
                            )
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.close();
                        Swal.fire(
                            'Oopss',
                            xhr.responseText,
                            'error'
                        )
                    }
                })
            }
        })
    })

    $("#form-edit").submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Mohon Tunggu Beberapa Saat',
            text: 'Proses update data',
            onBeforeOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: "<?= base_url('barang_toko/prosesEditBarang') ?>",
                    type: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(e) {
                        Swal.close();
                        if (e.status == 200) {
                            $('#modal-edit').modal('hide');
                            $('#form-edit').trigger("reset");
                            table_data.ajax.reload(null, true)
                            Swal.fire(
                                'Sukses',
                                e.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Oopss',
                                e.message,
                                'error'
                            )
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.close();
                        Swal.fire(
                            'Oopss',
                            xhr.responseText,
                            'error'
                        )
                    }
                })
            }
        })
    })

    function hapus(id) {
        swal.fire({
            title: 'Hapus Data ?',
            text: "Data akan terhapus secara permanent",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('barang_toko/prosesHapusBarang') ?>",
                    data: {
                        "id_data": id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 200) {
                            table_data.ajax.reload(null, true);
                            Swal.fire(
                                'Terhapus',
                                data.message,
                                'success'
                            );
                        } else {
                            Swal.close();
                            Swal.fire("Oops", data.message, "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Oops", xhr.responseText, "error");
                    }
                })
            }
        })
    }

    function edit(id) {
        $("#id_data").val(id)
        Swal.fire({
            title: 'Mohon Tunggu Beberapa Saat',
            text: 'Sedang Mengambil data...',
            onBeforeOpen: () => {
                Swal.showLoading();
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("barang_toko/get_barang") ?>",
                    dataType: "json",
                    data: {
                        id_barang: id
                    },
                    success: function(e) {
                        Swal.close();
                        $('#modal-edit').modal('show');
                        if (e.status == 200) {
                            $("#imgprev_edit").attr("src", e.data[0]["foto_barang"])
                            $("#kode_barang_edit").val(e.data[0].kode_barang)
                            $("#namabarang_edit").val(e.data[0].nama_barang)
                            $("#hargajual_edit").val(e.data[0].hargajual_barang)
                            $("#hargadiskon_edit").val(e.data[0].hargadiskon_barang)
                            $("#kategori_masterbarang_edit").val(e.data[0].kategori.id_kategori_barang)
                            $('#kategori_masterbarang_edit').trigger('change');
                            $("#satuan_barang_edit").val(e.data[0].satuan_barang)
                            $("#keterangan_barang_edit").val(e.data[0].keterangan_barang)
                            $("#keterangan_tambahan_edit").val(e.data[0].keterangan_tambahan)
                        } else {
                            $('#modal-edit').modal('hide');
                            Swal.fire("Oops", "Terjadi kesalahan saat mengambil data", "error");
                        }
                    }
                })
            }
        })
    }
</script>