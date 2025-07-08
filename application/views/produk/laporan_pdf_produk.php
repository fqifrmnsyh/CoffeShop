<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            padding: 10px 10px 10px 10px;
        }
    </style>
</head>

<body>
    <h3>
        <center>Cafe X</center>
        <center>Product Report</center>
    </h3>
    <br>
    <table class="table-data">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <!-- <th>Terbit</th>
                <th>Tahun Penerbit</th>
                <th>ISBN</th> -->
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($produk as $p) {
                ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $p['nama']; ?></td>
                    <td>
                        <?=
                            // Mencari nama kategori berdasarkan id_kategori dari buku saat ini
                            $nama_kategori = '';
                        foreach ($kategori as $k) {
                            if ($k['id'] == $p['id_kategori']) {
                                $nama_kategori = $k['kategori'];
                                break;
                            }
                        }
                        echo $nama_kategori;
                        ?>
                    </td>
                    <td><?= uang($p['harga']); ?></td>
                    <td><?= $p['stok']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>