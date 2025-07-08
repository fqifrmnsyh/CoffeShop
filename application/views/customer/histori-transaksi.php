<body class="bg-dark-custom">
    <!-- Single Page Header start -->
    <div class="container-fluid py-5">
        <!-- space -->
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Order History</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Order History</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Histori Transaksi Page Start -->
    <div class="container-fluid py-1">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="table-datatable">
                    <thead>
                        <tr class="bg-dark text-white text-center">
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="text-white"><?= $order['id_pesanan']; ?></td>
                                <td class="text-white"><?= $order['tgl_pesanan']; ?></td>
                                <td>
                                    <?php
                                    $statusClass = '';
                                    switch ($order['status']) {
                                        case 'InOrder':
                                            $statusClass = 'badge rounded-pill bg-warning bg-gradient text-white';
                                            break;
                                        case 'Complete':
                                            $statusClass = 'badge rounded-pill bg-success bg-gradient text-white';
                                            break;
                                    }
                                    ?>
                                    <span class="<?= $statusClass; ?>"><?= $order['status']; ?></span>
                                </td>
                                <td class="text-white"><?= $order['total_item']; ?></td>
                                <td class="text-white"><?= uang($order['total_harga']); ?></td>
                                <td>
                                    <a href="<?= base_url('HistoriTransaksi/pesanandetailCustomer/' . $order['id_pesanan']); ?>" class="btn btn-primary">See Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Histori Transaksi Page End -->

    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/lightbox/js/lightbox.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/'); ?>customer/js/main.js"></script>

    <!-- Custom Sorting Script -->
    <script>
        $(document).ready(function () {
            var rows = $('#table-datatable tbody tr').get();
            rows.sort(function (a, b) {
                var keyA = $(a).find('td:eq(2) span').text();
                var keyB = $(b).find('td:eq(2) span').text();
                if (keyA == 'InOrder' && keyB == 'Complete') {
                    return -1;
                }
                if (keyA == 'Complete' && keyB == 'InOrder') {
                    return 1;
                }
                return 0;
            });
            $.each(rows, function (index, row) {
                $('#table-datatable tbody').append(row);
            });
        });
    </script>
</body>
