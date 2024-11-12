<?= $this->extend('layout/template');; ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">invoice</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">Invoice</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?= $this->section('content');; ?>

<div class="row">
    <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <img src="<?= base_url('assets/img/logo_apotek.png'); ?>" alt="" width="100px"> Apotek <strong>Sumbersekar</strong>
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <small class="float-right">Date: <?= date('d F Y'); ?> </small>
                    </h4>
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
                <!-- /.col -->

                <!-- /.col -->
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

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="/print/<?= $invoice['no_faktur']; ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <a type="button" href="<?= base_url('/laporan_transaksi'); ?>" class="btn btn-secondary float-right">close</a>
                </div>
            </div>
        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
</div><!-- /.row -->

<?= $this->endSection();; ?>