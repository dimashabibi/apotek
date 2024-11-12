<!DOCTYPE html>
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
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <img src="<?= base_url('assets/img/logo_apotek.png'); ?>" alt="" width="100px"> Apotek Sumbersekar
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <small class="float-right">Date: <?= date('d F Y'); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        Jl. Raya Sumbersekar No.2, RT.05/RW.02,<br>
                        Krajan, Sumbersekar, Kec. Dau, Kabupaten Malang<br>
                        Jawa Timur 65151<br>
                        Phone: 085175126445
                    </address>
                </div>

                <div class="col-sm-4 invoice-col">
                    <b>No Faktur:</b> <?= $invoice['no_faktur']; ?><br>
                    <b>Tanggal Transaksi:</b> <?= $invoice['tgl_transaksi']; ?> <?= $invoice['jam']; ?><br>
                    <b>Petugas:</b> <?= $invoice['nama_kasir']; ?><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-capitalize">No</th>
                                <th class="text-capitalize">Tanggal</th>
                                <th class="text-capitalize">petugas</th>
                                <th class="text-capitalize">Barcode</th>
                                <th class="text-capitalize">Nama obat</th>
                                <th class="text-capitalize">Kategori</th>
                                <th class="text-capitalize">Satuan</th>
                                <th class="text-capitalize">Harga Jual</th>
                                <th class="text-uppercase">Qty</th>
                                <th class="text-capitalize">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $j = 1; ?>
                            <?php foreach ($detail_transaksi_faktur as $value): ?>
                                <?php if ($value['no_faktur'] == $invoice['no_faktur']): ?>
                                    <tr>
                                        <td class="text-center text-bold"><?= $j++; ?></td>
                                        <td><?= $value['tgl_transaksi']; ?></td>
                                        <td><?= $value['nama_kasir']; ?></td>
                                        <td><?= $value['barcode_obat']; ?></td>
                                        <td><?= $value['nama_obat']; ?></td>
                                        <td><?= $value['nama_kategori']; ?></td>
                                        <td class="text-center"><?= $value['nama_satuan']; ?></td>
                                        <td class="text-center"><strong><?= "Rp " . number_format($value['harga_jual'], 0, ",", "."); ?></strong></td>
                                        <td class="text-center text-bold"><?= number_format($value['qty']); ?></td>
                                        <td class="text-center"><strong><?= "Rp" . number_format($value['sub_total'], 0, ",", "."); ?></strong></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Catatan:</p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Tanggal Transaksi <?= $invoice['tgl_transaksi']; ?></p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td><?= "Rp" . " " . number_format($invoice['total_kotor'], 0, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <th>Disc (%):</th>
                                <td><?= "%" . " " . number_format($invoice['diskon_persen'], 0, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <th>Disc (Rp) :</th>
                                <td><?= "Rp" . " " . number_format($invoice['diskon_uang'], 0, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td><?= "Rp" . " " . number_format($invoice['total_bersih'], 0, ",", "."); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Bootstrap -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>