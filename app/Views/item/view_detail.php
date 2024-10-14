<table class="table table-bordered">
    <thead class="table table-bordered table-striped">
        <tr>
            <th class="text-capitalize">No</th>
            <th class="text-capitalize">Barcode</th>
            <th class="text-capitalize">Nama obat</th>
            <th class="text-capitalize">satuan</th>
            <th class="text-uppercase">qty</th>
            <th class="text-capitalize">Harga Jual</th>
            <th class="text-capitalize">sub total</th>
            <th class="text-capitalize">#</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($datadetail as $d) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $d['barcode_obat']; ?></td>
                <td><?= $d['nama_obat']; ?></td>
                <td><?= $d['qty']; ?></td>
                <td><?= $d['harga_jual']; ?></td>
                <td><?= $d['sub_total']; ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>