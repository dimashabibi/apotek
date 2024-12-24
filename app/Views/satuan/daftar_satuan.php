<?= $this->extend('layout/template') ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman satuan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">satuan</a></li>
                    <li class="breadcrumb-item text-capitalize active">daftar satuan</li>
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
                <h3 class="card-title">Input Satuan Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?= site_url('tambah_satuan'); ?>">
                <div class="card-body">
                    <div class="form-group row justify-content-center">
                        <label for="inputSatuan" class="col-sm-2 col-form-label">Nama Satuan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= (session()->get('errors')['nama_satuan'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('nama_satuan'); ?>" id="inputSatuan" placeholder="Nama Satuan" name="nama_satuan" autofocus>
                            <?php if (session()->get('errors')['nama_satuan'] ?? false) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['nama_satuan']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-lg btn-info">
                        <span><i class="fas fa-save"></i></span>
                        Save</button>
                </div>
        </div>
        <!-- /.card-footer -->
        </form>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Satuan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">nama Satuan</th>
                            <th class="text-capitalize">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($satuan as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td class="text-uppercase"><?= $row['nama_satuan']; ?></td>
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
</div>
<!-- /.col -->

<!-- --------------------------------------------------------- Modal Edit ---------------------------------------------------------------- -->
<?php foreach ($satuan as $edit) : ?>
    <div class="modal fade" id="modalEdit<?= $edit['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle" class="text-capitalize">edit satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('edit_satuan/' . $edit['id']); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="inputSatuan" class="text-capitalize">Nama Satuan</label>
                                        <input type="text" class="form-control <?= (session()->get('errors')['nama_satuan'] ?? false) ? 'is-invalid' : ''; ?>" id="inputSatuan"
                                            placeholder="Input Nama Satuan" name="nama_satuan" autofocus value="<?= old('nama_satuan') ? old('nama_satuan') : $edit['nama_satuan']; ?>">
                                        <?php if (session()->get('errors')['nama_satuan'] ?? false) : ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['nama_satuan']; ?>
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

<?php foreach ($satuan as $delete): ?>
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
                        action="<?= site_url('delete_satuan/' . $delete['id']); ?>">
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