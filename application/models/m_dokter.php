<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dokter extends CI_Model
{
    /**
     * Ambil semua data dokter
     */
    public function tampil_data()
    {
        return $this->db->get('dokter');
    }

    /**
     * Tambah data baru ke tabel dokter
     */
    public function input_data($data)
    {
        return $this->db->insert('dokter', $data);
    }

    /**
     * Hapus data dokter berdasarkan kondisi WHERE
     */
    public function hapus_data($where)
    {
        $this->db->where($where);
        return $this->db->delete('dokter');
    }

    /**
     * Ambil data dokter berdasarkan kondisi (untuk form edit)
     */
    public function edit_data($where)
    {
        return $this->db->get_where('dokter', $where);
    }

    /**
     * Update data dokter berdasarkan kondisi WHERE
     */
    public function update_data($where, $data)
    {
        $this->db->where($where);
        return $this->db->update('dokter', $data);
    }

    /**
     * Hitung jumlah semua data dokter
     */
    public function get_total()
    {
        return $this->db->count_all('dokter');
    }

    /**
     * Ambil 1 data dokter berdasarkan ID
     */
    public function get_by_id($id_dokter)
    {
        return $this->db->get_where('dokter', ['id_dokter' => $id_dokter])->row();
    }
}
