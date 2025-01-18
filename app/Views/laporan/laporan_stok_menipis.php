<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman stok menipis</h1>
            </div><!-- /.col -->
            <div class=" col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">laporan stok menipis</li>
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
                <h3 class="card-title">Daftar Stok Menipis</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Rak</th>
                            <th>Barcode Obat</th>
                            <th>kandungan</th>
                            <th>Nama Obat</th>
                            <th>Gol Obat</th>
                            <th>Kategori</th>
                            <th>Konsinyasi</th>
                            <th>Stok Min</th>
                            <th>Stok Tersedia</th>
                            <th>Satuan</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Etiket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($stok_menipis as $row): ?>
                            <?php if (!is_null($row['stok_obat']) && $row['stok_obat'] > 0 && $row['stok_obat'] <= $row['stok_min']) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row['kode_rak']; ?></td>
                                    <td><?= $row['barcode_obat']; ?></td>
                                    <td><?= $row['merk_obat']; ?></td>
                                    <td><?= $row['nama_obat']; ?></td>
                                    <td><?= $row['nama_golongan']; ?></td>
                                    <td><?= $row['nama_kategori']; ?></td>
                                    <td><?= $row['konsinyasi']; ?></td>
                                    <td><?= number_format($row['stok_min']); ?></td>
                                    <?php if ($row['stok_obat'] == 0) : ?>
                                        <td class="bg-danger"><?= number_format($row['stok_obat']); ?></td>
                                    <?php elseif ($row['stok_obat'] <= $row['stok_min']) : ?>
                                        <td class="bg-warning"><?= number_format($row['stok_obat']); ?></td>
                                    <?php else: ?>
                                        <td><?= number_format($row['stok_obat']); ?></td>
                                    <?php endif; ?>
                                    <td><?= $row['nama_satuan']; ?></td>
                                    <td><?= "Rp" . " " . " " .  number_format($row['harga_pokok'], 0, ",", "."); ?></td>
                                    <td><?= "Rp" . " " . " " . number_format($row['harga_jual'], 0, ",", "."); ?></td>
                                    <td><?= $row['nama_etiket']; ?></td>
                                </tr>
                            <?php endif; ?>
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Stok Habis</h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Rak</th>
                            <th>Barcode Obat</th>
                            <th>Kandungan</th>
                            <th>Nama Obat</th>
                            <th>Gol Obat</th>
                            <th>Kategori</th>
                            <th>Konsinyasi</th>
                            <th>Stok Min</th>
                            <th>Stok Tersedia</th>
                            <th>Satuan</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Etiket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($stok_menipis as $row): ?>
                            <?php if ($row['stok_obat'] == null || $row['stok_obat'] == 0) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row['kode_rak']; ?></td>
                                    <td><?= $row['barcode_obat']; ?></td>
                                    <td><?= $row['merk_obat']; ?></td>
                                    <td><?= $row['nama_obat']; ?></td>
                                    <td><?= $row['nama_golongan']; ?></td>
                                    <td><?= $row['nama_kategori']; ?></td>
                                    <td><?= $row['konsinyasi']; ?></td>
                                    <td><?= number_format($row['stok_min']); ?></td>
                                    <?php if ($row['stok_obat'] == 0) : ?>
                                        <td class="bg-danger"><?= number_format($row['stok_obat']); ?></td>
                                    <?php elseif ($row['stok_obat'] <= $row['stok_min']) : ?>
                                        <td class="bg-warning"><?= number_format($row['stok_obat']); ?></td>
                                    <?php else: ?>
                                        <td><?= number_format($row['stok_obat']); ?></td>
                                    <?php endif; ?>
                                    <td><?= $row['nama_satuan']; ?></td>
                                    <td><?= "Rp" . " " . " " .  number_format($row['harga_pokok'], 0, ",", "."); ?></td>
                                    <td><?= "Rp" . " " . " " . number_format($row['harga_jual'], 0, ",", "."); ?></td>
                                    <td><?= $row['nama_etiket']; ?></td>
                                </tr>
                            <?php endif; ?>
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
        $("#example1,#example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection(); ?>