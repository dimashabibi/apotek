<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<!-- modal golongan -->
<div class="modal fade" id="modalTambahGolongan" tabindex="-1" role="dialog" aria-labelledby="modalTambahGolonganCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <?= form_open('/simpanGolongan', ['class' => 'formTambahGolongan']); ?>
            <?= csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahGolonganCenterTitle">Tambah Golongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row justify-content-center">
                    <label for="inputGolongan" class="col-sm-2 col-form-label text-capitalize">Nama golongan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputGolongan" placeholder="Nama Golongan" name="nama_golongan" autofocus>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="golongan" class="col-sm-2 col-form-label text-capitalize">Keterangan golongan</label>
                    <div class="col-sm-8">
                        <textarea name="ket_golongan" id="" class="form-control" placeholder="keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombolClose" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombolSimpan">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- modal golongan end -->

<!-- modal kategori -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-labelledby="modalTambahKategoriCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <?= form_open('/simpanKategori', ['class' => 'formTambahKategori']); ?>
            <?= csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahKategoriCenterTitle">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row justify-content-center">
                    <label for="inputKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputKategori" placeholder="Nama Kategori" name="nama_kategori" autofocus>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="kategori" class="col-sm-2 col-form-label">Keterangan Kategori</label>
                    <div class="col-sm-8">
                        <textarea name="ket_kategori" id="" class="form-control" placeholder="keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombolClose" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombolSimpan">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- modal kategori end -->

<!-- modal etiket -->
<div class="modal fade" id="modalTambahEtiket" tabindex="-1" role="dialog" aria-labelledby="modalTambahEtiketCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <?= form_open('/simpanEtiket', ['class' => 'formTambahEtiket']); ?>
            <?= csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahEtiketCenterTitle">Tambah Etiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row justify-content-center">
                    <label for="InputEtiket" class="col-sm-2 col-form-label text-capitalize">Nama etiket</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEtiket" placeholder="Nama Etiket" name="nama_etiket">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="etiket" class="col-sm-2 col-form-label text-capitalize">Keterangan etiket</label>
                    <div class="col-sm-8">
                        <textarea name="ket_etiket" id="" class="form-control" placeholder="keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombolClose" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombolSimpan">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- modal etiket end -->

<!-- modal satuan -->
<div class="modal fade" id="modalTambahSatuan" tabindex="-1" role="dialog" aria-labelledby="modalTambahSatuanCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <?= form_open('/simpanSatuan', ['class' => 'formTambahSatuan']); ?>
            <?= csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSatuanCenterTitle">Tambah Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row justify-content-center">
                    <label for="inputSatuan" class="col-sm-2 col-form-label">Nama Satuan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputSatuan" placeholder="Nama Satuan" name="nama_satuan">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombolClose" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombolSimpan">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- modal satuan end -->

<!-- modal Supplier -->
<div class="modal fade" id="modalTambahSupplier" tabindex="-1" role="dialog" aria-labelledby="modalTambahSupplierCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <?= form_open('/simpanSupplier', ['class' => 'formTambahSupplier']); ?>
            <?= csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSupplierCenterTitle">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombolClose" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombolSimpan">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- modal Supplier end -->

<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.tombolClose').click(function(e) {
            e.preventDefault();
            window.location.reload();
        });

        // Jquery Tambah Golongan
        $('.formTambahGolongan').submit(function(e) {
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
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.success == 'berhasil') {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Anda berhasil menambahkan golongan baru !'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                    alert("Terjadi kesalahan:\n" + errorMessage);
                }
            });
        });
        // golongan end

        // jq tambah kategori
        $('.formTambahKategori').submit(function(e) {
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
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.success == 'berhasil') {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Anda berhasil menambahkan kategori baru !'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                    alert("Terjadi kesalahan:\n" + errorMessage);
                }
            });
        });
        // kategori end

        // jq tambah etiket
        $('.formTambahEtiket').submit(function(e) {
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
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.success == 'berhasil') {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Anda berhasil menambahkan etiket baru !'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                    alert("Terjadi kesalahan:\n" + errorMessage);
                }
            });
        });
        // etiket end

        // jq tambah satuan
        $('.formTambahSatuan').submit(function(e) {
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
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.success == 'berhasil') {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Anda berhasil menambahkan satuan baru !'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                    alert("Terjadi kesalahan:\n" + errorMessage);
                }
            });
        });
        // satuan end

        $('.formTambahSupplier').submit(function(e) {
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
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.success == 'berhasil') {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Anda berhasil menambahkan supplier baru !'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                    alert("Terjadi kesalahan:\n" + errorMessage);
                }
            });
        });


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


        $('.formTambahObat').submit(function(e) {
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
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.success == 'berhasil') {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Anda berhasil menambahkan Obat baru !'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    let errorMessage = ` Status: ${status} Error: ${error} Response: ${xhr.responseText}`;
                    alert("Terjadi kesalahan:\n" + errorMessage);
                }
            });
        });
    });
</script>