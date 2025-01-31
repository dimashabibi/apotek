<?= $this->extend('layout/template') ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman pabrik</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">pabrik</a></li>
                    <li class="breadcrumb-item text-capitalize active">daftar pabrik</li>
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
                <h3 class="card-title text-capitalize">input pabrik baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?= site_url('tambah_pabrik'); ?>">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group row justify-content-center">
                        <label for="inputPabrik" class="col-sm-2 col-form-label text-capitalize">Nama pabrik</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= (session()->get('errors')['nama_pabrik'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('nama_pabrik'); ?>" id="inputPabrik" placeholder="Nama pabrik" name="nama_pabrik" autofocus>
                            <?php if (session()->get('errors')['nama_pabrik'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['nama_pabrik']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="alamatPabrik" class="col-sm-2 col-form-label text-capitalize">alamat</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control <?= (session()->get('errors')['alamat_pabrik'] ?? false) ? 'is-invalid' : ''; ?>" id="alamatPabrik" placeholder="Alamat Pabrik" name="alamat_pabrik"><?= old('nama_pabrik'); ?></textarea>
                            <?php if (session()->get('errors')['alamat_pabrik'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['alamat_pabrik']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Kota" class="col-sm-2 col-form-label text-capitalize">Kota</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= (session()->get('errors')['kota'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('nama_pabrik'); ?>" id="Kota" placeholder="Kota" name="kota">
                            <?php if (session()->get('errors')['kota'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['kota']; ?>
                                </div>
                            <?php endif; ?>
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
                            <input type="text" inputmode="numeric" class="form-control <?= (session()->get('errors')['ket_pabrik'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('ket_pabrik'); ?>" id="keterangan" placeholder="Keterangan" name="ket_pabrik">
                            <?php if (session()->get('errors')['ket_pabrik'] ?? false) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['ket_pabrik']; ?>
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
                <h3 class="card-title text-capitalize">daftar pabrik</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-capitalize">nama pabrik</th>
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
                        <?php foreach ($pabrik as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td class="text-capitalize"><?= $row['nama_pabrik']; ?></td>
                                <td class="text-capitalize"><?= $row['alamat_pabrik']; ?></td>
                                <td class="text-capitalize"><?= $row['kota']; ?></td>
                                <td><?= $row['no_telp']; ?></td>
                                <td><?= $row['no_hp']; ?></td>
                                <td><?= $row['no_rekening']; ?></td>
                                <td><?= $row['npwp']; ?></td>
                                <td><?= $row['ket_pabrik']; ?></td>
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
<?php foreach ($pabrik as $edit) : ?>
    <div class="modal fade" id="modalEdit<?= $edit['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalCenterTitle">Edit pabrik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('edit_pabrik/' . $edit['id']); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="inputNamapabrik">Nama pabrik</label>
                                        <input type="text" class="form-control <?= (session()->get('errors')['nama_pabrik'] ?? false) ? 'is-invalid' : ''; ?>" id="inputNamapabrik"
                                            placeholder="Input Nama pabrik" name="nama_pabrik" value="<?= old('nama_pabrik') ? old('nama_pabrik') : $edit['nama_pabrik']; ?>" autofocus>
                                        <?php if (session()->get('errors')['nama_pabrik'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['nama_pabrik']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="pabrik" class="text-capitalize">alamat</label>
                                        <textarea name="alamat_pabrik" id="" class="form-control <?= (session()->get('errors')['alamat_pabrik'] ?? false) ? 'is-invalid' : ''; ?>" placeholder="Alamat"><?= old('alamat_pabrik') ? old('alamat_pabrik') : $edit['alamat_pabrik']; ?></textarea>
                                        <?php if (session()->get('errors')['alamat_pabrik'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['alamat_pabrik']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="pabrik" class="text-capitalize">kota</label>
                                        <input name="kota" id="" class="form-control <?= (session()->get('errors')['kota'] ?? false) ? 'is-invalid' : ''; ?>" value="<?= old('kota') ? old('kota') : $edit['kota']; ?>" placeholder="Kota">
                                        <?php if (session()->get('errors')['kota'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['kota']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="pabrik" class="text-capitalize">No Telepon</label>
                                        <input name="no_telp" id="" class="form-control " value="<?= $edit['no_telp']; ?>" placeholder="No Telepon">

                                    </div>
                                    <div class="form-group">
                                        <label for="pabrik" class="text-capitalize">No Handphone</label>
                                        <input name="no_hp" id="" class="form-control " value="<?= $edit['no_hp']; ?>" placeholder="No Handphone">

                                    </div>
                                    <div class="form-group">
                                        <label for="pabrik" class="text-capitalize">No Rekening</label>
                                        <input name="no_rekening" id="" class="form-control" value="<?= $edit['no_rekening']; ?>" placeholder="No Rekening">

                                    </div>
                                    <div class="form-group">
                                        <label for="pabrik" class="text-capitalize">npwp</label>
                                        <input name="npwp" id="" class="form-control " value="<?= $edit['npwp']; ?>" placeholder="npwp">

                                    </div>
                                    <div class="form-group">
                                        <label for="pabrik" class="text-capitalize">Keterangan</label>
                                        <textarea name="ket_pabrik" id="" class="form-control <?= (session()->get('errors')['ket_pabrik'] ?? false) ? 'is-invalid' : ''; ?>" placeholder="Keterangan"><?= old('ket_pabrik') ? old('ket_pabrik') : $edit['ket_pabrik']; ?></textarea>
                                        <?php if (session()->get('errors')['ket_pabrik'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->get('errors')['ket_pabrik']; ?>
                                            </div>
                                        <?php endif ?>
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

<?php foreach ($pabrik as $delete): ?>
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
                        action="<?= site_url('delete_pabrik/' . $delete['id']); ?>">
                        <?= csrf_field(); ?>
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
   $(document).ready(function() {
        var table = $('#example1').DataTable({
            "pageLength": 10
        });

        $('#pageLength').on('change', function() {
            var pageLength = parseInt($(this).val()); // Ambil nilai dropdown sebagai integer

            table.page.len(pageLength).draw(); // Ubah page length di tabel
        });
    });
</script>
<?= $this->endSection(); ?>