<div class="container">
    <?php if ($this->session->flashdata('pesan')): ?>
        <?php echo $this->session->flashdata('pesan'); ?>
    <?php endif; ?>
    <center>
        <table>
            <tr>
                <td>
                    <div class="table-responsive full-width">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <thead>
                                <tr class="dark-choco text-white">
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalTagihan = 0;
                                foreach ($detail_pesanan as $t):
                                    $totalTagihan += $t['sub_total'];
                                ?>
                                    <tr>
                                        <th scope="row" class="d-flex justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <img src="<?= base_url('assets/img/upload/' . $t['image']); ?>"
                                                     class="rounded" alt="No Picture"
                                                     style="max-width: 120px; max-height: 120px;">
                                            </div>
                                        </th>
                                        <td><?= $t['nama']; ?></td>
                                        <td><?= $t['catatan']; ?></td>
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
                                            <span class="<?= $statusClass; ?>"><?= $t['status']; ?></span>
                                        </td>
                                        <td><?= $t['jml_item']; ?></td>
                                        <td><?= uang($t['sub_total']); ?></td>
                                        <td>
                                            <?php if ($t['status'] == 'Pending'): ?>
                                                <form action="<?= base_url('pesanan/updateStatusDetailPesanan') ?>" method="post">
                                                    <input type="hidden" name="id_detail_pesanan" value="<?= $t['id'] ?>">
                                                    <button type="submit" class="btn btn-success">Confirm</button>
                                                </form>
                                                <form action="<?= base_url('pesanan/cancelPesanan') ?>" method="post" style="margin-top: 5px;">
                                                    <input type="hidden" name="id_detail_pesanan" value="<?= $t['id'] ?>">
                                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                                </form>
                                            <?php elseif ($t['status'] == 'Complete'): ?>
                                                <button class="btn btn-secondary" disabled>Confirmed</button>
                                            <?php elseif ($t['status'] == 'Canceled'): ?>
                                                <button class="btn btn-secondary" disabled>Canceled</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end"><strong>Total:</strong></td>
                                    <td><strong><?= uang($totalTagihan); ?></strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <form action="<?= base_url('pesanan/pesananSelesai') ?>" method="post" id="formSelesai">
                                            <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan'] ?>">
                                            <input type="hidden" name="nominal_dibayar_hidden" id="nominalDibayarHidden">
                                            <div class="mb-3">
                                                <label for="NominalBayar" class="form-label">Pay</label>
                                                <input type="number" class="form-control" id="NominalBayar" name="NominalBayar" step="0.01" min="0" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kembalian" class="form-label">Cashback</label>
                                                <input type="text" class="form-control" id="kembalian" readonly>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="prosesPembayaran">Process Payment</button>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" value="" id="checkDibayar" disabled>
                                                <label class="form-check-label" for="checkDibayar">
                                                    Paid
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-success" id="btnSelesai" disabled>Finish Order</button>
                                        </form>
                                        <div class="alert alert-danger mt-3" id="alertKurang" style="display: none;">
                                            Not enough money.
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </center>
</div>

<script>
document.getElementById('prosesPembayaran').addEventListener('click', function() {
    const totalTagihan = <?= $totalTagihan; ?>;
    const nominalInput = document.getElementById('NominalBayar');
    const nominal = parseFloat(nominalInput.value);
    const kembalian = document.getElementById('kembalian');
    const checkDibayar = document.getElementById('checkDibayar');
    const btnSelesai = document.getElementById('btnSelesai');
    const alertKurang = document.getElementById('alertKurang');
    const nominalDibayarHidden = document.getElementById('nominalDibayarHidden');

    console.log("Total Tagihan:", totalTagihan);
    console.log("Nominal Diterima:", nominal);

    if (!isNaN(nominal)) {
        const kembalianValue = nominal - totalTagihan;

        if (kembalianValue >= 0) {
            kembalian.value = kembalianValue.toFixed(2);
            checkDibayar.checked = true;
            checkDibayar.disabled = false;
            btnSelesai.disabled = false;
            alertKurang.style.display = 'none';
            nominalDibayarHidden.value = nominal;  // Set nilai hidden input
        } else {
            kembalian.value = '';
            checkDibayar.checked = false;
            checkDibayar.disabled = true;
            btnSelesai.disabled = true;
            alertKurang.style.display = 'block';
            nominalDibayarHidden.value = '';  // Clear hidden input
        }
    } else {
        kembalian.value = '';
        checkDibayar.checked = false;
        checkDibayar.disabled = true;
        btnSelesai.disabled = true;
        alertKurang.style.display = 'none';
        nominalDibayarHidden.value = '';  // Clear hidden input
    }

    console.log("Kembalian:", kembalian.value);
    console.log("Check Dibayar:", checkDibayar.checked);
});
</script>
