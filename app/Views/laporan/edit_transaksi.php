<?= $this->extend('layout/template') ?>

<?= $this->section('content_header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">halaman Edit Transaksi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">Transaksi</a></li>
                    <li class="breadcrumb-item text-capitalize active">Edit Transaksi</li>
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
                <h3 class="card-title text-capitalize">Detail Transaksi Penjualan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php form_open('/editTransaksi', ['class' => 'formpembayaran form-horizontal']) ?>
            <div class="card-body">
                <div class="form-group row justify-content-center">
                    <label for="no_faktur" class="col-sm-2 col-form-label text-capitalize">No Faktur</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $transaksi['no_faktur']; ?>" id="no_faktur" name="no_faktur" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="tanggal" class="col-sm-2 col-form-label text-capitalize">Tanggal transaksi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $transaksi['tgl_transaksi']; ?>" id="tanggal" name="tgl_transaksi" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="jam" class="col-sm-2 col-form-label text-capitalize">jam</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $transaksi['jam']; ?>" id="jam" placeholder="jam" name="jam" readonly>

                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="nama_kasir" class="col-sm-2 col-form-label text-capitalize">Nama Kasir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $transaksi['nama_kasir']; ?>" id="nama_kasir" name="nama_kasir" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="diskon_persen" class="col-sm-2 col-form-label text-capitalize">Disc (%)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= number_format($transaksi['diskon_persen']); ?> %" id="diskon_persen" name="diskon_persen" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="diskon_uang" class="col-sm-2 col-form-label text-capitalize">Disc (Rp)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= 'Rp' . ' ' . number_format($transaksi['diskon_uang'], 0, '.', ','); ?>" id="diskon_uang" name="diskon_uang" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="total_kotor" class="col-sm-2 col-form-label text-capitalize">total kotor</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= number_format($transaksi['total_kotor'], 0, '.', ','); ?>" id="total_kotor" name="total_kotor" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="total_bersih" class="col-sm-2 col-form-label text-capitalize">total bersih</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= number_format($transaksi['total_bersih'], 0, '.', ','); ?>" id="total_bersih" name="total_bersih" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="jumlah_uang" class="col-sm-2 col-form-label text-capitalize">Jumlah uang</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= number_format($transaksi['jumlah_uang'], 0, '.', ','); ?>" id="jumlah_uang" name="jumlah_uang" readonly>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="sisa_uang" class="col-sm-2 col-form-label text-capitalize">Kembalian</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= number_format($transaksi['sisa_uang'], 0, '.', ','); ?>" id="sisa_uang" name="sisa_uang" readonly>
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
                            <th class="text-capitalize">Harga Jual</th>
                            <th class="text-uppercase">qty</th>
                            <th class="text-capitalize">sub total</th>
                            <th class="text-capitalize">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($detail_transaksi as $d) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $d['kode_rak']; ?> </td>
                                <td><?= $d['barcode_obat']; ?></td>
                                <td><?= $d['nama_obat']; ?></td>
                                <td><?= $d['nama_kategori']; ?></td>
                                <td class="text-center"><?= $d['nama_satuan']; ?></td>
                                <td class="text-right"><?= number_format($d['harga_jual'], 0, ",", "."); ?></td>
                                <td class=" text-center text-danger text-bold"><?= number_format($d['qty']); ?></td>
                                <td>
                                    <?= number_format($d['sub_total'], 0, ",", "."); ?></td>
                                <td class=" text-center">
                                    <button type="button" class="btn btn-sm btn-info" onclick="edit('<?= $d['detail_transaksi_id']; ?>')">
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
            url: "<?= site_url('edit_detail_transaksi/') ?>" + $id,
            data: {
                no_faktur: $('#no_faktur').val(),
                tanggal: $('#tanggal').val(),
                jam: $('#jam').val(),
                nama_kasir: $('#nama_kasir').val(),
                diskon_persen: $('#diskon_persen').val(),
                diskon_uang: $('#diskon_uang').val(),
                total_kotor: $('#total_kotor').val(),
                total_bersih: $('#total_bersih').val(),
                jumlah_uang: $('#jumlah_uang').val(),
                sisa_uang: $('#sisa_uang').val(),
            },
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