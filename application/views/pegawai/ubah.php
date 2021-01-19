<!-- <div class="container-fluid">
    <div class="alert alert-dark" role="alert">
        <h3 class="h3 text-gray-800"><?= $title; ?></h3>
    </div>
</div> -->

<!-- <div class="jumbotron jumbotron-fluid bg-light"> -->
<div class="container col-md-8">
    <div class="card shadow">
        <div class="card-header bg-primary text-light text-center">
            Ubah Data Pegawai
        </div>
        <div class="row no-gutters">
            <div class="col-lg">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <?php echo form_open_multipart(''); ?>

                    <?= csrf() ?>
                    <!-- <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                        <div class="col-sm-7">
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
                    </div> -->
                    <input type="hidden" name="id" value="<?= $datauser['id_peg']; ?>">
                    <div class="form-group row">
                        <div class="col-sm-3">Foto</div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . $datauser['foto']; ?>" class="img-thumbnail img-preview">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                        <label class="custom-file-label" for="foto">Pilih foto jika ingin diubah</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('nama') ? ' is-invalid' : null ?>" id="nama" placeholder="Masukkan Nama" name="nama" autocomplete="off" value="<?= $datauser['nama']; ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>


                    <div class="form-group row mt-2">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control<?= form_error('nik') ? ' is-invalid' : null ?>" id="nik" placeholder="Masukkan NIK" name="nik" autocomplete="off" value="<?= $datauser['nik']; ?>">
                            <?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="npwp" class="col-sm-3 col-form-label">NPWP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control<?= form_error('npwp') ? ' is-invalid' : null ?>" id="npwp" placeholder="Masukkan NPWP" name="npwp" autocomplete="off" value="<?= $datauser['npwp']; ?>">
                            <?= form_error('npwp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="karpeg" class="col-sm-3 col-form-label">Karpeg</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control<?= form_error('karpeg') ? ' is-invalid' : null ?>" id="karpeg" placeholder="Masukkan Karpeg" name="karpeg" autocomplete="off" value="<?= $datauser['karpeg']; ?>">
                            <?= form_error('karpeg', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="karsu" class="col-sm-3 col-form-label">Karsu/Karis</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control<?= form_error('karsu') ? ' is-invalid' : null ?>" id="karsu" placeholder="Masukkan karsu/karis" name="karsu" autocomplete="off" value="<?= $datauser['karsu']; ?>">
                            <?= form_error('karsu', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="akta_nikah" class="col-sm-3 col-form-label">No Akta Nikah</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control<?= form_error('akta_nikah') ? ' is-invalid' : null ?>" id="akta_nikah" placeholder="Masukkan Nomor Akta Nikah" name="akta_nikah" autocomplete="off" value="<?= $datauser['akta_nikah']; ?>">
                            <?= form_error('akta_nikah', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="no_hp" class="col-sm-3 col-form-label">No HP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control<?= form_error('no_hp') ? ' is-invalid' : null ?>" id="no_hp" placeholder="Masukkan Nomor HP" name="no_hp" autocomplete="off" value="<?= $datauser['hp']; ?>">
                            <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>



                    <div class="form-group row mt-2">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('nip') ? ' is-invalid' : null ?>" id="nip" placeholder="Masukkan NIP" name="nip" autocomplete="off" value="<?= $datauser['nip']; ?>">
                            <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('email') ? ' is-invalid' : null ?>" id="email" placeholder="Masukkan E-mail" name="email" autocomplete="off" value="<?= $datauser['email']; ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jabatan') ? ' is-invalid' : null ?>" id="jabatan" placeholder="Masukkan jabatan" name="jabatan" autocomplete="off" value="<?= $datauser['jabatan']; ?>">
                            <?= form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                        <div class="col-sm-9">
                            <select class="form-control <?= form_error('unit') ? 'is-invalid' : null ?>" id="unit" name="unit">

                                <option value="">-- Pilih Unit --</option>
                                <?php foreach ($unit as $u) : ?>
                                    <option value="<?= $u['nama_unit'] ?>" <?= $datauser['unit'] == $u['nama_unit'] ? "selected" : null; ?>><?= $u['nama_unit'] ?></option>
                                <?php endforeach; ?>

                            </select>
                            <?= form_error('unit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_cpns" class="col-sm-3 col-form-label">TMT CPNS</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_cpns') ? ' is-invalid' : null ?>" id="tmt_cpns" name="tmt_cpns" value="<?= $datauser['tmt_cpns']; ?>">
                            <?= form_error('tmt_cpns', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt_pns" class="col-sm-3 col-form-label">TMT PNS</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tmt_pns') ? ' is-invalid' : null ?>" id="tmt_pns" name="tmt_pns" value="<?= $datauser['tmt_pns']; ?>">
                            <?= form_error('tmt_pns', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="golongan" class="col-sm-3 col-form-label">Golongan</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('golongan') ? ' is-invalid' : null ?>" id="golongan" name="golongan">
                                <option value="" class="text-secondary">-- Pilih Golongan --</option>
                                <option disabled class="text-secondary">Golongan I (Juru)</option>
                                <option value="I/A" <?= $datauser['gol'] == "I/A" ? "selected" : null; ?>>I/A</option>
                                <option value="I/B" <?= $datauser['gol'] == "I/B" ? "selected" : null; ?>>I/B</option>
                                <option value="I/C" <?= $datauser['gol'] == "I/C" ? "selected" : null; ?>>I/C</option>
                                <option value="I/D" <?= $datauser['gol'] == "I/D" ? "selected" : null; ?>>I/D</option>
                                <option disabled class="text-secondary">Golongan II (Pengatur)</option>
                                <option value="II/A" <?= $datauser['gol'] == "II/A" ? "selected" : null; ?>>II/A</option>
                                <option value="II/B" <?= $datauser['gol'] == "II/B" ? "selected" : null; ?>>II/B</option>
                                <option value="II/C" <?= $datauser['gol'] == "II/C" ? "selected" : null; ?>>II/C</option>
                                <option value="II/D" <?= $datauser['gol'] == "II/D" ? "selected" : null; ?>>II/D</option>
                                <option disabled class="text-secondary">Golongan III (Penata)</option>
                                <option value="III/A" <?= $datauser['gol'] == "III/A" ? "selected" : null; ?>>III/A</option>
                                <option value="III/B" <?= $datauser['gol'] == "III/B" ? "selected" : null; ?>>III/B</option>
                                <option value="III/C" <?= $datauser['gol'] == "III/C" ? "selected" : null; ?>>III/C</option>
                                <option value="III/D" <?= $datauser['gol'] == "III/D" ? "selected" : null; ?>>III/D</option>
                                <option disabled class="text-secondary">Golongan IV (Pembina)</option>
                                <option value="IV/A" <?= $datauser['gol'] == "IV/A" ? "selected" : null; ?>>IV/A</option>
                                <option value="IV/B" <?= $datauser['gol'] == "IV/B" ? "selected" : null; ?>>IV/B</option>
                                <option value="IV/C" <?= $datauser['gol'] == "IV/C" ? "selected" : null; ?>>IV/C</option>
                                <option value="IV/D" <?= $datauser['gol'] == "IV/D" ? "selected" : null; ?>>IV/D</option>
                                <option value="IV/E" <?= $datauser['gol'] == "IV/E" ? "selected" : null; ?>>IV/E</option>
                            </select>
                            <?= form_error('golongan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="no_sk" class="col-sm-3 col-form-label">No SK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('no_sk') ? ' is-invalid' : null ?>" id="no_sk" placeholder="Masukkan No SK" name="no_sk" autocomplete="off" value="<?= $datauser['no_sk']; ?>">
                            <?= form_error('no_sk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_sk" class="col-sm-3 col-form-label">Tanggal SK</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control <?= form_error('tgl_sk') ? 'is-invalid' : null ?>" id="tgl_sk" name="tgl_sk" value="<?= $datauser['tgl_sk']; ?>">
                            <?= form_error('tgl_sk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jab_fungsi" class="col-sm-3 col-form-label">Jab. Fungsi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jab_fungsi') ? ' is-invalid' : null ?>" id="jab_fungsi" placeholder="Masukkan Jabatan Fungsi" name="jab_fungsi" autocomplete="off" value="<?= $datauser['jabatan_fungsional']; ?>">
                            <?= form_error('jab_fungsi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('agama') ? ' is-invalid' : null ?>" id="agama" name="agama">
                                <option value="" class="text-secondary">-- Pilih Agama --</option>
                                <option value="islam" <?= $datauser['agama'] == "islam" ? "selected" : null; ?>>Islam</option>
                                <option value="protestan" <?= $datauser['agama'] == "protestan" ? "selected" : null; ?>>Protestan</option>
                                <option value="katolik" <?= $datauser['agama'] == "katolik" ? "selected" : null; ?>>Katolik</option>
                                <option value="budha" <?= $datauser['agama'] == "budha" ? "selected" : null; ?>>Budha</option>
                                <option value="hindu" <?= $datauser['agama'] == "hindu" ? "selected" : null; ?>>Hindu</option>
                                <option value="konghucu" <?= $datauser['agama'] == "konghucu" ? "selected" : null; ?>>Konghucu</option>
                            </select>
                            <?= form_error('agama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jns_pegawai" class="col-sm-3 col-form-label">Jns. Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jns_pegawai') ? ' is-invalid' : null ?>" id="jns_pegawai" placeholder="Masukkan Jenis Pegawai" name="jns_pegawai" autocomplete="off" value="<?= $datauser['jenis_pegawai']; ?>">
                            <?= form_error('jns_pegawai', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_jabatan" class="col-sm-3 col-form-label">Status Jabatan</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('status_jabatan') ? ' is-invalid' : null ?>" id="status_jabatan" name="status_jabatan">
                                <option value="" class="text-secondary">-- Pilih --</option>
                                <option value="non-pns" <?= $datauser['status_jabatan'] == "non-pns" ? "selected" : null; ?>>Non PNS</option>
                                <option value="ppnpn" <?= $datauser['status_jabatan'] == "ppnpn" ? "selected" : null; ?>>PPNPN</option>
                                <option value="cpns" <?= $datauser['status_jabatan'] == "cpns" ? "selected" : null; ?>>CPNS</option>
                                <option value="pns" <?= $datauser['status_jabatan'] == "pns" ? "selected" : null; ?>>PNS</option>
                            </select>
                            <?= form_error('status_jabatan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>





                    <div class="form-group row mt-2">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : null ?>" id="alamat" placeholder="Alamat Lengkap" name="alamat" rows="3"><?= $datauser['alamat']; ?></textarea>
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <?php $provById = $this->db->get_where('wilayah_provinsi', ['id' => $datauser['provinsi']])->result_array(); ?>
                    <div class="form-group row mt-2">
                        <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-sm-9">
                            <select class="form-control<?= form_error('provinsi') ? ' is-invalid' : null ?>" id="provinsi" name="provinsi">
                                <option value="">--Pilih Provinsi--</option>
                                <?php foreach ($provinsi as $prov) : ?>
                                    <option value="<?= $prov['id'] ?>" <?= $datauser['provinsi'] == $prov['id'] ? "selected" : null; ?>><?= $prov['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('provinsi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <?php $kabById = $this->db->get_where('wilayah_kabupaten', ['provinsi_id' => $datauser['provinsi']])->result_array(); ?>
                    <div class="form-group row mt-2">
                        <label for="kabupaten" class="col-sm-3 col-form-label">Kabupaten</label>
                        <div class="col-sm-9">
                            <select class="form-control<?= form_error('kabupaten') ? ' is-invalid' : null ?>" id="kabupaten" name="kabupaten">
                                <option value="">--Pilih Kabupaten--</option>
                                <?php foreach ($kabById as $kab) : ?>
                                    <option value="<?= $kab['id']; ?>" <?= $datauser['kabupaten'] == $kab['id'] ? "selected" : null; ?>><?= $kab['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kabupaten', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <?php $kecById = $this->db->get_where('wilayah_kecamatan', ['kabupaten_id' => $datauser['kabupaten']])->result_array(); ?>
                    <div class="form-group row mt-2">
                        <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-sm-9">
                            <select class="form-control<?= form_error('kecamatan') ? ' is-invalid' : null ?>" id="kecamatan" name="kecamatan">
                                <option value="">--Pilih Kecamatan--</option>
                                <?php foreach ($kecById as $kec) : ?>
                                    <option value="<?= $kec['id']; ?>" <?= $datauser['kecamatan'] == $kec['id'] ? "selected" : null; ?>><?= $kec['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kecamatan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <?php $desaById = $this->db->get_where('wilayah_desa', ['kecamatan_id' => $datauser['kecamatan']])->result_array(); ?>
                    <div class="form-group row mt-2">
                        <label for="desa" class="col-sm-3 col-form-label">Desa</label>
                        <div class="col-sm-9">
                            <select class="form-control<?= form_error('desa') ? ' is-invalid' : null ?>" id="desa" name="desa">
                                <option value="">--Pilih Desa/Kota--</option>
                                <?php foreach ($desaById as $desa) : ?>
                                    <option value="<?= $desa['id']; ?>" <?= $datauser['desa'] == $desa['id'] ? "selected" : null; ?>><?= $desa['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('desa', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>






                    <div class="form-group row mt-2">
                        <label for="tmp_lahir" class="col-sm-3 col-form-label">Tmp. Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('tmp_lahir') ? ' is-invalid' : null ?>" id="tmp_lahir" placeholder="Masukkan Tempat Lahir" name="tmp_lahir" autocomplete="off" value="<?= $datauser['tmp_lahir']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control <?= form_error('tgl_lahir') ? 'is-invalid' : null ?>" id="tgl_lahir" name="tgl_lahir" value="<?= $datauser['tgl_lahir']; ?>">
                            <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jns_kelamin" class="col-sm-3 col-form-label">Jns. Kelamin</label>
                        <div class="col-sm-9 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="jns_kelamin" class="custom-control-input<?= form_error('jns_kelamin') ? ' is-invalid' : null ?>" value="Laki-laki" <?= $datauser['jk'] == "Laki-laki" ? "checked" : null; ?>>
                                <label class="custom-control-label" for="customRadioInline1">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="jns_kelamin" class="custom-control-input<?= form_error('jns_kelamin') ? ' is-invalid' : null ?>" value="Perempuan" <?= $datauser['jk'] == "Perempuan" ? "checked" : null; ?>>
                                <label class="custom-control-label" for="customRadioInline2">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_pensiun" class="col-sm-3 col-form-label">Pensiun</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tgl_pensiun') ? ' is-invalid' : null ?>" id="tgl_pensiun" name="tgl_pensiun" value="<?= $datauser['pensiun']; ?>">
                            <?= form_error('tgl_pensiun', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('pendidikan') ? ' is-invalid' : null ?>" id="pendidikan" placeholder="Masukkan Pendidikan" name="pendidikan" autocomplete="off" value="<?= $datauser['pendidikan']; ?>">
                            <?= form_error('pendidikan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url('pegawai'); ?>" class="btn btn-secondary btn-md btn-block">
                                <i class="fas fa-undo-alt"> Batal</i>
                            </a>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-md btn-block"><i class="fas fa-edit"> Ubah</i></button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- </div> -->

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