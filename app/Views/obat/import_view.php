<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Import Data Obat</h3>
            </div>
            <div class="card-body">
                <?php if (session()->has('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('process_import_obat') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-1">
                        <a href="<?= site_url('daftar_obat') ?>" class="btn btn-sm btn-warning ">Kembali</a>
                    </div>
                    <div class="form-group">
                        <label>File Excel</label>
                        <input type="file" name="fileexcel" class="form-control <?= (session()->get('errors')['fileexcel'] ?? false) ? 'is-invalid' : ''; ?>" accept=".xlsx, .xls" required>
                        <small class="text-muted">Format file: .xlsx atau .xls</small>
                        <?php if (session()->get('errors')['fileexcel'] ?? false): ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['fileexcel']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Import Data</button>
                        <a href="<?= site_url('download_template') ?>" class="btn btn-success">Download Template</a>
                    </div>
                </form>

                <div class="mt-4">
                    <h5>Petunjuk Import:</h5>
                    <ol>
                        <li>Download template Excel yang telah disediakan</li>
                        <li>Isi data sesuai format yang ada pada template</li>
                        <li>Untuk kolom Golongan Obat, Kategori, Satuan, dan Etiket:
                            <ul>
                                <li>Jika mengisi dengan nama yang sudah ada, sistem akan menggunakan data yang sudah ada</li>
                                <li>Jika mengisi dengan nama baru, sistem akan otomatis membuat data master baru</li>
                            </ul>
                        </li>
                        <li>Format kolom harus sesuai:
                            <ul>
                                <li>Stok: Angka bulat</li>
                                <li>Harga: Angka (boleh menggunakan format Rupiah)</li>
                            </ul>
                        </li>
                        <li>Upload file Excel yang sudah diisi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>