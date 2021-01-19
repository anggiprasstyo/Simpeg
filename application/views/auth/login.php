<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <hr class="sidebar-divider my-1">
                                    <h4 class="m-0 font-weight-bold text-dark" style="font-family:'Courier New', Courier, monospace">Sistem Informasi Pegawai</h4>
                                    <hr class="sidebar-divider my-1 mb-3">
                                    <img src="<?= base_url('assets/img/'); ?>Polimedia.png" alt="Polimedia" width="350" class="img-fluid mb-3">
                                    <!-- <h5 class="m-0 font-weight-bold text-dark mt-3 mb-3"> Polimedia</h5> -->
                                </div>
                                <!-- <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Halaman Masuk</h1>
                                </div> -->



                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="POST" action="<?= base_url('auth'); ?>">

                                    <!-- <input type="hidden" name="token" value="<?= get_csrf_token() ?>"> -->

                                    <?= csrf() ?>


                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user <?= form_error('email') ? 'is-invalid' : null ?>" id="email" name="email" value="<?= set_value('email'); ?>" placeholder="Masukkan alamat email">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : null ?>" id="password" name="password" placeholder="Masukkan kata sandi">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-dark btn-user btn-block">
                                        Masuk
                                    </button>
                                </form>
                                <hr>
                                <!-- Footer -->
                                <footer class="sticky-footer bg-white">
                                    <div class="container my-auto">
                                        <div class="copyright text-center my-auto">
                                            <span>Copyright &copy; UPT TIK Polimedia <?= date('Y'); ?></span>
                                        </div>
                                    </div>
                                </footer>
                                <!-- End of Footer -->
                                <!-- <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Tidak Ingat Kata Sandi?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registration'); ?>">Buat akun!</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>