<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        @page {
            size: 80mm 297mm;
            margin: 0;
        }

        body {
            width: 80mm;
            font-size: 12px;
            font-family: Arial, sans-serif;
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-item td {
            padding: 2px 0;
        }

        .summary-table td {
            padding: 2px 5px;
        }

        .footer {
            margin-top: 10px;
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="text-center">
        <h3><strong>APOTEK SUMBER SEKAR</strong></h3>
        <p>
            Jl. Raya Sumbersekar No.2, RT.05/RW.02,<br>
            Krajan, Sumbersekar, Kec. Dau, Kabupaten Malang<br>
            Jawa Timur 65151<br>
            Phone: 085175126445
        </p>
    </div>

    <div class="divider"></div>

    <!-- Transaction Details -->
    <p>Tanggal: <?= date('d/m/Y', strtotime($transaksi['tgl_transaksi'])) ?> <?= $transaksi['jam']; ?></p>
    <p>Kasir: <?= $transaksi['nama_kasir']; ?></p>
    <p>No Transaksi: <?= $transaksi['no_faktur']; ?></p>

    <div class="divider"></div>

    <!-- Items Table -->
    <table class="table-item">
        <?php foreach ($detail as $item): ?>
            <tr>
                <td><?= $item['nama_obat']; ?> </td>
                <td class="text-right" colspan="2"><?= $item['nama_satuan']; ?></td>
            </tr>
            <tr>
                <td><?= number_format($item['harga_jual'], 0, ',', '.'); ?></td>
                <td>x <?= $item['qty']; ?></td>
                <td class="text-right">Rp <?= number_format($item['sub_total'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="divider"></div>

    <!-- Summary Table -->
    <table class="summary-table">
        <tr>
            <td>Sub Total</td>
            <td>:</td>
            <td class="text-right">Rp <?= number_format($transaksi['total_bersih'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td>:</td>
            <td class="text-right"><?= number_format($transaksi['diskon_persen'], 0, ',', '.'); ?>%</td>
        </tr>
        <tr>
            <td>Tunai</td>
            <td>:</td>
            <td class="text-right">Rp <?= number_format($transaksi['jumlah_uang'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td>:</td>
            <td class="text-right">Rp <?= number_format($transaksi['sisa_uang'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- Footer -->
    <div class="footer">
        <p>=== Terima Kasih ===</p>
        <p>Barang yang sudah dibeli</p>
        <p>tidak dapat dikembalikan</p>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>