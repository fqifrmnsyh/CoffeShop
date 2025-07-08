<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <?= $this->session->flashdata('pesan'); ?> -->
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <!-- <?= $this->session->flashdata('pesan'); ?> -->
            <!-- <a href="<?= base_url('laporan/cetak_laporan_produk'); ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a> -->
            <a href="<?= base_url('laporan/laporan_produk_pdf'); ?>" class="btn btn-danger mb-3"><i class="far fa-file-pdf"></i> Download Pdf</a>
            <a href="<?= base_url('laporan/export_excel'); ?>" class="btn btn-success mb-3"><i
                    class="far fa-file-excel"></i> Export to Excel</a>
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <!-- <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">ISBN</th> -->
                        <th scope="col">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($produk as $p) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
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
                            <td><?= $p['harga']; ?></td>
                            <td><?= $p['stok']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>