<body class="bg-dark-custom">

    <!-- Hero Start -->
    <div class="container-fluid py-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">A perfect blend of coffee and comfort</h4>
                    <h1 class="mb-5 display-3 text-title">Sip, Relax, and Enjoy at Cafe X</h1>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="<?= base_url('assets/'); ?>customer/img/KOPI.jpg"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Featurs Section Start -->
    
    <div class="container-fluid featurs">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-clock fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h2 class="text-white">Faster Order</h2>
                            <p class="mb-0">No more get bored while in queue</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-credit-card fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h2 class="text-white">Easier Payment</h2>
                            <p class="mb-0">Various method of payment with 100% security</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-clock fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h2 class="text-white">24/7 Support</h2>
                            <p class="mb-0">Support every time fast</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->
    <?php if ($this->session->flashdata('pesan')): ?>
        <?php echo $this->session->flashdata('pesan'); ?>
    <?php endif; ?>

    <div class="container-fluid fruite pb-5 pt-0">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1 class="text-white">Menu</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-toggle="pill"
                                    href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">Recommended</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">Junk Food</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Drink</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-toggle="pill" href="#tab-4">
                                    <span class="text-dark" style="width: 130px;">Snack</span>
                                </a>
                            </li>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php
                                    $i = 0;
                                    foreach ($produk as $p) {
                                        if ($i == 8)
                                            break;
                                        ?>
                                        <?php $i++; ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3 ">
                                            <div class="rounded position-relative fruite-item border-dark-custom"
                                                data-kategori="<?= $p->id_kategori; ?>">
                                                <div class="fruite-img" style="height: 200px;">
                                                    <img src="<?php echo base_url(); ?>assets/img/upload/<?= $p->image; ?>"
                                                        class="img-fluid w-100 rounded-top" alt="" style="scale: 130%;">
                                                </div>
                                                <div class="" style="top: 10px; left: 10px;">
                                                    <?php
                                                    $nama_kategori = 'Unknown';
                                                    foreach ($kategori as $k) {
                                                        if ($k->id == $p->id_kategori) {
                                                            $nama_kategori = $k->kategori;
                                                            break; // keluar dari loop setelah menemukan kecocokan
                                                        }
                                                    }
                                                    ?>
                                                    <div>
                                                        <?php
                                                        if ($k->id == 1) {
                                                            echo "<div class='text-white bg-primary px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$nama_kategori</div>";
                                                        } elseif ($k->id == 2) {
                                                            echo "<div class='text-white bg-drink px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$nama_kategori</div>";
                                                        } elseif ($k->id == 3) {
                                                            echo "<div class='text-white bg-danger px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$nama_kategori</div>";
                                                        } else {
                                                            null;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="p-4  rounded-bottom">
                                                    <h4 class="text-white">
                                                        <?= $p->nama; ?>
                                                    </h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap row">
                                                        <p class="text-gray fs-5 fw-bold mb-3">
                                                            <?= uang($p->harga) ?>
                                                        </p>
                                                        <input type="hidden" name="quantity" id="quantity" value="1">
                                                        <a href="<?= base_url('home/detailProduk/' . $p->id); ?>"
                                                            class="btn border border-white-custom rounded-pill px-3 mb-2">
                                                            <i class="fa fa-search me-2"></i> Detail</a>
                                                        <a>
                                                            <?php if ($p->stok < 1) {
                                                                echo "<a class='btn border col-12 border-dark rounded-pill px-3 sold-out-button' style='cursor: none;'><i class='fa fa-shopping-bag me-2'></i>Sold Out</a>";
                                                            } else {
                                                                echo "<a class='btn col-12 border-white-custom rounded-pill px-3 add-to-cart-btn' href='" . base_url('pesanan/tambahPesanan/' . $p->id) . "'><i class='fa fa-shopping-bag me-2'></i> Add to cart</a>";
                                                            }
                                                            ?>
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

                    <div id="tab-2" class="tab-pane fade">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php foreach ($produk as $p) { ?>
                                        <?php if ($p->id_kategori == 1) { // Ganti 1 dengan id_kategori yang diinginkan ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3 ">
                                                <div class="rounded position-relative fruite-item border-dark-custom"
                                                    data-kategori="<?= $p->id_kategori; ?>">
                                                    <div class="fruite-img" style="height: 200px;">
                                                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $p->image; ?>"
                                                            class="img-fluid w-100 rounded-top" alt="" style="scale: 130%;">
                                                    </div>
                                                    <div class="" style="top: 10px; left: 10px;">
                                                        <div>
                                                            <?php
                                                            $nama_kategori = 'Unknown';
                                                            foreach ($kategori as $k) {
                                                                if ($k->id == $p->id_kategori) {
                                                                    $nama_kategori = $k->kategori;
                                                                    break; // keluar dari loop setelah menemukan kecocokan
                                                                }
                                                            }
                                                            ?>
                                                            <div class='text-white bg-primary px-3 py-1 rounded position-absolute'
                                                                style='top: 10px; left: 10px;'>
                                                                <?= $nama_kategori ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-4  rounded-bottom">
                                                        <h4 class="text-white">
                                                            <?= $p->nama; ?>
                                                        </h4>
                                                        <div class="d-flex justify-content-between flex-lg-wrap row">
                                                            <p class="text-gray fs-5 fw-bold mb-3">
                                                                <?= uang($p->harga) ?>
                                                            </p>
                                                            <input type="hidden" name="quantity" id="quantity" value="1">
                                                            <a href="<?= base_url('home/detailProduk/' . $p->id); ?>"
                                                                class="btn border border-white-custom rounded-pill px-3 mb-2">
                                                                <i class="fa fa-search me-2"></i> Detail
                                                            </a>
                                                            <a>
                                                                <?php if ($p->stok < 1) {
                                                                    echo "<a class='btn border col-12 border-dark rounded-pill px-3' style='cursor: none;'><i class='fa fa-shopping-bag me-2'></i>Sold Out</a>";
                                                                } else {
                                                                    echo "<a class='btn border col-12 border-white-custom rounded-pill px-3 add-to-cart-btn' href='" . base_url('pesanan/tambahPesanan/' . $p->id) . "'><i class='fa fa-shopping-bag me-2'></i> Add to cart</a>";
                                                                }
                                                                ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-3" class="tab-pane fade">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php foreach ($produk as $p) { ?>
                                        <?php if ($p->id_kategori == 2) { // Ganti 1 dengan id_kategori yang diinginkan ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3 ">
                                                <div class="rounded position-relative fruite-item border-dark-custom"
                                                    data-kategori="<?= $p->id_kategori; ?>">
                                                    <div class="fruite-img" style="height: 200px;">
                                                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $p->image; ?>"
                                                            class="img-fluid w-100 rounded-top" alt="" style="scale: 130%;">
                                                    </div>
                                                    <div class="" style="top: 10px; left: 10px;">
                                                        <div>
                                                            <?php
                                                            $nama_kategori = 'Unknown';
                                                            foreach ($kategori as $k) {
                                                                if ($k->id == $p->id_kategori) {
                                                                    $nama_kategori = $k->kategori;
                                                                    break; // keluar dari loop setelah menemukan kecocokan
                                                                }
                                                            }
                                                            ?>
                                                            <div class='text-white bg-drink px-3 py-1 rounded position-absolute'
                                                                style='top: 10px; left: 10px;'>
                                                                <?= $nama_kategori ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-4  rounded-bottom">
                                                        <h4 class="text-white">
                                                            <?= $p->nama; ?>
                                                        </h4>
                                                        <div class="d-flex justify-content-between flex-lg-wrap row">
                                                            <p class="text-gray fs-5 fw-bold mb-3">
                                                                <?= uang($p->harga) ?>
                                                            </p>
                                                            <input type="hidden" name="quantity" id="quantity" value="1">
                                                            <a href="<?= base_url('home/detailProduk/' . $p->id); ?>"
                                                                class="btn border border-white-custom rounded-pill px-3 mb-2">
                                                                <i class="fa fa-search me-2"></i> Detail
                                                            </a>
                                                            <a>
                                                                <?php if ($p->stok < 1) {
                                                                    echo "<a class='btn border col-12 border-dark rounded-pill px-3' style='cursor: none;'><i class='fa fa-shopping-bag me-2'></i>Sold Out</a>";
                                                                } else {
                                                                    echo "<a class='btn border col-12 border-white-custom rounded-pill px-3 add-to-cart-btn' href='" . base_url('pesanan/tambahPesanan/' . $p->id) . "'><i class='fa fa-shopping-bag me-2'></i> Add to cart</a>";
                                                                }
                                                                ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-4" class="tab-pane fade">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php foreach ($produk as $p) { ?>
                                        <?php if ($p->id_kategori == 3) { // Ganti 1 dengan id_kategori yang diinginkan ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3 ">
                                                <div class="rounded position-relative fruite-item border-dark-custom"
                                                    data-kategori="<?= $p->id_kategori; ?>">
                                                    <div class="fruite-img" style="height: 200px;">
                                                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $p->image; ?>"
                                                            class="img-fluid w-100 rounded-top" alt="" style="scale: 130%;">
                                                    </div>
                                                    <div>
                                                        <?php
                                                        $nama_kategori = 'Unknown';
                                                        foreach ($kategori as $k) {
                                                            if ($k->id == $p->id_kategori) {
                                                                $nama_kategori = $k->kategori;
                                                                break; // keluar dari loop setelah menemukan kecocokan
                                                            }
                                                        }
                                                        ?>
                                                        <div class='text-white bg-danger px-3 py-1 rounded position-absolute'
                                                            style='top: 10px; left: 10px;'>
                                                            <?= $nama_kategori ?>
                                                        </div>
                                                    </div>
                                                    <div class="p-4  rounded-bottom">
                                                        <h4 class="text-white">
                                                            <?= $p->nama; ?>
                                                        </h4>
                                                        <div class="d-flex justify-content-between flex-lg-wrap row">
                                                            <p class="text-gray fs-5 fw-bold mb-3">
                                                                <?= uang($p->harga) ?>
                                                            </p>
                                                            <input type="hidden" name="quantity" id="quantity" value="1">
                                                            <a href="<?= base_url('home/detailProduk/' . $p->id); ?>"
                                                                class="btn border border-white-custom rounded-pill px-3 mb-2">
                                                                <i class="fa fa-search me-2"></i> Detail
                                                            </a>
                                                            <a>
                                                                <?php if ($p->stok < 1) {
                                                                    echo "<a class='btn border col-12 border-dark rounded-pill px-3' style='cursor: none;'><i class='fa fa-shopping-bag me-2'></i>Sold Out</a>";
                                                                } else {
                                                                    echo "<a class='btn border col-12 border-white-custom rounded-pill px-3 add-to-cart-btn' href='" . base_url('pesanan/tambahPesanan/' . $p->id) . "'><i class='fa fa-shopping-bag me-2'></i> Add to cart</a>";
                                                                }
                                                                ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    