<!-- Product section-->
<section class="py-5">
  <div class="container px-4 px-lg-5 my-5">
    <button class="btn btn-outline-secondary fas fw fa-reply col-2 mb-5" onclick="window.history.go(-1)">
      Kembali</button>
    <div class="row gx-4 gx-lg-5 align-items-center">
      <div class="col-md-6"
        style="height: 450px; width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
        <img class="card-img-top mb-5 mb-md-0" style="max-height: 450px; max-width: 450px;"
          src="<?php echo base_url(); ?>assets/img/upload/<?= $gambar; ?>" alt="..." />
      </div>
      <div class="col-md-6">
        <!-- <div class="small mb-1">SKU: BST-498</div> -->
        <h1 class="display-5 fw-bolder"><?= $nama; ?></h1>
        <div class="fs-5 mb-5">
          <!-- <span class="text-decoration-line-through"><?= $harga; ?></span> -->
          <span>RP <?= $harga; ?></span>
        </div>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam
          sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste
          laborum vero?</p>
        <div class="d-flex">
          <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
            style="max-width: 3rem" />
          <button class="btn btn-outline-dark flex-shrink-0" type="button">
            <i class="bi-cart-fill me-1"></i>
            Add to cart
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
  <div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4">Related products</h2>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
      <?php 
      $a = 0;
      foreach ($produk as $p) { 
        if ($a == 4) break;
        ?>
        <?php $a++; ?>
        <?php if ($p->id_kategori == $id) { // Ganti 1 dengan id_kategori yang diinginkan ?>
        <div class="col col-3 mb-4">
          <div class="card" style="height: 320px">
            <!-- Product image-->
            <div
              style="height: 200px; width: auto; display: flex; justify-content: center; align-items: center; overflow: hidden;">
              
              <img src="<?php echo base_url(); ?>assets/img/upload/<?= $p['image'] ?>" style="max-height: 100%;">
            </div>
            <!-- Product details-->
            <div class="card-body p-3">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder"><?= $p['nama'] ?></h5>
                <!-- Product price-->
                <?= $p['harga'] ?>
                <!-- <?php echo $i['id_kategori'] ?> -->
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center"><a class="btn btn-outline-dark mt-auto"
              href="<?= base_url('home/detailProduk/' . $p['id']); ?>">View
              options</a></div>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
  </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>