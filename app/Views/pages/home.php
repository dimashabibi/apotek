<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">home</a></li>
                    <li class="breadcrumb-item text-capitalize active">dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row">
    <?php if (session()->get('role') == 'super admin'): ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3><?= $total_obat; ?></h3>

                    <p class="text-capitalize">Daftar Obat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-capsules"></i>
                </div>
                <a href="<?= base_url('daftar_obat'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3><?= $stok_menipis; ?></h3>

                    <p class="text-capitalize">Stok Menipis</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="<?= base_url('laporan_menipis'); ?>" class="small-box-footer text-center">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?= $stok_habis; ?></h3>

                    <p class="text-capitalize">Stok Habis</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="<?= base_url('laporan_menipis'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive ">
                <div class="inner">
                    <h3><?= "Rp" . number_format($total_hutang); ?></h3>

                    <p class="text-capitalize">Daftar Hutang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-check"></i>
                </div>
                <a href="<?= base_url('hutang'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->get('role') == 'admin'): ?>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3><?= $total_obat; ?></h3>

                    <p class="text-capitalize">Daftar Obat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-capsules"></i>
                </div>
                <a href="<?= base_url('daftar_obat'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3><?= $stok_menipis; ?></h3>

                    <p class="text-capitalize">Stok Menipis</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="<?= base_url('laporan_menipis'); ?>" class="small-box-footer text-center">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?= $stok_habis; ?></h3>

                    <p class="text-capitalize">Stok Habis</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="<?= base_url('laporan_menipis'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    <?php endif; ?>


    <div class="col-md-4">
        <div class="info-box mb-3 bg-light">
            <span class="info-box-icon" style="background-color: #C6E7FF; border-radius: 10px;"><i class="fas fa-money-bill-wave text-lightblue"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Penjualan Hari Ini</span>
                <span class="info-box-number"><strong><?= "Rp" . " " . " " . number_format($income_per_hari, 0, ",", "."); ?></strong></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box mb-3 bg-light">
            <span class="info-box-icon" style="background-color: #C6E7FF; border-radius: 10px;"><i class="fas fa-money-bill-wave text-lightblue"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Penjualan Bulan <?= date('F'); ?></span>
                <span class="info-box-number"><strong><?= "Rp" . " " . " " . number_format($income_per_bulan, 0, ",", "."); ?></strong></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box mb-3 bg-light">
            <span class="info-box-icon" style="background-color: #C6E7FF; border-radius: 10px;"><i class="fas fa-money-bill-wave text-lightblue"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Penjualan Tahun <?= date('Y'); ?></span>
                <span class="info-box-number"><strong><?= "Rp" . " " . " " . number_format($income_per_tahun, 0, ",", "."); ?></strong></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>

    <!-- col-4 end -->
    <!-- PIE CHART -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Distribusi Kategori Obat
                    </h3>
                    <a href="<?= site_url('laporan_kategori'); ?>">Lihat Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <div class="mt-4" id="legend-container"></div>
            </div>
        </div>
    </div>
    <!-- /.card -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar"></i>
                        Grafik Penjualan
                    </h3>
                    <a href="<?= site_url('laporan_bulanan'); ?>">Lihat Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <?php
                        $total_keseluruhan = 0;
                        foreach ($data_transaksi as $value) {
                            $total_keseluruhan += $value['jumlah'];
                        }
                        ?>
                        <span class="text-bold text-lg">Rp <?= number_format($total_keseluruhan, 0, ',', '.') ?></span>
                        <span>Total Penjualan</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <?php
                        if (count($data_transaksi) >= 2) {
                            $last_month = end($data_transaksi)['jumlah'];
                            $prev_month = prev($data_transaksi)['jumlah'];
                            $growth = ($last_month - $prev_month) / $prev_month * 100;
                            $growth_class = $growth >= 0 ? 'text-success' : 'text-danger';
                            $growth_icon = $growth >= 0 ? 'up' : 'down';
                        ?>
                            <span class="<?= $growth_class ?>">
                                <i class="fas fa-arrow-<?= $growth_icon ?>"></i>
                                <?= number_format(abs($growth), 1) ?>%
                            </span>
                            <span class="text-muted">Dibandingkan bulan lalu</span>
                        <?php } ?>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <canvas id="barChart" height="200"></canvas>
                </div>
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
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Obat Terlaris <?= date('F'); ?></h3>
                    <a href="<?= site_url('laporan_terlaris'); ?>">Lihat Detail</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <div class="position-relative mb-4">
                    <table id="example1" class="table table-head-fixed text-nowrap">
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
            </div>
        </div>
    </div>
