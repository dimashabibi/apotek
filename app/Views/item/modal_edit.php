<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<!-- modal etiket -->
<div class="modal fade" id="modalEditItem" tabindex="-1" role="dialog" aria-labelledby="modalEditItemCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <?= form_open('/simpanEditItem', ['class' => 'formEditItem']); ?>
            <?= csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditItemCenterTitle">Tambah Etiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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

                    <div class="card-body">
                        <!-- Obat Start -->
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="detail-obat" role="tabpanel" aria-labelledby="detail-obat-tab">
                                <div class="form-group row">
                                    <label for="barcodeObat" class="col-sm-2 col-form-label">Barcode Obat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="barcodeObat"
                                            placeholder="Input Barcode Obat" name="barcode_obat" value="<?= $obat['barcode_obat']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="namaObat" class="col-sm-2 col-form-label">Nama Obat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="namaObat"
                                            placeholder="Input Nama Obat" name="nama_obat" value="<?= $obat['nama_obat']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="merkObat" class="col-sm-2 col-form-label">Merk Obat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="merkObat"
                                            placeholder="Input Merk Obat" name="merk_obat" value="<?= $obat['merk_obat']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Golongan Obat</label>
                                    <div class="input-group col-sm-10">
                                        <select class="form-control select2" name="id_golongan">
                                            <option selected="selected" value="<?= $golonganId['id']; ?>" hidden><?= $golonganId['nama_golongan']; ?></option>
                                            <?php foreach ($golongan as $gol) : ?>
                                                <option value="<?= $gol['id']; ?>"><?= $gol['nama_golongan']; ?></option>
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
                                            <option selected="selected" value="<?= $kategoriId['id']; ?>" hidden><?= $kategoriId['nama_kategori']; ?></option>
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
                                    <label class="col-sm-2 col-form-label">Etiket/Aturan Pemakaian</label>
                                    <div class="input-group col-sm-10">
                                        <select class="form-control select2" name="id_etiket">
                                            <option selected="selected" value="<?= $etiketId['id']; ?>" hidden><?= $etiketId['nama_etiket']; ?></option>
                                            <?php foreach ($etiket as $et) : ?>
                                                <option value="<?= $et['id']; ?>"><?= $et['nama_etiket']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary btnTambahEtiket" id="btnTambahEtiket">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="input-group">
                                        <label class="col-sm-2 col-form-label">Konsinyasi</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="konsinyasi">
                                                <option selected="selected" value="<?= $obat['konsinyasi']; ?>" hidden><?= $obat['konsinyasi']; ?></option>
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
                                                    <option selected="selected" value="<?= $satuanId['id']; ?>" hidden><?= $satuanId['nama_satuan']; ?></option>
                                                    <?php foreach ($satuan as $sat) : ?>
                                                        <option value=" <?= $sat['id']; ?>"><?= $sat['nama_satuan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-primary btnTambahSatuan" id="btnTambahSatuan">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="stokObat" class="col-sm-2 col-form-label">Stok Obat</label>
                                            <div class="col-sm-10">
                                                <input type="text" inputmode="numeric" class="form-control" id="stokObat"
                                                    placeholder="Input Stok Obat" name="stok_obat" value="<?= $obat['stok_obat']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="stokMin" class="col-sm-2 col-form-label">Stok Minimal</label>
                                            <div class="col-sm-10">
                                                <input type="text" inputmode="numeric" class="form-control" id="stokMin"
                                                    placeholder="Input Stok Minimal" name="stok_min" value="<?= $obat['stok_min']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="stokMin" class="col-sm-2 col-form-label">Kode Rak</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="kodeRak"
                                                    placeholder="Input Kode Rak" name="kode_rak" value="<?= $obat['kode_rak']; ?>" autocomplete="off">
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
                                                    <input type="text" class="form-control" name="harga_pokok" id="harga_pokok" placeholder="Input Harga Pokok" value="<?= $obat['harga_pokok']; ?>">
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
                                                    <input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="Input Harga Jual" value="<?= $obat['harga_jual']; ?>">
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
                    <!-- /.card -->
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <!-- modal etiket end -->

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
            $('.formEditItem').on('submit', function() {
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
        });
    </script>