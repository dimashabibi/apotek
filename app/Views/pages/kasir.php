<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css'); ?>">
    <!-- Font Jquery-ui -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.css'); ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css'); ?>">
</head>

<body class="hold-transition layout-top-nav" onload="startTime()">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <a href="<?= base_url('assets'); ?>/index3.html" class="navbar-brand me-3">
                <img src="<?= base_url('assets/img/logo_apotek.png'); ?>" width="150px">
            </a>
            <address class="ms-3">
                Apotek <strong>Sumbersekar</strong><br>
                Jl. Raya Sumbersekar No.2, RT.05/RW.02,<br>
                Krajan, Sumbersekar, Kec. Dau, Kabupaten Malang<br>
                Jawa Timur 65151<br>
                Phone: 085175126445
            </address>

            <div class=" navbar-collapse order-3" id="">
                <!-- Left navbar links -->
                <ul class="navbar-nav">

                </ul>
                <div class="container">
                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <li class="nav-item ms-3">
                            <a href="<?= site_url('home'); ?>" id="home" class="btn btn-success"><i class="fas fa-home"></i> (Home)</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="card card-primary card-outline">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">no faktur</label>
                                            <input type="text" class="form-control text-danger text-bold" id="no_faktur" name="no_faktur" value="<?= $no_faktur; ?>" readonly>
                                        </div>
                                    </div>
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    ?>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">tanggal</label>
                                            <input name="tanggal" id="tanggal" class="form-control text-bold" value="<?= date('d F Y'); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">jam</label>
                                            <input name="jam" id="jam" class="form-control text-bold" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">Nama Kasir</label>
                                            <input class="form-control text-bold" id="nama_kasir" name="nama_kasir" value="<?= session()->get('nama_user'); ?>" readonly>
                                        </div>
                                    </div>

                                    <!-- row card -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                            </div>
                            <!-- -------------------------------------------- display total bayar ------------------------------------------------------- -->

                            <div class="card-body bg-black text-right collor-pallete" style="height: 125px;">
                                <input id="totalbayar" name="totalbayar" class="form-control form-control-lg form-control-border text-right text-green display-4" value="0" width="100%" style="background-color: black; font-size:60px; height: 90px;" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- ----------------------------------------- Input Produk ----------------------------------------------------- -->

                    <div class="col-sm-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <?= form_open('/dataDetail'); ?>
                                <div class="row">
                                    <input type="hidden" id="no_faktur" name="no_faktur" value="<?= $no_faktur; ?>">
                                    <input type="hidden" id="nama_kategori" name="nama_kategori">
                                    <input type="hidden" id="nama_satuan" name="nama_satuan">
                                    <input type="hidden" class="form-control" placeholder="Harga Jual" id="harga_jual" name="harga_jual">
                                    <div class="col-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Ketik Barcode/Nama Obat/Kode Rak" name="barcode_obat" id="barcode_obat">
                                            <span class="input-group-append">
                                                <button id="search_obat" class="btn btn-flat btn-primary"><i class="fas fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Nama Obat" id="nama_obat" name="nama_obat" readonly>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Kode Rak" id="kode_rak" name="kode_rak" readonly>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="input-group">
                                            <input id="qty" type="number" min="1" value="1" class="form-control text-center" placeholder="QTY" name="qty">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button type="reset" id="reset_obat" class="btn btn-warning btn-flat"><i class="fas fa-sync"></i><span> (CTRL+Backspace)</span></button>
                                        <button
                                            type="button" id="hapus_tab" name="hapus_tab" class="btn btn-danger btn-flat"><i class="fas fa-trash-alt"></i>
                                            <span>(del)</span>
                                        </button>
                                        <button class="btn btn-success btn-flat" id="saveTransaksi"><i class="fas fa-cash-register"></i> <span>(F9)</span></button>
                                    </div>
                                </div>
                                <?= form_close(); ?>
                                <!-- Detail Transaksi -->
                                <div class="col-12 mt-4 dataDetailtransaksi"></div>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div> <!-- col-12 -->
                </div> <!-- row -->
                <div class="viewmodal" style="display: none;"></div>
                <div class="viewmodalpembayaran" style="display: none;"></div>
            </div>
        </div>




        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Default to the left -->
            <strong>Apotek Sumbersekar</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- jQuery UI -->
    <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.css'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/js/adminlte.min.js'); ?>"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- toastr -->
    <script src="<?= base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>


    <!-- search  -->
    <script>
        $(document).ready(function() {

            dataDetailtransaksi();
            hitungTotalBayar();
            $('#barcode_obat').focus();


            // key code function start document
            $(document).keydown(function(e) {

                // back home (home)
                if (e.keyCode == 36) {
                    e.preventDefault();
                    window.location.href = '<?= site_url('/home'); ?>';
                }
                // back home end

                // hapus input (ctrl + backspace)
                if (e.ctrlKey && e.keyCode === 8) {
                    e.preventDefault();
                    Kosong();
                }
                // hapus input end

                // focus input (ESC)
                if (e.keyCode == 27) {
                    e.preventDefault();
                    $('#barcode_obat').focus();

                }
                // focus input end

                // pembayaran (f9)
                if (e.keyCode == 120) {
                    e.preventDefault();
                    pembayaran();

                }
                // pembayaran end

                // hapus tab (delete)
                if (e.keyCode === 46) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Hapus Table Transaksi?",
                        html: "Yakin Batalkan Transaksi?",
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
                                url: "<?= site_url('/batalTransaksi'); ?>",
                                data: {
                                    no_faktur: $('#no_faktur').val()
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.success == 'berhasil') {
                                        window.location.reload();

                                    }

                                },
                                error: function(xhr, status, error) {
                                    alert("Error: " + error);
                                }
                            });
                        }
                    });
                }
                // hapus tab end
            });
            // keycode function end

            // kembali ke input barcode dari input qty (ESC)
            $('#qty').keydown(function(e) {
                if (e.keyCode == 27) {
                    e.preventDefault();
                    $('#barcode_obat').focus();

                }
            });
            // qty button end

            // button transaksi klik
            $('#saveTransaksi').click(function(e) {
                e.preventDefault();
                pembayaran();
            });
            $('#saveTransaksi').keydown(function(e) {
                if (keyCode == 120) {
                    e.preventDefault();
                    pembayaran();
                }
            });
            // button home

            $('#reset_obat').click(function(e) {
                e.preventDefault();
                Kosong();
            });

            // search obat (enter)
            $('#qty').keydown(function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    cekObat();

                }
            });

            // button search klik
            $('#search_obat').click(function(e) {
                e.preventDefault();
                cariObat();
            });



            //hapus tab button
            $('#hapus_tab').click(function(e) {
                Swal.fire({
                    title: "Hapus Table Transaksi?",
                    html: "Yakin Batalkan Transaksi?",
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
                            url: "<?= site_url('/batalTransaksi'); ?>",
                            data: {
                                no_faktur: $('#no_faktur').val()
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.success == 'berhasil') {
                                    window.location.reload();

                                }
                            },
                            error: function(xhr, status, error) {
                                alert("Error: " + error);
                            }
                        });
                    }
                });
            });
            // hapus tab button end

            $('#barcode_obat').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '<?= base_url('/autofill'); ?>',
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
                                        harga_jual: item.harga_jual,
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
                    $('#harga_jual').val(ui.item.harga_jual);
                    $('#kode_rak').val(ui.item.kode_rak);
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
                <span style="width: 200px; text-align: right; font-weight: bold; color: #555;">${item.harga_jual}</span>
            </div>`
                    )
                    .appendTo(ul);
            };

        });

        // -----------------------------------------------------  Data Detail Transaksi
        function dataDetailtransaksi() {
            $.ajax({
                type: "post",
                url: '<?= base_url('/dataDetail'); ?>',
                data: {
                    no_faktur: $('#no_faktur').val()
                },
                dataType: 'json',
                beforeSend: function() {
                    $('.dataDetailtransaksi').html('<i class="fa fa-spin fa-spinner"></i>'); // Tampilkan spinner
                },
                success: function(response) {
                    if (response.data) {
                        $('.dataDetailtransaksi').html(response.data); // Inject data ke tampilan
                    } else {
                        toastr.error('Tidak ada data detail transaksi');
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        }
        // data detaile transaksi end

        function cariObat() {
            let barcode = $('#barcode_obat').val();

            if (barcode.length == 0) {
                $.ajax({
                    url: '<?= base_url('/cekObat'); ?>',
                    type: "post",
                    dataType: 'json',
                    success: function(response) {
                        $('.viewmodal').html(response.viewmodal).show();
                        $('#modalObat').modal('show');
                        modalIsOpen = true;
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            }


        }

        // --------------------------------------------------------  Cek Obat
        function cekObat() {

            let barcode = $('#barcode_obat').val();
            let qty = $('#qty').val();

            if (qty.length == 0) {
                toastr.error('Quantity belum diinput');
            } else {
                $.ajax({
                    type: "post",
                    url: '<?= site_url('/simpanTemp'); ?>',
                    data: {
                        barcode_obat: barcode,
                        nama_obat: $('#nama_obat').val(),
                        kode_rak: $('#kode_rak').val(),
                        nama_kategori: $('#nama_kategori').val(),
                        nama_satuan: $('#nama_satuan').val(),
                        harga_jual: $('#harga_jual').val(),
                        qty: $('#qty').val(),
                        no_faktur: $('#no_faktur').val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == 'berhasil') {
                            dataDetailtransaksi();
                            Kosong();
                        }
                        if (response.error) {
                            toastr.error().html(response.error);
                            dataDetailtransaksi();
                            Kosong();
                        }

                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            }
        }
        $('#modalObat').on('hidden.bs.modal', function() {
            modalIsOpen = false;
        });
        // cek obat end

        // --------------------------------------------------------  Function Kosong
        function Kosong() {
            $('#kode_rak').val('');
            $('#barcode_obat').val('');
            $('#nama_obat').val('');
            $('#nama_kategori').val('');
            $('#nama_satuan').val('');
            $('#harga_jual').val('');
            $('#qty').val('1');
            $('#barcode_obat').prop('disabled', false);
            $('#barcode_obat').focus();

            hitungTotalBayar();
        }
        // kosong end

        // --------------------------------------------------------  Function Hitung Total Bayar
        function hitungTotalBayar() {

            $.ajax({
                type: "post",
                url: '<?= base_url('/hitungTotalBayar'); ?>',
                dataType: 'json',
                data: {
                    no_faktur: $('#no_faktur').val()
                },
                success: function(response) {
                    if (response.totalbayar) {
                        $('#totalbayar').val(response.totalbayar)
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        }
        // hitung end

        let modalOpened = false;

        function pembayaran() {
            if (modalOpened) return;
            let no_faktur = $('#no_faktur').val();
            $.ajax({
                type: "post",
                url: "<?= site_url('/pembayaran'); ?>",
                data: {
                    no_faktur: no_faktur,
                    tglTransaksi: $('#tanggal').val(),
                    jamTransaksi: $('#jam').val(),
                    namaKasir: $('#nama_kasir').val(),

                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        toastr.error(response.error);
                    }
                    if (response.data) {
                        $('.viewmodalpembayaran').html(response.data).show();
                        $('#modalPembayaran').on('shown.bs.modal', function(event) {
                            $('#jumlah_uang').focus();
                        });
                        $('#modalPembayaran').modal('show');
                        modalOpened = true;
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        }
        $('#modalPembayaran').on('hidden.bs.modal', function() {
            modalOpened = false;
        });

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);

            // Mengubah value dari input dengan id 'jam'
            document.getElementById('jam').value = h + ':' + m + ':' + s;

            // Mengatur interval pembaruan menjadi 1000ms (1 detik)
            setTimeout(function() {
                startTime();
            }, 1000);
        }

        function checkTime(i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        }

        // Memulai fungsi saat halaman dimuat
        window.onload = function() {
            startTime();
        };
    </script>
</body>

</html>