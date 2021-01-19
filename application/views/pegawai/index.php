    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDataUser"><i class="fas fa-user-plus"></i> Tambah Pegawai</a> -->
        <?php if ($user['role_id'] == 1) : ?>
            <a href="<?= base_url('pegawai/tambahPegawai'); ?>" class="btn btn-dark mb-3"><i class="fas fa-user-plus"></i> Tambah Pegawai</a>
        <?php endif; ?>

        <div class="card mb-4">
            <h5 class="card-header bg-secondary text-white">Filter Data</h5>
            <div class="card-body">
                <form action="<?= base_url('pegawai'); ?>" method="POST">
                    <div class="form-group row mt-2">
                        <label for="searchUnit" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="searchUnit" name="searchUnit">
                                <option value="" <?= $cariUnit == "" ? "selected" : null; ?>>-- All --</option>

                                <?php foreach ($unit as $u) : ?>
                                    <option value="<?= $u['nama_unit'] ?>" <?= $cariUnit == $u['nama_unit'] ? "selected" : null; ?>><?= $u['nama_unit'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="search_status_jabatan" class="col-sm-2 col-form-label">Status Jabatan</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="search_status_jabatan" name="search_status_jabatan">
                                <option value="" class="text-secondary" <?= $cariJabatan == "" ? "selected" : null; ?>>-- All --</option>
                                <option value="non-pns" <?= $cariJabatan == "non-pns" ? "selected" : null; ?>>Non PNS</option>
                                <option value="ppnpn" <?= $cariJabatan == "ppnpn" ? "selected" : null; ?>>PPNPN</option>
                                <option value="cpns" <?= $cariJabatan == "cpns" ? "selected" : null; ?>>CPNS</option>
                                <option value="pns" <?= $cariJabatan == "pns" ? "selected" : null; ?>>PNS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-6">
                            <input class="btn btn-dark" type="submit" name="tampilkan" value="Tampilkan">
                            <?php if ($user['email'] == 'adminupttik@polimedia.ac.id') { ?>
                                <input class="btn btn-primary" type="submit" name="tampilkanAdmin" value="Tampilkan Admin">
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <h5 class="h5 text-gray-800">Total Pegawai ( <?= count($datauser); ?> )</h5>

        <div class="row">
            <div class="col-lg">

                <!-- <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('nip', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('jabatan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('unit', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('tmt_awal', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('tmt_akhir', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('golongan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('no_sk', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('tgl_sk', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('jab_fungsi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('agama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('jns_pegawai', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('tmp_lahir', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('jns_kelamin', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('tgl_pensiun', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('pendidikan', '<div class="alert alert-danger" role="alert">', '</div>'); ?> -->

                <?= $this->session->flashdata('message'); ?>

                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <?php if ($user['role_id'] != 1) : ?>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Foto</th>
                                            <!-- <th scope="col">NIP</th> -->
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Unit</th>
                                            <!-- <th scope="col">TMT Awal</th>
                                            <th scope="col">TMT Akhir</th> -->
                                            <th scope="col">Golongan</th>
                                            <!-- <th scope="col">No SK</th>
                                            <th scope="col">Tanggal SK</th>
                                            <th scope="col">Jabatan Fungsional</th>
                                            <th scope="col">Agama</th>
                                            <th scope="col">Jenis Pegawai</th>
                                            <th scope="col">Status Jabatan</th>
                                            <th scope="col">Tempat Lahir</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Pensiun</th>
                                            <th scope="col">Pendidikan</th> -->
                                            <th scope="col">Email</th>
                                            <!-- <th scope="col">Status</th>
                                            <th scope="col">Tanggal Daftar</th>
                                            <th scope="col">Aksi</th> -->
                                        </tr>
                                    <?php elseif ($user['role_id'] == 1) : ?>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">NIP</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">NPWP</th>
                                            <th scope="col">Karpeg</th>
                                            <th scope="col">Karsu</th>
                                            <th scope="col">Akta Nikah</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">TMT CPNS</th>
                                            <th scope="col">TMT PNS</th>
                                            <th scope="col">Golongan</th>
                                            <th scope="col">No SK</th>
                                            <th scope="col">Tanggal SK</th>
                                            <th scope="col">Jabatan Fungsional</th>
                                            <th scope="col">Agama</th>
                                            <th scope="col">Jenis Pegawai</th>
                                            <th scope="col">Status Jabatan</th>
                                            <th scope="col">Tempat Lahir</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Pensiun</th>
                                            <th scope="col">Pendidikan</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <!-- <th scope="col">Tanggal Daftar</th> -->
                                            <th scope="col">Aksi</th>
                                            <?php if (($user['email'] == 'adminupttik@polimedia.ac.id') and empty($tampilkanAdm)) { ?>
                                                <th scope="col">Aksi Admin
                                                </th>
                                            <?php } ?>
                                        </tr>
                                    <?php endif; ?>


                                </thead>
                                <tbody>


                                    <?php if ($user['role_id'] != 1) : ?>
                                        <?php $i = 1;
                                        foreach ($datauser as $du) : ?>
                                            <tr>
                                                <th scope="row" class="text-center" style="vertical-align:middle"><?= $i++; ?></th>
                                                <td style="vertical-align:middle"><img src="<?= base_url('assets/img/profile/') . $du['foto']; ?>" alt="<?= $du['name']; ?>" width="70px"></td>
                                                <!-- <td style="vertical-align:middle"><?= $du['nip']; ?></td> -->
                                                <td style="vertical-align:middle"><?= $du['nama']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['jabatan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['unit']; ?></td>
                                                <!-- <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tmt_awal"])); ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tmt_akhir"])); ?></td> -->
                                                <td style="vertical-align:middle" class="text-center"><?= $du['gol']; ?></td>
                                                <!-- <td style="vertical-align:middle" class="text-center"><?= $du['no_sk']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tgl_sk"])); ?></td>
                                                <td style="vertical-align:middle"><?= $du['jabatan_fungsional']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['agama']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['jenis_pegawai']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['status_jabatan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['tmp_lahir']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tgl_lahir"])); ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['jk']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["pensiun"])); ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['pendidikan']; ?></td> -->
                                                <td style="vertical-align:middle"><?= $du['email']; ?></td>
                                                <!-- <?php if ($du['is_active'] == 0) : ?>
                                                    <td class="text-center" style="vertical-align:middle">Tidak Aktif</td>
                                                <?php elseif ($du['is_active'] == 1) : ?>
                                                    <td class="text-center" style="vertical-align:middle">Aktif</td>
                                                <?php endif; ?>
                                                <td class="text-center" style="vertical-align:middle"><?= date('d F Y', $du['date_created']); ?></td> -->


                                            </tr>
                                        <?php endforeach; ?>
                                    <?php elseif ($user['role_id'] == 1) : ?>
                                        <?php $i = 1;
                                        foreach ($datauser as $du) : ?>
                                            <tr>
                                                <th scope="row" class="text-center" style="vertical-align:middle"><?= $i++; ?></th>
                                                <td style="vertical-align:middle"><img src="<?= base_url('assets/img/profile/') . $du['foto']; ?>" alt="<?= $du['name']; ?>" width="70px"></td>
                                                <td style="vertical-align:middle"><?= $du['nip']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nik']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['npwp']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['karpeg']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['karsu']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['akta_nikah']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['hp']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nama']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['jabatan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['unit']; ?></td>

                                                <?php if ($du["tmt_cpns"] == 0000 - 00 - 00) : ?>
                                                    <td style="vertical-align:middle" class="text-center"> - </td>
                                                <?php else : ?>
                                                    <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tmt_cpns"])); ?></td>
                                                <?php endif; ?>

                                                <?php if ($du["tmt_pns"] == 0000 - 00 - 00) : ?>
                                                    <td style="vertical-align:middle" class="text-center"> - </td>
                                                <?php else : ?>
                                                    <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tmt_pns"])); ?></td>
                                                <?php endif; ?>

                                                <td style="vertical-align:middle" class="text-center"><?= $du['gol']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['no_sk']; ?></td>

                                                <?php if ($du["tgl_sk"] == 0000 - 00 - 00) : ?>
                                                    <td style="vertical-align:middle" class="text-center"> - </td>
                                                <?php else : ?>
                                                    <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tgl_sk"])); ?></td>
                                                <?php endif; ?>

                                                <td style="vertical-align:middle"><?= $du['jabatan_fungsional']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['agama']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['jenis_pegawai']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['status_jabatan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['tmp_lahir']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tgl_lahir"])); ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['jk']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["pensiun"])); ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['pendidikan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['email']; ?></td>
                                                <?php if ($du['is_active'] == 0) : ?>
                                                    <td class="text-center" style="vertical-align:middle">Tidak Aktif</td>
                                                <?php elseif ($du['is_active'] == 1) : ?>
                                                    <td class="text-center" style="vertical-align:middle">Aktif</td>
                                                <?php endif; ?>
                                                <!-- <td class="text-center" style="vertical-align:middle"><?= date('d F Y', $du['date_created']); ?></td> -->


                                                <td class="text-center" style="vertical-align:middle">

                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <?php if ($du['is_active'] == 0) : ?>
                                                            <a class="btn btn-primary" href="<?= base_url('pegawai/aktifkan/') . $du['id_peg']; ?>"><i class="fas fa-check-circle"></i> Aktifkan</a>
                                                        <?php elseif ($du['is_active'] == 1) : ?>
                                                            <a class="btn btn-secondary" href="<?= base_url('pegawai/nonAktifkan/') . $du['id_peg']; ?>"><i class="fas fa-times-circle"></i> Nonaktif</a>
                                                        <?php endif; ?>

                                                        <a class="btn btn-warning" href="<?= base_url('pegawai/pensiunPegawai/') . $du['id_peg']; ?>"><i class="fas fa-user-slash"></i> Pensiun</a>

                                                        <a class="btn btn-info" href="<?= base_url('pegawai/lihatDetail/') . $du['id_peg']; ?>"><i class="fas fa-eye"></i> Detail</a>

                                                        <a class="btn btn-success" href="<?= base_url('pegawai/ubah/') . $du['id_peg']; ?>"><i class="fas fa-edit"></i> Ubah</a>

                                                        <?php if ($du['id_peg'] != 20) { ?>
                                                            <a class="btn btn-danger" href="<?= base_url('pegawai/hapus/') . $du['id_peg']; ?>" onclick="return confirm('Anda yakin menghapus data ini?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                                        <?php } ?>

                                                    </div>
                                                </td>

                                                <?php if (($user['email'] == 'adminupttik@polimedia.ac.id') and ($du['role_id'] != 1)) { ?>
                                                    <td class="text-center" style="vertical-align:middle">
                                                        <a class="btn btn-dark btn-sm" href="<?= base_url('pegawai/jadikanAdmin/') . $du['id_peg']; ?>"><i class="fas fa-user-shield"></i>Jadikan Admin</a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- model -->
    <div class="modal fade" id="newDataUser" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRoleModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form action="<?= base_url('admin/dataUser'); ?>" method="post"> -->
                <?php echo form_open_multipart(''); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-3">Foto</div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/default.jpg') ?>" class="img-thumbnail img-preview">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                        <label class="custom-file-label" for="foto">Pilih foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('nama') ? ' is-invalid' : null ?>" id="nama" placeholder="Masukkan Nama" name="nama" autocomplete="off" value="<?= set_value('nama'); ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('nip') ? ' is-invalid' : null ?>" id="nip" placeholder="Masukkan NIP" name="nip" autocomplete="off" value="<?= set_value('nip'); ?>">
                            <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('email') ? ' is-invalid' : null ?>" id="email" placeholder="Masukkan E-mail" name="email" autocomplete="off" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <!-- <div class="form-group row mt-2">
                        <label for="password1" class="col-sm-3 col-form-label">Kata Sandi</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control<?= form_error('password1') ? ' is-invalid' : null ?>" id="password1" placeholder="Masukkan Kata Sandi" name="password1" autocomplete="off">
                            <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="password2" class="col-sm-3 col-form-label">Konfirmasi</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control<?= form_error('password2') ? ' is-invalid' : null ?>" id="password2" placeholder="Konfirmasi Kata Sandi" name="password2" autocomplete="off">
                            <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <label for="customFile" class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file">
                                <label class="custom-file-label" for="customFile">Masukkan Foto</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group row mt-2">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jabatan') ? ' is-invalid' : null ?>" id="jabatan" placeholder="Masukkan jabatan" name="jabatan" autocomplete="off" value="<?= set_value('jabatan'); ?>">
                            <?= form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                        <div class="col-sm-9">
                            <select class="form-control <?= form_error('unit') ? 'is-invalid' : null ?>" id="unit" name="unit">
                                <option value="">-- Pilih --</option>
                                <option value="BUK">BUK</option>
                                <option value="BAKPK">BAKPK</option>
                                <option value="Teknik Grafika">Teknik Grafika</option>
                                <option value="Desain">Desain</option>
                                <option value="Penerbitan">Penerbitan</option>
                                <option value="Pariwisata">Pariwisata</option>
                                <option value="P3M">P3M</option>
                                <option value="P4MP">P4MP</option>
                                <option value="PSDKU">PSDKU</option>
                                <option value="UPT TIK">UPT TIK</option>
                                <option value="UPT Perpustakaan">UPT Perpustakaan</option>
                                <option value="UPT Desain dan Periklanan">UPT Desain dan Periklanan</option>
                                <option value="UPT Percetakan dan Penerbitan">UPT Percetakan dan Penerbitan</option>
                            </select>
                            <?= form_error('unit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_awal" class="col-sm-3 col-form-label">TMT Awal</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_awal') ? ' is-invalid' : null ?>" id="tmt_awal" name="tmt_awal" value="<?= set_value('tmt_awal'); ?>">
                            <?= form_error('tmt_awal', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_akhir" class="col-sm-3 col-form-label">TMT Akhir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_akhir') ? ' is-invalid' : null ?>" id="tmt_akhir" name="tmt_akhir" value="<?= set_value('tmt_akhir'); ?>">
                            <?= form_error('tmt_akhir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="golongan" class="col-sm-3 col-form-label">Golongan</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('golongan') ? ' is-invalid' : null ?>" id="golongan" name="golongan">
                                <option value="" class="text-secondary">-- Pilih Golongan --</option>
                                <option disabled class="text-secondary">Golongan I (Juru)</option>
                                <option value="I/A">I/A</option>
                                <option value="I/B">I/B</option>
                                <option value="I/C">I/C</option>
                                <option value="I/D">I/D</option>
                                <option disabled class="text-secondary">Golongan II (Pengatur)</option>
                                <option value="II/A">II/A</option>
                                <option value="II/B">II/B</option>
                                <option value="II/C">II/C</option>
                                <option value="II/D">II/D</option>
                                <option disabled class="text-secondary">Golongan III (Penata)</option>
                                <option value="III/A">III/A</option>
                                <option value="III/B">III/B</option>
                                <option value="III/C">III/C</option>
                                <option value="III/D">III/D</option>
                                <option disabled class="text-secondary">Golongan IV (Pembina)</option>
                                <option value="IV/A">IV/A</option>
                                <option value="IV/B">IV/B</option>
                                <option value="IV/C">IV/C</option>
                                <option value="IV/D">IV/D</option>
                                <option value="IV/E">IV/E</option>
                            </select>
                            <?= form_error('golongan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="no_sk" class="col-sm-3 col-form-label">No SK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('no_sk') ? ' is-invalid' : null ?>" id="no_sk" placeholder="Masukkan No SK" name="no_sk" autocomplete="off" value="<?= set_value('no_sk'); ?>">
                            <?= form_error('no_sk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_sk" class="col-sm-3 col-form-label">Tanggal SK</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control <?= form_error('tgl_sk') ? 'is-invalid' : null ?>" id="tgl_sk" name="tgl_sk" value="<?= set_value('tgl_sk'); ?>">
                            <?= form_error('tgl_sk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jab_fungsi" class="col-sm-3 col-form-label">Jab. Fungsi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jab_fungsi') ? ' is-invalid' : null ?>" id="jab_fungsi" placeholder="Masukkan Jabatan Fungsi" name="jab_fungsi" autocomplete="off" value="<?= set_value('jab_fungsi'); ?>">
                            <?= form_error('jab_fungsi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('agama') ? ' is-invalid' : null ?>" id="agama" name="agama">
                                <option value="" class="text-secondary">-- Pilih Agama --</option>
                                <option value="islam">Islam</option>
                                <option value="protestan">Protestan</option>
                                <option value="katolik">Katolik</option>
                                <option value="budha">Budha</option>
                                <option value="hindu">Hindu</option>
                                <option value="konghucu">Konghucu</option>
                            </select>
                            <?= form_error('agama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jns_pegawai" class="col-sm-3 col-form-label">Jns. Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jns_pegawai') ? ' is-invalid' : null ?>" id="jns_pegawai" placeholder="Masukkan Jenis Pegawai" name="jns_pegawai" autocomplete="off" value="<?= set_value('jns_pegawai'); ?>">
                            <?= form_error('jns_pegawai', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_jabatan" class="col-sm-3 col-form-label">Status Jabatan</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('status_jabatan') ? ' is-invalid' : null ?>" id="status_jabatan" name="status_jabatan">
                                <option value="" class="text-secondary">-- Pilih --</option>
                                <option value="non-pns">Non PNS</option>
                                <option value="ppnpn">PPNPN</option>
                                <option value="cpns">CPNS</option>
                                <option value="pns">PNS</option>
                            </select>
                            <?= form_error('status_jabatan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="tmp_lahir" class="col-sm-3 col-form-label">Tmp. Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('tmp_lahir') ? ' is-invalid' : null ?>" id="tmp_lahir" placeholder="Masukkan Tempat Lahir" name="tmp_lahir" autocomplete="off" value="<?= set_value('tmp_lahir'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control <?= form_error('tgl_lahir') ? 'is-invalid' : null ?>" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>">
                            <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jns_kelamin" class="col-sm-3 col-form-label">Jns. Kelamin</label>
                        <div class="col-sm-9 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="jns_kelamin" class="custom-control-input<?= form_error('jns_kelamin') ? ' is-invalid' : null ?>" value="Laki-laki">
                                <label class="custom-control-label" for="customRadioInline1">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="jns_kelamin" class="custom-control-input<?= form_error('jns_kelamin') ? ' is-invalid' : null ?>" value="Perempuan">
                                <label class="custom-control-label" for="customRadioInline2">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_pensiun" class="col-sm-3 col-form-label">Pensiun</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tgl_pensiun') ? ' is-invalid' : null ?>" id="tgl_pensiun" name="tgl_pensiun" value="<?= set_value('tgl_pensiun'); ?>">
                            <?= form_error('tgl_pensiun', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('pendidikan') ? ' is-invalid' : null ?>" id="pendidikan" placeholder="Masukkan Pendidikan" name="pendidikan" autocomplete="off">
                            <?= form_error('pendidikan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>