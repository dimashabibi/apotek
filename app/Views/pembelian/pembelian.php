<?= $this->extend('layout/template'); ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman pembelian Obat</h1>
            </div><!-- /.col -->
            <div class=" col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">Transaksi</a></li>
                    <li class="breadcrumb-item text-capitalize active">pembelian Obat</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row d-flex justify-content-center">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-capitalize">input supplier baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?= site_url(''); ?>">
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
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('body').addClass('sidebar-collapse');
    });
</script>

<?= $this->endSection(); ?>