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
            <a href="" class="btn btn-cream mb-3 text-gray-900" data-toggle="modal" data-target="#bukuBaruModal"><i
                    class="fas fa-plus"></i> Add Product</a>
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr class="dark-choco text-white">
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">



                    <?php
                    $a = 1;
                    foreach ($produk as $p): ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td>
                                <picture style="width: 200px; height : 200px;">
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/upload/') . $p['image']; ?>"class="img-fluid img-thumbnail" style="max-width: 200px;" alt="...">
                                </picture>
                            </td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['kode']; ?></td>
                            <td><?= $p['harga']; ?></td>
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
                            <td><?= $p['stok']; ?></td>
                            <td>
                                <a href="<?= base_url('produk/ubahProduk/') . $p['id']; ?>" class="badge badge-info mb-2" style="height: 30px; width: 120px; display: flex; justify-content: center; align-items: center;"><i
                                        class="fas fa-edit mr-1"></i> Edit</a>
                                <a href="<?= base_url('produk/hapusProduk/') . $p['id']; ?>"
                                    onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $p['nama']; ?> ?');"
                                    class="badge badge-danger col-12" style="height: 30px; width: 120px; display: flex; justify-content: center; align-items: center;"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah buku baru-->
<div class="modal fade" id="bukuBaruModal" tabindex="-1" role="dialog" aria-labelledby="bukuBaruModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bukuBaruModalLabel">Tambah Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('produk'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama"
                            placeholder="Nama Item">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                            <option value="">Pilih Kategori</option>
                            <?php
                            foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" id="harga" name="harga"
                            placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kode" name="kode"
                            placeholder="Kode">
                    </div>
                    <div class="form-group">
                        <input type="int" class="form-control form-control-user" id="stok" name="stok"
                            placeholder="Masukkan nominal stok">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" cols="50" rows="5" id="deskripsi" name="deskripsi"
                            placeholder="Masukkan deskripsi produk" style="resize: none;"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->

<!-- End of Modal Tambah Mneu -->