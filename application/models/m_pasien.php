<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pasien extends CI_Model
{
    /**
     * Ambil semua data pasien
     */
    public function tampil_data()
    {
        return $this->db->get('pasien');
    }

    /**
     * Tambah data baru ke tabel pasien
     */
    public function input_data($data)
    {
        return $this->db->insert('pasien', $data);
    }

    /**
     * Hapus data pasien berdasarkan kondisi WHERE
     */
    public function hapus_data($where)
    {
        $this->db->where($where);
        return $this->db->delete('pasien');
    }

    /**
     * Ambil data pasien berdasarkan kondisi (untuk form edit)
     */
    public function edit_data($where)
    {
        return $this->db->get_where('pasien', $where);
    }

    /**
     * Update data pasien berdasarkan kondisi WHERE
     */
    public function update_data($where, $data)
    {
        $this->db->where($where);
        return $this->db->update('pasien', $data);
    }

    /**
     * Hitung jumlah semua pasien (untuk dashboard)
     */
    public function get_total()
    {
        return $this->db->count_all('pasien');
    }

    /**
     * Ambil 1 data pasien berdasarkan ID
     */
    public function get_by_id($id_pasien)
    {
        return $this->db->get_where('pasien', ['id_pasien' => $id_pasien])->row();
    }
}