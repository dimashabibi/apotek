<?php $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman tambah obat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('daftar_obat'); ?>" class="text-capitalize">obat</a></li>
                    <li class="breadcrumb-item text-capitalize active">tambah obat</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="col-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="detail-obat-tab" data-toggle="pill" href="#detail-obat" role="tab" aria-controls="detail-obat" aria-selected="true">Detail Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="detail-satuan-tab" data-toggle="pill" href="#detail-satuan" role="tab" aria-controls="detail-satuan" aria-selected="false">Detail Satuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#detail-supplier" role="tab" aria-controls="detail-supplier" aria-selected="false">Detail Supplier</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                </li> -->
            </ul>
        </div>
        <form action="<?= site_url('tambah_obat'); ?>" method="post" class="form-horizontal">
            <div class="card-body">
                <!-- Obat Start -->
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="detail-obat" role="tabpanel" aria-labelledby="detail-obat-tab">
                        <div class="form-group row">
                            <label for="barcodeObat" class="col-sm-2 col-form-label">Barcode Obat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="barcodeObat"
                                    placeholder="Input Barcode Obat" name="barcode_obat" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">Nama Obat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaObat"
                                    placeholder="Input Nama Obat" name="nama_obat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="merkObat" class="col-sm-2 col-form-label">Merk Obat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="merkObat"
                                    placeholder="Input Merk Obat" name="merk_obat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label">Golongan Obat</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;" name="id_golongan">
                                        <option selected="selected" hidden>Pilih Golongan</option>
                                        <?php foreach ($golongan as $gol) : ?>
                                            <option value="<?= $gol['id']; ?>"><?= $gol['nama_golongan']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <span class="input-group-append">
                                    <button class="btn btn-sm btn-flat btn-primary" data-toggle="modal"
                                        data-target="#modalCreategolongan">
                                        <i class=" fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;" name="id_kategori">
                                        <option selected="selected" hidden>Pilih Kategori</option>
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat['id']; ?>"><?= $kat['nama_kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <span class="input-group-append">
                                    <button class="btn btn-sm btn-flat btn-primary" data-toggle="modal"
                                        data-target="#modalCreatekategori">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label">Etiket/Aturan Pemakaian</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;" name="id_etiket">
                                        <option selected="selected" hidden>Pilih Etiket</option>
                                        <?php foreach ($etiket as $et) : ?>
                                            <option value="<?= $et['id']; ?>"><?= $et['nama_etiket']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <span class="input-group-append">
                                    <button class="btn btn-sm btn-flat btn-primary" data-toggle="modal"
                                        data-target="#modalCreateetiket">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="float-sm-right">
                                <a type="button" class="btn btn-secondary" href="<?= site_url('daftar_obat'); ?>">Close</a>
                            </div>
                        </div>
                    </div>
                    <!-- Obat End -->

                    <!-- Satuan Start -->
                    <div class="tab-pane fade" id="detail-satuan" role="tabpanel" aria-labelledby="detail-satuan-tab">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <div class="input-group">
                                        <label class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" style="width: 100%;" name="id_satuan">
                                                <option selected="selected" hidden>Pilih Satuan</option>
                                                <?php foreach ($satuan as $sat) : ?>
                                                    <option value="<?= $sat['id']; ?>"><?= $sat['nama_satuan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <span class="input-group-append">
                                            <button class="btn btn-sm btn-flat btn-primary" data-toggle="modal"
                                                data-target="#modalCreatesatuan">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stokObat" class="col-sm-2 col-form-label">Stok Obat</label>
                                    <div class="col-sm-10">
                                        <input type="text" inputmode="numeric" class="form-control" id="stokObat"
                                            placeholder="Input Stok Obat" name="stok_obat">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stokMin" class="col-sm-2 col-form-label">Stok Minimal</label>
                                    <div class="col-sm-10">
                                        <input type="text" inputmode="numeric" class="form-control" id="stokMin"
                                            placeholder="Input Stok Minimal" name="stok_min">
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="stokMin" class="col-sm-2 col-form-label">Harga Pokok</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control" name="harga_pokok" placeholder="Input Harga Pokok">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stokMin" class="col-sm-2 col-form-label">Harga Jual</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control" name="harga_jual" placeholder="Input Harga Jual">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="float-sm-right">
                                    <a type="button" class="btn btn-secondary" href="<?= site_url('daftar_obat'); ?>">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Satuan End -->
                    <div class="tab-pane fade" id="detail-supplier" role="tabpanel" aria-labelledby="detail-supplier-tab">
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select class="form-control select2" style="width: 100%;" name="id_supplier">
                                            <option selected="selected" hidden>Pilih Kategori</option>
                                            <?php foreach ($supplier as $sup) : ?>
                                                <option value="<?= $sup['id']; ?>"><?= $sup['nama_supplier']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pabrik</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="id_pabrik">
                                        <option selected="selected" hidden>Pilih Kategori</option>
                                        <?php foreach ($pabrik as $pab) : ?>
                                            <option value="<?= $pab['id']; ?>"><?= $pab['nama_pabrik']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="float-sm-right">
                                <a type="button" class="btn btn-secondary" href="<?= site_url('daftar_obat'); ?>">Close</a>
                                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">

                    </div> -->
                </div>
            </div>
        </form>
        <!-- /.card -->
    </div>
</div>

<?php $this->endSection(); ?>