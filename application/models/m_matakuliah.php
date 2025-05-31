<?php
class M_matakuliah extends CI_Model
{
    function tampil_data()
    {
        return $this->db->get('datamk');
    }

    function input_data($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    function hapus_data($where, $table)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    function get_jumlah()
    {
        return $this->db->count_all('datamk');
    }
}
?>