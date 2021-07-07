<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Kategori Barang Jenis Toko <b><?= $jenis_toko["nama"] ?></b></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= base_url("kategori_barang") ?>" class="btn btn-info">Kembali &nbsp;</a>
                        <button data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary">Tambah Kategori Barang &nbsp;<i class="fa fa-plus text-sm"></i></button>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tablex" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="50">Icon</th>
                                    <th>Nama Kategori Barang</th>
                                    <th>Utama ?</th>
                                    <th>Aktif ?</th>
                                    <th>Terakhir di perbaharui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-tambah" role="dialog">
    <div class="modal-dialog modal-md">
        <form id="form-tambah" enctype="multipart/form-data" action="<?= base_url("kategori_barang/tambah") ?>" method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Kategori Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Icon Kategori Barang</label>
                                <div class="media" style="max-height: 360px; margin-bottom: 10px;">
                                    <div class="social-profile">
                                        <img class="img-fluid p-0" id="imgprev" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                                        <div class="profile-hvr m-t-15 ">
                                            <div class="image-upload">
                                                <label for="imgInp">
                                                    <i for="imgInp" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                </label>
                                                <input id="imgInp" type="file" name="icon" accept="image/*">
                                                <i id="imgdel" class="fa fa-trash c-pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b>Catatan : </b>Ukuran gambar maksimal 1MB
                                <div class="form-group">
                                    <label for="kode_barang">Nama Kategori Barang</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Kategori Barang" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Utama ?</label>
                                    <select required class="form-control select2" name="is_active">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Aktif ?</label>
                                    <select required class="form-control select2" name="is_enable">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer ">
                    <input type="hidden" name="jenis_kategori" value="<?= $kode ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="btnKirim" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-edit" role="dialog">
    <div class="modal-dialog modal-md">
        <form id="form-edit" enctype="multipart/form-data" action="<?= base_url("kategori_barang/edit") ?>" method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Kategori Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Icon Kategori Barang</label>
                                <div class="media" style="max-height: 360px; margin-bottom: 10px;">
                                    <div class="social-profile">
                                        <img class="img-fluid p-0" id="imgprev_edit" src="<?= base_url() ?>assets/img/no-img.jpg" alt="">
                                        <div class="profile-hvr m-t-15 ">
                                            <div class="image-upload">
                                                <label for="imgInp_edit">
                                                    <i for="imgInp_edit" class="fa fa-pencil-alt p-r-10 c-pointer"></i>
                                                </label>
                                                <input id="imgInp_edit" type="file" name="icon" accept="image/*">
                                                <i id="imgdel_edit" class="fa fa-trash c-pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b>Catatan : </b>Ukuran gambar maksimal 1MB
                                <div class="form-group">
                                    <label for="kode_barang">Nama Kategori Barang</label>
                                    <input type="text" class="form-control" id="nama_edit" placeholder="Masukkan Nama Kategori Barang" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Utama ?</label>
                                    <select required class="form-control select2" name="is_active" id="is_active_edit">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Aktif ?</label>
                                    <select required class="form-control select2" name="is_enable" id="is_enable_edit">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer ">
                    <input type="hidden" id="id_data" name="id_data">
                    <input type="hidden" name="jenis_kategori" value="<?= $kode ?>">
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
            "url": "<?= base_url('kategori_barang/getData/' . $kode) ?>",
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
            },
            {
                data: "id",
                className: "align-top",
                render: function(data, type, row, meta) {
                    let result = '<a href="' + row.foto_kategori_barang + '" target="_blank" rel="noopener noreferrer">';
                    result += '<img style="height: 50px;" src="' + row.foto_kategori_barang + '" alt="">';
                    result += '</a>';
                    return result;
                }
            },
            {
                data: "nama_kategori_barang",
                className: "align-top",
            },
            {
                data: "is_active",
                className: "align-top",
                render: function(data, type, row, meta) {
                    return data == "1" ? "Ya" : "Tidak"
                }
            },
            {
                data: "is_enable",
                className: "align-top",
                render: function(data, type, row, meta) {
                    return data == "1" ? "Ya" : "Tidak"
                }
            },
            {
                data: "updated_at",
                className: "align-top",
            },
            {
                data: "id_kategori_barang",
                className: "align-top",
                render: function(data, type, row, meta) {
                    let base_url = "<?= base_url() ?>";
                    let buttonJawab = '<button onclick="edit(' + data + ');" type="button" class="btn btn-primary btn-xs" data-toggle="modal"><span class="fa fa-edit"> </span>Edit</button>&nbsp;&nbsp;'
                    let result = "";
                    result += buttonJawab
                    result += '<button onclick="hapus(' + data + ')" class="btn btn-danger btn-xs" data-toggle="modal"><span class="fa fa-edit"> </span>Hapus</button>';
                    return result;
                }
            },
        ]
    })

    $("#form-tambah").submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Mohon Tunggu Beberapa Saat',
            text: 'Proses menambah data',
            onBeforeOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: "<?= base_url('kategori_barang/tambah') ?>",
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
            text: 'Proses menambah data',
            onBeforeOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: "<?= base_url('kategori_barang/edit') ?>",
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

    function edit(id) {
        $("#id_data").val(id)
        Swal.fire({
            title: 'Mohon Tunggu Beberapa Saat',
            text: 'Sedang Mengambil data...',
            onBeforeOpen: () => {
                Swal.showLoading();
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("kategori_barang/getDataById") ?>",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(e) {
                        Swal.close();
                        console.log(JSON.stringify(e.data["foto_kategori_barang"]))
                        $('#modal-edit').modal('show');
                        if (e.status == 200) {
                            $("#imgprev_edit").attr("src", e.data["foto_kategori_barang"])
                            $("#nama_edit").val(e.data["nama_kategori_barang"])
                            $("#is_active_edit").val(e.data["is_active"])
                            $('#is_active_edit').trigger('change');
                            $("#is_enable_edit").val(e.data["is_enable"])
                            $('#is_enable_edit').trigger('change');
                        } else {
                            $('#modal-edit').modal('hide');
                            Swal.fire("Oops", "Terjadi kesalahan saat mengambil data", "error");
                        }
                    }
                })
            }
        })
    }

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
                    url: "<?= base_url('kategori_barang/hapus') ?>",
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
</script>