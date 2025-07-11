<?php
class M_kunjungan extends CI_Model
{
    // Menampilkan semua data kunjungan JOIN dengan pasien dan dokter (untuk admin)
    public function tampil_data()
    {
        $this->db->select('kunjungan.*, pasien.nama_pasien, dokter.nama_dokter');
        $this->db->from('kunjungan');
        $this->db->join('pasien', 'kunjungan.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'kunjungan.id_dokter = dokter.id_dokter');
        return $this->db->get();
    }

    // Menampilkan kunjungan berdasarkan dokter login
    public function get_by_dokter($id_dokter, $selesai = false)
    {
        $this->db->select('kunjungan.*, pasien.nama_pasien');
        $this->db->from('kunjungan');
        $this->db->join('pasien', 'kunjungan.id_pasien = pasien.id_pasien');
        $this->db->where('kunjungan.id_dokter', $id_dokter);

        if ($selesai) {
            $this->db->where('kunjungan.status', 'Selesai');
        } else {
            $this->db->where('kunjungan.status !=', 'Selesai');
        }

        $this->db->order_by('tanggal_kunjungan', 'DESC');
        return $this->db->get()->result();
    }

    // Menampilkan kunjungan berdasarkan pasien login
    public function get_by_pasien($id_pasien)
    {
        $this->db->select('kunjungan.*, dokter.nama_dokter');
        $this->db->from('kunjungan');
        $this->db->join('dokter', 'kunjungan.id_dokter = dokter.id_dokter');
        $this->db->where('kunjungan.id_pasien', $id_pasien);
        return $this->db->get()->result();
    }

    // Menambahkan data kunjungan
    public function input_data($data)
    {
        return $this->db->insert('kunjungan', $data);
    }

    // Menghapus data kunjungan berdasarkan ID
    public function hapus_data($id)
    {
        return $this->db->delete('kunjungan', ['id_kunjungan' => $id]);
    }

    // Mengambil data kunjungan berdasarkan ID (untuk form edit)
    public function get_by_id($id)
    {
        return $this->db->get_where('kunjungan', ['id_kunjungan' => $id])->row();
    }

    // Update data kunjungan
    public function update_data($id, $data)
    {
        $this->db->where('id_kunjungan', $id);
        return $this->db->update('kunjungan', $data);
    }

    // Menghitung jumlah semua kunjungan
    public function get_total()
    {
        return $this->db->count_all('kunjungan');
    }

    // Menghitung jumlah kunjungan yang belum selesai
    public function get_belum_selesai()
    {
        return $this->db->where('status', 'Belum')->count_all_results('kunjungan');
    }

    // Jumlah kunjungan oleh dokter
    public function count_by_dokter($id_dokter)
    {
        return $this->db->where('id_dokter', $id_dokter)->count_all_results('kunjungan');
    }

    // Jumlah kunjungan oleh pasien
    public function count_by_pasien($id_pasien)
    {
        return $this->db->where('id_pasien', $id_pasien)->count_all_results('kunjungan');
    }
    // Mendapatkan semua kunjungan yang belum selesai
    public function list_belum_selesai()
    {
        $this->db->select('kunjungan.*, pasien.nama_pasien, dokter.nama_dokter');
        $this->db->from('kunjungan');
        $this->db->join('pasien', 'kunjungan.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'kunjungan.id_dokter = dokter.id_dokter');
        $this->db->where('kunjungan.status', 'Belum');
        return $this->db->get()->result();
    }
}