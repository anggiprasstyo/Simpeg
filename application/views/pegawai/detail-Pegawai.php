<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Pegawai</h1>

    <!-- <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div> -->

    <div class="card mb-3 col-lg shadow">
        <div class="row no-gutters">
            <div class="col-md-2 mt-3">
                <img src="<?= base_url('assets/img/profile/') . $detail['foto']; ?>" class="card-img">
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <h5 class="card-title text-dark">
                        <b><?= $detail['nama']; ?></b>
                    </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-dark"><b>NIK : <?= $detail['nik']; ?></b></li>
                        <li class="list-group-item text-dark"><b>NIP : <?= $detail['nip']; ?></b></li>
                        <li class="list-group-item text-dark"><b>NPWP : <?= $detail['npwp']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Karpeg : <?= $detail['karpeg']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Karsu : <?= $detail['karsu']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Akta Nikah : <?= $detail['akta_nikah']; ?></b></li>
                        <li class="list-group-item text-dark"><b>No HP : <?= $detail['hp']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Jabatan : <?= $detail['jabatan']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Unit : <?= $detail['unit']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Agama : <?= $detail['agama']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Jenis Kelamin : <?= $detail['jk']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Alamat : <?= $detail['alamat'] . ", Desa " . $detail['namadesa'] . ", kecamatan " . $detail['namakec'] . ", Kabupaten " . $detail['namakab'] . ", Provinsi " . $detail['namaprov']; ?></b></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item text-dark"><b>TTL : <?= $detail['tmp_lahir'] . ", " . date('d F Y', strtotime($detail["tgl_lahir"])); ?></b></li>
                        <li class="list-group-item text-dark"><b>Email : <?= $detail['email']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Pendidikan : <?= $detail['pendidikan']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Status Jabatan : <?= $detail['status_jabatan']; ?></b></li>

                        <?php if ($detail["tmt_cpns"] == 0000 - 00 - 00) : ?>
                            <li class="list-group-item text-dark"><b>TMT CPNS : - </b></li>
                        <?php else : ?>
                            <li class="list-group-item text-dark"><b>TMT CPNS : <?= date('d F Y', strtotime($detail["tmt_cpns"])); ?></b></li>
                        <?php endif; ?>

                        <?php if ($detail["tmt_pns"] == 0000 - 00 - 00) : ?>
                            <li class="list-group-item text-dark"><b>TMT PNS : - </b></li>
                        <?php else : ?>
                            <li class="list-group-item text-dark"><b>TMT PNS : <?= date('d F Y', strtotime($detail["tmt_pns"])); ?></b></li>
                        <?php endif; ?>

                        <li class="list-group-item text-dark"><b>Golongan : <?= $detail['gol']; ?></b></li>
                        <li class="list-group-item text-dark"><b>NO SK : <?= $detail['no_sk']; ?></b></li>

                        <?php if ($detail["tgl_sk"] == 0000 - 00 - 00) : ?>
                            <li class="list-group-item text-dark"><b>Tanggal SK : - </b></li>
                        <?php else : ?>
                            <li class="list-group-item text-dark"><b>Tanggal SK : <?= date('d F Y', strtotime($detail["tgl_sk"])); ?></b></li>
                        <?php endif; ?>

                        <li class="list-group-item text-dark"><b>Jabatan Fungsi : <?= $detail['jabatan_fungsional']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Jenis Pegawai : <?= $detail['jenis_pegawai']; ?></b></li>
                        <li class="list-group-item text-dark"><b>Pensiun : <?= date('d F Y', strtotime($detail["pensiun"])); ?></b></li>
                    </ul>
                    <div class="card-footer">
                        <a href="<?= base_url('pegawai/resetPassword/') . $detail['id_peg']; ?>" class="btn btn-danger">Reset Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->