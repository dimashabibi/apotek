<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman pembelian Obat</h1>
            </div><!-- /.col -->
            <div class=" col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">Transaksi</a></li>
                    <li class="breadcrumb-item text-capitalize active">pembelian Obat</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?= form_open('/simpanPembelian', ['class' => 'formPembelian']); ?>
<?= csrf_field(); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label for="" class="text-capitalize">no Pembelian</label>
                            <input type="text" class="form-control text-danger text-bold" id="id_pembelian" name="id_pembelian" value="<?= $id_pembelian; ?>" readonly>
                        </div>
                    </div>
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    ?>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="" class="text-capitalize">tanggal</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" name="tgl_pembelian" id="tgl_pembelian" class="form-control datetimepicker-input" data-target="#reservationdate" autocomplete="off" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="" class="text-capitalize">Supplier</label>
                            <div class="input-group">
                                <select name="id_supplier" id="id_supplier" class="form-control">
                                    <option value="" selected hidden>-- Pilih Supplier --</option>
                                    <?php foreach ($supplier as $value) : ?>
                                        <option value="<?= $value['id']; ?>"><?= $value['nama_supplier']; ?></option>
                                    <?php endforeach;  ?>
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn btn-primary btnTambahSupplier" id="btnTambahSupplier" title="Tambah Supplier">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="" class="text-capitalize">No Faktur</label>
                            <input name="no_faktur" id="no_faktur" class="form-control" placeholder="Input no faktur dari supplier">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="" class="text-capitalize">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        </div>
                    </div>
                    <!-- row card -->
                </div>
            </div>
        </div>
    </div>

    <div class="modalTambah" style="display: none;"></div>



    <div class="col-sm-9">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <input type="hidden" id="id_pembelian" name="id_pembelian" value="<?= $id_pembelian; ?>">
                    <input type="hidden" id="kode_rak" name="kode_rak">
                    <input type="hidden" id="nama_kategori" name="nama_kategori">
                    <input type="hidden" class="form-control" placeholder="Harga Pokok" id="harga_pokok" name="harga_pokok">
                    <div class="col-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ketik Barcode/Nama Obat/Kode Rak" name="barcode_obat" id="barcode_obat" title="Input Barcode/Nama Obat/Kode Rak">
                            <div class="input-group-append">
                                <button type="button" class="btn btn btn-primary btnTambahObat" id="btnTambahObat" title="Tambah Obat">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Obat" id="nama_obat" name="nama_obat" readonly>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Satuan" id="nama_satuan" name="nama_satuan" readonly>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="input-group">
                            <input type="number" min="1" value="1" class="form-control text-center" placeholder="QTY" id="qty" name="qty" title="Input quantity">
                        </div>
                    </div>
                    <div class="col-2 text-center">
                        <button type="button" id="simpanTemp" class="btn btn-info" title="Simpan data obat"><i class="fas fa-check"></i></button>
                        <button type="reset" id="reset_obat" class="btn btn-warning" title="Reset input"><i class="fas fa-sync"></i></button>
                        <button type="button" id="hapus_tab" name="hapus_tab" class="btn btn-danger" title="Hapus table"><i class="fas fa-trash-alt"></i></button>
                        <button type="submit" class="btn btn-success buttonSimpan" title="Simpan data"><i class="fas fa-save"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- -------------------------------------------- display total beli ------------------------------------------------------- -->
    <div class="col-sm-3">
        <div class="card card-primary card-outline">
            <div class="card-header">
            </div>
            <div class="card-body bg-black text-right collor-pallete" style="height: 80px;">
                <input id="total_pembelian" name="total_pembelian" class="form-control form-control-lg form-control-border text-right text-green display-4" value="0" width="100%" style="background-color: black; font-size:45px; height: 50px;" title="Total pembelian" readonly>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------- Input Produk ----------------------------------------------------- -->
</div> <!-- row end -->
<?= form_close(); ?>


