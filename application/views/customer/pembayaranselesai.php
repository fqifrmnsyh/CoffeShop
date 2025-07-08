<body class="bg-dark-custom">

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5 pt-5">
        <!-- space -->
    </div>
    <div class="container-fluid page-header py-5 pt-5">
        <h1 class="text-center text-white display-6">Confirm Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
            <li class="breadcrumb-item active text-white">Confirm Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Confirmation Page Start -->
    <div class="container-fluid py-1">
        <div class="container py-5">
            <h1 class="mt-5 text-white">Thank you for your purchase!</h1>
            <h3 class="mt-5 text-white">Please show this order receipt to the cashier to proceed with the payment.</h3>
            <!-- <div class="alert alert-success" role="alert">
                Pembayaran Anda telah berhasil.<br> Untuk mengecek Status Pesanan Anda Silahkan lihat Detail Pesanan.
            </div> -->

            <div id="cetak">
                <h3 class="text-white">Order details:</h3>
                <table class="table text-white">
                    <tr>
                        <th>Order ID</th>
                        <td><?= $pesanan['id_pesanan'] ?></td>
                    </tr>
                    <tr>
                        <th>Order Number</th>
                        <td><?php echo substr($pesanan['id_pesanan'], -4); ?></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><?= date('d M Y H:i', strtotime($pesanan['tgl_pesanan'])) ?></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><?= uang($pesanan['total_harga']) ?></td>
                    </tr>
                    <!-- <tr>
                        <th>Metode Pembayaran</th>
                        <td><?= $pesanan['Pembayaran'] ?></td>
                    </tr> -->
                </table>
            </div>
            <a href="<?= base_url('customer/cetakPesanan/'.$pesanan['id_pesanan']) ?>" class="btn btn-secondary mt-3">Print</a>
        </div>
    </div>
    <!-- Confirmation Page End -->

</body>

</html>
