<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['nip']; ?></p>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <?php
                    if ($user['id_jabatan'] == 1) :
                        $dataUser = $this->db->get_where('pegawai', ['id_peg' => $user['id_pegawai']])->row_array(); ?>
                        <!-- <h5 class="card-title"><?= $dataUser['name']; ?></h5> -->

                        <?php if ($dataUser) : ?>
                            <p class="card-text"><?= $dataUser['pendidikan']; ?></p>
                            <p class="card-text"><?= $dataUser['status_jabatan']; ?></p>
                            <p class="card-text"><?= date('d F Y', strtotime($dataUser['pensiun'])); ?></p>
                        <?php endif; ?>

                    <?php elseif ($user['id_jabatan'] == 2) :
                        $dataUser = $this->db->get_where('dosen', ['id_dosen' => $user['id_pegawai']])->row_array(); ?>

                        <?php if ($dataUser) : ?>
                            <p class="card-text"><?= $dataUser['pendidikan']; ?></p>
                            <p class="card-text"><?= $dataUser['status_jabatan']; ?></p>
                            <p class="card-text"><?= date('d F Y', strtotime($dataUser['pensiun'])); ?></p>
                        <?php endif; ?>

                    <?php endif; ?>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->