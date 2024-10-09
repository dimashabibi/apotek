<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="row">
  <div class="col-md-2">
    <button type="button" class="btn btn-primary float-ms-left" data-toggle="modal" data-target="#modalCreateKategori">
      <i class="fas fa-solid fa-plus nav-icon"></i>
      Tambah Kategori
    </button>
  </div>

  <div class="col-md-10">
    <?php foreach ($kategori as $item): ?>

      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title"><?= $item['nama_kategori'] ?></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Barcode</th>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Harga Pokok</th>
                <th>Harga Jual</th>
                <th>Stok Min</th>
                <th>Keterangan</th>
                <th>Supplier</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($list_obat as $obat): ?>
                <?php if ($obat['id_kategori'] == $item['id']): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $obat['barcode']; ?></td>
                    <td class="text-capitalize"><?= $obat['nama_obat']; ?></td>
                    <td><?= $obat['stok_obat']; ?></td>
                    <td class="text-uppercase"><?= $obat['satuan']; ?></td>
                    <td class="text-uppercase"><?= $obat['jenis_obat']; ?></td>
                    <td class="text-uppercase"><?= $obat['nama_kategori']; ?></td>
                    <td class="text-capitalize"><?= $obat['merk_obat']; ?></td>
                    <td><?= $obat['harga_pokok']; ?></td>
                    <td><?= $obat['harga_jual']; ?></td>
                    <td><?= $obat['stok_min']; ?></td>
                    <td class="text-capitalize"><?= $obat['keterangan_obat']; ?></td>
                    <td class="text-uppercase"><?= $obat['supplier']; ?></td>
                    <td>
                      <button type="button" class="btn btn-sm bg-gradient-info" data-toggle="modal"
                        data-target="#modalEdit<?= $obat['id']; ?>">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button type="button" class="btn btn-sm bg-gradient-danger" data-toggle="modal"
                        data-target="#modalDelete<?= $obat['id']; ?>">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

    <?php endforeach; ?>

  </div>
</div>

<!-- --------------------------------------------------------- Modal Create ---------------------------------------------------------------- -->
<div class="modal fade" id="modalCreateKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('tambah_kategori'); ?>" method="post">
          <?= csrf_field() ?>
          <div class="card-body">
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="inputNamaKategori">Nama Kategori</label>
                  <input type="text" class="form-control" id="inputNamaKategori"
                    placeholder="Input Nama Kategori" name="nama_kategori">
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>