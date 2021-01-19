<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Program Studi</h1>


    <div class="row">
        <div class="col-lg-10">
            <?= form_error('jurusan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('nama_prodi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal"><i class="far fa-plus-square"></i> Tambah Prodi</a>

            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Nama Prodi</th>
                                    <th scope="col">Nama Jurusan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </tfoot> -->
                            <tbody>
                                <?php $i = 1;
                                foreach ($prodi as $p) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $i++; ?></th>
                                        <td><?= $p['nama_prog_studi']; ?></td>
                                        <td><?= $p['nama_jurusan']; ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-success" href="<?= base_url('admin/editProdi/') . $p['id_progstudi']; ?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger" href="<?= base_url('admin/deleteProdi/') . $p['id_progstudi']; ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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


<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Data Program Studi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/prodi'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php foreach ($jurusan as $j) : ?>
                                <option value="<?= $j['id_jurusan']; ?>"><?= $j['nama_jurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" placeholder="Nama Program Studi" value="<?= set_value('nama_prodi'); ?>">
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