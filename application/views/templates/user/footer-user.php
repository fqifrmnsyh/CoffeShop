<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/wow/wow.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/counterup/counterup.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/lib/lightbox/js/lightbox.min.js"></script>
    <script src="<?= base_url('assets/'); ?>customer/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.btn-minus').on('click', function () {
                var $display = $('#quantity-display');
                var count = parseInt($display.text()) - 1;
                count = count < 1 ? 1 : count;
                $display.text(count);
                return false;
            });
            $('.btn-plus').on('click', function () {
                var $display = $('#quantity-display');
                $display.text(parseInt($display.text()) + 1);
                return false;
            });
        });

    </script>

    <!-- filter kategori -->
    <script>
        document.getElementById('kategoriFilter').addEventListener('change', function () {
            var selectedCategory = this.value;
            var produkItems = document.querySelectorAll('.fruite-item');
            produkItems.forEach(function (item) {
                item.style.display = 'none';
            });

            if (selectedCategory === 'all') {
                produkItems.forEach(function (item) {
                    item.style.display = 'block';
                });
            } else {
                var produkByCategory = document.querySelectorAll('.fruite-item[data-kategori="' + selectedCategory + '"]');
                produkByCategory.forEach(function (item) {
                    item.style.display = 'block';
                });
            }
        });
    </script>
    
    <script>
//        // Simpan posisi scroll dan ID tab yang aktif saat tab diganti
//        $('.nav-pills a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
//            var targetTabId = $(e.target).attr('href'); // ID tab yang baru aktif
//            sessionStorage.setItem('activeTab', targetTabId); // Simpan ID tab yang aktif
//            sessionStorage.setItem('scrollPosition', $(window).scrollTop()); // Simpan posisi scroll saat ini
//        });
//
//        // Setel kembali posisi scroll dan tab yang aktif saat halaman dimuat
//        $(document).ready(function () {
//            var activeTab = sessionStorage.getItem('activeTab'); // Dapatkan ID tab yang aktif
//            var scrollPosition = sessionStorage.getItem('scrollPosition'); // Dapatkan posisi scroll
//
//            // Atur kembali tab yang aktif
//            if (activeTab) {
//                $('.nav-pills a[href="' + activeTab + '"]').tab('show');
//            }
//
//            // Atur kembali posisi scroll
//            if (scrollPosition) {
//                $(window).scrollTop(scrollPosition);
//            }
//        });
    </script>

        <!-- Cek Item Sudah di Keranjang  -->
    <script>
        $(document).ready(function () {
            $('.add-to-cart-btn').on('click', function (event) {
                event.preventDefault(); // Mencegah tombol dari pengiriman normal

                var url = $(this).attr('href');
                var id_produk = url.split('/').pop(); // Mendapatkan ID produk dari URL

                // Periksa apakah item sudah ada di keranjang
                $.ajax({
                    url: '<?= base_url("pesanan/CekItemKeranjang") ?>',
                    type: 'POST',
                    data: { id_produk: id_produk },
                    dataType: 'json',
                    success: function (response) {
                        if (response.exists) {
                            alert('Pesanan sudah ada di keranjang'); // Notifikasi jika item sudah ada
                        } else {
                            window.location.href = url; // Lanjutkan menambahkan ke keranjang
                        }
                    },
                    error: function () {
                        alert('Silahkan Login terlebih dahulu');
                    }
                });
            });
        });
    </script>
    <script>
  function loadJumlahKeranjang() {
    fetch('<?= base_url('pesanan/getJumlahItemKeranjang') ?>')
      .then(response => response.json())
      .then(data => {
        document.getElementById('keranjang-count').textContent = data.jumlah;
      });
  }

  document.addEventListener('DOMContentLoaded', loadJumlahKeranjang);
</script>
</body>
<footer>
<div class="container-fluid copyright bg-dark-custom py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Cafe X</a> All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Follow Us : <a href="#">Facebook</a> - <a href="#">Twitter</a> - <a href="#">Instagram</a>
                    </div>
                </div>
            </div>
        </div>
</footer>

</html>