<body class="bg-dark-custom">


    <!-- Single Page Header start -->
    <div class="container-fluid py-5">
        <!-- space -->
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Keranjang</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Keranjang</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-1">
        <div class="container py-5">
        <p class="text-white">
            ID Pesanan: <?= $id_pesanan; ?> <br>
            No. Pesanan: <?php echo substr($id_pesanan, -4); ?>
        </p>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <!-- <th scope="col" class="text-white">No</th> -->
                            <th scope="col" class="text-white">Produk</th>
                            <th scope="col" class="text-white">Nama</th>
                            <th scope="col" class="text-white">Catatan</th>
                            <th scope="col" class="text-white">Status</th>
                            <th scope="col" class="text-white">Harga</th>
                            <th scope="col" class="text-white">Jumlah</th>
                            <th scope="col" class="text-white">Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($detail_pesanan as $t) {
                            ?>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center">
                                    <div class="d-flex align-items-center " >
                                        <img src="<?= base_url('assets/img/upload/' . $t['image']); ?>" class="rounded"
                                            alt="No Picture" style="max-width: 120px; max-height: 120px;">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4 text-white">
                                        <?= $t['nama']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 text-white">
                                        <?= $t['catatan']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 text-center text-uppercase">
                                        <?php
                                        $statusClass = '';
                                        switch ($t['status']) {
                                            case 'Pending':
                                                $statusClass = 'badge rounded-pill bg-warning bg-gradient text-white';
                                                break;
                                            case 'Complete':
                                                $statusClass = 'badge rounded-pill bg-success bg-gradient';
                                                break;
                                            case 'Canceled':
                                                $statusClass = 'badge rounded-pill bg-danger bg-gradient';
                                                break;
                                        }
                                        ?>
                                        <span class="<?= $statusClass; ?>">
                                            <?=($t['status']); ?>
                                        </span>
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 text-white text-end">
                                        <?= uang($t['harga']); ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 text-white text-center">
                                        <?= $t['jml_item']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 text-white text-end">
                                        <?= uang($t['sub_total']); ?>
                                    </p>
                                </td>
                            </tr>
                            <?php
                            $no++;
                            $total += $t['sub_total'];
                        } ?>

                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end mt-4">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <!-- <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" style="color: black;">$96.00</p>
                            </div>
                        </div> -->
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" style="color: black">
                                <?= uang($total); ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/lightbox/js/lightbox.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/'); ?>customer/js/main.js"></script>

    <script>
        $(document).ready(function () {
            // Hapus event listener yang ada sebelumnya
            $('.btn-minus, .btn-plus').off('click');

            $('.btn-minus').on('click', function () {
                var $input = $(this).closest('.quantity').find('.jml-item');
                var id_produk = $input.data('id'); // Ambil id_produk
                var currentVal = parseInt($input.val());
                if (!isNaN(currentVal) && currentVal >= 1) {
                    $input.val(currentVal);
                    updateQuantity(id_produk, currentVal); // Panggil fungsi updateQuantity
                }
            });

            $('.btn-plus').on('click', function () {
                var $input = $(this).closest('.quantity').find('.jml-item');
                var id_produk = $input.data('id'); // Ambil id_produk
                var currentVal = parseInt($input.val());
                if (!isNaN(currentVal)) {
                    $input.val(currentVal);
                    updateQuantity(id_produk, currentVal); // Panggil fungsi updateQuantity
                }
            });

            $('jml-item').on('change', function () {
                var $input = $(this);
                var id_produk = $input.data('id'); // Ambil id_produk
                var currentVal = parseInt($input.val());
                if (!isNaN(currentVal) && currentVal > 0) {
                    updateQuantity(id_produk, currentVal); // Panggil fungsi updateQuantity
                } else {
                    $input.val(1);
                    updateQuantity(id_produk, 1); // Panggil fungsi updateQuantity dengan nilai 1
                    location.reload(); // Refresh page untuk memperbarui total
                }
            });

            function updateQuantity(id_produk, quantity) {
                $.ajax({
                    url: '<?= base_url('pesanan/updateQuantity') ?>', // Panggil endpoint updateQuantity
                    method: 'POST',
                    data: {
                        id_produk: id_produk,
                        quantity: quantity
                    },
                    success: function (response) {
                        location.reload(); // Refresh page untuk memperbarui total
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>

</body>

</html>