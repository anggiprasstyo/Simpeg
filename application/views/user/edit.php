<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/edit'); ?>
            <input type="hidden" name="id_pegawai" value="<?= $user['id_pegawai']; ?>">
            <input type="hidden" name="id_jabatan" value="<?= $user['id_jabatan']; ?>">
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                    <input type="text" name="nip" class="form-control" id="nip" value="<?= $user['nip']; ?>" readonly>
                    <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : null ?>" id="name" placeholder="Full name" name="name" value="<?= $datauser['nama']; ?>">
                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="hp" class="col-sm-2 col-form-label">HP</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= form_error('hp') ? 'is-invalid' : null ?>" id="hp" placeholder="Nomor HP" name="hp" value="<?= $datauser['hp']; ?>">
                    <?= form_error('hp', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : null ?>" id="alamat" placeholder="Alamat Lengkap" name="alamat" rows="3"><?= $datauser['alamat']; ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <?php $provById = $this->db->get_where('wilayah_provinsi', ['id' => $datauser['provinsi']])->result_array(); ?>
            <div class="form-group row">
                <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                <div class="col-sm-10">
                    <select class="form-control" id="provinsi" name="provinsi" required>
                        <option value="">--Pilih Provinsi--</option>
                        <?php foreach ($provinsi as $prov) : ?>
                            <option value="<?= $prov['id'] ?>" <?= $datauser['provinsi'] == $prov['id'] ? "selected" : null; ?>><?= $prov['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <?php $kabById = $this->db->get_where('wilayah_kabupaten', ['provinsi_id' => $datauser['provinsi']])->result_array(); ?>
            <div class="form-group row">
                <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kabupaten" name="kabupaten" required>
                        <option value="">--Pilih Kabupaten--</option>
                        <?php foreach ($kabById as $kab) : ?>
                            <option value="<?= $kab['id']; ?>" <?= $datauser['kabupaten'] == $kab['id'] ? "selected" : null; ?>><?= $kab['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <?php $kecById = $this->db->get_where('wilayah_kecamatan', ['kabupaten_id' => $datauser['kabupaten']])->result_array(); ?>
            <div class="form-group row">
                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kecamatan" name="kecamatan" required>
                        <option value="">--Pilih Kecamatan--</option>
                        <?php foreach ($kecById as $kec) : ?>
                            <option value="<?= $kec['id']; ?>" <?= $datauser['kecamatan'] == $kec['id'] ? "selected" : null; ?>><?= $kec['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <?php $desaById = $this->db->get_where('wilayah_desa', ['kecamatan_id' => $datauser['kecamatan']])->result_array(); ?>
            <div class="form-group row">
                <label for="desa" class="col-sm-2 col-form-label">Desa</label>
                <div class="col-sm-10">
                    <select class="form-control" id="desa" name="desa" required>
                        <option value="">--Pilih Desa/Kota--</option>
                        <?php foreach ($desaById as $desa) : ?>
                            <option value="<?= $desa['id']; ?>" <?= $datauser['desa'] == $desa['id'] ? "selected" : null; ?>><?= $desa['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- <?php
                    if ($user['id_jabatan'] == 1) :
                        $dataUser = $this->db->get_where('pegawai', ['id_peg' => $user['id_pegawai']])->row_array(); ?>

                <?php if ($dataUser) : ?>

                    <div class="form-group row">
                        <label for="tmp_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= form_error('tmp_lahir') ? 'is-invalid' : null ?>" id="tmp_lahir" placeholder="Full tmp_lahir" name="tmp_lahir" value="<?= $dataUser['tmp_lahir']; ?>">
                            <?= form_error('tmp_lahir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control <?= form_error('tgl_lahir') ? 'is-invalid' : null ?>" id="tgl_lahir" name="tgl_lahir" value="<?= $dataUser['tgl_lahir']; ?>">
                            <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                <?php endif; ?>

            <?php elseif ($user['id_jabatan'] == 2) :
                        $dataUser = $this->db->get_where('dosen', ['id_dosen' => $user['id_pegawai']])->row_array(); ?>

                <?php if ($dataUser) : ?>
                    <div class="form-group row">
                        <label for="tmp_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= form_error('tmp_lahir') ? 'is-invalid' : null ?>" id="tmp_lahir" placeholder="Full tmp_lahir" tmp_lahir="tmp_lahir" value="<?= $dataUser['tmp_lahir']; ?>">
                            <?= form_error('tmp_lahir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control <?= form_error('tgl_lahir') ? 'is-invalid' : null ?>" id="tgl_lahir" name="tgl_lahir" value="<?= $dataUser['tgl_lahir']; ?>">
                            <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endif; ?> -->

            <div class="form-group row">
                <div class="col-sm-2">Foto</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="image" onchange="previewImg()">
                                <label class="custom-file-label" for="image">Pilih foto jika ingin diubah</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah</button>
                </div>

            </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; UPT TIK Polimedia <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah yakin ingin keluar akun?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Keluar" jika anda ingin keluar akun.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>


<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables-1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('assets/'); ?>vendor/datatables/datatables.min.js"></script>

<!-- Page level custom scripts -->
<!-- <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script> -->


<!-- <script src="<?= base_url('assets/'); ?>vendor/datatables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/Buttons-1.6.5/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/Buttons-1.6.5/js/buttons.colVis.min.js"></script> -->

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });

    function previewImg() {
        const sampul = document.querySelector('#foto');
        const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        sampulLabel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    $(document).ready(function() {
        $('#pilihJurusan').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('pegawai/getProgstudi') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#pilih_Progstudi').html(response);
                }

            });
        });

        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('User/getKabupaten') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kabupaten').html(response);
                }

            });
        });

        $('#kabupaten').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('User/getKecamatan') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kecamatan').html(response);
                }

            });
        });

        $('#kecamatan').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('User/getDesa') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#desa').html(response);
                }

            });
        });

        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ]
        });

    });
</script>

</body>

</html>