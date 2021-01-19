    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $jurusan['id_jurusan']; ?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="jurusan">Nama Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" id="jurusan" placeholder="Nama Jurusan" value="<?= $jurusan['nama_jurusan']; ?>">
                        <small class="form-text text-danger"><?= form_error('jurusan'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="edit"><i class="fas fa-save"></i> Simpan</button>
                    <a href="<?= base_url('admin/jurusan'); ?>" class="btn btn-success float-left"><i class="fas fa-arrow-alt-circle-left"></i> Batal</a>
                </div>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->