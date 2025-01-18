<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">laporan Bulan <?= date('F Y', strtotime($bulan)); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">laporan Bulanan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="bulanan-tab" data-toggle="pill" href="#bulanan" role="tab" aria-controls="bulanan" aria-selected="true">Detail Penjualan Bulanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rekap-tab" data-toggle="pill" href="#rekap" role="tab" aria-controls="rekap" aria-selected="false">Rekap Penjualan Bulanan</a>
                    </li>
                </ul>
                <div class="card-tools">
                    <form action="" method="get" class="form-inline">
                        <input type="month" name="bulan" class="form-control mr-2" value="<?= $bulan; ?>">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="bulanan" role="tabpanel" aria-labelledby="bulanan-tab">
                        <table class="table table-bordered" id="datatable1">
                            <thead class="tet-center">
                                <tr>
                                    <th>No</th>
                                    <th>No Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Detail Obat</th>
                                    <th>Total Qty</th>
                                    <th>Total Kotor</th>
                                    <th>Diskon Persen</th>
                                    <th>Diskon Uang</th>
                                    <th>total_bersih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_bulan as $transaksi): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $transaksi['no_faktur']; ?></td>
                                        <td class="text-center"><?= date('d F Y', strtotime($transaksi['tgl_transaksi'])); ?></td>
                                        <td>
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Obat</th>
                                                        <th>Kategori</th>
                                                        <th>Qty</th>
                                                        <th>Harga</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($transaksi['items'] as $item): ?>
                                                        <tr>
                                                            <td><?= $item['nama_obat']; ?></td>
                                                            <td><?= $item['nama_kategori']; ?></td>
                                                            <td><?= $item['qty']; ?> <?= $item['nama_satuan']; ?></td>
                                                            <td>Rp <?= number_format($item['harga_jual'], 0, ',', '.'); ?></td>
                                                            <td>Rp <?= number_format($item['sub_total'], 0, ',', '.'); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="text-center"><?= $transaksi['total_qty']; ?></td>
                                        <td class="text-center">Rp <?= number_format($transaksi['total_kotor'], 0, ',', '.'); ?></td>
                                        <td class="text-center"><?= number_format($transaksi['diskon_persen']); ?> %</td>
                                        <td class="text-center">Rp <?= number_format($transaksi['diskon_uang']); ?></td>
                                        <td class="text-center">Rp <?= number_format($transaksi['total_bersih'], 0, ',', '.'); ?></td>
                                    </tr>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="text-center">
                                <tr>
                                    <th colspan="4">Total</th>
                                    <th><?= number_format($total_qty); ?></th>
                                    <th>Rp <?= number_format($total_kotor, 0, ',', '.'); ?></th>
                                    <th colspan="2"></th>
                                    <th class="text-danger">Rp <?= number_format($total_bersih, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                    <div class="tab-pane fade" id="rekap" role="tabpanel" aria-labelledby="rekap-tab">
                        <table class="table table-bordered stripped" id="datatable2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_rekap as $rekap): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= date('d F Y', strtotime($rekap['tanggal'])); ?></td>
                                        <td><?= "Rp" . " " . number_format($rekap['total_penghasilan'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('#datatable1, #datatable2').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection(); ?>