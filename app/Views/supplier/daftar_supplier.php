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
                            <input type="text" class="form-control <?= (session()->get('errors')['nama_supplier'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('nama_supplier'); ?>" id="inputSupplier" placeholder="Nama supplier" name="nama_supplier" autofocus>
                            <?php if (session()->get('errors')['nama_supplier'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['nama_supplier']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="alamatSupplier" class="col-sm-2 col-form-label text-capitalize">alamat</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control <?= (session()->get('errors')['alamat_supplier'] ?? false) ? 'is-invalid' : ''; ?>" id="alamatSupplier" placeholder="Alamat Supplier" name="alamat_supplier"><?= old('alamat_supplier'); ?></textarea>
                            <?php if (session()->get('errors')['alamat_supplier'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['alamat_supplier']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Kota" class="col-sm-2 col-form-label text-capitalize">Kota</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= (session()->get('errors')['kta'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('kta'); ?>" id="Kota" placeholder="Kota" name="kota">
                            <?php if (session()->get('errors')['kta'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['kta']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Telepon" class="col-sm-2 col-form-label text-capitalize">No Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control <?= (session()->get('errors')['no_telp'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('no_telp'); ?>" id="Telepon" placeholder="No Telepon" name="no_telp">
                            <?php if (session()->get('errors')['no_telp'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['no_telp']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Hanphone" class="col-sm-2 col-form-label text-capitalize">No Handphone</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control <?= (session()->get('errors')['no_hp'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('no_hp'); ?>" id="Hanphone" placeholder="No Handphone" name="no_hp">
                            <?php if (session()->get('errors')['no_hp'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['no_hp']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Rekening" class="col-sm-2 col-form-label text-capitalize">No Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control <?= (session()->get('errors')['no_rekening'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('no_rekening'); ?>" id="Rekening" placeholder="No Rekening" name="no_rekening">
                            <?php if (session()->get('errors')['no_rekening'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['no_rekening']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="npwp" class="col-sm-2 col-form-label text-uppercase">npwp</label>
                        <div class="col-sm-8">
                            <input type="text" inputmode="numeric" class="form-control <?= (session()->get('errors')['npwp'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('npwp'); ?>" id="npwp" placeholder="NPWP" name="npwp">
                            <?php if (session()->get('errors')['npwp'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['npwp']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="npwp" class="col-sm-2 col-form-label text-uppercase">keterangan</label>
                        <div class="col-sm-8">
                            <textarea type="text" inputmode="numeric" class="form-control <?= (session()->get('errors')['ket_supplier'] ?? false) ? 'is-invalid' : ''; ?>" id="keterangan" placeholder="Keterangan" name="ket_supplier"><?= old('ket_supplier'); ?></textarea>
                            <?php if (session()->get('errors')['ket_supplier'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['ket_supplier']; ?>
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
                                        <input type="text" class="form-control <?= (session()->get('errors')['nama_supplier'] ?? false) ? 'is-invalid' : ''; ?>" id="inputNamasupplier"
                                            placeholder="Input Nama supplier" name="nama_supplier" value="<?= old('nama_supplier') ? old('nama_supplier') : $edit['nama_supplier']; ?>" autofocus>
                                        <?php if (session()->get('errors')['nama_supplier'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['nama_supplier']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">alamat</label>
                                        <textarea name="alamat_supplier" id="" class="form-control <?= (session()->get('errors')['alamat_supplier'] ?? false) ? 'is-invalid' : ''; ?>" placeholder="Alamat"><?= old('alamat_supplier') ? old('alamat_supplier') : $edit['alamat_supplier']; ?></textarea>
                                        <?php if (session()->get('errors')['alamat_supplier'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['alamat_supplier']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">kota</label>
                                        <input name="kota" id="" class="form-control <?= (session()->get('errors')['kota'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('kota') ? old('kota') : $edit['kota']; ?>" placeholder="Kota">
                                        <?php if (session()->get('errors')['kota'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['kota']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">No Telepon</label>
                                        <input name="no_telp" id="" class="form-control <?= (session()->get('errors')['no_telp'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('no_telp') ? old('no_telp') : $edit['no_telp']; ?>" placeholder="No Telepon">
                                        <?php if (session()->get('errors')['no_telp'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['no_telp']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">No Handphone</label>
                                        <input name="no_hp" id="" class="form-control <?= (session()->get('errors')['no_hp'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('no_hp') ? old('no_hp') : $edit['no_hp']; ?>" placeholder="No Handphone">
                                        <?php if (session()->get('errors')['no_hp'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['no_hp']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">No Rekening</label>
                                        <input name="no_rekening" id="" class="form-control <?= (session()->get('errors')['no_rekening'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('no_rekening') ? old('no_rekening') : $edit['no_rekening']; ?>" splaceholder="No Rekening">
                                        <?php if (session()->get('errors')['no_rekening'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['no_rekening']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">npwp</label>
                                        <input name="npwp" id="" class="form-control <?= (session()->get('errors')['npwp'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('npwp') ? old('npwp') : $edit['npwp']; ?>" placeholder="npwp">
                                        <?php if (session()->get('errors')['npwp'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['npwp']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="text-capitalize">Keterangan</label>
                                        <textarea name="ket_supplier" id="" class="form-control <?= (session()->get('errors')['ket_supplier'] ?? false) ? 'is-invalid' : ''; ?>" placeholder="Keterangan"><?= old('ket_supplier') ? old('ket_supplier') : $edit['ket_supplier']; ?></textarea>
                                        <?php if (session()->get('errors')['ket_supplier'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['ket_supplier']; ?>
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