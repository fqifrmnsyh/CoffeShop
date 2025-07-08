<div class="container">
    <a href="<?= base_url('laporan/laporan_transaksi_pdf'); ?>" class="btn btn-danger mb-3"><i class="fas fa-print"></i>
        Print PDF</a>
    <a href="<?= base_url('laporan/export_excel_transaksi'); ?>" class="btn btn-success mb-3"><i
            class="far fa-file-pdf"></i> Export Excel</a>
    <center>
        <div class="table-responsive full-width" id="histori">
            <table class="table table-bordered table-striped table-hover" id="table-datatable">
                <thead>
                    <tr class="dark-choco text-white">
                        <th>Order ID</th>
                        <th>Order Number</th>
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
                            <td><?= $order['id_pesanan']; ?></td>
                            <td><?php echo substr($order['id_pesanan'], -4); ?></td>
                            <td><?= $order['tgl_pesanan']; ?></td>
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
                                <span class="<?= $statusClass; ?>">
                                    <?= $order['status']; ?>
                                </span>
                            </td>
                            <td><?= $order['total_item']; ?></td>
                            <td><?= uang($order['total_harga']); ?></td>
                            <td>
                                <a href="<?php echo base_url('HistoriTransaksi/pesanandetailBackEnd/' . $order['id_pesanan']); ?>"
                                    class="btn btn-primary">Detail</a>

                                <!-- Tombol Cetak Struk -->
                                <form action="<?= base_url('pesanan/exportToPdf'); ?>" method="post" target="_blank"
                                    style="display: inline-block;">
                                    <input type="hidden" name="id_pesanan" value="<?= $order['id_pesanan']; ?>">
                                    <button type="submit" class="btn btn-info">Print</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
        </div>
    </center>
</div>