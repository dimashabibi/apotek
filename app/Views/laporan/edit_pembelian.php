<?= $this->extend('layout/template') ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman Edit Pembelian</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">Pembelian</a></li>
                    <li class="breadcrumb-item text-capitalize active">Edit Pembelian</li>
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
        <div class="my-3 col-1">
            <a href="<?= site_url('laporan_pembelian'); ?>" class="btn btn-block btn-warning">
                <i class="fas fa-angle-double-left"></i>
                Kembali</a>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-capitalize">Detail Transaksi Pembelian</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php form_open('/editTransaksi', ['class' => 'formpembayaran form-horizontal']) ?>
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group row justify-content-center">
                    <label for="id_pembelian" class="col-sm-2 col-form-label text-capitalize">No Pembelian</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $pembelian['id_pembelian']; ?>" id="id_pembelian" name="id_pembelian" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="tgl_pembelian" class="col-sm-2 col-form-label text-capitalize">Tanggal Pembelian</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $pembelian['tgl_pembelian']; ?>" id="tgl_pembelian" name="tgl_pembelian" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="no_faktur" class="col-sm-2 col-form-label text-capitalize">No Faktur</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $pembelian['no_faktur']; ?>" id="no_faktur" name="no_faktur" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="id_supplier" class="col-sm-2 col-form-label text-capitalize">Supplier</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $supplier['nama_supplier']; ?>" id="id_supplier" name="id_supplier" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="total_pembelian" class="col-sm-2 col-form-label text-capitalize">Total Pembelian</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= number_format($pembelian['total_pembelian'], 0, '.', ','); ?>" id="total_pembelian" name="total_pembelian" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="deskripsi" class="col-sm-2 col-form-label text-capitalize">Deskripsi</label>
                    <div class="col-sm-8">
                        <textarea name="deskripsi" id="deskripsi" class="form-control" readonly><?= $pembelian['deskripsi']; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card-footer -->
        <?php form_close() ?>
    </div>


    <div class="col-12">
        <div class="card ">
            <!-- /.card-header -->
            <div class="card-body ">
                <table class="table table-bordered">
                    <thead class="table table-head-fixed text-nowrap">
                        <tr class="text-center">
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">kode rak</th>
                            <th class="text-capitalize">Barcode</th>
                            <th class="text-capitalize">Nama obat</th>
                            <th class="text-capitalize">Kategori</th>
                            <th class="text-capitalize">satuan</th>
                            <th class="text-capitalize">Harga Pokok</th>
                            <th class="text-uppercase">qty</th>
                            <th class="text-capitalize">sub total</th>
                            <th class="text-capitalize">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($detail_pembelian as $d) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $d['kode_rak']; ?> </td>
                                <td><?= $d['barcode_obat']; ?></td>
                                <td><?= $d['nama_obat']; ?></td>
                                <td><?= $d['nama_kategori']; ?></td>
                                <td class="text-center"><?= $d['nama_satuan']; ?></td>
                                <td class="text-right"><?= number_format($d['harga_pokok'], 0, ",", "."); ?></td>
                                <td class=" text-center text-danger text-bold"><?= number_format($d['qty']); ?></td>
                                <td>
                                    <?= number_format($d['sub_total'], 0, ",", "."); ?></td>
                                <td class=" text-center">
                                    <button type="button" class="btn btn-sm btn-info" onclick="edit('<?= $d['detail_pembelian_id']; ?>')">
                                        <i class="fas fa-edit"></i>
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
    <div class="viewmodal" style="display: none;"></div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<script>
    function edit($id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('edit_detail_pembelian/') ?>" + $id,
            data: {
                id_pembelian: $('#id_pembelian').val(),
                tgl_pembelian: $('#tgl_pembelian').val(),
                no_faktur: $('#no_faktur').val(),
                id_supplier: $('#id_supplier').val(),
                total_pembelian: $('#total_pembelian').val(),
                deskripsi: $('#deskripsi').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalformedit').on('shown.bs.modal', function(event) {
                        $('#qty').focus();
                    });
                    $('#modalformedit').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>