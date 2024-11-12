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
                <h3><?= $total_supplier; ?></h3>

                <p class="text-capitalize">Daftar Supplier</p>
            </div>
            <div class="icon">
                <i class="fas fa-store-alt"></i>
            </div>
            <a href="<?= base_url('daftar_supplier'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


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
    <div class="col-md-6">
        <!-- PIE CHART -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><span><i class="fas fa-chart-pie"></i></span> <strong>Penjualan per-kategori</strong> </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <!-- DONUT CHART -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><span><i class="fas fa-chart-line"></i></span> <strong>Grafik Penjualan</strong></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>





<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<!-- ChartJS -->
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js'); ?>"></script>
<script>
    $(function() {

        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var total_transaksi = [];
        var bulan_transaksi = [];

        <?php foreach ($data_transaksi as $value): ?>
            total_transaksi.push(<?= $value['jumlah']; ?>);
            bulan_transaksi.push(<?= $value['bulan']; ?>);
        <?php endforeach; ?>



        var areaChartData = {
            labels: bulan_transaksi,
            datasets: [{
                label: 'jumlah',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: total_transaksi
            }, ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                x: [{
                    gridLines: {
                        display: false,
                    }
                }],
                y: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var diagram_data_kategori = [];
        var label_data_kategori = [];

        <?php foreach ($data_kategori as $value) { ?> diagram_data_kategori.push(<?= $value['jumlah'] ?>);
            label_data_kategori.push('<?= $value['kategori'] ?>');
        <?php } ?>

        var diagram_penjualan_kategori = {
            datasets: [{
                label: 'jumlah',
                data: diagram_data_kategori,
                backgroundColor: ['#9DB2BF', '#B9E5E8', '#7AB2D3', '#4A628A', '#9B7EBD', '#D4BEE4', '#6A9C89', '#C4DAD2', '#FFEAD2', '#FCDE70'],
            }],
            labels: label_data_kategori,
        }

        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: diagram_penjualan_kategori,
            options: pieOptions
        })
    })
</script>
<?= $this->endSection(); ?>