</div>





<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<!-- ChartJS -->
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js'); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var barChartCanvas = document.getElementById('barChart').getContext('2d');

        // Data dari PHP
        var total_transaksi = [
            <?php
            foreach ($data_transaksi as $value) {
                echo $value['jumlah'] . ',';
            }
            ?>
        ];

        var bulan_transaksi = [
            <?php
            $nama_bulan = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];
            foreach ($data_transaksi as $value) {
                echo "'" . $nama_bulan[$value['bulan'] - 1] . "',";
            }
            ?>
        ];

        // Fungsi untuk memformat angka ke format rupiah
        function formatRupiah(angka) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
        }

        // Data untuk chart
        var barChartData = {
            labels: bulan_transaksi,
            datasets: [{
                label: 'Total Penjualan',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                borderWidth: 1,
                data: total_transaksi
            }]
        };

        // Opsi untuk bar chart
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            return formatRupiah(value);
                        }
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return formatRupiah(tooltipItem.yLabel);
                    }
                }
            }
        };

        // Membuat chart
        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });


        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = document.getElementById('pieChart').getContext('2d');

        // Data from PHP query
        var kategori_data = [
            <?php foreach ($data_kategori as $value): ?> {
                    kategori: '<?= $value['kategori'] ?>',
                    jumlah: <?= $value['jumlah'] ?>
                },
            <?php endforeach; ?>
        ];

        // Prepare data for chart
        var labels = kategori_data.map(item => item.kategori);
        var data = kategori_data.map(item => item.jumlah);

        // Function to generate colors dynamically
        function generateColors(numColors) {
            var colors = [];

            // Base colors that look good together
            var baseColors = [
                '#9DB2BF', '#B9E5E8', '#7AB2D3', '#4A628A', '#9B7EBD',
                '#D4BEE4', '#6A9C89', '#C4DAD2', '#FFEAD2', '#FCDE70'
            ];

            // If we have enough base colors, use them first
            if (numColors <= baseColors.length) {
                return baseColors.slice(0, numColors);
            }

            // Use base colors
            colors = [...baseColors];

            // Generate additional colors using HSL
            for (let i = baseColors.length; i < numColors; i++) {
                // Use golden ratio to spread colors evenly
                const hue = (i * 137.508) % 360; // golden ratio in degrees
                const saturation = 65 + Math.random() * 10; // 65-75%
                const lightness = 45 + Math.random() * 10; // 45-55%

                colors.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`);
            }

            return colors;
        }

        // Generate colors based on number of categories
        var backgroundColors = generateColors(kategori_data.length);

        // Chart configuration
        var chartConfig = {
            datasets: [{
                data: data,
                backgroundColor: backgroundColors,
                borderWidth: 1,
                borderColor: '#fff'
            }],
            labels: labels
        };

        var chartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[0];
                        var label = data.labels[tooltipItem.index];
                        var value = dataset.data[tooltipItem.index];
                        var total = dataset.data.reduce((a, b) => a + b, 0);
                        var percentage = Math.round((value / total) * 100);

                        return `${label}: ${value} transaksi (${percentage}%)`;
                    }
                }
            }
        };

        // Create pie chart
        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: chartConfig,
            options: chartOptions
        });

        // Create custom legend with scrollable container if needed
        var legendContainer = document.getElementById('legend-container');
        var legendHtml = `
    <div class="row" style="max-height: 300px; overflow-y: auto;">
`;

        kategori_data.forEach((item, index) => {
            var total = data.reduce((a, b) => a + b, 0);
            var percentage = Math.round((item.jumlah / total) * 100);

            legendHtml += `
        <div class="col-6 mb-2">
            <div class="d-flex align-items-center">
                <span class="mr-2" style="
                    display: inline-block;
                    width: 12px;
                    height: 12px;
                    background-color: ${backgroundColors[index]};
                    border-radius: 2px;
                "></span>
                <span class="text-sm">
                    ${item.kategori}<br>
                    <small class="text-muted">
                        ${item.jumlah} transaksi (${percentage}%)
                    </small>
                </span>
            </div>
        </div>
    `;
        });

        legendHtml += '</div>';
        legendContainer.innerHTML = legendHtml;

    })

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