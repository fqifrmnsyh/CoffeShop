<div class="container">
    <center>
       
                    <div class="table-responsive full-width">
                        <table class="table table-bordered table-striped tablehover" id="table-datatable">
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
                                        <td>
                                            <?= $order['id_pesanan']; ?>
                                        </td>
                                        <td>
                                            <?php echo substr($order['id_pesanan'], -4); ?>
                                        </td>
                                        <td>
                                            <?= $order['tgl_pesanan']; ?>
                                        </td>
                                        <td>
                                        <?php
                                        $statusClass = '';
                                        switch ($order['status']) {
                                            case 'InOrder':
                                                $statusClass = 'badge rounded-pill bg-warning bg-gradient text-white';
                                                break;
                                            case 'Complete':
                                                $statusClass = 'badge rounded-pill bg-success bg-gradient';
                                                break;
                                        }
                                        ?>
                                        <span class="<?= $statusClass; ?>">
                                            <?=($order['status']); ?>
                                        </span>
                                        </td>
                                        <td>
                                            <?= $order['total_item']; ?>
                                        </td>
                                        <td>
                                            <?= uang($order['total_harga']) ?>
                                        </td>
                                        <td><a href="<?php echo base_url('pesanan/pesanandetailBackEnd/' . $order['id_pesanan']); ?>"
                                                class="btn btn-primary">Detail</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                
    </center>
</div>