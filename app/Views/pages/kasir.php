<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css'); ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css'); ?>">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">

            <a href="<?= base_url('assets'); ?>/index3.html" class="navbar-brand me-3">
                <img src="<?= base_url('assets/img/logo.png'); ?>" width="150px">
                <span class="brand-text">Apotek <strong>Sumbersekar</strong></span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">

                </ul>
                <div class="container">
                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                        <li class="nav-item ms-3">
                            <a href="<?= site_url('home'); ?>" class="btn btn-success"><i class="fas fa-home"></i></a>
                        </li>
                    </ul>
                </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <div class="row">
                <div class="col-md-7">
                    <div class="card card-primary card-outline">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">no faktur</label>
                                        <label for="" class="form-control text-danger"><?= $no_faktur; ?></label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">tanggal</label>
                                        <label for="" class="form-control"><?= date('d m y'); ?></label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">jam</label>
                                        <label for="" class="form-control"><?= date('12:00:00'); ?></label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">Nama Kasir</label>
                                        <label for="" class="form-control"><?= session()->get('username') ?></label>
                                    </div>
                                </div>

                                <!-- row card -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                        </div>
                        <div class="card-body bg-black text-right collor-pallete">
                            <label class="display-4 text-green">Rp. 120,000,- </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <?= form_open(); ?>
                            <div class="row">
                                <div class="col-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input Barcode" name="barcode_obat" readonly>
                                    </div>
                                </div>
                                <div class="col-3">

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Nama Obat" id="nama_obat" name="nama_obat" autocomplete="off">
                                        <span class="input-group-append">
                                            <button class="btn btn-flat btn-primary" name="submit"><i class="fas fa-search"></i></button>
                                        </span>
                                        <span class="input-group-append">
                                            <button class="btn btn-flat btn-danger"><i class="fas fa-times"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Kategori" name="nama_kategori" readonly>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Satuan" name="nama_satuan" readonly>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Harga Jual" name="harga_jual" readonly>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="input-group">
                                        <input id="qty" type="number" min="1" value="1" class="form-control text-center" placeholder="QTY" name="qty">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-cart-plus"></i> <span>Add</span></button>
                                    <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-sync"></i> <span>clear</span></button>
                                    <button class="btn btn-success btn-flat"><i class="fas fa-cash-register"></i> <span>Pembayaran</span></button>
                                </div>
                            </div>
                            <?= form_close(); ?>


                            <!-- row card -->

                            <div class="col-12 mt-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-capitalize">Kode Barcode</th>
                                            <th class="text-capitalize">Nama Obat</th>
                                            <th class="text-capitalize">kategori</th>
                                            <th class="text-capitalize">satuan</th>
                                            <th class="text-capitalize">harga jual</th>
                                            <th class="text-capitalize" width="50px">qty</th>
                                            <th class="text-capitalize">total harga</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>123443242</td>
                                            <td class="text-capitalize text-center">Oskadon</td>
                                            <td class="text-capitalize text-center">Obat Dewasa</td>
                                            <td class="text-uppercase text-center">PCS</td>
                                            <td class="text-right">Rp. 2,000,-</td>
                                            <td class="text-center">2</td>
                                            <td class="text-right">Rp. 2,000,-</td>
                                            <td><button class="btn btn-sm btn-flat btn-danger"><i class="fas fa-times"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- card body -->
                    </div>
                </div>
                <!-- row -->
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
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/js/adminlte.min.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets/js/demo.js'); ?>s"></script>
    <!-- toastr -->
    <script src="<?= base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>

    <!-- search  -->
    <script>
        $(document).ready(function() {
            $('#nama_obat').focus();
            $('#nama_obat').keydown(function(e) {
                if (e.keyCode == 13) { // Ketika tombol Enter ditekan
                    e.preventDefault();
                    let nama_obat = $('#nama_obat').val(); // Ambil nilai input di dalam event
                    if (nama_obat == '') {
                        toastr.error('Harap menginput nama obat');
                    } else {
                        cekObat(nama_obat);
                    }
                }
            });
        });

        function cekObat(nama_obat) {
            $.ajax({
                url: '<?= base_url('/cekObat'); ?>', // Ganti dengan URL server Anda
                type: 'GET',
                data: {
                    nama_obat: nama_obat, // Mengirim nilai yang diambil dari input
                },
                success: function(response) {
                    console.log(response); // Tambahkan log untuk mengecek respons
                    if (response.nama_obat === '') {
                        toastr.error('Obat tidak terdaftar');
                    } else {
                        // Mengisi input berdasarkan respons
                        $('input[name="barcode_obat"]').val(response.barcode_obat);
                        $('input[name="nama_kategori"]').val(response.nama_kategori);
                        $('input[name="nama_satuan"]').val(response.nama_satuan);
                        $('input[name="harga_jual"]').val(response.harga_jual);
                        $('#qty').focus();
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        }
    </script>




</body>

</html>