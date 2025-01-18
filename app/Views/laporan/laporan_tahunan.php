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
                    <li class="nav-item">
                        <a class="nav-link active" id="tahunan-tab" data-toggle="pill" href="#tahunan" role="tab" aria-controls="tahunan" aria-selected="true">Detail Penjualan Tahunan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rekap-tab" data-toggle="pill" href="#rekap" role="tab" aria-controls="rekap" aria-selected="false">Rekap Penjualan Tahunan</a>
                    </li>
                </ul>
                <div class="card-tools">
                    <div class="d-flex flex-row justify-content-end align-items-center">
                        <form action="" method="get" class="form-inline" id="yearForm">
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
                    <div class="tab-pane fade show active" id="tahunan" role="tabpanel" aria-labelledby="tahunan-tab">
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
                    <div class="tab-pane fade " id="rekap" role="tabpanel" aria-labelledby="rekap-tab">
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
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
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