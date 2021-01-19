    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <!-- <h5 class="h5 text-gray-800">Total Ulang Tahun ( <?= count($ulangTahun); ?> )</h5> -->

        <div class="row">
            <div class="col-lg">

                <?= $this->session->flashdata('message'); ?>

                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($ulangTahun as $du) : ?>
                                        <?php
                                        $pecah = explode("-", $du['tgl_lahir']); //pecah string menjadi array
                                        $tgl_skrg = date("d"); //menampilkan hari saat ini
                                        $bln_skrg = date("m"); //menampilkan bulan saat ini
                                        if (($bln_skrg == $pecah[1]) && ($tgl_skrg == $pecah[2])) :
                                        ?>
                                            <tr class="text-center">
                                                <th scope="row" class="text-center" style="vertical-align:middle"><?= $i++; ?></th>
                                                <td style="vertical-align:middle"><img src="<?= base_url('assets/img/profile/') . $du['foto']; ?>" alt="<?= $du['nama']; ?>" width="70px"></td>
                                                <td style="vertical-align:middle"><?= $du['nama']; ?></td>
                                                <td style="vertical-align:middle"><?= date('d F Y', strtotime($du["tgl_lahir"])); ?></td>
                                                <td style="vertical-align:middle"><?= $du['unit']; ?></td>

                                            </tr>
                                    <?php
                                        endif;
                                    endforeach; ?>
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