<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Obat</h3>
                <button type="button" class="btn-sm btn-primary float-sm-right" data-toggle="modal"
                    data-target="#modalCreate">
                    <i class="fas fa-solid fa-plus nav-icon"></i>
                    Tambah Obat
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped align-items-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Nama Obat</th>
                            <th>Stok Obat</th>
                            <th>Satuan</th>
                            <th>Jenis Obat</th>
                            <th>Kategori Obat</th>
                            <th>Merk Obat</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Stok Min</th>
                            <th>Keterangan Obat</th>
                            <th>Supplier</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($list_obat as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['barcode']; ?></td>
                                <td class="text-capitalize"><?= $row['nama_obat']; ?></td>
                                <td><?= $row['stok_obat']; ?></td>
                                <td class="text-uppercase"><?= $row['satuan']; ?></td>
                                <td class="text-uppercase"><?= $row['jenis_obat']; ?></td>
                                <td class="text-uppercase"><?= $row['nama_kategori']; ?></td>
                                <td class="text-capitalize"><?= $row['merk_obat']; ?></td>
                                <td><?= $row['harga_pokok']; ?></td>
                                <td><?= $row['harga_jual']; ?></td>
                                <td><?= $row['stok_min']; ?></td>
                                <td class="text-capitalize"><?= $row['keterangan_obat']; ?></td>
                                <td class="text-uppercase"><?= $row['supplier']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm bg-gradient-info" data-toggle="modal"
                                        data-target="#modalEdit<?= $row['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
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

<!-- --------------------------------------------------------- Modal Create ---------------------------------------------------------------- -->
<div class="modal fade " id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('tambah_obat'); ?>" method="post">
                    <?php csrf_field() ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="inputBarcode">Barcode</label>
                                    <input type="text" inputmode="numeric" class="form-control" id="inputBarcode"
                                        placeholder="Input Barcode" name="barcode">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="namaObat">Nama Obat</label>
                                    <input type="text" class="form-control" id="namaObat" placeholder="Input Nama Obat"
                                        name="nama_obat">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="stokObat">Stok Obat</label>
                                    <input type="text" inputmode="numeric" class="form-control" id="stokObat"
                                        placeholder="Input Stok Obat" name="stok_obat">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuanObat">Satuan</label>
                                    <input type="text" class="form-control" id="satuanObat"
                                        placeholder="Input Satuan Obat" name="satuan">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenisObat">Jenis Obat</label>
                                    <input type="text" class="form-control" id="jenisObat"
                                        placeholder="Input Jenis Obat" name="jenis_obat">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_kategori">
                                        <option selected="selected">Pilih kategori</option>
                                        <?php foreach ($kategori as $kategori): ?>
                                            <option value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="merkObat">Merk Obat</label>
                                    <input type="text" class="form-control" id="merkObat" placeholder="Input Merk Obat"
                                        name="merk_obat">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hargaPokok">Harga Pokok</label>
                                    <input type="text" class="form-control" id="hargaPokok"
                                        placeholder="Input Harga Pokok" name="harga_pokok">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hargaJual">Harga Jual</label>
                                    <input type="text" class="form-control" id="hargaJual"
                                        placeholder="Input Harga Jual" name="harga_jual">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="stokMin">Stok Minimal</label>
                                    <input type="text" inputmode="numeric" class="form-control" id="stokMin"
                                        placeholder="Input Stok Minimal" name="stok_min">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan Obat</label>
                                    <textarea class="form-control" rows="3" name="keterangan_obat" id="keterangan"
                                        placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputSupplier"> Nama Supplier</label>
                                    <input type="text" class="form-control" id="inputSupplier"
                                        placeholder="Input Supplier" name="supplier">
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

<!-- --------------------------------------------------------- Modal Edit ---------------------------------------------------------------- -->

<?php foreach ($list_obat as $edit): ?>
    <div class="modal fade " id="modalEdit<?= $edit['id']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('edit_obat/' . $edit['id']); ?>" method="post">
                        <?php csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="inputBarcode">Barcode</label>
                                        <input type="text" inputmode="numeric" class="form-control" id="inputBarcode"
                                            placeholder="Input Barcode" value="<?= $edit['barcode']; ?>" name="barcode">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="namaObat">Nama Obat</label>
                                        <input type="text" class="form-control" id="namaObat" placeholder="Input Nama Obat"
                                            value="<?= $edit['nama_obat']; ?>" name="nama_obat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stokObat">Stok Obat</label>
                                        <input type="text" inputmode="numeric" class="form-control" id="stokObat"
                                            placeholder="Input Stok Obat" value="<?= $edit['stok_obat']; ?>"
                                            name="stok_obat">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="satuanObat">Satuan</label>
                                        <input type="text" class="form-control" id="satuanObat"
                                            placeholder="Input Satuan Obat" value="<?= $edit['satuan']; ?>" name="satuan">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jenisObat">Jenis Obat</label>
                                        <input type="text" class="form-control" id="jenisObat"
                                            placeholder="Input Jenis Obat" value="<?= $edit['jenis_obat']; ?>"
                                            name="jenis_obat">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kategoriObat">Kategori</label>
                                        <input type="text" class="form-control" id="kategoriObat"
                                            placeholder="Input Kategori Obat" value="<?= $edit['id_kategori']; ?>"
                                            name="id_kategori">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="merkObat">Merk Obat</label>
                                        <input type="text" class="form-control" id="merkObat" placeholder="Input Merk Obat"
                                            value="<?= $edit['merk_obat']; ?>" name="merk_obat">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hargaPokok">Harga Pokok</label>
                                        <input type="text" class="form-control" id="hargaPokok"
                                            placeholder="Input Harga Pokok" value="<?= $edit['harga_pokok']; ?>"
                                            name="harga_pokok">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hargaJual">Harga Jual</label>
                                        <input type="text" class="form-control" id="hargaJual"
                                            placeholder="Input Harga Jual" value="<?= $edit['harga_jual']; ?>"
                                            name="harga_jual">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stokMin">Stok Minimal</label>
                                        <input type="text" inputmode="numeric" class="form-control" id="stokMin"
                                            placeholder="Input Stok Minimal" value="<?= $edit['stok_min']; ?>"
                                            name="stok_min">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan Obat</label>
                                        <textarea class="form-control" rows="3" name="keterangan_obat" id="keterangan"
                                            placeholder="Keterangan"><?= $edit['keterangan_obat']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputSupplier"> Nama Supplier</label>
                                        <input type="text" class="form-control" id="inputSupplier"
                                            placeholder="Input Supplier" value="<?= $edit['supplier']; ?>" name="supplier">
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

<?php foreach ($list_obat as $delete): ?>
    <div class="modal fade " id="modalDelete<?= $delete['id']; ?>" tabindex="-1" role="dialog"
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
                        action="<?= site_url('delete_obat/' . $delete['id']); ?>">
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