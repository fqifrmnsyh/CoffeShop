<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <center>
                <div class="table-responsive full-width">
                    <table class="table table-bordered table-striped tablehover" id="table-datatable">
                        <thead>
                            <tr class="dark-choco text-white">
                                <th>Product</th>
                                <th>Name</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_pesanan as $t): ?>
                                <tr>
                                    <th scope="row" class="d-flex justify-content-center">
                                        <div class="d-flex align-items-center ">
                                            <img src="<?= base_url('assets/img/upload/' . $t['image']); ?>" class="rounded"
                                                alt="No Picture" style="max-width: 120px; max-height: 120px;">
                                        </div>
                                    </th>
                                    <td>
                                        <?= $t['nama']; ?>
                                    </td>
                                    <td>
                                        <?= $t['catatan']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $statusClass = '';
                                        switch ($t['status']) {
                                            case 'Pending':
                                                $statusClass = 'badge rounded-pill bg-warning bg-gradient text-white';
                                                break;
                                            case 'Complete':
                                                $statusClass = 'badge rounded-pill bg-success text-white bg-gradient';
                                                break;
                                            case 'Canceled':
                                                $statusClass = 'badge rounded-pill bg-danger text-white bg-gradient';
                                                break;
                                        }
                                        ?>
                                        <span class="<?= $statusClass; ?>">
                                            <?= ($t['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $t['jml_item']; ?>
                                    </td>
                                    <td>
                                        <?= uang($t['sub_total']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tfoot>
                    </table>
                </div>
            </center>
        </div>