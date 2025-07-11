<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * Ambil data user berdasarkan username dan password (untuk login)
     */
    public function get_user($username, $password) {
        return $this->db->get_where('users', [
            'username' => $username,
            'password' => $password
        ])->row();
    }

    /**
     * Ambil semua data user (opsional, untuk admin melihat daftar user)
     */
    public function get_all_users() {
        return $this->db->get('users')->result();
    }

    /**
     * Hitung total user (untuk admin dashboard)
     */
    public function get_total() {
        return $this->db->count_all('users');
    }

    /**
     * Ambil user berdasarkan ID (opsional untuk edit user)
     */
    public function get_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    /**
     * Tambahkan user baru (jika ada fitur buat user manual dari admin)
     */
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    /**
     * Update data user
     */
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    /**
     * Hapus user berdasarkan ID
     */
    public function delete_user($id) {
        return $this->db->delete('users', ['id' => $id]);
    }
    public function get_users_dokter_belum_terdaftar()
    {
        $this->db->where('role', 'dokter');
        $this->db->where('id_dokter', null);
        return $this->db->get('users')->result();
    }

}