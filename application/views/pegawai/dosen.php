    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDataUser"><i class="fas fa-user-plus"></i> Tambah Dosen</a> -->
        <?php if ($user['role_id'] == 1) : ?>
            <a href="<?= base_url('pegawai/tambahDosen'); ?>" class="btn btn-dark mb-3"><i class="fas fa-user-plus"></i> Tambah Dosen</a>
        <?php endif; ?>

        <div class="card mb-4">
            <h5 class="card-header bg-secondary text-white">Filter Data</h5>
            <div class="card-body">
                <form action="<?= base_url('pegawai/dosen'); ?>" method="POST">
                    <div class="form-group row">
                        <label for="pilihJurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-6">
                            <select class="custom-select<?= form_error('jurusan') ? ' is-invalid' : null ?>" id="pilihJurusan" name="jurusan">
                                <option value="" class="text-secondary" <?= $cariJurusan == "" ? "selected" : null; ?>>-- All --</option>
                                <?php foreach ($jurusan as $jur) : ?>
                                    <option value="<?= $jur['id_jurusan'] ?>" <?= $cariJurusan == $jur['id_jurusan'] ? "selected" : null; ?>><?= $jur['nama_jurusan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('jurusan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pilih_Progstudi" class="col-sm-2 col-form-label">Prog.Studi</label>
                        <div class="col-sm-6">
                            <select class="custom-select<?= form_error('prog_studi') ? ' is-invalid' : null ?>" id="pilih_Progstudi" name="prog_studi">
                                <option value="" class="text-secondary" <?= $cariProgstudi == "" ? "selected" : null; ?>>-- All --</option>
                                <?php if ($cariJurusan !== "") : ?>
                                    <?php $prodi = $this->db->get_where('prog_studi', ['id_jur' => $cariJurusan])->result_array(); ?>
                                    <?php foreach ($prodi as $p) : ?>
                                        <option value="<?= $p['id_progstudi'] ?>" <?= $cariProgstudi == $p['id_progstudi'] ? "selected" : null; ?>><?= $p['nama_prog_studi'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?= form_error('prog_studi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="search_status_jabatan" class="col-sm-2 col-form-label">Status Jabatan</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="search_status_jabatan" name="search_status_jabatan">
                                <option value="" class="text-secondary" <?= $cariStatusJab == "" ? "selected" : null; ?>>-- All --</option>
                                <option value="non-pns" <?= $cariStatusJab == "non-pns" ? "selected" : null; ?>>Non PNS</option>
                                <option value="ppnpn" <?= $cariStatusJab == "ppnpn" ? "selected" : null; ?>>PPNPN</option>
                                <option value="cpns" <?= $cariStatusJab == "cpns" ? "selected" : null; ?>>CPNS</option>
                                <option value="pns" <?= $cariStatusJab == "pns" ? "selected" : null; ?>>PNS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-6">
                            <input class="btn btn-dark" type="submit" name="tampilkan" value="Tampilkan">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <h5 class="h5 text-gray-800">Total Dosen ( <?= count($datauser); ?> )</h5>

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
                                            <th scope="col">NIP</th>
                                            <th scope="col">NIDN</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Pendidikan</th>
                                            <th scope="col">Jabatan Fungsi</th>
                                            <!-- <th scope="col">TMT Jabatan Fungsi</th> -->
                                            <th scope="col">Golongan</th>
                                            <!-- <th scope="col">TMT Golongan</th> -->
                                            <th scope="col">Unit</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Program Studi</th>
                                            <!-- <th scope="col">Tempat Lahir</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Pensiun</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Agama</th> -->
                                            <th scope="col">Jabatan Struktural</th>
                                            <!-- <th scope="col">TMT Jabatan Struktural</th>
                                            <th scope="col">TMT CPNS</th>
                                            <th scope="col">TMT PNS</th>
                                            <th scope="col">Status Jabatan</th> -->
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
                                            <th scope="col">NIDN</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Pendidikan</th>
                                            <th scope="col">Jabatan Fungsi</th>
                                            <th scope="col">TMT Jabatan Fungsi</th>
                                            <th scope="col">Golongan</th>
                                            <th scope="col">TMT Golongan</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Program Studi</th>
                                            <th scope="col">Tempat Lahir</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Pensiun</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Agama</th>
                                            <th scope="col">Jabatan Struktural</th>
                                            <th scope="col">TMT Jabatan Struktural</th>
                                            <th scope="col">TMT CPNS</th>
                                            <th scope="col">TMT PNS</th>
                                            <th scope="col">Status Jabatan</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <!-- <th scope="col">Tanggal Daftar</th> -->
                                            <th scope="col">Aksi</th>
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
                                                <td style="vertical-align:middle"><?= $du['nip']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nidn']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nama']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['pendidikan']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['jabatan_fungsi']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['gol']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['unit']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nama_jurusan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nama_prog_studi']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['jab_struktural']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['email']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>


                                    <?php elseif ($user['role_id'] == 1) : ?>
                                        <?php $i = 1;
                                        foreach ($datauser as $du) : ?>
                                            <tr>
                                                <th scope="row" class="text-center" style="vertical-align:middle"><?= $i++; ?></th>
                                                <td style="vertical-align:middle"><img src="<?= base_url('assets/img/profile/') . $du['foto']; ?>" alt="<?= $du['name']; ?>" width="70px"></td>
                                                <td style="vertical-align:middle"><?= $du['nip']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nidn']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nama']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['pendidikan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['jabatan_fungsi']; ?></td>

                                                <?php if ($du["tmt_jab_fungsi"] == 0000 - 00 - 00) : ?>
                                                    <td style="vertical-align:middle" class="text-center"> - </td>
                                                <?php else : ?>
                                                    <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tmt_jab_fungsi"])); ?></td>
                                                <?php endif; ?>

                                                <td style="vertical-align:middle"><?= $du['gol']; ?></td>

                                                <?php if ($du['tmt_golongan'] == 0000 - 00 - 00) : ?>
                                                    <td style="vertical-align:middle" class="text-center"> - </td>
                                                <?php else : ?>
                                                    <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tmt_golongan"])); ?></td>
                                                <?php endif; ?>

                                                <td style="vertical-align:middle"><?= $du['unit']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nama_jurusan']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['nama_prog_studi']; ?></td>
                                                <td style="vertical-align:middle"><?= $du['tmp_lahir']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tgl_lahir"])); ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["pensiun"])); ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['jk']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['agama']; ?></td>
                                                <td style="vertical-align:middle" class="text-center"><?= $du['jab_struktural']; ?></td>


                                                <?php if ($du["tmt_jab_struk"] == 0000 - 00 - 00) : ?>
                                                    <td style="vertical-align:middle" class="text-center"> - </td>
                                                <?php else : ?>
                                                    <td style="vertical-align:middle" class="text-center"><?= date('d F Y', strtotime($du["tmt_jab_struk"])); ?></td>
                                                <?php endif; ?>

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

                                                <td style="vertical-align:middle"><?= $du['status_jabatan']; ?></td>
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
                                                            <a class="btn btn-primary" href="<?= base_url('pegawai/aktifkanDosen/') . $du['id_dosen']; ?>"><i class="fas fa-check-circle"></i> Aktifkan</a>
                                                        <?php elseif ($du['is_active'] == 1) : ?>
                                                            <a class="btn btn-secondary" href="<?= base_url('pegawai/nonAktifkanDosen/') . $du['id_dosen']; ?>"><i class="fas fa-times-circle"></i> Nonaktif</a>
                                                        <?php endif; ?>

                                                        <a class="btn btn-warning" href="<?= base_url('pegawai/pensiunDosen/') . $du['id_dosen']; ?>"><i class="fas fa-user-slash"></i> Pensiun</a>

                                                        <a class="btn btn-info" href="<?= base_url('pegawai/lihatDetailDosen/') . $du['id_dosen']; ?>"><i class="fas fa-eye"></i> Detail</a>

                                                        <a class="btn btn-success" href="<?= base_url('pegawai/ubahDosen/') . $du['id_dosen']; ?>"><i class="fas fa-edit"></i> Ubah</a>

                                                        <a class="btn btn-danger" href="<?= base_url('pegawai/hapusDosen/') . $du['id_dosen']; ?>" onclick="return confirm('Anda yakin menghapus data ini?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                                    </div>
                                                </td>
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
    <!-- <div class="modal fade" id="newDataUser" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRoleModalLabel">Tambah Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                        <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('nidn') ? ' is-invalid' : null ?>" id="nidn" placeholder="Masukkan NIDN" name="nidn" autocomplete="off" value="<?= set_value('nidn'); ?>">
                            <?= form_error('nidn', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('email') ? ' is-invalid' : null ?>" id="email" placeholder="Masukkan E-mail" name="email" autocomplete="off" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div> -->
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
    <!-- <div class="form-group row mt-2">
                        <label for="jabatanFungsi" class="col-sm-3 col-form-label">Jab. Fungsi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jabatanFungsi') ? ' is-invalid' : null ?>" id="jabatanFungsi" placeholder="Masukkan jabatan fungsi" name="jabatanFungsi" autocomplete="off" value="<?= set_value('jabatanFungsi'); ?>">
                            <?= form_error('jabatanFungsi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_jabfung" class="col-sm-3 col-form-label">TMT Jabfung</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_jabfung') ? ' is-invalid' : null ?>" id="tmt_jabfung" name="tmt_jabfung" value="<?= set_value('tmt_jabfung'); ?>">
                            <?= form_error('tmt_jabfung', '<small class="text-danger">', '</small>'); ?>
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
                    <div class="form-group row">
                        <label for="tmt_golongan" class="col-sm-3 col-form-label">TMT Gol</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_golongan') ? ' is-invalid' : null ?>" id="tmt_golongan" name="tmt_golongan" value="<?= set_value('tmt_golongan'); ?>">
                            <?= form_error('tmt_golongan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_jabatan" class="col-sm-3 col-form-label">Status Jabatan</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('status_jabatan') ? ' is-invalid' : null ?>" id="status_jabatan" name="status_jabatan">
                                <option value="" class="text-secondary">-- Pilih --</option>
                                <option value="non-pns">Non PNS</option>
                                <option value="cpns">CPNS</option>
                                <option value="pns">PNS</option>
                            </select>
                            <?= form_error('status_jabatan', '<small class="text-danger">', '</small>'); ?>
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
                        <label for="pilihJurusan" class="col-sm-3 col-form-label">Jurusan</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('jurusan') ? ' is-invalid' : null ?>" id="pilihJurusan" name="jurusan">
                                <option value="" class="text-secondary">-- Pilih Jurusan --</option>
                                <?php foreach ($jurusan as $jur) : ?>
                                    <option value="<?= $jur['id_jurusan'] ?>"><?= $jur['nama_jurusan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('jurusan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pilih_Progstudi" class="col-sm-3 col-form-label">Prog.Studi</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('prog_studi') ? ' is-invalid' : null ?>" id="pilih_Progstudi" name="prog_studi">
                                <option value="" class="text-secondary">-- Pilih Program Studi --</option>
                            </select>
                            <?= form_error('prog_studi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div> -->
    <!-- <div class="form-group row">
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
                    </div> -->
    <!-- <div class="form-group row">
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
                    </div> -->
    <!-- <div class="form-group row mt-2">
                        <label for="jns_pegawai" class="col-sm-3 col-form-label">Jns. Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jns_pegawai') ? ' is-invalid' : null ?>" id="jns_pegawai" placeholder="Masukkan Jenis Pegawai" name="jns_pegawai" autocomplete="off" value="<?= set_value('jns_pegawai'); ?>">
                            <?= form_error('jns_pegawai', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div> -->
    <!-- <div class="form-group row mt-2">
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
                    </div> -->
    <!-- <div class="form-group row">
                        <label for="tgl_pensiun" class="col-sm-3 col-form-label">Pensiun</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tgl_pensiun') ? ' is-invalid' : null ?>" id="tgl_pensiun" name="tgl_pensiun" value="<?= set_value('tgl_pensiun'); ?>">
                            <?= form_error('tgl_pensiun', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('pendidikan') ? ' is-invalid' : null ?>" id="pendidikan" placeholder="Masukkan Pendidikan" name="pendidikan" autocomplete="off" value="<?= set_value('pendidikan'); ?>">
                            <?= form_error('pendidikan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jab_struktural" class="col-sm-3 col-form-label">Jab. Struktural</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jab_struktural') ? ' is-invalid' : null ?>" id="jab_struktural" placeholder="Masukkan Jab. Struktural" name="jab_struktural" autocomplete="off" value="<?= set_value('jab_struktural'); ?>">
                            <?= form_error('jab_struktural', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_jab_struktural" class="col-sm-3 col-form-label">TMT Jab. Struktural</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_jab_struktural') ? ' is-invalid' : null ?>" id="tmt_jab_struktural" name="tmt_jab_struktural" value="<?= set_value('tmt_jab_struktural'); ?>">
                            <?= form_error('tmt_jab_struktural', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_cpns" class="col-sm-3 col-form-label">TMT CPNS</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_cpns') ? ' is-invalid' : null ?>" id="tmt_cpns" name="tmt_cpns" value="<?= set_value('tmt_cpns'); ?>">
                            <?= form_error('tmt_cpns', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_pns" class="col-sm-3 col-form-label">TMT PNS</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_pns') ? ' is-invalid' : null ?>" id="tmt_pns" name="tmt_pns" value="<?= set_value('tmt_pns'); ?>">
                            <?= form_error('tmt_pns', '<small class="text-danger">', '</small>'); ?>
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
    </div> -->