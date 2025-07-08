<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3>
    <center>Laporan Data Buku Perputakaan Online</center>
</h3>
<br />
<table class="table-data">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
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
</table