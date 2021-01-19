<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Ubah Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim', [
            'required' => 'Nama tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('nip', 'NIP', 'required|trim|min_length[6]|max_length[16]', [
        //     'required' => 'Nama tidak boleh kosong!',
        //     'min_length' => 'NIP terlalu pendek!',
        //     'max_length' => 'NIP terlalu panjang!'
        // ]);

        $this->form_validation->set_rules('hp', 'No HP', 'required|trim|min_length[10]|max_length[13]', [
            'required' => 'No HP tidak boleh kosong!',
            'min_length' => 'No HP terlalu pendek!',
            'max_length' => 'No HP terlalu panjang!'
        ]);

        $this->load->model('Wilayah_model');
        $data['provinsi'] = $this->Wilayah_model->getDataProv();

        $this->load->model('Admin_model', 'admin');

        $id = $data['user']['id_pegawai'];
        $id_jabatan = $data['user']['id_jabatan'];

        if ($id_jabatan == 1) {
            $data['datauser'] = $this->admin->getPegawaiId($id);
        } elseif ($id_jabatan == 2) {
            $data['datauser'] = $this->admin->getDosenId($id);
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            // $this->load->view('templates/footer');
        } else {
            $id_pegawai = $this->input->post('id_pegawai');
            $id_jabatan = $this->input->post('id_jabatan');
            $name = $this->input->post('name');
            $nip = $this->input->post('nip');
            $email = $this->input->post('email');

            // Cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    // $new_image = $this->upload->data('file_name');
                    $image = $this->upload->data('file_name');
                    // $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $image = $data['user']['image'];
            }

            $data = [
                'name'  => $name,
                'nip'   => $nip,
                'image' => $image
            ];

            $this->db->where('id_pegawai', $id_pegawai, 'id_jabatan', $id_jabatan);
            $this->db->update('user', $data);

            $hp = $this->input->post('hp');
            $alamat = $this->input->post('alamat');
            $provinsi = $this->input->post('provinsi');
            $kabupaten = $this->input->post('kabupaten');
            $kecamatan = $this->input->post('kecamatan');
            $desa = $this->input->post('desa');

            if ($id_jabatan == 1) {
                $data = [
                    'nip'       => $nip,
                    'hp'        => $hp,
                    'nama'      => $name,
                    'alamat'    => $alamat,
                    'provinsi'  => $provinsi,
                    'kabupaten' => $kabupaten,
                    'kecamatan' => $kecamatan,
                    'desa'      => $desa,
                    'foto'      => $image
                ];

                $this->db->where('id_peg', $id_pegawai, 'jabatan_id', $id_jabatan);
                $this->db->update('pegawai', $data);
            } elseif ($id_jabatan == 2) {
                $data = [
                    'nip'       => $nip,
                    'hp'        => $hp,
                    'nama'      => $name,
                    'alamat'    => $alamat,
                    'provinsi'  => $provinsi,
                    'kabupaten' => $kabupaten,
                    'kecamatan' => $kecamatan,
                    'desa'      => $desa,
                    'foto'      => $image
                ];

                $this->db->where('id_dosen', $id_pegawai, 'jabatan_id', $id_jabatan);
                $this->db->update('dosen', $data);
            }

            // $this->db->set('name', $name);
            // $this->db->set('nip', $nip);
            // $this->db->where('id_pegawai', $id_pegawai, 'id_jabatan', $id_jabatan);
            // $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profil anda telah diperbarui!</div>');
            redirect('user');
        }
    }

    public function getKabupaten()
    {
        // untuk edit data
        $kabupatenId = $this->input->post('kabupaten');

        $idprov = $this->input->post('id');
        $this->load->model('Wilayah_model');
        $data = $this->Wilayah_model->getDataKabupaten($idprov);
        $output = '<option value=""> --Pilih Kabupaten-- </option> ';

        foreach ($data as $row) {

            if ($kabupatenId) { //untuk edit data
                if ($kabupatenId == $row->id) {
                    $output .= '<option value="' . $row->id . '" selected>' . $row->nama . '</option>';
                } else {
                    $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
                }
            } else { //untuk tambah data
                $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getKecamatan()
    {
        // untuk edit data
        $kecamatanId = $this->input->post('kecamatan');

        $idkabupaten = $this->input->post('id');
        $this->load->model('Wilayah_model');
        $data = $this->Wilayah_model->getDataKecamatan($idkabupaten);
        $output = '<option value=""> --Pilih Kecamatan-- </option> ';

        foreach ($data as $row) {
            if ($kecamatanId) { //untuk edit data
                if ($kecamatanId == $row->id) {
                    $output .= '<option value="' . $row->id . '" selected>' . $row->nama . '</option>';
                } else {
                    $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
                }
            } else { //untuk tambah data
                $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getDesa()
    {
        // untuk edit data
        $desaId = $this->input->post('desa');

        $idkecamatan = $this->input->post('id');
        $this->load->model('Wilayah_model');
        $data = $this->Wilayah_model->getDataDesa($idkecamatan);
        $output = '<option value=""> --Pilih Desa-- </option> ';

        foreach ($data as $row) {
            if ($desaId) { //untuk edit data
                if ($desaId == $row->id) {
                    $output .= '<option value="' . $row->id . '" selected>' . $row->nama . '</option>';
                } else {
                    $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
                }
            } else { //untuk tambah data
                $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function changePassword()
    {
        $data['title'] = 'Ubah Kata Sandi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim', [
            'required' => 'Kata Sandi saat ini tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]', [
            'required' => 'Kata Sandi Baru tidak boleh kosong!',
            'min_length' => 'Kata Sandi Baru terlalu pendek!',
            'matches' => 'Kata Sandi tidak cocok!'
        ]);

        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[5]|matches[new_password1]', [
            'required' => 'Kata Sandi tidak boleh kosong!',
            'min_length' => 'Kata Sandi terlalu pendek!',
            'matches' => 'Kata Sandi tidak cocok!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Kata Sandi saat ini salah!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Kata Sandi baru tidak boleh sama dengan kata sandi saat ini!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('id_pegawai', $this->session->userdata('id_pegawai'), 'id_jabatan', $this->session->userdata('id_jabatan'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Kata Sandi berhasil diubah!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
