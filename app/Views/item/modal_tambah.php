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
                    alert("Error: " + error);
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
                    alert("Error: " + error);
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
                    alert("Error: " + error);
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
                    alert("Error: " + error);
                }
            });
        });
        // satuan end
    });
</script>