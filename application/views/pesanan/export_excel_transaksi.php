// application/views/transaksi/export_excel_transaksi.php
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Transaksi.xls");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
</head>
<body>
    <h2 class="text-center">Laporan Transaksi</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Tanggal Pesanan</th>
                <th>Status</th>
                <th>Total Item</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id_pesanan']; ?></td>
                    <td><?= date('d-m-Y', strtotime($order['tgl_pesanan'])); ?></td>
                    <td><?= $order['status']; ?></td>
                    <td><?= $order['total_item']; ?></td>
                    <td><?= uang($order['total_harga']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
