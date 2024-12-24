<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman obat terlaris</h1>
            </div><!-- /.col -->
            <div class=" col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">daftar obat terlaris</li>
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
                <div class="card-tools">
                    <form action="" method="get" class="form-inline">
                        <input type="month" name="bulan" class="form-control mr-2" value="<?= $bulan; ?>">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Rak</th>
                            <th>Barcode Obat</th>
                            <th>Nama Obat</th>
                            <th>Konsinyasi</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Total Qty</th>
                            <th>Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data_terlaris as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['kode_rak']; ?></td>
                                <td><?= $row['barcode_obat']; ?></td>
                                <td class="text-capitalize"><?= $row['nama_obat']; ?></td>
                                <td class="text-capitalize"><?= $row['konsinyasi']; ?></td>
                                <td class="text-capitalize"><?= $row['nama_kategori']; ?></td>
                                <td class="text-center"><?= $row['nama_satuan']; ?></td>
                                <td class="text-center text-bold"><?= number_format($row['total_qty']); ?></td>
                                <td class="text-center text-bold"><?= "Rp" . " " . " " . number_format($row['total'], 0, ",", "."); ?></td>
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
    });
</script>
<?= $this->endSection(); ?>