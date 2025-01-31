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
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" id="menipis-tab" data-toggle="pill" href="#menipis" role="tab" aria-controls="menipis" aria-selected="false">Stok Menipis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="habis-tab" data-toggle="pill" href="#habis" role="tab" aria-controls="habis" aria-selected="true">Stok Habis</a>
                    </li>
                </ul>

            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="menipis" role="tabpanel" aria-labelledby="menipis-tab">
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

                    <div class="tab-pane fade " id="habis" role="tabpanel" aria-labelledby="habis-tab">
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
                </div>


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
    $(document).ready(function() {
        // Inisialisasi DataTables untuk kedua tabel
        var table1 = $('#example1').DataTable({
            "pageLength": 10
        });
        var table2 = $('#example2').DataTable({
            "pageLength": 10
        });

        // Event listener untuk dropdown page length
        $('#pageLength').on('change', function() {
            var pageLength = parseInt($(this).val()); // Ambil nilai dropdown sebagai integer
            var activeTab = $('.tab-pane.show.active').attr('id'); // Cek tab yang aktif

            if (activeTab === "menipis") {
                table1.page.len(pageLength).draw(); // Ubah page length di tabel 1
            } else if (activeTab === "habis") {
                table2.page.len(pageLength).draw(); // Ubah page length di tabel 2
            }
        });

        // Event listener untuk tab, supaya dataTables dirender ulang saat pindah tab
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        });
    });
</script>
<?= $this->endSection(); ?>