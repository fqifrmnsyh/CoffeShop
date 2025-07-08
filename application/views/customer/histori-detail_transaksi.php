<body class="bg-dark-custom">
    <!-- Single Page Header start -->
    <div class="container-fluid py-5">
        <!-- space -->
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Order Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Order Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Detail Pesanan Page Start -->
    <div class="container-fluid py-1">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center">Product</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Note</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark-custom">
                        <?php foreach ($detail_pesanan as $t): ?>
                            <tr class="text-white">
                                <th scope="row" class="justify-content-center" width="250px">
                                    <div class="align-items-center">
                                        <img src="<?= base_url('assets/img/upload/' . $t['image']); ?>" class="rounded" alt="No Picture" style="max-width: 100%; max-height: 100%;">
                                    </div>
                                </th>
                                <td class="text-center"><?= $t['nama']; ?></td>
                                <td class="text-center"><?= $t['catatan']; ?></td>
                                <td class="text-center">
                                    <?php
                                    $statusClass = '';
                                    switch ($t['status']) {
                                        case 'Pending':
                                            $statusClass = 'badge rounded-pill bg-warning bg-gradient text-white';
                                            break;
                                        case 'Complete':
                                            $statusClass = 'badge rounded-pill bg-success bg-gradient text-white';
                                            break;
                                        case 'Canceled':
                                            $statusClass = 'badge rounded-pill bg-danger bg-gradient text-white';
                                            break;
                                    }
                                    ?>
                                    <span class="<?= $statusClass; ?>"><?= $t['status']; ?></span>
                                </td>
                                <td class="text-center"><?= $t['jml_item']; ?></td>
                                <td class="text-center"><?= uang($t['sub_total']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Detail Pesanan Page End -->

    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/lightbox/js/lightbox.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/'); ?>customer/js/main.js"></script>
</body>
