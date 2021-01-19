    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $prodi['id_progstudi']; ?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="jurusan">Nama Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php foreach ($jurusan as $j) : ?>
                                <option value="<?= $j['id_jurusan']; ?>" <?= $j['id_jurusan'] == $prodi['id_jur'] ? "selected" : null ?>><?= $j['nama_jurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('jurusan'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama_prodi">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" class="form-control" id="nama_prodi" placeholder="Nama Program Studi" value="<?= $prodi['nama_prog_studi']; ?>">
                        <small class="form-text text-danger"><?= form_error('nama_prodi'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="edit"><i class="fas fa-save"></i> Simpan</button>
                    <a href="<?= base_url('admin/prodi'); ?>" class="btn btn-success float-left"><i class="fas fa-arrow-alt-circle-left"></i> Batal</a>
                </div>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->