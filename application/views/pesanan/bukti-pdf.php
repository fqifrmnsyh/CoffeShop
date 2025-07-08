<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $judul; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .judul {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .info {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .table {
            width: 100%;
            margin-bottom: 10px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .table th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .table td {
            text-align: right;
        }

        .total {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <p>
                Cafe X<br>
                Jalan yang benar nomor 02<br>
                082112800821
            </p>
        </center>
        <hr>
        <table style="width: 100vw;">
            <tr>
                <td>Kasir</td>
                <td align="right"><?= $user; ?></td>
            </tr>
            <tr>
                <td>ID Pesanan</td>
                <td align="right"><?= $pesanan['id_pesanan']; ?></td>
            </tr>
            <tr>
                <td>Tanggal pesanan</td>
                <td align="right"><?= date('d-m-Y', strtotime($pesanan['tgl_pesanan'])); ?></td>
            </tr>
        </table>
        <br>
        <br>
        <!-- <div class="header">
            <div class="judul"><?= $judul; ?></div>
            <div class="info">
                <div>Nama: <?= $user; ?></div>
                <div>ID Pesanan: <?= $pesanan['id_pesanan']; ?></div>
                <div>Tanggal Pesanan: <?= date('d-m-Y', strtotime($pesanan['tgl_pesanan'])); ?></div>
            </div>
        </div> -->
        <table class="table" border="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <!-- <th>Status</th> -->
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_harga = 0 ?>
                <?php foreach ($detail_pesanan as $t): ?>
                    <tr>
                        <td><?= $t['nama']; ?></td>
                        <td><?= $t['harga']; ?></td>
                        <!-- <td><?= $t['status']; ?></td> -->
                        <td><?= $t['jml_item']; ?></td>
                        <td><?= uang($t['sub_total']); ?></td>
                    </tr>
                    <?php $total_harga += $t['sub_total'] ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">
            Total: <?= uang($total_harga); ?>
        </div>
        <table style="width: 100vw;">
            <tr>
                <td>Tunai</td>
                <td align="right"><?= uang($pesanan['NominalBayar']) ?></td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td align="right"><?= uang($pesanan['NominalBayar'] - $total_harga) ?></td>
            </tr>
        </table>
        <div class="footer">
            Terima kasih atas pembeliannya.
        </div>
    </div>
</body>

</html>
