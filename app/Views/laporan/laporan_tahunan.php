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
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" id="rekap-tab" data-toggle="pill" href="#rekap" role="tab" aria-controls="rekap" aria-selected="false">Rekap Penjualan Tahunan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tahunan-tab" data-toggle="pill" href="#tahunan" role="tab" aria-controls="tahunan" aria-selected="true">Detail Penjualan Tahunan</a>
                    </li>
                </ul>
                <div class="card-tools">
                    <div class="d-flex flex-row justify-content-end align-items-center">
                        <form action="" method="get" class="form-inline" id="yearForm">
                            <?= csrf_field(); ?>
                            <!-- Tombol Previous Year -->
                            <button type="button"
                                class="btn btn-sm btn-outline-secondary mr-2"
                                onclick="changeYear(-1)">
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            <!-- Input Tahun -->
                            <div class="form-group">
                                <input type="number"
                                    name="tahun"
                                    id="tahunInput"
                                    class="form-control form-control-sm text-center mr-2"
                                    value="<?= isset($tahun) ? htmlspecialchars($tahun) : date('Y'); ?>"
                                    placeholder="Tahun"
                                    style="width: 100px;"
                                    min="1900"
                                    max="<?= date('Y'); ?>">
                            </div>

                            <!-- Tombol Next Year -->
                            <button type="button"
                                class="btn btn-sm btn-outline-secondary mr-2"
                                onclick="changeYear(1)"
                                <?= (isset($tahun) && $tahun >= date('Y')) ? 'disabled' : '' ?>>
                                <i class="fas fa-chevron-right"></i>
                            </button>

                            <!-- Tombol Filter -->
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="rekap" role="tabpanel" aria-labelledby="rekap-tab">
                        <form action="<?= site_url('exportpdf_tahunan'); ?>" method="get">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="tahun" value="<?= $tahun; ?>">
                            <button type="submit" class="btn btn-sm btn-info float-right">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </form>
                        <table class="table table-bordered table-striped" id="datatable2">
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
                                        <td class="text-center" style="width: 50px;"><?= $i++; ?></td>
                                        <td> <?= date('Y/m/d', strtotime($rekap['tanggal'])); ?></td>
                                        <td><?= "Rp" . " " . number_format($rekap['total_penghasilan'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-center"> Total</th>
                                    <th>Rp <?= number_format($income_per_tahun, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="tab-pane fade " id="tahunan" role="tabpanel" aria-labelledby="tahunan-tab">
                        <table class="table table-bordered table-striped" id="datatable1">
                            <thead class="tet-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>No Faktur</th>
                                    <th>Nama Obat</th>
                                    <th>Qty</th>
                                    <th>jumlah</th>
                                    <th>Total Kotor</th>
                                    <th>Diskon Persen</th>
                                    <th>Diskon Uang</th>
                                    <th>total_bersih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_tahun as $transaksi): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td style="width: 100px;"><?= date('Y/m/d', strtotime($transaksi['tgl_transaksi'])); ?> <?= $transaksi['jam']; ?></td>
                                        <td style="width: 50px;"><?= $transaksi['nama_kasir']; ?></td>
                                        <td style="width: 50px;"><?= $transaksi['no_faktur']; ?></td>
                                        <td style="width: 300px;"><?= $transaksi['nama_obat']; ?> </td>
                                        <td><?= number_format($transaksi['qty']); ?> <?= $transaksi['nama_satuan']; ?></td>
                                        <td><?= number_format($transaksi['sub_total'], 0, ',', '.'); ?> </td>
                                        <td style="width: 150px;"><?= number_format($transaksi['total_kotor'], 0, ',', '.'); ?> </td>
                                        <td style="width: 15px;"><?= number_format($transaksi['diskon_persen']); ?> %</td>
                                        <td style="width: 15px;"><?= number_format($transaksi['diskon_uang'], 0, ',', '.'); ?> </td>
                                        <td style="width: 15px;"><?= number_format($transaksi['total_bersih'], 0, ',', '.'); ?> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="text-center">
                                <tr>
                                    <th colspan="7">Total</th>
                                    <th>Rp <?= number_format($sum_total_kotor, 0, ',', '.'); ?></th>
                                    <th colspan="2"></th>
                                    <th class="text-danger">Rp <?= number_format($sum_total_bersih, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
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
        // Inisialisasi DataTables untuk kedua tabel
        var table1 = $('#datatable1').DataTable({
            "pageLength": 10
        });
        var table2 = $('#datatable2').DataTable({
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

    function changeYear(increment) {
        const input = document.getElementById('tahunInput');
        const currentYear = parseInt(input.value);
        const maxYear = <?= date('Y') ?>;

        // Hitung tahun baru
        let newYear = currentYear + increment;

        // Validasi range tahun
        if (newYear > maxYear) {
            newYear = maxYear;
        }
        if (newYear < 1900) {
            newYear = 1900;
        }

        // Update nilai input
        input.value = newYear;

        // Submit form
        document.getElementById('yearForm').submit();
    }
</script>
<?= $this->endSection(); ?>