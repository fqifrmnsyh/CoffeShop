<body class="bg-dark-custom">


    <!-- Single Page Header start -->
    <div class="container-fluid py-5">
        <!-- space -->
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-1">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <!-- <th scope="col" class="text-white">No</th> -->
                            <th scope="col" class="text-white">Product</th>
                            <th scope="col" class="text-white">Name</th>
                            <th scope="col" class="text-white">Note</th>
                            <th scope="col" class="text-white">Price</th>
                            <th scope="col" class="text-white">Quantity</th>
                            <th scope="col" class="text-white">Total</th>
                            <th scope="col" class="text-white">Cancel</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($temp as $t) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center" style="width: 120px; height: 120px;">
                                        <img src="<?= base_url('assets/img/upload/' . $t['image']); ?>" class="rounded"
                                            alt="No Picture" style="max-width: 120px; max-height: 120px;">
                                        <!-- <img src="img/vegetable-item-3.png" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt=""> -->
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4 text-white">
                                        <?= $t['nama']; ?>
                                    </p>
                                </td>
                                <td>
                                    <input type="text" class="form-control note-item bg-dark-custom mb-0 mt-4mb-0 mt-4"
                                        value="<?= $t['catatan']; ?>" data-id="<?= $t['id_produk'] ?>">
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 text-white">
                                        <?= uang($t['harga']); ?>
                                    </p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-dark-custom border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm text-center border-0 bg-dark-custom jml-item"
                                            value="<?= $t['jml_item'] ?>" data-id="<?= $t['id_produk'] ?>">
                                        <!-- Tambahkan id_produk sebagai data -->
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-dark-custom border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 text-white">
                                        <?= uang($t['sub_total']); ?>
                                    </p>

                                </td>
                                <td>
                                    <button class="btn mt-4">
                                        <a href="<?= base_url('pesanan/hapusPesanan/' . $t['id_produk']); ?>"
                                            onclick="return confirm('Yakin ingin Menghapus <?= $t['nama']; ?>?')"><i
                                                class="btn btn-danger fas fw fa-trash"></i></a>
                                    </button>
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
                        <form action="<?= base_url('pesanan/konfirmasiPesanan') ?>" method="POST">
                            <!-- <div class="mb-4 ms-4 me-4">
                                <label for="payment-method" class="form-label">Metode Pembayaran</label>
                                <select id="payment-method" name="MetodePembayaran" class="form-select">
                                    <option value="BCA">BCA</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                    <option value="DANA">DANA</option>
                                    <option value="OVO">OVO</option>
                                </select>
                            </div> -->
                            <button
                                class="btn border border-black-custom rounded-pill px-4 py-3 text-uppercase mb-4 ms-4" 
                                type="submit">Proceed Checkout
                            </button>
                        </form>
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


    <!-- Update quantity -->
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

    <!-- Update Note -->
    <script>
        $(document).ready(function () {
            // Event listener untuk input catatan
            $('.note-item').on('change', function () {
                var $input = $(this);
                var id_produk = $input.data('id'); // Ambil id_produk
                var note = $input.val(); // Ambil nilai catatan

                // Panggil fungsi updateNote
                updateNote(id_produk, note);
            });

            function updateNote(id_produk, note) {
                $.ajax({
                    url: '<?= base_url('pesanan/updateNote') ?>', // Panggil endpoint updateNote
                    method: 'POST',
                    data: {
                        id_produk: id_produk,
                        note: note
                    },
                    success: function (response) {
                        // Opsi: Tampilkan notifikasi sukses
                        alert('Catatan berhasil diperbarui');
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat memperbarui catatan');
                    }
                });
            }
        });
    </script>
</body>

</html>