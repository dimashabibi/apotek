<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<!-- SweetAlert2 -->
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="modalPembayaranCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPembayaranCenterTitle">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
                    <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <?= form_open('/simpanPembayaran', ['class' => 'formpembayaran']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="no_faktur" id="no_faktur" value="<?= $no_faktur; ?>">
                <input type="hidden" name="total_kotor" id="total_kotor" value="<?= $total_bayar; ?>">
                <?php
                date_default_timezone_set('Asia/Jakarta');
                ?>
                <input type="hidden" name="tgl_transaksi" id="tgl_transaksi" value="<?= $tgl_transaksi; ?>">
                <input type="hidden" name="jam" id="jam" value="<?= $jam; ?>">
                <input type="hidden" name="nama_kasir" id="nama_kasir" value="<?= $nama_kasir; ?>">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Disc(%)</label>
                            <input type="text" id="diskon_persen" name="diskon_persen" class="form-control form-control-lg form-control-border text-right text-blue" width="100%" autocomplete="off">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Disc(Rp)</label>
                            <input type="text" id="diskon_uang" name="diskon_uang" class="form-control form-control-lg form-control-border text-right text-blue" width="100%" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Total Pembayaran</label>
                    <input type="text" id="total_bersih" name="total_bersih" class="form-control form-control-lg form-control-border text-right text-green " value="<?= $total_bayar; ?>" width="100%" style="background-color: black; font-size:60px; height: 70px;" readonly>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="">Jumlah Uang (Rp)</label>
                        <input type="text" id="jumlah_uang" name="jumlah_uang" class="form-control form-control-border text-right text-red" autocomplete="off" width="100%">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Kembalian(Rp)</label>
                        <input type="text" id="sisa_uang" name="sisa_uang" class="form-control form-control-lg form-control-border text-right text-red text-bold" width="100%" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary tombolSimpan">Simpan</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Toast
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        // Toast End

        // Auto Numeric
        $('#diskon_persen').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '2'
        });
        $('#diskon_uang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#total_bersih').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#jumlah_uang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#sisa_uang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        // Auto numeric end

        // hitung Diskon & sisa uang
        $('#diskon_persen').keyup(function(e) {
            hitungDiskon();
        });
        $('#diskon_uang').keyup(function(e) {
            hitungDiskon();
        });
        $('#jumlah_uang').keyup(function(e) {
            hitungSisaUang();
        });
        // hitung diskon & sisa uang end

        // form pembayaran
        $('.formpembayaran').submit(function(e) {
            e.preventDefault();

            let jumlahuang = ($('#jumlah_uang').val() == "") ? 0 : $('#jumlah_uang').autoNumeric('get');
            let sisauang = ($('#sisa_uang').val() == "") ? 0 : $('#sisa_uang').autoNumeric('get');

            if (parseFloat(jumlahuang) == 0 || parseFloat(jumlahuang) == "") {
                Toast.fire({
                    icon: 'error',
                    title: 'Maaf jumlah uang belum diinput...'
                });
            } else if (parseFloat(sisauang) < 0) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Maaf jumlah uang kurang....'
                });
            } else {
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.tombolSimpan').prop('disabled', true);
                        $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.tombolSimpan').prop('disabled', false);
                        $('.tombolSimpan').html('Simpan');
                    },
                    success: function(response) {
                        if (response.success == 'berhasil') {
                            Swal.fire({
                                title: "Cetak Struk",
                                text: "Apakah ingin mencetak struk ?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Ya, cetak !",
                                cancelButtonText: "Tidak"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    let printWindow = window.open('/printStruk/' + response.no_faktur, '_blank');
                                    // Simpan data struk ke sessionStorage
                                    sessionStorage.setItem('printData', JSON.stringify(response.no_faktur));
                                    printWindow.onload = function() {
                                        printWindow.print();
                                        printWindow.onafterprint = function() {
                                            printWindow.close();
                                            window.location.reload();
                                        };
                                    };

                                } else {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                        alert("Terjadi kesalahan:\n" + errorMessage);
                    }
                });

            }
            return false;
        });
        // form pembayaran end
    });

    function hitungDiskon() {
        let total_kotor = $('#total_kotor').val();
        let diskon_persen = ($('#diskon_persen').val() == "") ? 0 : $('#diskon_persen').autoNumeric('get');
        let diskon_uang = ($('#diskon_uang').val() == "") ? 0 : $('#diskon_uang').autoNumeric('get');

        let hasil;
        hasil = parseFloat(total_kotor) - (parseFloat(total_kotor) * parseFloat(diskon_persen) / 100) - parseFloat(diskon_uang);

        $('#total_bersih').val(hasil);
        let total_bersih = $('#total_bersih').val();
        $('#total_bersih').autoNumeric('set', total_bersih);

    }

    function hitungSisaUang() {
        let total_pembayaran = $('#total_bersih').autoNumeric('get');
        let jumlahuang = ($('#jumlah_uang').val() == "") ? 0 : $('#jumlah_uang').autoNumeric('get');

        sisaUang = parseFloat(jumlahuang) - parseFloat(total_pembayaran);

        $('#sisa_uang').val(sisaUang);
        let sisauang = $('#sisa_uang').val();
        $('#sisa_uang').autoNumeric('set', sisauang);
    }
</script>