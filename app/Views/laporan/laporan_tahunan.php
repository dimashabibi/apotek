<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">laporan Tahun <?= date('Y', strtotime($tahun)); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">laporan Tahunan</li>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Penjualan Tahunan</h3>
                <div class="card-tools">
                    <form action="" method="get" class="form-inline">
                        <input
                            type="number"
                            name="tahun"
                            class="form-control mr-2"
                            value="<?= isset($tahun) ? htmlspecialchars($tahun) : ''; ?>"
                            placeholder="Tahun"
                            min="1900"
                            max="<?= date('Y'); ?>">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead class="tet-center">
                        <tr>
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal</th>
                            <th>Detail Obat</th>
                            <th>Total Qty</th>
                            <th>Total Penjualan</th>
                            <th>Diskon Uang</th>
                            <th>Diskon Persen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_tahun as $transaksi): ?>
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
                                                    <td><?= $item['total_qty']; ?> <?= $item['nama_satuan']; ?></td>
                                                    <td>Rp <?= number_format($item['harga_jual'], 0, ',', '.'); ?></td>
                                                    <td>Rp <?= number_format($item['total_penjualan'], 0, ',', '.'); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-center"><?= $transaksi['total_qty']; ?></td>
                                <td class="text-center">Rp <?= number_format($transaksi['total_penjualan'], 0, ',', '.'); ?></td>
                                <td class="text-center">Rp <?= number_format($transaksi['diskon_uang'], 0, ',', '.'); ?></td>
                                <td class="text-center"><?= number_format($transaksi['diskon_persen'], 0, ',', '.'); ?> %</td>
                            </tr>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="text-center">
                        <tr>
                            <th colspan="4">Total</th>
                            <th><?= number_format($total_qty); ?></th>
                            <th>Rp <?= number_format($total_penjualan, 0, ',', '.'); ?></th>
                            <th>Rp <?= number_format($total_diskon_uang, 0, ',', '.'); ?></th>
                            <th><?= number_format($total_diskon_persen, 0, ',', '.'); ?> %</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection(); ?>