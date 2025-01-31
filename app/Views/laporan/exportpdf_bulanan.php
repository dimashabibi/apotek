<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #D9EAFD;
        }

        .total {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Pendapatan Bulan <?= date('F Y', strtotime($bulan)); ?></h2>
        <p>Dicetak pada tanggal : <?= date('d F Y H:i:s') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="45%">Tanggal</th>
                <th width="45%">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data_rekap as $rekap): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= date('d F Y', strtotime($rekap['tanggal'])); ?></td>
                    <td>Rp <?= number_format($rekap['total_penghasilan'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td colspan="2" class="text-center">Total</td>
                <td>Rp <?= number_format($income_per_bulan, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>