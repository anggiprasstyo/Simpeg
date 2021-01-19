<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['datauser'] = $this->admin->getPegawai();

        $data['unit'] = $this->db->get('unit')->result_array();

        // $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
        //     'required' => 'Nama Lengkap tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[6]|max_length[25]|is_unique[pegawai.nip]', [
        //     'required' => 'NIP tidak boleh kosong!',
        //     'is_unique' => 'NIP ini sudah terdaftar!',
        //     'min_length' => 'NIP terlalu pendek!',
        //     'max_length' => 'NIP terlalu panjang!',
        //     'numeric' => 'NIP tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[user.email]', [
        //     'required' => 'Email tidak boleh kosong!',
        //     'valid_email' => 'Email tidak valid!',
        //     'is_unique' => 'Email ini sudah terdaftar!'
        // ]);

        // // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
        // //     'required' => 'Kata Sandi tidak boleh kosong!',
        // //     'matches' => 'Kata Sandi tidak cocok!',
        // //     'min_length' => 'Kata Sandi terlalu pendek!'
        // // ]);

        // // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
        // //     'required' => 'Konfirmasi Kata Sandi tidak boleh kosong!',
        // //     'matches' => 'Konfirmasi Kata Sandi tidak cocok!'
        // // ]);

        // $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
        //     'required' => 'Jabatan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
        //     'required' => 'Unit tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_awal', 'TMT Awal', 'required|trim', [
        //     'required' => 'TMT Awal tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_akhir', 'TMT Akhir', 'required|trim', [
        //     'required' => 'TMT Akhir tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('golongan', 'Golongan', 'required|trim', [
        //     'required' => 'Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('no_sk', 'No SK', 'required|trim', [
        //     'required' => 'No SK tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tgl_sk', 'Tanggal SK', 'required|trim', [
        //     'required' => 'Tanggal SK tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jab_fungsi', 'Jabatan Fungsional', 'required|trim', [
        //     'required' => 'Jabatan Fungsional tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
        //     'required' => 'Agama tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jns_pegawai', 'Jenis Pegawai', 'required|trim', [
        //     'required' => 'Jenis Pegawai tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', [
        //     'required' => 'Tempat Lahir tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
        //     'required' => 'Tanggal Lahir tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required|trim', [
        //     'required' => 'Jenis Kelamin tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
        //     'required' => 'Tanggal Pensiun tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim', [
        //     'required' => 'Pendidikan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('status_jabatan', 'Status Jabatan', 'required|trim', [
        //     'required' => 'Status Jabatan tidak boleh kosong!'
        // ]);
        $data['cariUnit'] = $this->input->post('searchUnit', true);
        $data['cariJabatan'] = $this->input->post('search_status_jabatan', true);

        $data['tampilkanAdm'] = '';

        if ($this->input->post('tampilkan')) {
            $searchUnit = $this->input->post('searchUnit', true);
            $statusJabatan = $this->input->post('search_status_jabatan', true);
            $data['tampilkanAdm'] = '';
            // $data['searchUnit'] = $this->input->post('searchUnit', true);
            // $data['statusJabatan'] = $this->input->post('search_status_jabatan', true);


            if (empty($searchUnit) and !empty($statusJabatan)) {
                $query = "SELECT `user`.*, `pegawai`.*
                    FROM `user` JOIN `pegawai`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` WHERE `pegawai`.`status_jabatan` = '$statusJabatan' AND `user`.`role_id` != 1
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (!empty($searchUnit) and empty($statusJabatan)) {
                $query = "SELECT `user`.*, `pegawai`.*
                    FROM `user` JOIN `pegawai`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` WHERE `pegawai`.`unit` = '$searchUnit' AND `user`.`role_id` != 1
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (!empty($searchUnit) and !empty($statusJabatan)) {
                $query = "SELECT `user`.*, `pegawai`.*
                    FROM `user` JOIN `pegawai`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` WHERE `pegawai`.`unit` = '$searchUnit' AND `pegawai`.`status_jabatan` = '$statusJabatan' AND `user`.`role_id` != 1
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (empty($searchUnit) and empty($statusJabatan)) {
                $query = "SELECT `user`.*, `pegawai`.*
                    FROM `user` JOIN `pegawai`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` AND `user`.`role_id` != 1
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            }
        } elseif ($this->input->post('tampilkanAdmin')) {
            $data['tampilkanAdm'] = $this->input->post('tampilkanAdmin');

            $query = "SELECT `user`.*, `pegawai`.*
                    FROM `user` JOIN `pegawai`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` WHERE `user`.`role_id` = 1
                    ORDER BY date_created DESC";

            $data['datauser'] = $this->db->query($query)->result_array();
        }

        // if ($this->form_validation->run() == false) {
        $data['title'] = 'Pegawai';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/index', $data);
        $this->load->view('templates/footer');
        // } else {

        // $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir', true));
        // $timeToAdd = "+ 58 years";
        // $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
        // $objDateTime->modify($timeToAdd);

        // $tgl_lahir = date('Y-m-d');
        // $timeToAdd = "+ 58 years";
        // $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
        // $objDateTime->modify($timeToAdd);

        // if ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-01-d")) {
        //     $cetaktgl = $objDateTime->format("Y-02-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-02-d")) {
        //     $cetaktgl = $objDateTime->format("Y-03-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-03-d")) {
        //     $cetaktgl = $objDateTime->format("Y-04-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-04-d")) {
        //     $cetaktgl = $objDateTime->format("Y-05-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-05-d")) {
        //     $cetaktgl = $objDateTime->format("Y-06-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-06-d")) {
        //     $cetaktgl = $objDateTime->format("Y-07-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-07-d")) {
        //     $cetaktgl = $objDateTime->format("Y-08-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-08-d")) {
        //     $cetaktgl = $objDateTime->format("Y-09-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-09-d")) {
        //     $cetaktgl = $objDateTime->format("Y-10-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-10-d")) {
        //     $cetaktgl = $objDateTime->format("Y-11-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-11-d")) {
        //     $cetaktgl = $objDateTime->format("Y-12-01");
        // } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-12-d")) {
        //     $tgl_lahir = $objDateTime->format("Y-m-d");

        //     $timeToAdd = "+ 1 month";
        //     $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
        //     $objDateTime->modify($timeToAdd);

        //     $cetaktgl = $objDateTime->format("Y-m-01");
        // }

        // echo $cetaktgl;

        // Cek jika ada gambar yang akan diupload
        // $upload_image = $_FILES['foto']['name'];

        // if ($upload_image) {
        //     $config['allowed_types'] = 'gif|jpg|png';
        //     $config['max_size']     = '2048';
        //     $config['upload_path'] = './assets/img/profile/';

        //     $this->load->library('upload', $config);
        //     if ($this->upload->do_upload('foto')) {
        //         $namafoto = $this->upload->data('file_name');
        //     } else {
        //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        //     Data gagal disimpan. Pastikan yang diupload format gambar !!</div>');
        //         redirect('pegawai');
        //     }
        // } else {
        //     $namafoto = 'default.jpg';
        // }

        // $data = [
        //     'jabatan_id' => 1,
        //     'nip' => htmlspecialchars($this->input->post('nip', true)),
        //     'nama' => htmlspecialchars($this->input->post('nama', true)),
        //     'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
        //     'unit' => htmlspecialchars($this->input->post('unit', true)),
        //     'tmt_awal' => htmlspecialchars($this->input->post('tmt_awal', true)),
        //     'tmt_akhir' => htmlspecialchars($this->input->post('tmt_akhir', true)),
        //     'gol' => htmlspecialchars($this->input->post('golongan', true)),
        //     'no_sk' => htmlspecialchars($this->input->post('no_sk', true)),
        //     'tgl_sk' => htmlspecialchars($this->input->post('tgl_sk', true)),
        //     'jabatan_fungsional' => htmlspecialchars($this->input->post('jab_fungsi', true)),
        //     'agama' => htmlspecialchars($this->input->post('agama', true)),
        //     'jenis_pegawai' => htmlspecialchars($this->input->post('jns_pegawai', true)),
        //     'tmp_lahir' => htmlspecialchars($this->input->post('tmp_lahir', true)),
        //     'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
        //     'jk' => htmlspecialchars($this->input->post('jns_kelamin', true)),
        //     // 'pensiun' => $objDateTime->format("Y-m-d"),
        //     'pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
        //     'pendidikan' => htmlspecialchars($this->input->post('pendidikan', true)),
        //     'status_jabatan' => htmlspecialchars($this->input->post('status_jabatan', true)),
        //     'foto' => $namafoto,
        // ];
        // $user = $this->db->insert('pegawai', $data);

        // if ($user) {
        //     $last = $this->db->insert_id();
        //     $data = [
        //         'id_pegawai' => $last,
        //         'id_jabatan' => 1,
        //         'name' => htmlspecialchars($this->input->post('nama', true)),
        //         'nip' => htmlspecialchars($this->input->post('nip', true)),
        //         'email' => htmlspecialchars($this->input->post('email', true)),
        //         'image' => $namafoto,
        //         'password' => password_hash('simpeg12345', PASSWORD_DEFAULT),
        //         'role_id' => 2,
        //         'is_active' => 0,
        //         'date_created' => time()
        //     ];
        //     $user = $this->db->insert('user', $data);

        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        //     Data pengguna berhasil ditambahkan.</div>');
        //     redirect('pegawai');
        // }

        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        // Data pengguna berhasil ditambahkan.</div>');
        // redirect('pegawai');
        // }
    }

    public function lihatDetail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Pegawai';

        $this->load->model('Admin_model', 'admin');
        $data['detail'] = $this->admin->detailPegawai($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/detail-Pegawai', $data);
        $this->load->view('templates/footer');
    }

    public function lihatDetailDosen($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Dosen';

        $this->load->model('Admin_model', 'admin');
        $data['detail'] = $this->admin->detailDosen($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/detail-Dosen', $data);
        $this->load->view('templates/footer');
    }

    public function resetPassword($id)
    {
        $password_hash = password_hash('simpeg12345', PASSWORD_DEFAULT);

        $this->db->set('password', $password_hash);
        $this->db->where('id_pegawai', $id, 'id_jabatan', 1);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kata Sandi berhasil direset!</div>');
        redirect('pegawai');
    }

    public function resetPasswordDosen($id)
    {
        $password_hash = password_hash('simpeg12345', PASSWORD_DEFAULT);

        $this->db->set('password', $password_hash);
        $this->db->where('id_pegawai', $id, 'id_jabatan', 2);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kata Sandi berhasil direset!</div>');
        redirect('pegawai/dosen');
    }

    public function tambahPegawai()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Lengkap tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[6]|max_length[25]|is_unique[pegawai.nip]', [
        //     'required' => 'NIP tidak boleh kosong!',
        //     'is_unique' => 'NIP ini sudah terdaftar!',
        //     'min_length' => 'NIP terlalu pendek!',
        //     'max_length' => 'NIP terlalu panjang!',
        //     'numeric' => 'NIP tidak boleh ada huruf'
        // ]);

        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[8]|max_length[30]|is_unique[pegawai.nik]', [
            'required' => 'NIK tidak boleh kosong!',
            'is_unique' => 'NIK ini sudah terdaftar!',
            'min_length' => 'NIK terlalu pendek!',
            'max_length' => 'NIK terlalu panjang!',
            'numeric' => 'NIK tidak boleh ada huruf'
        ]);

        // $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim|numeric|min_length[8]|max_length[30]|is_unique[pegawai.npwp]', [
        //     'required' => 'NPWP tidak boleh kosong!',
        //     'is_unique' => 'NPWP ini sudah terdaftar!',
        //     'min_length' => 'NPWP terlalu pendek!',
        //     'max_length' => 'NPWP terlalu panjang!',
        //     'numeric' => 'NPWP tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('karpeg', 'Karpeg', 'trim|numeric|min_length[8]|max_length[30]|is_unique[pegawai.karpeg]', [
        //     'is_unique' => 'Karpeg ini sudah terdaftar!',
        //     'min_length' => 'Karpeg terlalu pendek!',
        //     'max_length' => 'Karpeg terlalu panjang!',
        //     'numeric' => 'Karpeg tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('karsu', 'Karsu', 'trim|numeric|min_length[8]|max_length[30]|is_unique[pegawai.karsu]', [
        //     'is_unique' => 'Karsu ini sudah terdaftar!',
        //     'min_length' => 'Karsu terlalu pendek!',
        //     'max_length' => 'Karsu terlalu panjang!',
        //     'numeric' => 'Karsu tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('akta_nikah', 'Akta Nikah', 'trim|numeric|min_length[8]|max_length[30]|is_unique[pegawai.akta_nikah]', [
        //     'is_unique' => 'Akta Nikah ini sudah terdaftar!',
        //     'min_length' => 'Akta Nikah terlalu pendek!',
        //     'max_length' => 'Akta Nikah terlalu panjang!',
        //     'numeric' => 'Akta Nikah tidak boleh ada huruf'
        // ]);

        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|numeric|min_length[10]|max_length[13]|is_unique[pegawai.hp]', [
            'is_unique' => 'No HP ini sudah terdaftar!',
            'min_length' => 'No HP terlalu pendek!',
            'max_length' => 'No HP terlalu panjang!',
            'numeric' => 'No HP tidak boleh ada huruf'
        ]);

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Email tidak valid!',
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);

        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
        //     'required' => 'Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Kata Sandi tidak cocok!',
        //     'min_length' => 'Kata Sandi terlalu pendek!'
        // ]);

        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
        //     'required' => 'Konfirmasi Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Konfirmasi Kata Sandi tidak cocok!'
        // ]);

        // $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
        //     'required' => 'Jabatan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
        //     'required' => 'Unit tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_cpns', 'TMT Awal', 'required|trim', [
        //     'required' => 'TMT Awal tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_pns', 'TMT Akhir', 'required|trim', [
        //     'required' => 'TMT Akhir tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('golongan', 'Golongan', 'required|trim', [
        //     'required' => 'Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('no_sk', 'No SK', 'required|trim', [
        //     'required' => 'No SK tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tgl_sk', 'Tanggal SK', 'required|trim', [
        //     'required' => 'Tanggal SK tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jab_fungsi', 'Jabatan Fungsional', 'required|trim', [
        //     'required' => 'Jabatan Fungsional tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
            'required' => 'Agama tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('jns_pegawai', 'Jenis Pegawai', 'required|trim', [
            'required' => 'Jenis Pegawai tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', [
            'required' => 'Tempat Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
        //     'required' => 'Tanggal Pensiun tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim', [
            'required' => 'Pendidikan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('status_jabatan', 'Status Jabatan', 'required|trim', [
            'required' => 'Status Jabatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', [
            'required' => 'Provinsi tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim', [
            'required' => 'Kabupaten tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', [
            'required' => 'Kecamatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('desa', 'Desa', 'required|trim', [
            'required' => 'Desa tidak boleh kosong!'
        ]);

        $this->load->model('Wilayah_model');
        $data['provinsi'] = $this->Wilayah_model->getDataProv();

        $data['unit'] = $this->db->get('unit')->result_array();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pegawai';


            // $tgl_lahir = date('Y-m-d');
            // $timeToAdd = "+ 58 years 1 month";
            // $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
            // $objDateTime->modify($timeToAdd);

            // echo $objDateTime->format("Y-m-01");



            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/tambah-Pegawai', $data);
            // $this->load->view('templates/footer');
        } else {
            // $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir', true));
            // $timeToAdd = "+ 58 years";
            // $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
            // $objDateTime->modify($timeToAdd);
            cek_csrf();

            $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir', true));
            $timeToAdd = "+ 58 years";
            $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
            $objDateTime->modify($timeToAdd);

            if ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-01-d")) {
                $cetaktgl = $objDateTime->format("Y-02-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-02-d")) {
                $cetaktgl = $objDateTime->format("Y-03-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-03-d")) {
                $cetaktgl = $objDateTime->format("Y-04-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-04-d")) {
                $cetaktgl = $objDateTime->format("Y-05-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-05-d")) {
                $cetaktgl = $objDateTime->format("Y-06-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-06-d")) {
                $cetaktgl = $objDateTime->format("Y-07-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-07-d")) {
                $cetaktgl = $objDateTime->format("Y-08-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-08-d")) {
                $cetaktgl = $objDateTime->format("Y-09-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-09-d")) {
                $cetaktgl = $objDateTime->format("Y-10-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-10-d")) {
                $cetaktgl = $objDateTime->format("Y-11-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-11-d")) {
                $cetaktgl = $objDateTime->format("Y-12-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-12-d")) {
                $tgl_lahir = $objDateTime->format("Y-m-d");

                $timeToAdd = "+ 1 month";
                $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
                $objDateTime->modify($timeToAdd);

                $cetaktgl = $objDateTime->format("Y-m-01");
            }

            // echo $objDateTime->format("Y-m-01");


            // Cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $namafoto = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal disimpan. Pastikan yang diupload format gambar !!</div>');
                    redirect('pegawai');
                }
            } else {
                $namafoto = 'default.jpg';
            }

            $data = [
                'jabatan_id' => 1,
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'karpeg' => htmlspecialchars($this->input->post('karpeg', true)),
                'karsu' => htmlspecialchars($this->input->post('karsu', true)),
                'akta_nikah' => htmlspecialchars($this->input->post('akta_nikah', true)),
                'hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                'unit' => htmlspecialchars($this->input->post('unit', true)),
                'tmt_cpns' => htmlspecialchars($this->input->post('tmt_cpns', true)),
                'tmt_pns' => htmlspecialchars($this->input->post('tmt_pns', true)),
                'gol' => htmlspecialchars($this->input->post('golongan', true)),
                'no_sk' => htmlspecialchars($this->input->post('no_sk', true)),
                'tgl_sk' => htmlspecialchars($this->input->post('tgl_sk', true)),
                'jabatan_fungsional' => htmlspecialchars($this->input->post('jab_fungsi', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'jenis_pegawai' => htmlspecialchars($this->input->post('jns_pegawai', true)),
                'tmp_lahir' => htmlspecialchars($this->input->post('tmp_lahir', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'provinsi' => htmlspecialchars($this->input->post('provinsi', true)),
                'kabupaten' => htmlspecialchars($this->input->post('kabupaten', true)),
                'kecamatan' => htmlspecialchars($this->input->post('kecamatan', true)),
                'desa' => htmlspecialchars($this->input->post('desa', true)),
                'jk' => htmlspecialchars($this->input->post('jns_kelamin', true)),
                'pensiun' => $cetaktgl,
                // 'pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
                'pendidikan' => htmlspecialchars($this->input->post('pendidikan', true)),
                'status_jabatan' => htmlspecialchars($this->input->post('status_jabatan', true)),
                'foto' => $namafoto,
            ];
            $user = $this->db->insert('pegawai', $data);

            if ($user) {
                $last = $this->db->insert_id();
                $data = [
                    'id_pegawai' => $last,
                    'id_jabatan' => 1,
                    'name' => htmlspecialchars($this->input->post('nama', true)),
                    'nip' => htmlspecialchars($this->input->post('nip', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'image' => $namafoto,
                    'password' => password_hash('simpeg12345', PASSWORD_DEFAULT),
                    'role_id' => 2,
                    'is_active' => 0,
                    'date_created' => time()
                ];
                $user = $this->db->insert('user', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Pegawai berhasil ditambahkan.</div>');
                redirect('pegawai');
            }
        }
    }

    public function ubah($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['datauser'] = $this->admin->getPegawaiId($id);


        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Lengkap tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[8]|max_length[30]', [
            'required' => 'NIK tidak boleh kosong!',
            // 'is_unique' => 'NIK ini sudah terdaftar!',
            'min_length' => 'NIK terlalu pendek!',
            'max_length' => 'NIK terlalu panjang!',
            'numeric' => 'NIK tidak boleh ada huruf'
        ]);

        // $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim|numeric|min_length[8]|max_length[30]', [
        //     'required' => 'NPWP tidak boleh kosong!',
        //     'min_length' => 'NPWP terlalu pendek!',
        //     'max_length' => 'NPWP terlalu panjang!',
        //     'numeric' => 'NPWP tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('karpeg', 'Karpeg', 'trim|numeric|min_length[8]|max_length[30]', [
        //     'min_length' => 'Karpeg terlalu pendek!',
        //     'max_length' => 'Karpeg terlalu panjang!',
        //     'numeric' => 'Karpeg tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('karsu', 'Karsu', 'trim|numeric|min_length[8]|max_length[30]', [
        //     'min_length' => 'Karsu terlalu pendek!',
        //     'max_length' => 'Karsu terlalu panjang!',
        //     'numeric' => 'Karsu tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('akta_nikah', 'Akta Nikah', 'trim|numeric|min_length[8]|max_length[30]', [
        //     'min_length' => 'Akta Nikah terlalu pendek!',
        //     'max_length' => 'Akta Nikah terlalu panjang!',
        //     'numeric' => 'Akta Nikah tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('no_hp', 'No HP', 'trim|numeric|min_length[10]|max_length[13]', [
        //     // 'is_unique' => 'No HP ini sudah terdaftar!',
        //     'min_length' => 'No HP terlalu pendek!',
        //     'max_length' => 'No HP terlalu panjang!',
        //     'numeric' => 'No HP tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[6]|max_length[25]', [
        //     'required' => 'NIP tidak boleh kosong!',
        //     'min_length' => 'NIP terlalu pendek!',
        //     'max_length' => 'NIP terlalu panjang!',
        //     'numeric' => 'NIP tidak boleh ada huruf'
        // ]);

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Email tidak valid!',
            // 'is_unique' => 'Email ini sudah terdaftar!'
        ]);

        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
        //     'required' => 'Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Kata Sandi tidak cocok!',
        //     'min_length' => 'Kata Sandi terlalu pendek!'
        // ]);

        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
        //     'required' => 'Konfirmasi Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Konfirmasi Kata Sandi tidak cocok!'
        // ]);

        // $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
        //     'required' => 'Jabatan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
        //     'required' => 'Unit tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_cpns', 'TMT CPNS', 'required|trim', [
        //     'required' => 'TMT CPNS tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_pns', 'TMT PNS', 'required|trim', [
        //     'required' => 'TMT PNS tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('golongan', 'Golongan', 'required|trim', [
        //     'required' => 'Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('no_sk', 'No SK', 'required|trim', [
        //     'required' => 'No SK tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tgl_sk', 'Tanggal SK', 'required|trim', [
        //     'required' => 'Tanggal SK tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jab_fungsi', 'Jabatan Fungsional', 'required|trim', [
        //     'required' => 'Jabatan Fungsional tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
            'required' => 'Agama tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('jns_pegawai', 'Jenis Pegawai', 'required|trim', [
            'required' => 'Jenis Pegawai tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', [
            'required' => 'Tempat Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
        //     'required' => 'Tanggal Pensiun tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim', [
            'required' => 'Pendidikan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('status_jabatan', 'Status Jabatan', 'required|trim', [
            'required' => 'Status Jabatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', [
            'required' => 'Provinsi tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim', [
            'required' => 'Kabupaten tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', [
            'required' => 'Kecamatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('desa', 'Desa', 'required|trim', [
            'required' => 'Desa tidak boleh kosong!'
        ]);

        $this->load->model('Wilayah_model');
        $data['provinsi'] = $this->Wilayah_model->getDataProv();

        $data['unit'] = $this->db->get('unit')->result_array();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pegawai';
            // $this->load->model('Admin_model', 'admin');
            // $data['datauser'] = $this->admin->getPegawaiId($id);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/ubah', $data);
            // $this->load->view('templates/footer');
        } else {

            cek_csrf();

            // Cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $old_image = $data['datauser']['foto'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $image = $this->upload->data('file_name');
                    // $this->db->set('foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $image = $data['datauser']['foto'];
            }

            $id_pegawai = $this->input->post('id', true);
            $data = [
                'id_peg' => $id_pegawai,
                'jabatan_id' => 1,
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'karpeg' => htmlspecialchars($this->input->post('karpeg', true)),
                'karsu' => htmlspecialchars($this->input->post('karsu', true)),
                'akta_nikah' => htmlspecialchars($this->input->post('akta_nikah', true)),
                'hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                'unit' => htmlspecialchars($this->input->post('unit', true)),
                'tmt_cpns' => htmlspecialchars($this->input->post('tmt_cpns', true)),
                'tmt_pns' => htmlspecialchars($this->input->post('tmt_pns', true)),
                'gol' => htmlspecialchars($this->input->post('golongan', true)),
                'no_sk' => htmlspecialchars($this->input->post('no_sk', true)),
                'tgl_sk' => htmlspecialchars($this->input->post('tgl_sk', true)),
                'jabatan_fungsional' => htmlspecialchars($this->input->post('jab_fungsi', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'jenis_pegawai' => htmlspecialchars($this->input->post('jns_pegawai', true)),
                'tmp_lahir' => htmlspecialchars($this->input->post('tmp_lahir', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'provinsi' => htmlspecialchars($this->input->post('provinsi', true)),
                'kabupaten' => htmlspecialchars($this->input->post('kabupaten', true)),
                'kecamatan' => htmlspecialchars($this->input->post('kecamatan', true)),
                'desa' => htmlspecialchars($this->input->post('desa', true)),
                'jk' => htmlspecialchars($this->input->post('jns_kelamin', true)),
                // 'pensiun' => $objDateTime->format("Y-m-d"),
                'pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
                'pendidikan' => htmlspecialchars($this->input->post('pendidikan', true)),
                'status_jabatan' => htmlspecialchars($this->input->post('status_jabatan', true)),
                'foto' => $image,
            ];
            // $this->db->where('id_peg', $id_pegawai);
            // $this->db->update('pegawai', $data);
            $this->db->update('pegawai', $data, array('id_peg' => $id_pegawai));

            $data = [
                'name' => htmlspecialchars($this->input->post('nama', true)),
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => $image,
            ];

            $jab = $data['datauser']['id_jabatan'];
            $this->db->where('id_pegawai', $id, 'id_jabatan', $jab);
            $this->db->update('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai berhasil diperbaharui!</div>');
            redirect('pegawai');
        }
    }

    public function hapus($id)
    {
        // $data = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data = $this->admin->getPegawaiId($id);

        if ($data['foto'] != "default.jpg") {
            unlink('./assets/img/profile/' . $data['foto']);
        }

        // $this->db->where('id_peg', $id);
        // $this->db->delete('pegawai');

        $this->db->delete('pegawai', array('id_peg' => $id));
        $this->db->delete('user', array('id_pegawai' => $id, 'id_jabatan' => $data['id_jabatan']));

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Dihapus!</div>');
        redirect('pegawai');
    }

    public function aktifkan($id)
    {
        $this->load->model('Admin_model', 'admin');
        $data = $this->admin->getPegawaiId($id);

        $data = [
            'is_active' => 1,
        ];
        $jab = $data['id_jabatan'];
        $this->db->where('id_pegawai', $id, 'id_jabatan', $jab);
        $this->db->update('user', $data);
        // $this->db->update('user', $data, array('id_pegawai' => $id, 'id_jabatan' => $data['id_jabatan']));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diaktifkan!</div>');
        redirect('pegawai');
    }

    public function nonAktifkan($id)
    {
        $this->load->model('Admin_model', 'admin');
        $data = $this->admin->getPegawaiId($id);

        $data = [
            'is_active' => 0,
        ];

        $jab = $data['id_jabatan'];
        $this->db->where('id_pegawai', $id, 'id_jabatan', $jab);
        $this->db->update('user', $data);
        // $this->db->update('user', $data, array('id_pegawai' => $id, 'id_jabatan' => $data['id_jabatan']));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di non aktifkan!</div>');
        redirect('pegawai');
    }

    public function dosen()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['datauser'] = $this->admin->getDosen();

        // $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
        //     'required' => 'Nama Lengkap tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[6]|max_length[25]|is_unique[dosen.nip]', [
        //     'required' => 'NIP tidak boleh kosong!',
        //     'is_unique' => 'NIP ini sudah terdaftar!',
        //     'min_length' => 'NIP terlalu pendek!',
        //     'max_length' => 'NIP terlalu panjang!',
        //     'numeric' => 'NIP tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('nidn', 'NIDN', 'required|trim|numeric|min_length[6]|max_length[25]|is_unique[dosen.nidn]', [
        //     'required' => 'NIDN tidak boleh kosong!',
        //     'is_unique' => 'NIDN ini sudah terdaftar!',
        //     'min_length' => 'NIDN terlalu pendek!',
        //     'max_length' => 'NIDN terlalu panjang!',
        //     'numeric' => 'NIDN tidak boleh ada huruf'
        // ]);

        // $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[user.email]', [
        //     'required' => 'Email tidak boleh kosong!',
        //     'valid_email' => 'Email tidak valid!',
        //     'is_unique' => 'Email ini sudah terdaftar!'
        // ]);

        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
        //     'required' => 'Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Kata Sandi tidak cocok!',
        //     'min_length' => 'Kata Sandi terlalu pendek!'
        // ]);

        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
        //     'required' => 'Konfirmasi Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Konfirmasi Kata Sandi tidak cocok!'
        // ]);

        // $this->form_validation->set_rules('jabatanFungsi', 'Jabatan Fungsi', 'required|trim', [
        //     'required' => 'Jabatan Fungsi tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_jabfung', 'TMT Jabfung', 'required|trim', [
        //     'required' => 'TMT Jabfung tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('golongan', 'Golongan', 'required|trim', [
        //     'required' => 'Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_golongan', 'TMT Golongan', 'required|trim', [
        //     'required' => 'TMT Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
        //     'required' => 'Unit tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
        //     'required' => 'Jurusan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('prog_studi', 'Program Studi', 'required|trim', [
        //     'required' => 'Program Studi tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
        //     'required' => 'Agama tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', [
        //     'required' => 'Tempat Lahir tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
        //     'required' => 'Tanggal Lahir tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required|trim', [
        //     'required' => 'Jenis Kelamin tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
        //     'required' => 'Tanggal Pensiun tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim', [
        //     'required' => 'Pendidikan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jab_struktural', 'Jabatan Struktural', 'required|trim', [
        //     'required' => 'Jabatan Struktural tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_jab_struktural', 'TMT Jabatan Struktural', 'required|trim', [
        //     'required' => 'TMT Jabatan Struktural tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_cpns', 'TMT CPNS', 'required|trim', [
        //     'required' => 'TMT CPNS tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_pns', 'TMT PNS', 'required|trim', [
        //     'required' => 'TMT PNS tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('status_jabatan', 'Status Jabatan', 'required|trim', [
        //     'required' => 'Status Jabatan tidak boleh kosong!'
        // ]);

        $data['cariJurusan'] = $this->input->post('jurusan', true);
        $data['cariProgstudi'] = $this->input->post('prog_studi', true);
        $data['cariStatusJab'] = $this->input->post('search_status_jabatan', true);

        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        if ($this->input->post('tampilkan')) {
            $searchJurusan = $this->input->post('jurusan', true);
            $searchProgstudi = $this->input->post('prog_studi', true);
            $statusJabatan = $this->input->post('search_status_jabatan', true);

            // $data['searchUnit'] = $this->input->post('searchUnit', true);
            // $data['statusJabatan'] = $this->input->post('search_status_jabatan', true);


            if (!empty($searchJurusan) and !empty($searchProgstudi) and !empty($statusJabatan)) {
                $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi` WHERE `dosen`.`jurusan` = '$searchJurusan' AND `dosen`. `prog_studi` = '$searchProgstudi' AND `dosen`.`status_jabatan` = '$statusJabatan'
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (!empty($searchJurusan) and !empty($searchProgstudi) and empty($statusJabatan)) {
                $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi` WHERE `dosen`.`jurusan` = '$searchJurusan' AND `dosen`. `prog_studi` = '$searchProgstudi'
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (!empty($searchJurusan) and empty($searchProgstudi) and empty($statusJabatan)) {
                $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi` WHERE `dosen`.`jurusan` = '$searchJurusan'
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (empty($searchJurusan) and empty($searchProgstudi) and !empty($statusJabatan)) {
                $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                    FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                    ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi` WHERE `dosen`.`status_jabatan` = '$statusJabatan'
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (!empty($searchJurusan) and empty($searchProgstudi) and !empty($statusJabatan)) {
                $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                    FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                    ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi` WHERE `dosen`.`jurusan` = '$searchJurusan' AND `dosen`.`status_jabatan` = '$statusJabatan'
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            } elseif (empty($searchJurusan) and empty($searchProgstudi) and empty($statusJabatan)) {
                $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                    FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                    ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi`
                    ORDER BY date_created DESC";
                // return $this->db->query($query)->result_array();

                $data['datauser'] = $this->db->query($query)->result_array();
            }
        }

        // if ($this->form_validation->run() == false) {
        $data['title'] = 'Dosen';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/dosen', $data);
        $this->load->view('templates/footer');
        // } else {
        //     // Cek jika ada gambar yang akan diupload
        //     $upload_image = $_FILES['foto']['name'];

        //     if ($upload_image) {
        //         $config['allowed_types'] = 'gif|jpg|png';
        //         $config['max_size']     = '2048';
        //         $config['upload_path'] = './assets/img/profile/';

        //         $this->load->library('upload', $config);
        //         if ($this->upload->do_upload('foto')) {
        //             $namafoto = $this->upload->data('file_name');
        //         } else {
        //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        //         Data gagal disimpan. Pastikan yang diupload format gambar !!</div>');
        //             redirect('pegawai');
        //         }
        //     } else {
        //         $namafoto = 'default.jpg';
        //     }

        //     $data = [
        //         'jabatan_id' => 2,
        //         'nip' => htmlspecialchars($this->input->post('nip', true)),
        //         'nidn' => htmlspecialchars($this->input->post('nidn', true)),
        //         'nama' => htmlspecialchars($this->input->post('nama', true)),
        //         'pendidikan' => htmlspecialchars($this->input->post('pendidikan', true)),
        //         'jabatan_fungsi' => htmlspecialchars($this->input->post('jabatanFungsi', true)),
        //         'tmt_jab_fungsi' => htmlspecialchars($this->input->post('tmt_jabfung', true)),
        //         'gol' => htmlspecialchars($this->input->post('golongan', true)),
        //         'tmt_golongan' => htmlspecialchars($this->input->post('tmt_golongan', true)),
        //         'unit' => htmlspecialchars($this->input->post('unit', true)),
        //         'jurusan' => htmlspecialchars($this->input->post('jurusan', true)),
        //         'prog_studi' => htmlspecialchars($this->input->post('prog_studi', true)),
        //         'tmp_lahir' => htmlspecialchars($this->input->post('tmp_lahir', true)),
        //         'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
        //         'pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
        //         'jk' => htmlspecialchars($this->input->post('jns_kelamin', true)),
        //         'agama' => htmlspecialchars($this->input->post('agama', true)),
        //         'jab_struktural' => htmlspecialchars($this->input->post('jab_struktural', true)),
        //         'tmt_jab_struk' => htmlspecialchars($this->input->post('tmt_jab_struktural', true)),
        //         'tmt_cpns' => htmlspecialchars($this->input->post('tmt_cpns', true)),
        //         'tmt_pns' => htmlspecialchars($this->input->post('tmt_pns', true)),
        //         'status_jabatan' => htmlspecialchars($this->input->post('status_jabatan', true)),
        //         'foto' => $namafoto,
        //     ];
        //     $user = $this->db->insert('dosen', $data);

        //     if ($user) {
        //         $last = $this->db->insert_id();
        //         $data = [
        //             'id_pegawai' => $last,
        //             'id_jabatan' => 2,
        //             'name' => htmlspecialchars($this->input->post('nama', true)),
        //             'nip' => htmlspecialchars($this->input->post('nip', true)),
        //             'email' => htmlspecialchars($this->input->post('email', true)),
        //             'image' => $namafoto,
        //             'password' => password_hash('simpeg12345', PASSWORD_DEFAULT),
        //             'role_id' => 2,
        //             'is_active' => 0,
        //             'date_created' => time()
        //         ];
        //         $user = $this->db->insert('user', $data);

        //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        //         Data Dosen berhasil ditambahkan.</div>');
        //         redirect('pegawai/dosen');
        //     }
        // }
    }

    public function tambahDosen()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $this->load->model('Admin_model', 'admin');
        // $data['datauser'] = $this->admin->getDosen();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Lengkap tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[6]|max_length[25]|is_unique[dosen.nip]', [
            'required' => 'NIP tidak boleh kosong!',
            'is_unique' => 'NIP ini sudah terdaftar!',
            'min_length' => 'NIP terlalu pendek!',
            'max_length' => 'NIP terlalu panjang!',
            'numeric' => 'NIP tidak boleh ada huruf'
        ]);

        $this->form_validation->set_rules('nidn', 'NIDN', 'required|trim|numeric|min_length[6]|max_length[25]|is_unique[dosen.nidn]', [
            'required' => 'NIDN tidak boleh kosong!',
            'is_unique' => 'NIDN ini sudah terdaftar!',
            'min_length' => 'NIDN terlalu pendek!',
            'max_length' => 'NIDN terlalu panjang!',
            'numeric' => 'NIDN tidak boleh ada huruf'
        ]);

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Email tidak valid!',
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);

        $this->form_validation->set_rules('hp', 'No HP', 'required|trim|numeric|min_length[10]|max_length[13]|is_unique[dosen.hp]', [
            'required' => 'No HP tidak boleh kosong!',
            'is_unique' => 'No HP ini sudah terdaftar!',
            'min_length' => 'No HP terlalu pendek!',
            'max_length' => 'No HP terlalu panjang!',
            'numeric' => 'No HP tidak boleh ada huruf'
        ]);

        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
        //     'required' => 'Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Kata Sandi tidak cocok!',
        //     'min_length' => 'Kata Sandi terlalu pendek!'
        // ]);

        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
        //     'required' => 'Konfirmasi Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Konfirmasi Kata Sandi tidak cocok!'
        // ]);

        // $this->form_validation->set_rules('jabatanFungsi', 'Jabatan Fungsi', 'required|trim', [
        //     'required' => 'Jabatan Fungsi tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_jabfung', 'TMT Jabfung', 'required|trim', [
        //     'required' => 'TMT Jabfung tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('golongan', 'Golongan', 'required|trim', [
        //     'required' => 'Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_golongan', 'TMT Golongan', 'required|trim', [
        //     'required' => 'TMT Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
        //     'required' => 'Unit tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
            'required' => 'Jurusan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('prog_studi', 'Program Studi', 'required|trim', [
            'required' => 'Program Studi tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
            'required' => 'Agama tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', [
            'required' => 'Tempat Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
        //     'required' => 'Tanggal Pensiun tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim', [
            'required' => 'Pendidikan tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('jab_struktural', 'Jabatan Struktural', 'required|trim', [
        //     'required' => 'Jabatan Struktural tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_jab_struktural', 'TMT Jabatan Struktural', 'required|trim', [
        //     'required' => 'TMT Jabatan Struktural tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_cpns', 'TMT CPNS', 'required|trim', [
        //     'required' => 'TMT CPNS tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_pns', 'TMT PNS', 'required|trim', [
        //     'required' => 'TMT PNS tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('status_jabatan', 'Status Jabatan', 'required|trim', [
            'required' => 'Status Jabatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', [
            'required' => 'Provinsi tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim', [
            'required' => 'Kabupaten tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', [
            'required' => 'Kecamatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('desa', 'Desa', 'required|trim', [
            'required' => 'Desa tidak boleh kosong!'
        ]);

        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        $this->load->model('Wilayah_model');
        $data['provinsi'] = $this->Wilayah_model->getDataProv();

        $data['unit'] = $this->db->get('unit')->result_array();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Dosen';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/tambah-Dosen', $data);
            // $this->load->view('templates/footer');
        } else {

            cek_csrf();

            $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir', true));
            $timeToAdd = "+ 65 years";
            $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
            $objDateTime->modify($timeToAdd);

            if ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-01-d")) {
                $cetaktgl = $objDateTime->format("Y-02-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-02-d")) {
                $cetaktgl = $objDateTime->format("Y-03-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-03-d")) {
                $cetaktgl = $objDateTime->format("Y-04-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-04-d")) {
                $cetaktgl = $objDateTime->format("Y-05-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-05-d")) {
                $cetaktgl = $objDateTime->format("Y-06-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-06-d")) {
                $cetaktgl = $objDateTime->format("Y-07-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-07-d")) {
                $cetaktgl = $objDateTime->format("Y-08-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-08-d")) {
                $cetaktgl = $objDateTime->format("Y-09-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-09-d")) {
                $cetaktgl = $objDateTime->format("Y-10-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-10-d")) {
                $cetaktgl = $objDateTime->format("Y-11-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-11-d")) {
                $cetaktgl = $objDateTime->format("Y-12-01");
            } elseif ($objDateTime->format("Y-m-d") == $objDateTime->format("Y-12-d")) {
                $tgl_lahir = $objDateTime->format("Y-m-d");

                $timeToAdd = "+ 1 month";
                $objDateTime = DateTime::createFromFormat("Y-m-d", $tgl_lahir);
                $objDateTime->modify($timeToAdd);

                $cetaktgl = $objDateTime->format("Y-m-01");
            }

            // Cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $namafoto = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal disimpan. Pastikan yang diupload format gambar !!</div>');
                    redirect('pegawai');
                }
            } else {
                $namafoto = 'default.jpg';
            }

            $data = [
                'jabatan_id' => 2,
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nidn' => htmlspecialchars($this->input->post('nidn', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'pendidikan' => htmlspecialchars($this->input->post('pendidikan', true)),
                'jabatan_fungsi' => htmlspecialchars($this->input->post('jabatanFungsi', true)),
                'tmt_jab_fungsi' => htmlspecialchars($this->input->post('tmt_jabfung', true)),
                'gol' => htmlspecialchars($this->input->post('golongan', true)),
                'tmt_golongan' => htmlspecialchars($this->input->post('tmt_golongan', true)),
                'unit' => htmlspecialchars($this->input->post('unit', true)),
                'jurusan' => htmlspecialchars($this->input->post('jurusan', true)),
                'prog_studi' => htmlspecialchars($this->input->post('prog_studi', true)),
                'tmp_lahir' => htmlspecialchars($this->input->post('tmp_lahir', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'hp' => htmlspecialchars($this->input->post('hp', true)),
                'provinsi' => htmlspecialchars($this->input->post('provinsi', true)),
                'kabupaten' => htmlspecialchars($this->input->post('kabupaten', true)),
                'kecamatan' => htmlspecialchars($this->input->post('kecamatan', true)),
                'desa' => htmlspecialchars($this->input->post('desa', true)),
                // 'pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
                'pensiun' => $cetaktgl,
                'jk' => htmlspecialchars($this->input->post('jns_kelamin', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'jab_struktural' => htmlspecialchars($this->input->post('jab_struktural', true)),
                'tmt_jab_struk' => htmlspecialchars($this->input->post('tmt_jab_struktural', true)),
                'tmt_cpns' => htmlspecialchars($this->input->post('tmt_cpns', true)),
                'tmt_pns' => htmlspecialchars($this->input->post('tmt_pns', true)),
                'status_jabatan' => htmlspecialchars($this->input->post('status_jabatan', true)),
                'foto' => $namafoto,
            ];
            $user = $this->db->insert('dosen', $data);

            if ($user) {
                $last = $this->db->insert_id();
                $data = [
                    'id_pegawai' => $last,
                    'id_jabatan' => 2,
                    'name' => htmlspecialchars($this->input->post('nama', true)),
                    'nip' => htmlspecialchars($this->input->post('nip', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'image' => $namafoto,
                    'password' => password_hash('simpeg12345', PASSWORD_DEFAULT),
                    'role_id' => 2,
                    'is_active' => 0,
                    'date_created' => time()
                ];
                $user = $this->db->insert('user', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Dosen berhasil ditambahkan.</div>');
                redirect('pegawai/dosen');
            }
        }
    }

    public function ubahDosen($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['datauser'] = $this->admin->getDosenId($id);

        $data['unit'] = $this->db->get('unit')->result_array();

        $this->load->model('Wilayah_model');
        $data['provinsi'] = $this->Wilayah_model->getDataProv();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Lengkap tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[6]|max_length[25]', [
            'required' => 'NIP tidak boleh kosong!',
            'min_length' => 'NIP terlalu pendek!',
            'max_length' => 'NIP terlalu panjang!',
            'numeric' => 'NIP tidak boleh ada huruf'
        ]);

        $this->form_validation->set_rules('nidn', 'NIDN', 'required|trim|numeric|min_length[6]|max_length[25]', [
            'required' => 'NIDN tidak boleh kosong!',
            'min_length' => 'NIDN terlalu pendek!',
            'max_length' => 'NIDN terlalu panjang!',
            'numeric' => 'NIDN tidak boleh ada huruf'
        ]);

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Email tidak valid!',
        ]);

        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
        //     'required' => 'Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Kata Sandi tidak cocok!',
        //     'min_length' => 'Kata Sandi terlalu pendek!'
        // ]);

        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
        //     'required' => 'Konfirmasi Kata Sandi tidak boleh kosong!',
        //     'matches' => 'Konfirmasi Kata Sandi tidak cocok!'
        // ]);

        // $this->form_validation->set_rules('jabatanFungsi', 'Jabatan Fungsi', 'required|trim', [
        //     'required' => 'Jabatan Fungsi tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_jabfung', 'TMT Jabfung', 'required|trim', [
        //     'required' => 'TMT Jabfung tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('golongan', 'Golongan', 'required|trim', [
        //     'required' => 'Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_golongan', 'TMT Golongan', 'required|trim', [
        //     'required' => 'TMT Golongan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
        //     'required' => 'Unit tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
        //     'required' => 'Jurusan tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('prog_studi', 'Program Studi', 'required|trim', [
        //     'required' => 'Program Studi tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
            'required' => 'Agama tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', [
            'required' => 'Tempat Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal Lahir tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
            'required' => 'Tanggal Pensiun tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim', [
            'required' => 'Pendidikan tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('jab_struktural', 'Jabatan Struktural', 'required|trim', [
        //     'required' => 'Jabatan Struktural tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_jab_struktural', 'TMT Jabatan Struktural', 'required|trim', [
        //     'required' => 'TMT Jabatan Struktural tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_cpns', 'TMT CPNS', 'required|trim', [
        //     'required' => 'TMT CPNS tidak boleh kosong!'
        // ]);

        // $this->form_validation->set_rules('tmt_pns', 'TMT PNS', 'required|trim', [
        //     'required' => 'TMT PNS tidak boleh kosong!'
        // ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', [
            'required' => 'Provinsi tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim', [
            'required' => 'Kabupaten tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', [
            'required' => 'Kecamatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('desa', 'Desa', 'required|trim', [
            'required' => 'Desa tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('status_jabatan', 'Status Jabatan', 'required|trim', [
            'required' => 'Status Jabatan tidak boleh kosong!'
        ]);

        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Dosen';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/ubah-Dosen', $data);
            // $this->load->view('templates/footer');
        } else {
            cek_csrf();

            // Cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $old_image = $data['datauser']['foto'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $image = $this->upload->data('file_name');
                    // $this->db->set('foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $image = $data['datauser']['foto'];
            }

            $id_dosen = $this->input->post('id', true);

            $data = [
                'jabatan_id' => 2,
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nidn' => htmlspecialchars($this->input->post('nidn', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'pendidikan' => htmlspecialchars($this->input->post('pendidikan', true)),
                'jabatan_fungsi' => htmlspecialchars($this->input->post('jabatanFungsi', true)),
                'tmt_jab_fungsi' => htmlspecialchars($this->input->post('tmt_jabfung', true)),
                'gol' => htmlspecialchars($this->input->post('golongan', true)),
                'tmt_golongan' => htmlspecialchars($this->input->post('tmt_golongan', true)),
                'unit' => htmlspecialchars($this->input->post('unit', true)),
                'jurusan' => htmlspecialchars($this->input->post('jurusan', true)),
                'prog_studi' => htmlspecialchars($this->input->post('prog_studi', true)),
                'tmp_lahir' => htmlspecialchars($this->input->post('tmp_lahir', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'hp' => htmlspecialchars($this->input->post('hp', true)),
                'provinsi' => htmlspecialchars($this->input->post('provinsi', true)),
                'kabupaten' => htmlspecialchars($this->input->post('kabupaten', true)),
                'kecamatan' => htmlspecialchars($this->input->post('kecamatan', true)),
                'desa' => htmlspecialchars($this->input->post('desa', true)),
                'pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
                'jk' => htmlspecialchars($this->input->post('jns_kelamin', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'jab_struktural' => htmlspecialchars($this->input->post('jab_struktural', true)),
                'tmt_jab_struk' => htmlspecialchars($this->input->post('tmt_jab_struktural', true)),
                'tmt_cpns' => htmlspecialchars($this->input->post('tmt_cpns', true)),
                'tmt_pns' => htmlspecialchars($this->input->post('tmt_pns', true)),
                'status_jabatan' => htmlspecialchars($this->input->post('status_jabatan', true)),
                'foto' => $image,
            ];

            $this->db->update('dosen', $data, array('id_dosen' => $id_dosen));

            $data = [
                'name' => htmlspecialchars($this->input->post('nama', true)),
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => $image,
            ];

            $jab = $data['datauser']['id_jabatan'];
            $this->db->where('id_pegawai', $id, 'id_jabatan', $jab);
            $this->db->update('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen berhasil diperbaharui!</div>');
            redirect('pegawai/dosen');
        }
    }

    public function getProgstudi()
    {
        $idjurusan = $this->input->post('id');
        $data = $this->db->get_where('prog_studi', ['id_jur' => $idjurusan])->result();
        $output = '<option value=""> -- Pilih Program Studi -- </option> ';

        foreach ($data as $row) {
            $output .= '<option value="' . $row->id_progstudi . '">' . $row->nama_prog_studi . '</option>';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function hapusDosen($id)
    {
        // $data = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data = $this->admin->getDosenId($id);

        if ($data['foto'] != "default.jpg") {
            unlink('./assets/img/profile/' . $data['foto']);
        }

        // $this->db->where('id_peg', $id);
        // $this->db->delete('pegawai');

        $this->db->delete('dosen', array('id_dosen' => $id));
        $this->db->delete('user', array('id_pegawai' => $id, 'id_jabatan' => $data['id_jabatan']));

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Dihapus!</div>');
        redirect('pegawai/dosen');
    }

    public function aktifkanDosen($id)
    {
        $this->load->model('Admin_model', 'admin');
        $data = $this->admin->getDosenId($id);

        $data = [
            'is_active' => 1,
        ];
        $jab = $data['id_jabatan'];
        $this->db->where('id_pegawai', $id, 'id_jabatan', $jab);
        $this->db->update('user', $data);
        // $this->db->update('user', $data, array('id_pegawai' => $id, 'id_jabatan' => $data['id_jabatan']));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen berhasil diaktifkan!</div>');
        redirect('pegawai/dosen');
    }

    public function nonAktifkanDosen($id)
    {
        $this->load->model('Admin_model', 'admin');
        $data = $this->admin->getDosenId($id);

        $data = [
            'is_active' => 0,
        ];

        $jab = $data['id_jabatan'];
        $this->db->where('id_pegawai', $id, 'id_jabatan', $jab);
        $this->db->update('user', $data);
        // $this->db->update('user', $data, array('id_pegawai' => $id, 'id_jabatan' => $data['id_jabatan']));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen berhasil di non aktifkan!</div>');
        redirect('pegawai/dosen');
    }

    public function pensiunPegawai($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['datauser'] = $this->admin->getPegawaiId($id);

        $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
            'required' => 'Tanggal Pensiun tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
            'required' => 'Status tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pegawai';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/pensiunPegawai', $data);
            $this->load->view('templates/footer');
        } else {
            $id_peg = htmlspecialchars($this->input->post('id', true));
            $data = [
                'id_pegawai' => $id_peg,
                'jabatan_id' => 1,
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jenis' => htmlspecialchars($this->input->post('jns_pegawai', true)),
                'unit' => htmlspecialchars($this->input->post('unit', true)),
                'status' => htmlspecialchars($this->input->post('status', true)),
                'tmt_pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                'foto' => htmlspecialchars($this->input->post('foto', true)),

            ];
            $this->db->insert('pensiun', $data);
            $this->db->delete('pegawai', array('id_peg' => $id_peg, 'jabatan_id' => 1));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pensiun berhasil ditambahkan!</div>');
            redirect('pegawai');
        }
    }

    public function pensiunDosen($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['datauser'] = $this->admin->getDosenId($id);

        $this->form_validation->set_rules('tgl_pensiun', 'Tanggal Pensiun', 'required|trim', [
            'required' => 'Tanggal Pensiun tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
            'required' => 'Status tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Dosen';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/pensiunDosen', $data);
            $this->load->view('templates/footer');
        } else {
            $id_dosen = htmlspecialchars($this->input->post('id', true));
            $data = [
                'id_pegawai' => $id_dosen,
                'jabatan_id' => 2,
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jenis' => 'dosen',
                'unit' => htmlspecialchars($this->input->post('unit', true)),
                'status' => htmlspecialchars($this->input->post('status', true)),
                'tmt_pensiun' => htmlspecialchars($this->input->post('tgl_pensiun', true)),
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                'foto' => htmlspecialchars($this->input->post('foto', true)),

            ];
            $this->db->insert('pensiun', $data);
            $this->db->delete('dosen', array('id_dosen' => $id_dosen, 'jabatan_id' => 2));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pensiun berhasil ditambahkan!</div>');
            redirect('pegawai/dosen');
        }
    }

    public function pensiun()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $this->admin->dataPensiun();
        $this->admin->deleteDataPensiun();
        $this->admin->dataPensiunDosen();
        $this->admin->deleteDataPensiunDosen();
        $data['datauser'] = $this->admin->getPensiun();


        $data['title'] = 'Pensiun';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/pensiun', $data);
        $this->load->view('templates/footer');
    }

    public function hapusPensiun($id)
    {
        // $data = $this->db->get_where('user', ['id' => $id])->row_array();
        // $this->load->model('Admin_model', 'admin');
        // $data = $this->admin->getDosenId($id);

        // if ($data['foto'] != "default.jpg") {
        //     unlink('./assets/img/profile/' . $data['foto']);
        // }

        // $this->db->where('id_peg', $id);
        // $this->db->delete('pegawai');

        $this->db->delete('pensiun', array('id_pensiun' => $id));
        // $this->db->delete('user', array('id_pegawai' => $id, 'id_jabatan' => $data['id_jabatan']));

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pensiun Berhasil Dihapus!</div>');
        redirect('pegawai/pensiun');
    }

    public function ulangTahun()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['ulangTahun'] = $this->admin->berulangTahun();

        $data['title'] = 'Berulang Tahun';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/ulangTahun', $data);
        $this->load->view('templates/footer');
    }

    public function jadikanAdmin($id)
    {
        $this->load->model('Admin_model', 'admin');
        $data['datauser'] = $this->admin->getPegawaiId($id);

        $data = [
            'role_id' => 1
        ];

        $jab = $data['datauser']['id_jabatan'];
        $this->db->where('id_pegawai', $id, 'id_jabatan', $jab);
        $this->db->update('user', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menjadikan admin!</div>');
        redirect('pegawai');
    }
}
