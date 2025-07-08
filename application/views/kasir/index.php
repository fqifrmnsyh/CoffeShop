<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- row ux-->
  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-bottom-danger shadow h-10 py-2 bg-white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-dark text-uppercase mb-1">Jumlah Kasir</div>
              <div class="h1 mb-0 font-weight-bold text-dark"><?= $this->ModelUser->getUserWhere(['role_id' => 2])->num_rows(); ?></div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('user/anggota'); ?>"><i class="fas fa-user-tie fa-3x text-danger"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-bottom-success shadow h-10 py-2 bg-white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-dark text-uppercase mb-1">Stok Item</div>
              <div class="h1 mb-0 font-weight-bold text-dark">
                <?php
                $where = ['stok != 0'];
                $totalstok = $this->ModelProduk->total('stok', $where);
                echo $totalstok;
                ?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('produk'); ?>"><i class="fas fa-hamburger fa-3x text-success"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-bottom-primary shadow h-10 py-2 bg-white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-dark text-uppercase mb-1">Histori Penjualan</div>
              <div class="h1 mb-0 font-weight-bold text-dark">
              <?php
                $totalpenjualan = $this->ModelPesanan ->total();
                echo $totalpenjualan;
                ?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('HistoriTransaksi'); ?>"><i class="fas fa-money-bill-wave rotate-n-15 fa-3x text-primary"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2 bg-success">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-white text-uppercase mb-1">Produk yang dibooking</div>
              <div class="h1 mb-0 font-weight-bold text-white">
                //<?php
                //$where = ['dibooking !=0'];
                //$totaldibooking = $this->ModelProduk->total('dibooking', $where);
                //echo $totaldibooking;
                //?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('user'); ?>"><i class="fas fa-shopping-cart fa-3x text-danger"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- end row ux-->

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- row table-->
  <div class="row">
    <div class="table-responsive table-bordered col-sm-12 ml-auto mt-2">
      <div class="page-header">
        <span class="fas fa-users text-primary mt-2"><span style="font-weight: bold; font-family: arial;"> Data User</span></span>
        <a class="text-danger" href="<?php echo base_url('user/data_user'); ?>">
        <i class="fas fa-search mt-2 float-right"> Tampilkan</i></a>
      </div>
      <table class="table mt-3" id="dataTable">
        <thead>
          <tr class="dark-choco text-white">
            <th>#</th>
            <th>Nama Anggota</th>
            <th>Email</th>
            <th>Role ID</th>
            <th>Aktif</th>
            <th>Member Sejak</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <?php
          $i = 1;
          foreach ($anggota as $a) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $a['nama']; ?></td>
              <td><?= $a['email']; ?></td>
              <td><?= $a['role_id']; ?></td>
              <td>
                <?php
                  if ($a['is_active'] == 1) {
                    echo "<i class='fas fa-circle mr-2' style='color: green;'></i>Aktif";
                  } else {
                    echo "<i class='fas fa-circle mr-2' style='color: gray;'></i>Tidak Aktif";
                  }
                ?>
              </td>
              <!-- <td><?= $a['is_active']; ?></td> -->
              <td><?= date('Y', $a['tanggal_input']); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


    <div class="table-responsive table-bordered col-sm-12 ml-auto mr-auto mt-2">
      <div class="page-header">
        <span class="fas fa-users text-success mt-2"><span style="font-weight: bold; font-family: arial;"> Data Item</span></span>
        <!-- <span class="fas fa-book text-warning mt-2"> Data Item</span> -->
        <a href="<?= base_url('produk'); ?>"><i class="fas fa-search text-primary mt-2 float-right"> Tampilkan</i></a>
      </div>
      <div class="table-responsive">
        <table class="table mt-3" id="table-datatable">
          <thead>
            <tr class="dark-choco text-white">
              <th>#</th>

              <th>Nama</th>
              <!-- <th>Judul Produk</th> -->
              
              <th>Kode</th>

              <th>Harga</th>
              <!-- <th>Pengarang</th> -->


              <!-- <th>Penerbit</th>
              <th>Tahun Terbit</th>
              <th>ISBN</th> -->
              <th>Stok</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            <?php
            $i = 1;
            foreach ($produk as $b) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $b['nama']; ?></td>
                <td><?= $b['kode']; ?></td>
                <td><?= $b['harga']; ?></td>
                <!-- <td><?= $b['penerbit']; ?></td>
                <td><?= $b['tahun_terbit']; ?></td>
                <td><?= $b['isbn']; ?></td> -->
                <td><?= $b['stok']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>


  </div>
  <!-- end of row table-->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->