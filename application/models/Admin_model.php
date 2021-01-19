<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getUser()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
                    FROM `user` JOIN `user_role`
                    ON `user`.`role_id` = `user_role`.`id`
                    WHERE `user`.`role_id` != 1 ORDER BY date_created DESC";
        return $this->db->query($query)->result_array();
    }

    public function getPegawai()
    {
        $query = "SELECT `user`.*, `pegawai`.*
                    FROM `user` JOIN `pegawai`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` WHERE `user`.`role_id` != 1
                    ORDER BY date_created DESC";
        return $this->db->query($query)->result_array();

        // Detail Pegawai

        // $query = "SELECT `user`.*, `pegawai`.*, `wilayah_desa`.nama as namadesa, `wilayah_kabupaten`.nama as namakab, `wilayah_kecamatan`.nama as namakec, `wilayah_provinsi`.nama as namaprov
        //             FROM `user` JOIN `pegawai` JOIN `wilayah_desa` JOIN `wilayah_kabupaten` JOIN `wilayah_kecamatan` JOIN `wilayah_provinsi`
        //             ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` AND `pegawai`.`desa` = `wilayah_desa`.`id` AND `pegawai`.`kabupaten` = `wilayah_kabupaten`.`id` AND `pegawai`.`kecamatan` = `wilayah_kecamatan`.`id` AND `pegawai`.`provinsi` = `wilayah_provinsi`.`id`
        //             ORDER BY date_created DESC";
        // return $this->db->query($query)->result_array();
    }

    public function detailPegawai($id)
    {
        $query = "SELECT `user`.*, `pegawai`.*, `wilayah_desa`.nama as namadesa, `wilayah_kabupaten`.nama as namakab, `wilayah_kecamatan`.nama as namakec, `wilayah_provinsi`.nama as namaprov
                    FROM `user` JOIN `pegawai` JOIN `wilayah_desa` JOIN `wilayah_kabupaten` JOIN `wilayah_kecamatan` JOIN `wilayah_provinsi`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg` AND `pegawai`.`desa` = `wilayah_desa`.`id` AND `pegawai`.`kabupaten` = `wilayah_kabupaten`.`id` AND `pegawai`.`kecamatan` = `wilayah_kecamatan`.`id` AND `pegawai`.`provinsi` = `wilayah_provinsi`.`id` WHERE `user`.`id_pegawai` = $id AND `user`.`id_jabatan` = 1
                    ORDER BY date_created DESC";
        return $this->db->query($query)->row_array();
    }

    public function detailDosen($id)
    {
        $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`, `wilayah_desa`.nama as namadesa, `wilayah_kabupaten`.nama as namakab, `wilayah_kecamatan`.nama as namakec, `wilayah_provinsi`.nama as namaprov
                    FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi` JOIN `wilayah_desa` JOIN `wilayah_kabupaten` JOIN `wilayah_kecamatan` JOIN `wilayah_provinsi`
                    ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi` AND `dosen`.`desa` = `wilayah_desa`.`id` AND `dosen`.`kabupaten` = `wilayah_kabupaten`.`id` AND `dosen`.`kecamatan` = `wilayah_kecamatan`.`id` AND `dosen`.`provinsi` = `wilayah_provinsi`.`id` WHERE `user`.`id_pegawai` = $id AND `user`.`id_jabatan` = 2
                    ORDER BY date_created DESC";
        return $this->db->query($query)->row_array();
    }

    public function getPegawaiId($id)
    {
        $query = "SELECT `user`.*, `pegawai`.*
                    FROM `user` JOIN `pegawai`
                    ON `user`.`id_jabatan` = `pegawai`.`jabatan_id` AND `user`.`id_pegawai` = `pegawai`.`id_peg`
                    WHERE `user`.`id_pegawai` = $id AND `user`.`id_jabatan` = 1";
        return $this->db->query($query)->row_array();
    }

    public function getDosen()
    {
        $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                    FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                    ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi`
                    ORDER BY date_created DESC";
        return $this->db->query($query)->result_array();
    }

    public function getDosenId($id)
    {
        $query = "SELECT `user`.*, `dosen`.*, `jurusan`.`nama_jurusan`, `prog_studi`.`nama_prog_studi`
                    FROM `user` JOIN `dosen` JOIN `jurusan` JOIN `prog_studi`
                    ON `user`.`id_jabatan` = `dosen`.`jabatan_id` AND `user`.`id_pegawai` = `dosen`.`id_dosen` AND `jurusan`. `id_jurusan` = `dosen`. `jurusan` AND `prog_studi`. `id_progstudi` = `dosen`. `prog_studi` WHERE `user`.`id_pegawai` = $id AND `user`.`id_jabatan` = 2
                    ORDER BY date_created DESC";
        return $this->db->query($query)->row_array();
    }

    public function getPensiun()
    {
        $query = "SELECT `user`.*, `pensiun`.*
                    FROM `user` JOIN `pensiun` 
                    ON `user`.`id_jabatan` = `pensiun`.`jabatan_id` AND `user`.`id_pegawai` = `pensiun`.`id_pegawai`
                    ORDER BY tgl_input DESC";
        return $this->db->query($query)->result_array();
    }

    public function dataPensiun()
    {
        $query = "INSERT INTO `pensiun` (`id_pegawai`, `jabatan_id`, `nip`, `nama`, `jenis`, `unit`, `status`, `tmt_pensiun`, `jabatan`, `status_jab`, `foto`) SELECT `id_peg`, `jabatan_id`, `nip`, `nama`, `jenis_pegawai`, `unit`, 'pensiun', `pensiun`, `jabatan`, `status_jabatan`, `foto` FROM `pegawai` WHERE pensiun < CURDATE()";
        return $this->db->query($query);
    }

    public function deleteDataPensiun()
    {
        $query = "DELETE FROM `pegawai` WHERE pensiun < CURDATE()";
        return $this->db->query($query);
    }

    public function dataPensiunDosen()
    {
        $query = "INSERT INTO `pensiun` (`id_pegawai`, `jabatan_id`, `nip`, `nama`, `jenis`, `unit`, `status`, `tmt_pensiun`, `jabatan`, `status_jab`, `foto`) SELECT `id_dosen`, `jabatan_id`, `nip`, `nama`, 'dosen', `unit`, 'pensiun', `pensiun`, `jabatan_fungsi`, `status_jabatan`, `foto` FROM `dosen` WHERE pensiun < CURDATE()";
        return $this->db->query($query);
    }

    public function deleteDataPensiunDosen()
    {
        $query = "DELETE FROM `dosen` WHERE pensiun < CURDATE()";
        return $this->db->query($query);
    }

    public function berulangTahun()
    {
        // $query = "SELECT *
        //         FROM `pegawai`
        //         WHERE `tgl_lahir` = CURDATE()";
        $query = "SELECT * FROM `pegawai`";
        return $this->db->query($query)->result_array();
    }
}
