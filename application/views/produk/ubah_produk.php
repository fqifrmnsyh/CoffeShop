<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <?= $this->session->flashdata('pesan'); ?> -->
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <!-- <?= $this->session->flashdata('pesan'); ?> -->
            <?php foreach ($produk as $p) { ?>
                <form action="<?= base_url('produk/ubahProduk'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">NAME</label>
                        <input type="hidden" name="id" id="id" value="<?php echo $p['id']; ?>">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" value="<?= $p['nama']; ?>">
                    </div>
                    <label for="kategori">CATEGORY</label>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                            <option value="<?= $id; ?>" selected="selected"><?= $k; ?></option>
                            <?php
                            foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">PRICE</label>
                        <input type="number" class="form-control form-control-user" id="harga" name="harga" placeholder="Harga" value="<?= $p['harga']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="kode">CODE</label>
                        <input type="text" class="form-control form-control-user" id="kode" name="kode" placeholder="Kode" value="<?= $p['kode']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="stok">STOCK</label>
                        <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $p['stok']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">DESCRIPTION</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="8" placeholder="Deskripsi" spellcheck="false" style="resize: none;" value=""><?= $p['deskripsi']; ?></textarea>
                    </div>
                    <label for="old_pict">IMAGE</label>
                    <div class="form-group">
                        <?php
                        if (isset($p['image'])) { ?>

                            <input type="hidden" name="old_pict" id="old_pict" value="<?= $p['image']; ?>">

                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $p['image']; ?>" class="rounded mx-auto mb-3 d-blok" style="width: 300px" alt="...">
                            </picture>

                        <?php } ?>

                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Back" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Update">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>