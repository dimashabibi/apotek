<div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="modalformeditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalformeditLabel">Edit <strong><?= $obat['nama_obat']; ?></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('simpanTransaksi', ['class' => 'formsimpan']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <input type="hidden" name="detail_transaksi_id" value="<?= $detail['detail_transaksi_id']; ?>">
                <input type="hidden" name="id_obat" value="<?= $detail['id_obat']; ?>">
                <input type="hidden" name="harga_pokok" value="<?= $detail['harga_pokok']; ?>">
                <input type="hidden" name="no_faktur" value="<?= $no_faktur; ?>">
                <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">
                <input type="hidden" name="jam" value="<?= $jam; ?>">
                <input type="hidden" name="nama_kasir" value="<?= $nama_kasir; ?>">
                <input type="hidden" name="diskon_persen" id="diskon_persen" value="<?= $diskon_persen; ?>">
                <input type="hidden" name="diskon_uang" id="diskon_uang" value="<?= $diskon_uang; ?>">
                <input type="hidden" name="total_kotor" id="total_kotor" value="<?= $total_kotor; ?>">
                <input type="hidden" name="total_bersih" id="total_berseih" value="<?= $total_bersih; ?>">
                <input type="hidden" name="jumlah_uang" id="jumlah_uang" value="<?= $jumlah_uang; ?>">
                <input type="hidden" name="sisa_uang" id="sisa_uang" value="<?= $sisa_uang; ?>">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Kode Rak</label>
                            <input type="text" name="kode_rak" id="kode_rak" class="form-control " value="<?= $obat['kode_rak']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Barcode</label>
                            <input type="text" name="barcode_obat" id="barcode_obat" class="form-control " value="<?= $obat['barcode_obat']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Nama Obat</label>
                            <input type="text" name="nama_obat" id="nama_obat" class="form-control " value="<?= $obat['nama_obat']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control " value="<?= $kategori['nama_kategori']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Satuan</label>
                            <input type="text" name="nama_satuan" id="nama_satuan" class="form-control " value="<?= $satuan['nama_satuan']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Harga Jual</label>
                            <input type="text" name="harga_jual" id="harga_jual" class="form-control " value="<?= $detail['harga_jual']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Qty</label>
                            <input type="text" name="qty" id="qty" class="form-control" value="<?= $detail['qty']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Sub Total</label>
                            <input type="text" name="sub_total" id="sub_total" class="form-control " value="<?= $detail['sub_total']; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary tombolSimpan">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
<script>
    $(document).ready(function() {

        $('#qty').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#sub_total').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#harga_jual').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $('#qty').keyup(function(e) {
            e.preventDefault();
            hitungSubtotal();
        });

        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(e) {
                    $('.tombolSimpan').prop('disabled', true);
                    $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Berhasil',
                            response.success,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });

                    }
                    if (response.error) {
                        toastr.error().html(response.error);
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });

    function hitungSubtotal() {
        let hargaJual = ($('#harga_jual').val() == "") ? 0 : $('#harga_jual').autoNumeric('get');
        let qty = ($('#qty').val() == "") ? 0 : $('#qty').autoNumeric('get');

        let hasil = parseFloat(hargaJual) * parseFloat(qty);

        $('#sub_total').val(hasil);
        let sub_total = $('#sub_total').val();
        $('#sub_total').autoNumeric('set', sub_total);
    }
</script>