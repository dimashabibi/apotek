<div class="modal fade" id="modalPembelian" tabindex="-1" role="dialog" aria-labelledby="modalPembelianCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPembelianCenterTitle">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/simpanPembayaran', ['class' => 'formpembayaran']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="col-12">
                    <div class="row">
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">No Pembelian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_pembelian"
                                    name="id_pembelian" value="<?= $id_pembelian; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tgl_pembelian"
                                    name="tgl_pembelian" value="<?= $tgl_pembelian; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">Supplier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_supplier"
                                    name="id_supplier" value="<?= $id_supplier; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">No Faktur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_faktur"
                                    name="no_faktur" value="<?= $no_faktur; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="deskripsi"
                                    name="deskripsi" value="<?= $deskripsi; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaObat" class="col-sm-2 col-form-label">Total Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="total_beli"
                                    name="total_beli" value="<?= $total_beli; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead class="table table-bordered table-striped">
                            <tr class="text-center">
                                <th class="text-capitalize">No</th>
                                <th class="text-capitalize">kode rak</th>
                                <th class="text-capitalize">Barcode</th>
                                <th class="text-capitalize">Nama obat</th>
                                <th class="text-capitalize">Kategori</th>
                                <th class="text-capitalize">satuan</th>
                                <th class="text-capitalize">Harga Pokok</th>
                                <th class="text-uppercase">qty</th>
                                <th class="text-capitalize">sub total</th>
                                <th class="text-capitalize">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($temp as $d) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $d['kode_rak']; ?></td>
                                    <td><?= $d['barcode_obat']; ?></td>
                                    <td><?= $d['nama_obat']; ?></td>
                                    <td><?= $d['nama_kategori']; ?></td>
                                    <td class="text-center"><?= $d['nama_satuan']; ?></td>
                                    <td class="text-right"><strong><?= number_format($d['harga_pokok'], 0, ",", "."); ?></strong></td>
                                    <td class="text-center text-danger text-bold"><?= number_format($d['qty']); ?></td>
                                    <td><strong><?= number_format($d['sub_total'], 0, ",", "."); ?></strong></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusitem('<?= $d['id']; ?>','<?= $d['nama_obat']; ?>') ">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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