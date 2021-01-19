<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');
        $data['dataPegawai'] = $this->admin->getPegawai();
        $data['dataDosen'] = $this->admin->getDosen();
        $data['dataPensiun'] = $this->admin->getPensiun();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Akses Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Nama akses pengguna tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => htmlspecialchars($this->input->post('role', true))
            ];

            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses pengguna telah ditambahkan!</div>');
            redirect('admin/role');
        }
    }

    public function editRole($id)
    {
        $data['title'] = 'Ubah Akses Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Nama akses pengguna tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editRole', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'role' => htmlspecialchars($this->input->post('role', true))
            ];

            $this->db->where('id', $id);
            $this->db->update('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses pengguna berhasil diubah!</div>');
            redirect('admin/role');
        }
    }

    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses Pengguna berhasil dihapus!</div>');
        redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Akses Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses Telah diubah!</div>');
    }

    public function politeknik()
    {
        $data['title'] = 'Data Politeknik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['unit'] = $this->db->get('unit')->result_array();
        $data['prodi'] = $this->db->get('prog_studi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('politeknik/index', $data);
        $this->load->view('templates/footer');
    }

    public function jurusan()
    {
        $data['title'] = 'Data Politeknik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        $this->form_validation->set_rules('jurusan', 'Nama Jurusan', 'required|trim', [
            'required' => 'Nama Jurusan tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('politeknik/jurusan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_jurusan' => htmlspecialchars($this->input->post('jurusan', true))
            ];

            $this->db->insert('jurusan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jurusan telah ditambahkan!</div>');
            redirect('admin/jurusan');
        }
    }

    public function editJurusan($id)
    {
        $data['title'] = 'Data Politeknik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jurusan'] = $this->db->get_where('jurusan', ['id_jurusan' => $id])->row_array();

        $this->form_validation->set_rules('jurusan', 'Nama Jurusan', 'required|trim', [
            'required' => 'Nama Jurusan tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('politeknik/editJurusan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_jurusan' => $this->input->post('id'),
                'nama_jurusan' => htmlspecialchars($this->input->post('jurusan', true))
            ];

            $this->db->where('id_jurusan', $id);
            $this->db->update('jurusan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jurusan berhasil diubah!</div>');
            redirect('admin/jurusan');
        }
    }

    public function deleteJurusan($id)
    {
        $this->db->delete('jurusan', ['id_jurusan' => $id]);
        $this->db->delete('prog_studi', ['id_jur' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jurusan berhasil dihapus!</div>');
        redirect('admin/jurusan');
    }

    public function prodi()
    {
        $data['title'] = 'Data Politeknik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('*');
        $this->db->from('prog_studi');
        $this->db->join('jurusan', 'jurusan.id_jurusan = prog_studi.id_jur');
        $query = $this->db->get()->result_array();

        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['prodi'] = $query;

        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
            'required' => 'Jurusan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('nama_prodi', 'Nama Prodi', 'required|trim', [
            'required' => 'Nama Prodi tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('politeknik/prodi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_jur' => htmlspecialchars($this->input->post('jurusan', true)),
                'nama_prog_studi' => htmlspecialchars($this->input->post('nama_prodi', true))
            ];

            $this->db->insert('prog_studi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Program Studi telah ditambahkan!</div>');
            redirect('admin/prodi');
        }
    }

    public function editProdi($id)
    {
        $data['title'] = 'Data Politeknik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('*');
        $this->db->from('prog_studi');
        $this->db->join('jurusan', 'jurusan.id_jurusan = prog_studi.id_jur');
        $this->db->where('id_progstudi', $id);
        $query = $this->db->get()->row_array();

        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['prodi'] = $query;

        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
            'required' => 'Jurusan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('nama_prodi', 'Nama Prodi', 'required|trim', [
            'required' => 'Nama Prodi tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('politeknik/editProdi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_progstudi' => $this->input->post('id'),
                'id_jur' => htmlspecialchars($this->input->post('jurusan', true)),
                'nama_prog_studi' => htmlspecialchars($this->input->post('nama_prodi', true))
            ];

            $this->db->where('id_progstudi', $id);
            $this->db->update('prog_studi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Program Studi berhasil diubah!</div>');
            redirect('admin/prodi');
        }
    }

    public function deleteProdi($id)
    {
        $this->db->delete('prog_studi', ['id_progstudi' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Program Studi berhasil dihapus!</div>');
        redirect('admin/prodi');
    }

    public function unit()
    {
        $data['title'] = 'Data Politeknik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['unit'] = $this->db->get('unit')->result_array();

        $this->form_validation->set_rules('unit', 'Nama Unit', 'required|trim', [
            'required' => 'Nama Unit tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('politeknik/unit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('unit', true))
            ];

            $this->db->insert('unit', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Unit telah ditambahkan!</div>');
            redirect('admin/unit');
        }
    }

    public function editUnit($id)
    {
        $data['title'] = 'Data Politeknik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['unit'] = $this->db->get_where('unit', ['id_unit' => $id])->row_array();

        $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
            'required' => 'Nama Unit tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('politeknik/editUnit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('unit', true))
            ];

            $this->db->where('id_unit', $id);
            $this->db->update('unit', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Unit berhasil diubah!</div>');
            redirect('admin/unit');
        }
    }

    public function deleteUnit($id)
    {
        $this->db->delete('unit', ['id_unit' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Unit berhasil dihapus!</div>');
        redirect('admin/unit');
    }
}
