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
<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<div class="col-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="detail-obat-tab" data-toggle="pill" href="#detail-obat" role="tab" aria-controls="detail-obat" aria-selected="true">Detail Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="detail-satuan-tab" data-toggle="pill" href="#detail-satuan" role="tab" aria-controls="detail-satuan" aria-selected="false">Detail Stok</a>
                </li>
            </ul>
        </div>
        <form action="<?= site_url('tambah_obat'); ?>" method="post" class="form-horizontal">

            <div class="card-body">
                <!-- Obat Start -->
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="detail-obat" role="tabpanel" aria-labelledby="detail-obat-tab">
                        <div class="form-group row">
                            <label for="barcodeObat" class="col-sm-2 col-form-label">Barcode Obat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="barcodeObat"
                                    placeholder="Input Barcode Obat" name="barcode_obat" autocomplete="off" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">Nama Obat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaObat"
                                    placeholder="Input Nama Obat" name="nama_obat" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="merkObat" class="col-sm-2 col-form-label">Merk Obat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="merkObat"
                                    placeholder="Input Merk Obat" name="merk_obat" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Golongan Obat</label>
                            <div class="input-group col-sm-10">
                                <select class="form-control select2" name="id_golongan">
                                    <option selected="selected" hidden>Pilih Golongan</option>
                                    <?php foreach ($golongan as $gol) : ?>
                                        <option value="<?= $gol['id']; ?>"><?= $gol['nama_golongan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary btnTambahGolongan" id="btnTambahGolongan">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kategori</label>
                            <div class="input-group col-sm-10">
                                <select class="form-control select2" name="id_kategori">
                                    <option selected="selected" hidden>Pilih Kategori</option>
                                    <?php foreach ($kategori as $kat) : ?>
                                        <option value="<?= $kat['id']; ?>"><?= $kat['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary btnTambahKategori" id="btnTambahKategori">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Etiket/Aturan Pakai</label>
                            <div class="input-group col-sm-10">
                                <select class="form-control select2" name="id_etiket">
                                    <option selected="selected" hidden>Pilih Etiket</option>
                                    <?php foreach ($etiket as $et) : ?>
                                        <option value="<?= $et['id']; ?>"><?= $et['nama_etiket']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-append">
                                    <button type="button" class="btn btn btn-primary btnTambahEtiket" id="btnTambahEtiket">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label">Konsinyasi</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="konsinyasi">
                                        <option selected="selected" hidden>Pilih Konsinyasi</option>
                                        <option value="konsinyasi">Konsinyasi</option>
                                        <option value="non konsinyasi">Non Konsinyasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="float-sm-right">
                                <a type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modalClose">Close</a>
                                <button type="button" class="btn btn-primary next-tab" data-next="#detail-satuan-tab">Next</button>
                            </div>
                        </div>
                    </div>
                    <!-- Obat End -->

                    <!-- Satuan Start -->
                    <div class="tab-pane fade" id="detail-satuan" role="tabpanel" aria-labelledby="detail-satuan-tab">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Satuan</label>
                                    <div class="input-group col-sm-10">
                                        <select class="form-control select2" name="id_satuan">
                                            <option selected="selected" hidden>Pilih Satuan</option>
                                            <?php foreach ($satuan as $sat) : ?>
                                                <option value="<?= $sat['id']; ?>"><?= $sat['nama_satuan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn btn-primary btnTambahSatuan" id="btnTambahSatuan">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stokObat" class="col-sm-2 col-form-label">Stok Obat</label>
                                    <div class="col-sm-10">
                                        <input type="text" inputmode="numeric" class="form-control" id="stokObat"
                                            placeholder="Input Stok Obat" name="stok_obat" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stokMin" class="col-sm-2 col-form-label">Stok Minimal</label>
                                    <div class="col-sm-10">
                                        <input type="text" inputmode="numeric" class="form-control" id="stokMin"
                                            placeholder="Input Stok Minimal" name="stok_min" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stokMin" class="col-sm-2 col-form-label">Kode Rak</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kodeRak"
                                            placeholder="Input Kode Rak" name="kode_rak" autocomplete="off">
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
                                            <input type="text" class="form-control" id="harga_pokok" name="harga_pokok" placeholder="Input Harga Pokok" autocomplete="off">
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
                                            <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Input Harga Jual" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="float-sm-right">
                                    <button type="button" class="btn btn-secondary prev-tab" data-prev="#detail-obat-tab">Previous</button>
                                    <a type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalClose">Close</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Satuan End -->
                </div>
            </div>
        </form>
        <!-- /.card -->
    </div>
    <div class="modalTambah" style="display: none;"></div>
</div>



<!-- --------------------------------------------------------- Modal Close ---------------------------------------------------------------- -->
<div class="modal fade" id="modalClose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Close Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" method="get" action="<?= site_url('/daftar_obat'); ?>">
                    <?php csrf_field() ?>
                    <div class="form-group">
                        <h5>Apakah anda yakin untuk tidak melanjutkan pengisian data?</h5>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn bg-gradient-danger">Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('script') ?>
<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<script>
    $(document).ready(function() {
        // Tab navigation
        $('.next-tab').click(function() {
            var nextTab = $(this).data('next');
            $(nextTab).tab('show');
        });

        $('.prev-tab').click(function() {
            var prevTab = $(this).data('prev');
            $(prevTab).tab('show');
        });

        // Simpan input ke LocalStorage setiap kali pengguna mengetik
        $('input, select').on('input change', function() {
            var name = $(this).attr('name'); // Ambil nama input
            var value = $(this).val(); // Ambil nilai input
            localStorage.setItem(name, value); // Simpan di LocalStorage
        });

        // Saat halaman dimuat, isi input dengan data dari LocalStorage
        $('input, select').each(function() {
            var name = $(this).attr('name'); // Ambil nama input
            var value = localStorage.getItem(name); // Ambil nilai dari LocalStorage
            if (value) {
                $(this).val(value); // Set nilai input
            }
        });

        // Hapus data dari LocalStorage setelah form dikirim
        $('form').on('submit', function() {
            localStorage.clear(); // Bersihkan seluruh LocalStorage
        });

        $('#harga_pokok').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#harga_jual').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#stokObat').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#stokMin').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $('#btnTambahGolongan').click(function(e) {
            e.preventDefault();
            tambahGolongan();
        });
        $('#btnTambahKategori').click(function(e) {
            e.preventDefault();
            tambahKategori();
        });
        $('#btnTambahEtiket').click(function(e) {
            e.preventDefault();
            tambahEtiket();
        });
        $('#btnTambahSatuan').click(function(e) {
            e.preventDefault();
            tambahSatuan();
        });

    });

    function tambahGolongan() {
        $.ajax({
            type: "post",
            url: "<?= site_url('/tambahGolongan'); ?>",
            dataType: "json",
            success: function(response) {
                $('.modalTambah').html(response.modalTambah).show();
                $('#modalTambahGolongan').on('shown.bs.modal', function(event) {
                    $('#inputGolongan').focus();
                });
                $('#modalTambahGolongan').modal('show');
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }

    function tambahKategori() {
        $.ajax({
            type: "post",
            url: "<?= site_url('/tambahKategori'); ?>",
            dataType: "json",
            success: function(response) {
                $('.modalTambah').html(response.modalTambah).show();
                $('#modalTambahKategori').on('shown.bs.modal', function(event) {
                    $('#inputKategori').focus();
                });
                $('#modalTambahKategori').modal('show');
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }

    function tambahEtiket() {
        $.ajax({
            type: "post",
            url: "<?= site_url('/tambahEtiket'); ?>",
            dataType: "json",
            success: function(response) {
                $('.modalTambah').html(response.modalTambah).show();
                $('#modalTambahEtiket').on('shown.bs.modal', function(event) {
                    $('#inputEtiket').focus();
                });
                $('#modalTambahEtiket').modal('show');
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }

    function tambahSatuan() {
        $.ajax({
            type: "post",
            url: "<?= site_url('/tambahSatuan'); ?>",
            dataType: "json",
            success: function(response) {
                $('.modalTambah').html(response.modalTambah).show();
                $('#modalTambahSatuan').on('shown.bs.modal', function(event) {
                    $('#inputSatuan').focus();
                });
                $('#modalTambahSatuan').modal('show');
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }
</script>
<?php $this->endSection(); ?>