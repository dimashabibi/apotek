<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">Halaman laporan transaksi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">laporan transaksi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($transaksi); ?></h3>

                <p>Jumlah Order</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= "Rp" . " " . number_format($total, 0, ",", "."); ?></h3>

                <p>Total Pemasukan</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-12">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        ?>
        <form action="" method="post">
            <?php csrf_field() ?>
            <div class="row">

                <div class="col-3">
                    <div class="form-group">
                        <label>Filter Tanggal:</label>
                        <div class="row">
                            <div class="col-5">
                                <input type="date" class="form-control" name="start_date" id="start_date"
                                    value="<?= $start_date ?? ''; ?>">
                                <small class="form-text text-muted">Tanggal Mulai</small>
                            </div>
                            <div class="col-5">
                                <input type="date" class="form-control" name="end_date" id="end_date"
                                    value="<?= $end_date ?? ''; ?>">
                                <small class="form-text text-muted">Tanggal Akhir</small>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label>Filter Periode:</label>
                        <div class="input-group">
                            <select class="form-control" name="period_filter" id="period_filter">
                                <option value="" hidden>Pilih Periode</option>
                                <option value="3_hari" <?= ($period_filter == '3_hari') ? 'selected' : '' ?>>3 Hari Terakhir</option>
                                <option value="7_hari" <?= ($period_filter == '7_hari') ? 'selected' : '' ?>>7 Hari Terakhir</option>
                                <option value="1_bulan" <?= ($period_filter == '1_bulan') ? 'selected' : '' ?>>1 Bulan Terakhir</option>
                            </select>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-filter"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label>Sort Order:</label>
                        <div class="input-group">
                            <select class="form-control text-capitalize select2" name="order" id="order">
                                <option value="<?= $order; ?>" hidden selected><?= $order; ?></option>
                                <option value="terbaru">terbaru</option>
                                <option value="terlama">terlama</option>
                            </select>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-save"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <div class="col-12">
        <div id="accordion">
            <?php foreach ($faktur as $faktur): ?>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapse_<?= $faktur['no_faktur']; ?>">
                        <div class="card-header">
                            <h4 class="card-title text-info w-100">
                                <table id="dataTable" class="table">
                                    <thead class="text-bold">
                                        <td>Tanggal Transaksi: <?= $faktur['tgl_transaksi']; ?> <?= $faktur['jam']; ?></td>
                                        <td>No Faktur: <?= $faktur['no_faktur']; ?></td>
                                        <td>Petugas: <?= $faktur['nama_kasir']; ?></td>
                                    </thead>
                                </table>
                            </h4>
                        </div>
                    </a>
                    <div id="collapse_<?= $faktur['no_faktur']; ?>" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-capitalize">No</th>
                                        <th class="text-capitalize">kode rak</th>
                                        <th class="text-capitalize">Barcode</th>
                                        <th class="text-capitalize">Nama obat</th>
                                        <th class="text-capitalize">konsinyasi</th>
                                        <th class="text-capitalize">Kategori</th>
                                        <th class="text-capitalize">Harga Jual</th>
                                        <th class="text-capitalize">Satuan</th>
                                        <th class="text-uppercase">Qty</th>
                                        <th class="text-capitalize">Disc (%)</th>
                                        <th class="text-capitalize">Disc (Rp)</th>
                                        <th class="text-capitalize">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $j = 1; ?>
                                    <?php foreach ($detail_transaksi as $value): ?>
                                        <?php if ($value['no_faktur'] == $faktur['no_faktur']): ?>
                                            <tr>
                                                <td class="text-center text-bold"><?= $j++; ?></td>
                                                <td><?= $value['kode_rak']; ?></td>
                                                <td><?= $value['barcode_obat']; ?></td>
                                                <td><?= $value['nama_obat']; ?></td>
                                                <td><?= $value['konsinyasi']; ?></td>
                                                <td><?= $value['nama_kategori']; ?></td>
                                                <td class="text-center"><strong><?= "Rp " . number_format($value['harga_jual'], 0, ",", "."); ?></strong></td>
                                                <td class="text-center"><?= $value['nama_satuan']; ?></td>
                                                <td class="text-center text-bold"><?= number_format($value['qty']); ?></td>
                                                <td colspan="2"></td>
                                                <td class="text-center"><strong><?= "Rp " . number_format($value['sub_total'], 0, ",", "."); ?></strong></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center text-danger">
                                        <th colspan="8"><strong>TOTAL BERSIH</strong></th>
                                        <th><strong><?php
                                                    $sub_qty = 0;
                                                    foreach ($detail_transaksi as $value) {
                                                        if ($value['no_faktur'] == $faktur['no_faktur']) {
                                                            $sub_qty += $value['qty'];
                                                        }
                                                    }
                                                    echo $sub_qty;
                                                    ?></strong></th>
                                        <th> <?= number_format($faktur['diskon_persen']) . " %"; ?></th>
                                        <th> <?= number_format($faktur['diskon_uang'], 0, ",", "."); ?></th>
                                        <th><strong><?= "Rp " . number_format($faktur['total_bersih'], 0, ",", "."); ?></strong></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <a class="btn btn-primary" href="/invoice/<?= $faktur['no_faktur']; ?>">
                                <i class="fas fa-file-invoice"></i> Invoice
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- /.col -->

</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    $(document).ready(function() {

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('#period_filter').change(function() {
            if ($(this).val() === 'custom') {
                $('#custom_date_filter').show();
            } else {
                $('#custom_date_filter').hide();
            }
        });

    });
</script>
<?= $this->endSection(); ?>