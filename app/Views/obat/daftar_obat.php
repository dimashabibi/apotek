<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman daftar obat</h1>
            </div><!-- /.col -->
            <div class=" col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">obat</a></li>
                    <li class="breadcrumb-item text-capitalize active">daftar obat</li>
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
                <h3 class="card-title"><span class="text-bold"><i class="fas fa-capsules"></i></span> Daftar Obat</h3>

                <a type="button" class="btn-sm btn-primary float-sm-right" href="<?= site_url('create_obat'); ?>">
                    <i class="fas fa-solid fa-plus nav-icon"></i>
                    Tambah Obat
                </a>
                <a type="button" class="btn-sm btn-success float-sm-right mr-2" href="<?= site_url('exportExcel'); ?>">
                    <i class="fas fa-file-excel nav-icon"></i>
                    Export Excel
                </a>
                <a type="button" class="btn-sm btn-info float-sm-right mr-2" href="<?= site_url('import_obat'); ?>">
                    <i class="fas fa-file-upload nav-icon"></i>
                    Import Excel
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
                            <?php if (session()->get('role') == 'super admin') : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($obat as $row): ?>
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
                                <?php if (session()->get('role') == 'super admin') : ?>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a type="button" class="btn btn-sm bg-gradient-info" href="<?= site_url('edit_obat/' . $row['id']); ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm bg-gradient-danger" data-toggle="modal"
                                                data-target="#modalDelete<?= $row['id']; ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                <?php endif; ?>
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

<!-- /.row -->



<!-- /.row -->

<!-- --------------------------------------------------------- Modal Delete ---------------------------------------------------------------- -->

<?php foreach ($obat as $delete) : ?>
    <div class="modal fade" id="modalDelete<?= $delete['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" method="get" action="<?= site_url('delete_obat/' . $delete['id']); ?>">
                        <?php csrf_field() ?>
                        <div class="form-group">
                            <h5>Apakah anda ingin menghapus data ini </h5>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn bg-gradient-danger">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(function() {
        $('body').addClass('sidebar-collapse');

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<?= $this->endSection(); ?>