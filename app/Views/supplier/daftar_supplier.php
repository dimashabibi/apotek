<?= $this->extend('layout/template') ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman supplier</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">supplier</a></li>
                    <li class="breadcrumb-item text-capitalize active">daftar supplier</li>
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
                <h3 class="card-title text-capitalize">input supplier baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?= site_url('tambah_supplier'); ?>">
                <div class="card-body">
                    <div class="form-group row justify-content-center">
                        <label for="inputSupplier" class="col-sm-2 col-form-label text-capitalize">Nama supplier</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputSupplier" placeholder="Nama supplier" name="nama_supplier" autofocus>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="alamatSupplier" class="col-sm-2 col-form-label text-capitalize">alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamatSupplier" placeholder="Alamat Supplier" name="alamat_supplier">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Kota" class="col-sm-2 col-form-label text-capitalize">Kota</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Kota" placeholder="Kota" name="kota">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Telepon" class="col-sm-2 col-form-label text-capitalize">No Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control" id="Telepon" placeholder="No Telepon" name="no_telp">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Hanphone" class="col-sm-2 col-form-label text-capitalize">No Handphone</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control" id="Hanphone" placeholder="No Handphone" name="no_hp">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Rekening" class="col-sm-2 col-form-label text-capitalize">No Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control" id="Rekening" placeholder="No Rekening" name="no_rekening">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="npwp" class="col-sm-2 col-form-label text-uppercase">npwp</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control" id="npwp" placeholder="NPWP" name="npwp">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="npwp" class="col-sm-2 col-form-label text-uppercase">keterangan</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control" id="keterangan" placeholder="Keterangan" name="ket_supplier">
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
                <h3 class="card-title text-capitalize">daftar supplier</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-capitalize">nama supplier</th>
                            <th class="text-capitalize">Alamat</th>
                            <th class="text-capitalize">Kota</th>
                            <th class="text-capitalize">No Telepon</th>
                            <th class="text-capitalize">no handphone</th>
                            <th class="text-capitalize">no rekening</th>
                            <th class="text-uppercase">npwp</th>
                            <th class="text-capitalize">keterangan</th>
                            <th class="text-capitalize">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($supplier as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td class="text-capitalize"><?= $row['nama_supplier']; ?></td>
                                <td class="text-capitalize"><?= $row['alamat_supplier']; ?></td>
                                <td class="text-capitalize"><?= $row['kota']; ?></td>
                                <td><?= $row['no_telp']; ?></td>
                                <td><?= $row['no_hp']; ?></td>
                                <td><?= $row['no_rekening']; ?></td>
                                <td><?= $row['npwp']; ?></td>
                                <td><?= $row['ket_supplier']; ?></td>
                                <td class="text-center py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn bg-gradient-info" data-toggle="modal"
                                            data-target="#modalEdit<?= $row['id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn bg-gradient-danger" data-toggle="modal"
                                            data-target="#modalDelete<?= $row['id']; ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
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
<?php foreach ($supplier as $edit) : ?>
    <div class="modal fade" id="modalEdit<?= $edit['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalCenterTitle">Edit supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('edit_supplier/' . $edit['id']); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="inputNamasupplier">Nama supplier</label>
                                        <input type="text" class="form-control" id="inputNamasupplier"
                                            placeholder="Input Nama supplier" name="nama_supplier" value="<?= $edit['nama_supplier']; ?>" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">alamat</label>
                                        <textarea name="alamat_supplier" id="" class="form-control" placeholder="Alamat"><?= $edit['alamat_supplier']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">kota</label>
                                        <textarea name="kota" id="" class="form-control" placeholder="Kota"><?= $edit['kota']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">No Telepon</label>
                                        <textarea name="no_telp" id="" class="form-control" placeholder="No Telepon"><?= $edit['no_telp']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">No Handphone</label>
                                        <textarea name="no_hp" id="" class="form-control" placeholder="No Handphone"><?= $edit['no_hp']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">No Rekening</label>
                                        <textarea name="no_rekening" id="" class="form-control" placeholder="No Rekening"><?= $edit['no_rekening']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">npwp</label>
                                        <textarea name="npwp" id="" class="form-control" placeholder="npwp"><?= $edit['npwp']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">Keterangan</label>
                                        <textarea name="ket_supplier" id="" class="form-control" placeholder="Keterangan"><?= $edit['ket_supplier']; ?></textarea>
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

<?php foreach ($supplier as $delete): ?>
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
                        action="<?= site_url('delete_supplier/' . $delete['id']); ?>">
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