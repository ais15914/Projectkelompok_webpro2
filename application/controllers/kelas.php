<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('m_kelas'); // Load model M_kelas
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    // Metode helper untuk memuat template (sama seperti di Mahasiswa.php)
    private function _load_template($content_view, $data = array()) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        echo '<div class="app-content-wrapper">';
        $this->load->view($content_view, $data);
        echo '</div>';
        $this->load->view('templates/footer', $data);
    }

    // Menampilkan daftar kelas
    public function index()
    {
        $data['datakelas'] = $this->m_kelas->tampil_data()->result();
        $data['title'] = 'Data Kelas';
        $this->_load_template('kelas/tampil', $data);
    }

    // Menampilkan form tambah kelas
    public function tambah()
    {
        $data['title'] = 'Tambah Data Kelas';
        $this->_load_template('kelas/tambah', $data);
    }

    // Aksi untuk menyimpan data kelas baru
    public function tambah_aksi()
    {
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|is_unique[datakelas.nama_kelas]');
        // --- PERUBAHAN DI SINI: Mengganti 'kapasitas' dengan 'kode_kelas' ---
        $this->form_validation->set_rules('kode_kelas', 'Kode Kelas', 'required|is_unique[datakelas.kode_kelas]'); // Tambahkan is_unique jika kode_kelas harus unik
        // --- AKHIR PERUBAHAN ---

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->tambah();
        } else {
            $data = array(
                'nama_kelas' => $this->input->post('nama_kelas'),
                // --- PERUBAHAN DI SINI ---
                'kode_kelas' => $this->input->post('kode_kelas')
                // --- AKHIR PERUBAHAN ---
            );
            $this->m_kelas->input_data($data, 'datakelas');
            $this->session->set_flashdata('success', 'Data kelas berhasil ditambahkan.');
            redirect('kelas');
        }
    }

    // Aksi untuk menghapus data kelas
    public function hapus($id)
    {
        $where = array('id' => $id);
        $this->m_kelas->hapus_data($where, 'datakelas');
        $this->session->set_flashdata('success', 'Data kelas berhasil dihapus.');
        redirect('kelas');
    }

    // Menampilkan form edit kelas dengan data terisi
    public function edit($id)
    {
        $where = array('id' => $id);
        $data['kelas'] = $this->m_kelas->edit_data($where, 'datakelas')->row();
        if (!$data['kelas']) {
            $this->session->set_flashdata('error', 'Data kelas tidak ditemukan.');
            redirect('kelas');
        }
        $data['title'] = 'Edit Data Kelas';
        $this->_load_template('kelas/edit', $data);
    }

    // Aksi untuk memperbarui data kelas
    public function update()
    {
        $id = $this->input->post('id');
        $nama_kelas_baru = $this->input->post('nama_kelas');
        $kode_kelas_baru = $this->input->post('kode_kelas'); // Ambil kode_kelas dari input

        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|callback_check_nama_kelas_update');
        // --- PERUBAHAN DI SINI: Mengganti 'kapasitas' dengan 'kode_kelas' dan menambahkan callback ---
        $this->form_validation->set_rules('kode_kelas', 'Kode Kelas', 'required|callback_check_kode_kelas_update');
        // --- AKHIR PERUBAHAN ---

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->edit($id);
        } else {
            $data = array(
                'nama_kelas' => $nama_kelas_baru,
                // --- PERUBAHAN DI SINI ---
                'kode_kelas' => $kode_kelas_baru
                // --- AKHIR PERUBAHAN ---
            );
            $where = array('id' => $id);
            $this->m_kelas->update_data($where, $data, 'datakelas');
            $this->session->set_flashdata('success', 'Data kelas berhasil diperbarui.');
            redirect('kelas');
        }
    }

    // Callback function untuk validasi keunikan nama kelas saat update (ini sudah benar untuk nama_kelas)
    public function check_nama_kelas_update($nama_kelas)
    {
        $id = $this->input->post('id');
        $this->db->where('nama_kelas', $nama_kelas);
        $this->db->where('id !=', $id);
        $query = $this->db->get('datakelas');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_nama_kelas_update', 'Nama Kelas ini sudah terdaftar.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // --- PERUBAHAN DI SINI: Menambahkan callback baru untuk kode_kelas ---
    // Callback function untuk validasi keunikan kode kelas saat update
    public function check_kode_kelas_update($kode_kelas)
    {
        $id = $this->input->post('id');
        $this->db->where('kode_kelas', $kode_kelas);
        $this->db->where('id !=', $id);
        $query = $this->db->get('datakelas');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_kode_kelas_update', 'Kode Kelas ini sudah terdaftar.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    // --- AKHIR PERUBAHAN ---
}