<!-- Sidebar -->
<ul class="navbar-nav dark-choco sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        style="height: 150px; flex-direction: column;" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15 mb-4 mt-4">
            <i class="fas fa-mug-hot" style="scale :2;"></i>
        </div>
        <div class="sidebar-brand-text mx-5"> Cafe X</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Looping Menu-->
    <div class="sidebar-heading">
        Home
    </div>
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
            <i class="fa fa-fw fa-table"></i>
            <span>Dashboard</span></a>
    </li>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('user/anggota'); ?>">
            <i class="fa fa-fw fa-user"></i>
            <span>User</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('produk'); ?>">
            <i class="fa fa-fw fa-list"></i>
            <span>Product</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('produk/kategori'); ?>">
            <i class="fa fa-fw fa-layer-group"></i>
            <span>Category</span></a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('meja'); ?>">
            <i class="fa fa-fw fa-chair"></i>
            <span>Meja</span></a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('laporan/laporan_produk'); ?>">
            <i class="fa fa-fw fa-scroll"></i>
            <span>Report</span></a>
    </li>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <div class="sidebar-heading">
        Transactions
    </div>
    <!-- Nav Item - Data Transaksi -->
    <li class="nav-item active">
        <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('HistoriTransaksi'); ?>">
                <i class="fa fa-fw fa-user"></i>
                <span>Transaction History</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('Pesanan'); ?>">
                <i class="fa fa-fw fa-user"></i>
                <span>Orders</span></a>
        </li>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->

</ul>
<!-- End of Sidebar --   > 
        
        