<?php
class M_dosen extends CI_Model
{
    function tampil_data()
    {
        return $this->db->get('dosen');
    }

    function input_data($data, $table)
    {
        $insert = $this->db->insert($table, $data);
        return $insert; // Mengembalikan nilai TRUE jika berhasil, FALSE jika gagal
    }

    function hapus_data($where, $table)
    {
        $this->db->where($where);
        $delete = $this->db->delete($table);
        return $delete; // Mengembalikan nilai TRUE jika berhasil, FALSE jika gagal
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $update = $this->db->update($table, $data);
        return $update; // Mengembalikan TRUE jika berhasil, FALSE jika gagal
    }

    function get_jumlah()
    {
        return $this->db->count_all('dosen');
    }
}
?>