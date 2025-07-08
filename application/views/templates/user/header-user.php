<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $judul ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>vendor/datatables/datatables.bootstrap4.css" rel="stylesheet"
        type="text/css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/'); ?>customer/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>customer/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/'); ?>customer/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/'); ?>customer/css/style.css" rel="stylesheet">

    <!-- Menu-detail -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Product Detail</title> -->
    <!-- <link href="<?= base_url('assets/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?= base_url('assets/'); ?>customer/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>customer/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>customer/css/style.css" rel="stylesheet">
</head>

<div class="container-fluid navibar bg-dark-custom">
    <div class="container bg-dark-custom">
        <nav class="navbar navbar-dark navbar-expand-xl">
            <a href="#" class="navbar-brand">
                <h1 class="text-secondary display-6">Cafe X</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-secondary"></span>
            </button>
            <div class="collapse navbar-collapse bg-dark-custom" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="<?= base_url('home'); ?>" class="nav-item nav-link active bg-dark-custom">Home</a>
                    <?php if (!empty($this->session->userdata('email'))) { ?>
                        <span class="nav-item nav-link">Hello,<span class="text-secondary"> <?= ucwords($user); ?></span></span>
                        <a href="<?= base_url('HistoriTransaksi/pesananCustomer'); ?>" class="nav-item nav-link">Order History</a>
                        <a class="nav-item nav-link" href="<?= base_url('autentifikasi/logout'); ?>"><i class="fas fw fa-login"></i> Log out</a>
                    <?php } else { ?>
                        <a class="nav-item nav-link" href="<?= base_url('customer'); ?>"><i class="fas fw fa-login"></i>Register</a>
                        <a class="nav-item nav-link" href="<?= base_url('autentifikasi'); ?>"><i class="fas fw fa-login"></i>Log in</a>
                    <?php } ?>
                    <a href="<?= base_url('home/about'); ?>" class="nav-item nav-link bg-dark-custom">About</a>
                    <a href="<?= base_url('home/faq'); ?>" class="nav-item nav-link bg-dark-custom">FaQ</a>
                    <!-- <a href="#" class="nav-item nav-link">Contact</a> -->
                    <!-- <a href="<?= base_url('autentifikasi/logout'); ?>" class="nav-item nav-link">Log Out</a> -->
                </div>
                <div class="d-flex m-3 me-0">
                    <a href="<?= base_url('pesanan/keranjang') ?>" style="position: relative;">
  <i class="fa fa-shopping-cart" style="font-size: 22px; color: yellow;"></i>
  <span id="keranjang-count" class="badge">0</span>
</a>
                    <!-- <a href="<?= base_url('pesanan/keranjang'); ?>" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                    </a> -->
                </div>
            </div>
        </nav>
    </div>
</div>