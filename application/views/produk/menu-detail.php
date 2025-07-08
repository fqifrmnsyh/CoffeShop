<body class="bg-dark-custom">
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- Single Page Header start -->
    <div class="container-fluid py-5">
        <!-- space -->
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Product Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-0">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-11 col-xl-12">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="<?php echo base_url(); ?>assets/img/upload/<?= $gambar; ?>"
                                        class="img-fluid rounded" style="width: 100%;" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h1 class="fw-bold mb-3 text-white">
                                <?= $nama; ?>
                            </h1>
                            <p class="mb-3">Category:
                                <?= $kategori; ?>
                            </p>
                            <h3 class="fw-bold mb-3 text-white">
                                <?= uang($harga); ?>
                            </h3>
                            <form action="<?= base_url('pesanan/tambahpesanan/' . $id) ?>" method="post">
                                <div class="input-group quantity mb-2">
                                    <button type="button"
                                        class="btn btn-sm btn-minus rounded-circle bg-dark-custom border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input type="hidden" name="quantity" id="quantity" value="1">
                                    <span class="text-center border-0 bg-dark-custom mt-1" id="quantity-display"
                                        style="width: 50px;">1</span>

                                    <button type="button"
                                        class="btn btn-sm btn-plus rounded-circle bg-dark-custom border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border rounded my-4 bg-dark-custom">
                                        <textarea name="note" id="" class="form-control border-0 bg-dark-custom"
                                            cols="30" rows="8" placeholder="Add a note" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <?php
                                if (!empty($this->session->userdata('email'))) { ?>
                                    <button type="submit" class="btn border border-white-custom rounded-pill px-4 py-2 mb-4" >
                                        <i class="fa fa-shopping-bag me-2 text-secondary"></i> Add to cart
                                    </button>
                                <?php } else { ?>
                                    <button type="submit" class="btn border border-white-custom rounded-pill px-4 py-2 mb-2" disabled>
                                        <i class="fa fa-shopping-bag me-2 text-secondary"></i> Add to cart
                                    </button>
                                    <p style="font-style: italic; font-size: 15px">Silakan Login Terlebih Dahulu</p>
                                <?php } ?>
                            </form>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <span class="mb-2" type="bg-dark-custom" role="tab" id="nav-about-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about"
                                        aria-selected="true">Description</span>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <?= $deskripsi; ?>
                                    <div class="px-2">
                                        <div class="row g-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="fw-bold mb-0 text-white">Related products</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        <?php
                        $a = 0;
                        foreach ($produk as $p) {
                            if ($a == 6)
                                break;
                            ?>
                            <?php $a++; ?>
                            <div class="rounded position-relative vesitable-item pb-4" style="border: 1px solid black;">
                                <div class="vesitable-img" style="height: 200px;">
                                    <img src="<?php echo base_url(); ?>assets/img/upload/<?= $p['image'] ?>"
                                        class="img-fluid w-100 rounded-top" alt="" style="scale: 130%;">
                                </div>
                                <?php
                                $kategori = $p['id_kategori'];
                                if ($kategori == 1) {
                                    echo "<div class='text-white bg-secondary px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$p[nama_kategori]</div>";
                                } elseif ($kategori == 2) {
                                    echo "<div class='text-white bg-drink px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$p[nama_kategori]</div>";
                                } elseif ($kategori == 3) {
                                    echo "<div class='text-white bg-danger px-3 py-1 rounded position-absolute' style='top: 10px; left: 10px;'>$p[nama_kategori]</div>";
                                } else {
                                    null;
                                }
                                ?>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4 class="text-white">
                                        <?= $p['nama'] ?>
                                    </h4>

                                    <div class="d-flex justify-content-between flex-lg-wrap row">
                                        <p class="text-gray fs-5 fw-bold mb-2">
                                            <?= uang($p['harga']); ?>
                                        </p>
                                        <a href="<?= base_url('home/detailProduk/' . $p['id']); ?>"
                                            class="btn border border-white-custom rounded-pill px-3 mb-2">
                                            <i class="fa fa-search me-2"></i> Detail
                                        </a>
                                        <a href="<?= base_url('pesanan/tambahpesanan/' . $p['id']) ?>"
                                            class="btn border border-white-custom rounded-pill px-3 add-to-cart-btn">
                                            <i class="fa fa-shopping-bag me-2"></i> Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

    <a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>