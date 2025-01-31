<!-- Modal Edit -->
<div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="modalformeditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalformeditLabel">Edit <strong><?= $obat['nama_obat']; ?></strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('updatePembelian', ['class' => 'formsimpanpembelian']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <!-- Hidden inputs -->
                <input type="hidden" name="detail_pembelian_id" value="<?= $detail['detail_pembelian_id']; ?>">
                <input type="hidden" name="id_obat" value="<?= $detail['id_obat']; ?>">
                <input type="hidden" name="id_pembelian" value="<?= $id_pembelian; ?>">
                <input type="hidden" name="tgl_pembelian" value="<?= $tgl_pembelian; ?>">
                <input type="hidden" name="no_faktur" value="<?= $no_faktur; ?>">
                <input type="hidden" name="total_pembelian" id="total_pembelian" value="<?= $total_pembelian; ?>">
                <input type="hidden" name="deskripsi" id="deskripsi" value="<?= $deskripsi; ?>">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kode_rak">Kode Rak</label>
                            <input type="text" name="kode_rak" id="kode_rak" class="form-control" value="<?= $obat['kode_rak']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="barcode_obat">Barcode</label>
                            <input type="text" name="barcode_obat" id="barcode_obat" class="form-control" value="<?= $obat['barcode_obat']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="<?= $obat['nama_obat']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_kategori">Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="<?= $kategori['nama_kategori']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_satuan">Satuan</label>
                            <input type="text" name="nama_satuan" id="nama_satuan" class="form-control" value="<?= $satuan['nama_satuan']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="harga_pokok">Harga Pokok</label>
                            <input type="text" name="harga_pokok" id="harga_pokok" class="form-control" value="<?= $detail['harga_pokok']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="text" name="qty" id="qty" class="form-control" value="<?= $detail['qty']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="sub_total">Sub Total</label>
                            <input type="text" name="sub_total" id="sub_total" class="form-control" value="<?= $detail['sub_total']; ?>" readonly>
                        </div>
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

<script>
    $(document).ready(function() {
        // Inisialisasi autoNumeric
        const autoNumericOptions = {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        };

        $('#qty').autoNumeric('init', autoNumericOptions);
        $('#sub_total').autoNumeric('init', autoNumericOptions);
        $('#harga_pokok').autoNumeric('init', autoNumericOptions);

        // Hitung subtotal saat qty berubah
        $('#qty').on('keyup change', function(e) {
            e.preventDefault();
            hitungSubtotal();
        });

        // Handle form submission
        $('.formsimpanpembelian').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.tombolSimpan').prop('disabled', true);
                    $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Data berhasil diubah',
                            text: response.success,
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, thrownError) {
                    console.error('Error:', xhr.status, xhr.responseText, thrownError);
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memproses data',
                        icon: 'error'
                    });
                },
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                }
            });
        });
    });

    function hitungSubtotal() {
        let hargaPokok = $('#harga_pokok').autoNumeric('get') || 0;
        let qty = $('#qty').autoNumeric('get') || 0;

        let hasil = parseFloat(hargaPokok) * parseFloat(qty);

        $('#sub_total').autoNumeric('set', hasil);
    }
</script>