<div class="col-12">
    <div class="card card-primary card-outline" title="table data obat">
        <div class="card-body">
            <div class="dataDetailPembelian"></div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('body').addClass('sidebar-collapse');

        hitungTotalBeli();
        dataDetailPembelian();
        $('#barcode_obat').focus();

        $(document).keydown(function(e) {
            if (e.keyCode == 27) {
                e.preventDefault();
                $('#barcode_obat').focus();
            }
            // hapus input (ctrl + backspace)
            if (e.ctrlKey && e.keyCode === 8) {
                e.preventDefault();
                Kosong();
            }
            // hapus input end
        });

        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#reset_obat').click(function(e) {
            e.preventDefault();
            Kosong();
        });

        $('#barcode_obat').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?= base_url('/autofillPembelian'); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        barcode_obat: request.term
                    },
                    success: function(data) {
                        if (data.success === 'berhasil') {
                            response($.map(data.data, function(item) {
                                return { // Value set in the input field
                                    value: item.value, // Value set in the input field
                                    id: item.id,
                                    harga_pokok: item.harga_pokok,
                                    stok_obat: item.stok_obat,
                                    nama_satuan: item.nama_satuan,
                                    kode_rak: item.kode_rak,
                                    nama_obat: item.nama_obat,
                                };
                            }));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                $('#barcode_obat').val(ui.item.value);
                $('#nama_obat').val(ui.item.nama_obat);
                $('#harga_pokok').val(ui.item.harga_pokok);
                $('#kode_rak').val(ui.item.kode_rak);
                $('#nama_satuan').val(ui.item.nama_satuan);
                $('#barcode_obat').prop('disabled', true);
                $('#qty').focus();
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append(
                    `<div style="display: flex; justify-content: space-between; align-items: center; padding: 5px 10px; border-bottom: 1px solid #ddd;">
                <span style="width: 90px; font-weight: bold; color: #555;">${item.kode_rak}</span>
                <span style="flex-grow: 3; padding-left: 10px; color: #333;">${item.nama_obat}</span>
                <span style="width: 50px; padding-left: 25px; color: #333;">${item.stok_obat}</span>
                <span style="width: 40px; padding-left: 10px; color: #333;">${item.nama_satuan}</span>
                <span style="width: 200px; text-align: right; font-weight: bold; color: #555;">${item.harga_pokok}</span>
            </div>`
                )
                .appendTo(ul);
        };



        $('#qty').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                simpanTempPembelian();
            }
        });

        $('#savePembelian').click(function(e) {
            e.preventDefault();
            detailPembelian();
        });

        $('#hapus_tab').click(function(e) {
            Swal.fire({
                title: "Hapus Table Pembelian?",
                html: "Yakin Batalkan Pembelian?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus !",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('/batalPembelian'); ?>",
                        data: {
                            id_pembelian: $('#id_pembelian').val()
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == 'berhasil') {
                                window.location.reload();

                            }
                        },
                        error: function(xhr, status, error) {
                            let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                            alert("Terjadi kesalahan:\n" + errorMessage);
                        }
                    });
                }
            });
        });

        $('.formPembelian').validate({
            rules: {
                tgl_pembelian: {
                    required: true,
                },
                id_supplier: {
                    required: true
                },
                no_faktur: {
                    required: true
                },
            },
            messages: {
                tgl_pembelian: {
                    required: "Tanggal belum diinput"
                },
                id_supplier: {
                    required: "Supplier belum dipilih"
                },
                no_faktur: {
                    required: "No Faktur Belum diinput",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                // Hanya jalankan ajax jika form valid

                Swal.fire({
                    title: "Simpan Pembelian",
                    text: "Apakah ingin menyimpan pembelian ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, simpan !",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(form).attr('action'),
                            data: $(form).serialize(),
                            dataType: "json",
                            beforeSend: function() {
                                $('.buttonSimpan').prop('disabled', true);
                                $('.buttonSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                            },
                            complete: function() {
                                $('.buttonSimpan').prop('disabled', false);
                                $('.buttonSimpan').html('<i class="fas fa-save">');
                            },
                            success: function(response) {
                                if (response.success == 'berhasil') {
                                    var Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Data pembelian berhasil diinput'
                                    })
                                    window.location.reload();
                                }
                                if (response.error) {
                                    var Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    Toast.fire({
                                        icon: 'error',
                                        html: `<strong>${response.error}</strong>`
                                    })
                                }
                            }
                        });
                    }
                });
            }
        });



        $('#btnTambahSupplier').click(function(e) {
            e.preventDefault();
            console.log("Button tambah supplier diklik");
            tambahSupplier();
        });
        $('#btnTambahObat').click(function(e) {
            e.preventDefault();
            console.log("Button tambah supplier diklik");
            window.location.href = '/create_obat';
        });

        $('#simpanTemp').click(function(e) {
            e.preventDefault();
            simpanTempPembelian();
        });

    });

    // -----------------------------------------------------  Data Detail Pembelian
    function dataDetailPembelian() {
        $.ajax({
            type: "post",
            url: '<?= base_url('/dataDetailPembelian'); ?>',
            data: {
                id_pembelian: $('#id_pembelian').val()
            },
            dataType: 'json',
            beforeSend: function() {
                $('.dataDetailPembelian').html('<i class="fa fa-spin fa-spinner"></i>'); // Tampilkan spinner
            },
            success: function(response) {
                if (response.data) {
                    $('.dataDetailPembelian').html(response.data); // Inject pedata ke tampilan
                } else {
                    toastr.error('Tidak ada data detail pembelian');
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                alert("Terjadi kesalahan:\n" + errorMessage);
            }
        });
    }
    // data detail Pembelian end

    // --------------------------------------------------------  Function Simpan Temp
    function simpanTempPembelian() {
        let barcode = $('#barcode_obat').val();
        $.ajax({
            type: "post",
            url: "<?= site_url('/simpanTempPembelian'); ?>",
            data: {
                barcode_obat: barcode,
                nama_obat: $('#nama_obat').val(),
                kode_rak: $('#kode_rak').val(),
                nama_kategori: $('#nama_kategori').val(),
                nama_satuan: $('#nama_satuan').val(),
                harga_pokok: $('#harga_pokok').val(),
                qty: $('#qty').val(),
                id_pembelian: $('#id_pembelian').val(),
            },
            dataType: "json",
            success: function(response) {
                if (response.success == 'berhasil') {
                    dataDetailPembelian();
                    Kosong();
                }
                if (response.error) {
                    toastr.error().html(response.error);
                    dataDetailPembelian();
                    Kosong();
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                alert("Terjadi kesalahan:\n" + errorMessage);
            }
        });
    }
    // Simpan Temp End



    // --------------------------------------------------------  Function Kosong
    function Kosong() {
        $('#barcode_obat').val('');
        $('#nama_obat').val('');
        $('#nama_satuan').val('');
        $('#harga_pokok').val('');
        $('#qty').val('1');
        $('#barcode_obat').prop('disabled', false);
        $('#barcode_obat').focus();

        hitungTotalBeli();
    }
    // kosong end

    // --------------------------------------------------------  Function hitung total pembelian
    function hitungTotalBeli() {
        $.ajax({
            type: "post",
            url: "<?= base_url('/hitungTotalBeli'); ?>",
            data: {
                id_pembelian: $('#id_pembelian').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.totalbeli) {
                    $('#total_pembelian').val(response.totalbeli);
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                alert("Terjadi kesalahan:\n" + errorMessage);
            }
        });
    }
    // hitung total pembelian end

    // --------------------------------------------------------  Function Tambah supplier
    function tambahSupplier() {
        $.ajax({
            type: "post",
            url: "<?= site_url('/tambahSupplier'); ?>",
            dataType: "json",
            success: function(response) {
                if (response.modalTambah) {
                    $('.modalTambah').html(response.modalTambah).show();
                    $('#modalTambahSupplier').on('shown.bs.modal', function(event) {
                        $('#inputSupplier').focus();
                    });
                    $('#modalTambahSupplier').modal('show');

                }
            }
        });
    }
    // tambah supplier end
</script>

<?= $this->endSection(); ?>