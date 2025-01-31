<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">laporan tanggal <?= date('d F Y', strtotime($hari)); ?></h1>
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
                <h3 class="card-title">Detail Penjualan Harian</h3>
                <div class="card-tools">
                    <form action="" method="get" class="form-inline">
                        <?= csrf_field(); ?>
                        <input type="date" name="hari" class="form-control mr-2" value="<?= $hari; ?>">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
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
                            <?php if (session()->get('role') == 'super admin'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <?php $no = 1;
                        foreach ($data_hari as $transaksi): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td style="width: 100px;"><?= date('Y/m/d', strtotime($transaksi['tgl_transaksi'])); ?> <?= $transaksi['jam']; ?></td>
                                <td style="width: 50px;"><?= $transaksi['nama_kasir']; ?></td>
                                <td style="width: 50px;"><?= $transaksi['no_faktur']; ?></td>
                                <td style="width: 300px;"><?= $transaksi['nama_obat']; ?> </td>
                                <td><?=  number_format($transaksi['qty']); ?> <?= $transaksi['nama_satuan']; ?></td>
                                <td><?= number_format($transaksi['sub_total'], 0, ',', '.'); ?> </td>
                                <td style="width: 150px;"><?= number_format($transaksi['total_kotor'], 0, ',', '.'); ?> </td>
                                <td style="width: 15px;"><?= number_format($transaksi['diskon_persen']); ?> %</td>
                                <td style="width: 15px;"><?= number_format($transaksi['diskon_uang'], 0, ',', '.'); ?> </td>
                                <td style="width: 150px;"><?= number_format($transaksi['total_bersih'], 0, ',', '.'); ?> </td>
                                <?php if (session()->get('role') == 'super admin') : ?>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a type="button" class="btn btn-sm bg-gradient-info" href="<?= site_url('editTransaksi/' . $transaksi['no_faktur']); ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="hapusTransaksi('<?= $transaksi['no_faktur']; ?>')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" class="text-center">Total</th>
                            <th>Rp <?= number_format($sum_total_kotor, 0, ',', '.'); ?></th>
                            <th colspan="2"></th>
                            <th>Rp <?= number_format($sum_total_bersih, 0, ',', '.'); ?></th>
                            <th></th>
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
        var table = $('#example1').DataTable({
            "pageLength": 10
            
        });

        $('#pageLength').on('change', function() {
            var pageLength = parseInt($(this).val()); // Ambil nilai dropdown sebagai integer

            table.page.len(pageLength).draw(); // Ubah page length di tabel
        });
    });

    function hapusTransaksi(id) {
        Swal.fire({
            title: "Hapus item?",
            html: `Yakin Ingin menghapus <strong>${id}</strong>?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus !",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('/hapusTransaksi'); ?>",
                    data: {
                        no_faktur: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == 'berhasil') {
                            Swal.fire(
                                'Data berhasil dihapus',
                                response.success,
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        if (response.error) {
                            toastr.error().html(response.error);
                        }

                    }
                });
            }
        });

    }
</script>
<?= $this->endSection(); ?>