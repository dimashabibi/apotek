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
                        <input type="date" name="hari" class="form-control mr-2" value="<?= $hari; ?>">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead >
                        <tr>
                            <th>No</th>
                            <th>Kasir</th>
                            <th>No Faktur</th>
                            <th>Tanggal</th>
                            <th>Detail Obat</th>
                            <th>Total Qty</th>
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
                                <td><?= $no++; ?></td>
                                <td class="py-0 align-middle"><?= $transaksi['nama_kasir']; ?></td>
                                <td class="py-0 align-middle"><?= $transaksi['no_faktur']; ?></td>
                                <td class="text-center py-0 align-middle"><?= date('d F Y', strtotime($transaksi['tgl_transaksi'])); ?></td>
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
                                <td class="text-center py-0 align-middle"><?= $transaksi['total_qty']; ?></td>
                                <td class="text-center py-0 align-middle">Rp <?= number_format($transaksi['total_kotor'], 0, ',', '.'); ?></td>
                                <td class="text-center py-0 align-middle"><?= number_format($transaksi['diskon_persen']); ?> %</td>
                                <td class="text-center py-0 align-middle">Rp <?= number_format($transaksi['diskon_uang']); ?></td>
                                <td class="text-center py-0 align-middle text-bold">Rp <?= number_format($transaksi['total_bersih'], 0, ',', '.'); ?></td>
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
                    <tfoot class="text-center">
                        <tr>
                            <th colspan="5">Total</th>
                            <th><?= number_format($total_qty); ?></th>
                            <th>Rp <?= number_format($total_kotor, 0, ',', '.'); ?></th>
                            <th colspan="2"></th>
                            <th class="text-danger">Rp <?= number_format($total_bersih, 0, ',', '.'); ?></th>
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
        $('#datatable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
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