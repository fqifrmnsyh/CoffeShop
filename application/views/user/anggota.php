<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- <?= $this->session->flashdata('pesan'); ?> -->
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <a href="" class="btn btn-cream mb-3 text-gray-900" data-toggle="modal" data-target="#daftarModal"><i
                    class="fas fa-pencil-alt"></i> Add User</a>
            <!-- <a class="nav-item nav-link" data-toggle="modal" data-target="#daftarModal" href="#"><i class="fas fw fa-pencil-alt"></i> Daftar</a> -->
            <!-- <?= $this->session->flashdata('pesan'); ?> -->

            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr class="dark-choco text-white">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th scope="col" nowrap>Joined Since</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    $i = 1;
                    foreach ($anggota as $a) { ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $a['nama']; ?></td>
                            <td>
                                <?php 
                                if ($a['role_id'] == 1) {
                                    echo "Admin";
                                } elseif ($a['role_id'] == 2) {
                                    echo "Kasir";
                                } else {
                                    echo "???";
                                }
                                ?>
                            </td>
                            <td><?= $a['email']; ?></td>
                            <td><?= date('d F Y', $a['tanggal_input']); ?></td>
                            <td>
                                <picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/profile/') . $a['image']; ?>" class="img-fluid img-thumbnail" alt="..." style="width:80px;height:80px;">
                                </picture>
                            </td>
                            <td>
                                <a href="<?= base_url('user/hapus/' . $a['id']); ?>" onclick="return confirm('Kamu yakin akan menghapus anggota ini?');" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Remove</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- daftar modal --> 
<div class="modal fade" tabindex="-1" id="daftarModal" role="dialog"> 
    <div class="modal-dialog" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title">User SignUp</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                </button> 
            </div> 
            <form action="<?= base_url('user/daftar'); ?>" method="post"> 
                <div class="modal-body"> 
                    <div class="form-group"> 
                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Name" required> 
                    </div> 
                    <div class="form-group"> 
                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Address" required> 
                    </div> 
                    <div class="form-group"> 
                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" required> 
                    </div> 
                    <div class="form-group"> 
                        <input type="text" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" required> 
                    </div> 
                    <div class="form-group"> 
                        <input type="text" class="form-control form-control-user" id="password2" name="password2" placeholder="Confirm Password" required> 
                    </div> 
                </div> 
 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-outline-primary">Save</button> 
                </div> 
            </form> 
        </div> 
    </div> 
</div> 
<!--/end of Modal Daftar -->
