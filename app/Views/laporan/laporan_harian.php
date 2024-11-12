<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">Halaman laporan harian</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">laporan harian</li>
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
                <h3 class="card-title">Laporan Obat Terlaris</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">tanggal</th>
                            <th class="text-capitalize">no faktur</th>
                            <th class="text-capitalize">Barcode</th>
                            <th class="text-capitalize">Nama obat</th>
                            <th class="text-capitalize">Kategori</th>
                            <th class="text-capitalize">Harga Jual</th>
                            <th class="text-uppercase">Qty</th>
                            <th class="text-capitalize">Disc (%)</th>
                            <th class="text-capitalize">Disc (Rp)</th>
                            <th class="text-capitalize">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($hari_ini as $value): ?>
                            <tr>
                                <td class="text-center text-bold"><?= $i++; ?></td>
                                <td><?= $value['tgl_transaksi']; ?> <?= $value['jam']; ?></td>
                                <td><?= $value['no_faktur']; ?></td>
                                <td><?= $value['kode_rak']; ?></td>
                                <td><?= $value['barcode_obat']; ?></td>
                                <td><?= $value['nama_obat']; ?></td>
                                <td><?= $value['nama_kategori']; ?></td>
                                <td class="text-center"><strong><?= "Rp " . number_format($value['harga_jual'], 0, ",", "."); ?></strong></td>
                                <td class="text-center text-bold"><?= number_format($value['qty']); ?> <?= $value['nama_satuan']; ?></td>
                                <td class="text-center"><strong><?= "%" . number_format($value['diskon_persen'], 0, ",", "."); ?></strong></td>
                                <td class="text-center"><strong><?= "Rp" . number_format($value['diskon_uang'], 0, ",", "."); ?></strong></td>
                                <td class="text-center"><strong><?= "Rp " . number_format($value['sub_total'], 0, ",", "."); ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
    });
</script>
<?= $this->endSection(); ?>