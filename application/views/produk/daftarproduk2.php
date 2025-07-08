<!-- <?= $this->session->flashdata('pesan'); ?> -->

<div style="padding: 0px;" class="">
    <div class="x_panel">
        <div class="x_content">
            <!-- Tampilkan semua produk -->
            <div class="row">
                <!-- looping products -->

                <!-- end looping -->
            </div>
            <header class="bg-dark py-5"
                style="background-image: url('https://post.app/wp-content/uploads/2021/01/coffee-shop-1.jpeg');">
                <div class="container"
                    style="height: 350px; display: flex; justify-content: center; align-items: center; ">
                    <div class="text-center text-white" style="">
                        <h1 class="display-4 fw-bolder">Welcome</h1>
                        <!-- <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p> -->
                    </div>
                </div>
            </header>
            <div class="container-fluid fruite py-5 ">
                <!-- <div class="container py-5"> -->
                <div class="tab-class text-center">
                    <div class="row g-4 p-3">
                        <div class="col-lg-4 text-start">
                            <h1>Our Organic Products</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                        href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">All Products</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill"
                                        href="#tab-2">
                                        <span class="text-dark" style="width: 130px;">Vegetables</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                        href="#tab-3">
                                        <span class="text-dark" style="width: 130px;">Fruits</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                        href="#tab-4">
                                        <span class="text-dark" style="width: 130px;">Bread</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                        href="#tab-5">
                                        <span class="text-dark" style="width: 130px;">Meat</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tambahkan menu filter -->
                            <div class="col-md-12 rounded-pill">
                                <label for="kategoriFilter">Filter :</label>
                                <select id="kategoriFilter" class="rounded-pill p-2 bg-light">
                                    <option value="all" class="m-2">All Categories</option>
                                    <?php foreach ($kategori as $k) { ?>
                                        <option value="<?= $k->id; ?>"><?= $k->kategori; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active" style="overflow: hidden;">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php foreach ($produk as $p) { ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3 col-3 fruite-item" data-kategori="<?= $p->id_kategori; ?>">
                                                <div class="rounded position-relative fade show" style="height: 100%; width: 100%;">
                                                    <div class="fruite-img" style="height: 200px;">
                                                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $p->image; ?>"
                                                            class="img-fluid rounded-top" style="height: 100%; width: 100%;"
                                                            alt="">
                                                    </div>
                                                    <div>
                                                        <?php
                                                        $kategori = $p->id_kategori;
                                                        if ($kategori == 1) {
                                                            echo "<div class='text-white bg-secondary px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$p->nama_kategori</div>";
                                                        } elseif ($kategori == 2) {
                                                            echo "<div class='text-white bg-primary px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$p->nama_kategori</div>";
                                                        } elseif ($kategori == 3) {
                                                            echo "<div class='text-white bg-danger px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$p->nama_kategori</div>";
                                                        } else {
                                                            null;
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="p-4 rounded-bottom">
                                                        <h4><?= $p->nama ?></h4>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                            eiusmod te incididunt</p>
                                                        <div
                                                            class="d-flex justify-content-between flex-lg-wrap flex-column">
                                                            <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                            <a href="#"
                                                                class="btn border border-secondary rounded-pill px-3 text-primary mb-2 mt-3">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i>Add to
                                                                cart
                                                            </a>
                                                            <a href="#"
                                                                class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i>Detail
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('kategoriFilter').addEventListener('change', function () {
        var selectedCategory = this.value;
        var produkItems = document.querySelectorAll('.fruite-item');
        produkItems.forEach(function (item) {
            item.style.display = 'none';
        });

        if (selectedCategory === 'all') {
            produkItems.forEach(function (item) {
                item.style.display = 'block';
            });
        } else {
            var produkByCategory = document.querySelectorAll('.fruite-item[data-kategori="' + selectedCategory + '"]');
            produkByCategory.forEach(function (item) {
                item.style.display = 'block';
            });
        }
    });
</script>
