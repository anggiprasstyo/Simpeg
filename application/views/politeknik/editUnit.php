    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $unit['id_unit']; ?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="jurusan">Nama Unit</label>
                        <input type="text" name="unit" class="form-control" id="unit" placeholder="Nama Unit" value="<?= $unit['nama_unit']; ?>">
                        <small class="form-text text-danger"><?= form_error('unit'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="edit"><i class="fas fa-save"></i> Simpan</button>
                    <a href="<?= base_url('admin/unit'); ?>" class="btn btn-success float-left"><i class="fas fa-arrow-alt-circle-left"></i> Batal</a>
                </div>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->