<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Order Details:</h3>
        <table class="table">
            <tr>
                <th>Order ID</th>
                <td><?= $pesanan['id_pesanan'] ?></td>
            </tr>
            <tr>
                <th>Order Number</th>
                <td><?php echo substr($pesanan['id_pesanan'], -4); ?></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><?= date('d M Y H:i', strtotime($pesanan['tgl_pesanan'])) ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td><?= uang($pesanan['total_harga']) ?></td>
            </tr>
        </table>
        <h3>Thank you for your purchases!</h3>
    </div>
</body>
</html>
