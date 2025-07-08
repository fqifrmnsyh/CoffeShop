<!-- <?= $this->session->flashdata('pesan'); ?> -->

<div style="padding: 0px;" class="">
    <div class="x_panel">
        <div class="x_content">
            <!-- Tampilkan semua produk -->
            <div class="row">
                <!-- looping products -->

                <!-- end looping -->
            </div>
            <header class="bg-dark py-5" style="background-image: url('https://post.app/wp-content/uploads/2021/01/coffee-shop-1.jpeg');">
                <div class="container" style="height: 350px; display: flex; justify-content: center; align-items: center; ">
                    <div class="text-center text-white" style="">
                        <h1 class="display-4 fw-bolder">Welcome</h1>
                        <!-- <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p> -->
                    </div>
                </div>
            </header>
            <section class="py-5 bg-light">
                <div class="container px-4 px-lg-5 mt-5">
                    <h2 class="fw-bolder mb-4">Rekomendasi</h2>
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        <?php foreach ($produk as $produk) { ?>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <div style="height: 200px; width: auto; display: flex; justify-content: center; align-items: center; overflow: hidden;">

                                    <img src="<?php echo base_url(); ?>assets/img/upload/<?= $produk->image; ?>" style="max-height: 100%;">
                                    </div>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder"><?= $produk->nama ?></h5>
                                            <!-- Product price-->
                                            <?= $produk->harga ?>
                                            <!-- <?php echo $i['id_kategori'] ?> -->
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="">View
                                                options</a></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>



