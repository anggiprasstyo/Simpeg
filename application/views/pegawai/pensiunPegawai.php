<!-- <div class="container-fluid">
    <div class="alert alert-dark" role="alert">
        <h3 class="h3 text-gray-800"><?= $title; ?></h3>
    </div>
</div> -->

<!-- <div class="jumbotron jumbotron-fluid bg-light"> -->
<div class="container col-md-8">
    <div class="card shadow">
        <div class="card-header bg-primary text-light text-center">
            Pensiun Pegawai
        </div>
        <div class="row no-gutters">
            <div class="col-lg">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <?php echo form_open_multipart(''); ?>
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
                                    <input type="hidden" name="foto" value="<?= $datauser['foto']; ?>">
                                </div>
                                <!-- <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                        <label class="custom-file-label" for="foto">Pilih foto jika ingin diubah</label>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('nama') ? ' is-invalid' : null ?>" id="nama" placeholder="Masukkan Nama" name="nama" autocomplete="off" value="<?= $datauser['nama']; ?>" readonly>
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('nip') ? ' is-invalid' : null ?>" id="nip" placeholder="Masukkan NIP" name="nip" autocomplete="off" value="<?= $datauser['nip']; ?>" readonly>
                            <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('email') ? ' is-invalid' : null ?>" id="email" placeholder="Masukkan E-mail" name="email" autocomplete="off" value="<?= $datauser['email']; ?>" readonly>
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jabatan') ? ' is-invalid' : null ?>" id="jabatan" placeholder="Masukkan jabatan" name="jabatan" autocomplete="off" value="<?= $datauser['jabatan']; ?>" readonly>
                            <?= form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('unit') ? ' is-invalid' : null ?>" id="unit" placeholder="Masukkan unit" name="unit" autocomplete="off" value="<?= $datauser['unit']; ?>" readonly>
                            <?= form_error('unit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jns_pegawai" class="col-sm-3 col-form-label">Jns. Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= form_error('jns_pegawai') ? ' is-invalid' : null ?>" id="jns_pegawai" placeholder="Masukkan Jenis Pegawai" name="jns_pegawai" autocomplete="off" value="<?= $datauser['jenis_pegawai']; ?>" readonly>
                            <?= form_error('jns_pegawai', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_pensiun" class="col-sm-3 col-form-label">Pensiun</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control<?= form_error('tgl_pensiun') ? ' is-invalid' : null ?>" id="tgl_pensiun" name="tgl_pensiun" value="<?= $datauser['pensiun']; ?>">
                            <?= form_error('tgl_pensiun', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="custom-select<?= form_error('status') ? ' is-invalid' : null ?>" id="status" name="status">
                                <option value="" class="text-secondary">-- Pilih --</option>
                                <option value="pensiun">Pensiun</option>
                                <option value="meninggal">Meninggal</option>
                                <option value="berhenti">Berhenti</option>
                            </select>
                            <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url('pegawai'); ?>" class="btn btn-secondary btn-md btn-block">
                                <i class="fas fa-undo-alt"> Batal</i>
                            </a>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-md btn-block"><i class="fas fa-user-slash"> Pensiunkan</i></button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- </div> -->