<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/autoNumeric.js'); ?>"></script>

<div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="modalformeditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalformeditLabel">Cicil Hitang No <strong><?= $hutang['id_hutang']; ?></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('updateHutang', ['class' => 'formsimpan']) ?>
            <div class="modal-body">
                <input type="hidden" name="detail_transaksi_id" value="<?= $hutang['id_hutang']; ?>">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="text" class="form-control " value="<?= date('d F y'); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Jumlah Hutang</label>
                            <input type="text" name="total_hutang" id="jumlah_hutang" class="form-control" value="<?= number_format($hutang['total_hutang'], 2, ',', '.'); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Jumlah cicil</label>
                            <input type="text" name="jumlah_cicil" id="jumlah_cicil" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">sisa hutang</label>
                            <input type="text" class="form-control" value="<?= number_format($hutang['sisa_hutang']); ?>" readonly>
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
<script>
    $(document).ready(function() {
        $('#jumlah_cicil').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#jumlah_hutang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '2'
        });
        $('#sisa_hutang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '2'
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
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'error',
                            html: response.error
                        })
                        $('.tombolSimpan').prop('disabled', false);
                        $('.tombolSimpan').html('Simpan')
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });

    function hitungHutang() {
        let jumlah_cicil = ($('#jumlah_cicil').val() == "") ? 0 : $('#jumlah_cicil').autoNumeric('get');
        let jumlah_hutang = ($('#jumlah_hutang').val() == "") ? 0 : $('#jumlah_hutang').autoNumeric('get');

        let hasil = parseFloat(jumlah_hutang) - parseFloat(jumlah_cicil);

        $('#sisa_hutang').val(hasil);
        let sisaHutang = $('#sisa_hutang').val();
        $('#sisa_hutang').autoNumeric('set', sisaHutang);
    }
</script>