<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('assets/'); ?>"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Account settings - Account | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/'); ?>img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>sneat/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>sneat/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>sneat/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>sneat/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= base_url('assets/'); ?>sneat/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/'); ?>sneat/assets/js/config.js"></script>
  </head>

  <body>
  
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="">

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

              <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> -->

              <div class="row">
                <div class="row ">
                  <div class="card ml-4 col-10">
                    
                    <!-- Account -->
                    <?= form_open_multipart('user/ubahprofil'); ?>
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <?php
                        if (isset($user['image'])) { ?>
                      <input type="hidden" name="old_pict" id="old_pict" value="<?= $user['image']; ?>">
                        
                      <img
                          src="<?= base_url('assets/img/profile/') . $user['image']; ?>"
                          alt="user-avatar"
                          class="d-block rounded mr-3"
                          height="150"
                          width="150"
                          id="uploadedAvatar"
                        />
                        <?php } ?>
                        <div class="button-wrapper">
                          <label for="image" class="btn dark-choco text-white mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="image"
                              name="image"
                              class="account-file-input"
                              hidden
                            />
                          </label>
                          <!-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button> -->

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 10MB</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">NAME</label>
                            <input
                              class="form-control"
                              type="text"
                              id="nama"
                              name="nama"
                              value="<?= $user['nama']; ?>"
                              autofocus
                            /><?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Email</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="<?= $user['email']; ?>"
                              autofocus
                              readonly
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone</label>
                            <div class="input-group input-group-merge">
                              <!-- <span class="input-group-text bg-secondary text-white">ID (+62)</span> -->
                              <input
                                type="text"
                                id="telepon"
                                name="telepon"
                                class="form-control"
                                value="<?= $user['telepon']; ?>"
                              />
                            </div><?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>" />
                          </div>
                          
                        </div>
                        <div class="mt-2">
            
                          <button type="submit" class="btn dark-choco text-white">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary" onclick="window.history.go(-1)">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            
            <!-- / Content -->

            

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url('assets/'); ?>sneat/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url('assets/'); ?>sneat/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url('assets/'); ?>sneat/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url('assets/'); ?>sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= base_url('assets/'); ?>sneat/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= base_url('assets/'); ?>sneat/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/'); ?>sneat/assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>