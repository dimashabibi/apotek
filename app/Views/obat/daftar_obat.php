<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman daftar obat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
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
                <h3 class="card-title">Daftar Obat</h3>
                <a type="button" class="btn-sm btn-primary float-sm-right" href="<?= site_url('create_obat'); ?>">
                    <i class="fas fa-solid fa-plus nav-icon"></i>
                    Tambah Obat
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode Obat</th>
                            <th>Nama Obat</th>
                            <th>Gol Obat</th>
                            <th>Kategori</th>
                            <th>Supplier</th>
                            <th>Pabrik</th>
                            <th>Stok Min</th>
                            <th>Stok Tersedia</th>
                            <th>Satuan</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Etiket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($obat as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['barcode_obat']; ?></td>
                                <td><?= $row['nama_obat']; ?></td>
                                <td><?= $row['nama_golongan']; ?></td>
                                <td><?= $row['nama_kategori']; ?></td>
                                <td><?= $row['nama_supplier']; ?></td>
                                <td><?= $row['nama_pabrik']; ?></td>
                                <td><?= number_format($row['stok_min']); ?></td>
                                <td><?= number_format($row['stok_obat']); ?></td>
                                <td><?= $row['nama_satuan']; ?></td>
                                <td><?= $row['harga_pokok']; ?></td>
                                <td><?= $row['harga_jual']; ?></td>
                                <td><?= $row['nama_etiket']; ?></td>
                                <td>
                                    <a type="button" class="btn btn-sm bg-gradient-info" href="<?= site_url('edit_obat/' . $row['id']); ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm bg-gradient-danger" data-toggle="modal"
                                        data-target="#modalDelete<?= $row['id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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