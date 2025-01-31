<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">laporan Bulan <?= date('F', strtotime($bulan)); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active">laporan Bulanan</li>
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
                <h3 class="card-title">Detail Penjualan Bulanan</h3>
                <div class="card-tools">
                    <form action="" method="get" class="form-inline">
                        <?= csrf_field(); ?>
                        <input type="month" name="bulan" class="form-control mr-2" value="<?= $bulan; ?>">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead class="tet-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Pembelian</th>
                            <th>Nama Obat</th>
                            <th>Qty</th>
                            <th>Jumlah</th>
                            <th>Total Pembelian</th>
                            <?php if (session()->get('role') == 'super admin'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_bulan as $pembelian): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= $pembelian['id_pembelian']; ?></td>
                                <td class="text-center"><?= date('d F Y', strtotime($pembelian['tgl_pembelian'])); ?></td>
                                <td><?= $pembelian['nama_obat']; ?></td>
                                <td class="text-center"><?= $pembelian['qty']; ?></td>
                                <td class="text-center">Rp <?= number_format($pembelian['sub_total'], 0, ',', '.'); ?></td>
                                <td class="text-center">Rp <?= number_format($pembelian['total_pembelian'], 0, ',', '.'); ?></td>
                                <?php if (session()->get('role') == 'super admin') : ?>
                                    <td class="text-center">
                                        <a type="button" class="btn btn-sm bg-gradient-info" href="<?= site_url('editPembelian/' . $pembelian['id_pembelian']); ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusPembelian('<?= $pembelian['id_pembelian']; ?>')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="text-center">
                        <tr>
                            <th colspan="6">Total</th>
                            <th>Rp <?= number_format($total_pembelian, 0, ',', '.'); ?></th>
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
        var table = $('#datatable').DataTable({
            "pageLength": 10
        });

        $('#pageLength').on('change', function() {
            var pageLength = parseInt($(this).val()); // Ambil nilai dropdown sebagai integer

            table.page.len(pageLength).draw(); // Ubah page length di tabel
        });
    });


    function hapusPembelian(id) {
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
                    url: "<?= site_url('/hapusPembelian'); ?>",
                    data: {
                        id_pembelian: id
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