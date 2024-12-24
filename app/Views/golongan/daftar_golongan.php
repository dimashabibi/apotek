<?= $this->extend('layout/template') ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman golongan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">golongan</a></li>
                    <li class="breadcrumb-item text-capitalize active">daftar golongan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<div class="row d-flex justify-content-center">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-capitalize">input golongan baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?= site_url('tambah_golongan'); ?>">
                <div class="card-body">
                    <div class="form-group row justify-content-center">
                        <label for="inputGolongan" class="col-sm-2 col-form-label text-capitalize">Nama golongan</label>
                        <div class="col-sm-8">
                            <input
                                type="text"
                                class="form-control <?= (session()->get('errors')['nama_golongan'] ?? false) ? 'is-invalid' : ''; ?>"
                                id="inputGolongan"
                                placeholder="Nama Golongan"
                                name="nama_golongan"
                                value="<?= old('nama_golongan'); ?>"
                                autofocus>
                            <?php if (session()->get('errors')['nama_golongan'] ?? false) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['nama_golongan']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="golongan" class="col-sm-2 col-form-label text-capitalize">Keterangan golongan</label>
                        <div class="col-sm-8">
                            <textarea
                                name="ket_golongan"
                                id="golongan"
                                class="form-control <?= (session()->get('errors')['ket_golongan'] ?? false) ? 'is-invalid' : ''; ?>"
                                placeholder="Keterangan"><?= old('ket_golongan'); ?></textarea>
                            <?php if (session()->get('errors')['ket_golongan'] ?? false) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['ket_golongan']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-lg btn-info">
                        <span><i class="fas fa-save"></i></span>
                        Save
                    </button>
                </div>
            </form>

        </div>
        <!-- /.card-footer -->
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-capitalize">daftar golongan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-capitalize">nama golongan</th>
                            <th class="text-capitalize">Keterangan golongan</th>
                            <th class="text-capitalize">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($golongan as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td class="text-capitalize"><?= $row['nama_golongan']; ?></td>
                                <td class="text-lowercase"><?= $row['ket_golongan']; ?></td>
                                <td>
                                    <button type="button" class="btn bg-gradient-info" data-toggle="modal"
                                        data-target="#modalEdit<?= $row['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn bg-gradient-danger" data-toggle="modal"
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

<!-- --------------------------------------------------------- Modal Edit ---------------------------------------------------------------- -->
<?php foreach ($golongan as $edit) : ?>
    <div class="modal fade" id="modalEdit<?= $edit['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Golongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('edit_golongan/' . $edit['id']); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="inputNamaGolongan">Nama Golongan</label>
                                        <input
                                            type="text"
                                            class="form-control <?= (session()->get('errors')['nama_golongan'] ?? false) ? 'is-invalid' : ''; ?>"
                                            id="inputNamaGolongan"
                                            placeholder="Input Nama Golongan"
                                            name="nama_golongan"
                                            value="<?= old('nama_golongan') ? old('nama_golongan') : $edit['nama_golongan']; ?>"
                                            autofocus>
                                        <?php if (session()->get('errors')['nama_golongan'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['nama_golongan']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="keteranganGolongan" class="text-capitalize">Keterangan Golongan</label>
                                        <textarea
                                            name="ket_golongan"
                                            id="keteranganGolongan"
                                            class="form-control <?= (session()->get('errors')['ket_golongan'] ?? false) ? 'is-invalid' : ''; ?>"
                                            placeholder="Keterangan"><?= old('ket_golongan') ? old('ket_golongan') : $edit['ket_golongan']; ?></textarea>
                                        <?php if (session()->get('errors')['ket_golongan'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['ket_golongan']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- --------------------------------------------------------- Modal Delete ---------------------------------------------------------------- -->

<?php foreach ($golongan as $delete): ?>
    <div class="modal fade" id="modalDelete<?= $delete['id']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Data Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" method="get"
                        action="<?= site_url('delete_golongan/' . $delete['id']); ?>">
                        <?php csrf_field() ?>
                        <div class="form-group">
                            <h5>Apakah anda ingin menghapus data ini ? </h5>
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