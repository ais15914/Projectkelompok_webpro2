<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_matakuliah');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    // Helper function untuk memuat template utama.
    // Menggabungkan header, sidebar, konten spesifik, dan footer.
    private function _load_template($content_view, $data = array()) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        echo '<div class="app-content-wrapper">'; // <--- PASTIKAN INI ADA
        $this->load->view($content_view, $data);
        echo '</div>'; // <--- PASTIKAN INI ADA
        $this->load->view('templates/footer', $data);
    }

    function index()
    {
        $data['datamk'] = $this->m_matakuliah->tampil_data()->result();
        $data['title'] = 'Data Mata Kuliah'; // Tambahkan ini agar title muncul di view
        // Menggunakan helper function _load_template
        // --- PERUBAHAN DI SINI ---
        $this->_load_template('matakuliah/tampil', $data); // Ubah 'm_tampilmk' ke 'matakuliah/tampil'
        // --- AKHIR PERUBAHAN ---
    }

    // --- PERUBAHAN DI SINI: Menambahkan method tambah() ---
    function tambah()
    {
        $data['title'] = 'Tambah Data Mata Kuliah';
        $this->_load_template('matakuliah/tambah', $data); // Memuat view untuk form tambah
    }
    // --- AKHIR PERUBAHAN ---

    function tambah_aksi()
    {
        $this->form_validation->set_rules('nama_mk', 'Nama Matakuliah', 'required');
        $this->form_validation->set_rules('kode_mk', 'Kode Matakuliah', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            // --- PERUBAHAN DI SINI ---
            $this->tambah(); // Kembali ke form tambah jika validasi gagal
            // --- AKHIR PERUBAHAN ---
        } else {
            $data = array(
                'nama_mk' => $this->input->post('nama_mk'),
                'kode_mk' => $this->input->post('kode_mk')
            );
            if ($this->m_matakuliah->input_data($data, 'datamk')) {
                $this->session->set_flashdata('success', 'Data matakuliah berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan data matakuliah.');
            }
            // --- PERUBAHAN DI SINI ---
            redirect('matakuliah'); // Redirect ke daftar matakuliah (method index)
            // --- AKHIR PERUBAHAN ---
        }
    }

    function hapus($id)
    {
        $where = array('id' => $id);
        if ($this->m_matakuliah->hapus_data($where, 'datamk')) {
            $this->session->set_flashdata('success', 'Data matakuliah berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus data matakuliah.');
        }
        // --- PERUBAHAN DI SINI ---
        redirect('matakuliah'); // Redirect ke daftar matakuliah (method index)
        // --- AKHIR PERUBAHAN ---
    }

    // --- PERUBAHAN DI SINI: Menambahkan method edit($id) ---
    function edit($id)
    {
        $where = array('id' => $id);
        $data['matakuliah'] = $this->m_matakuliah->edit_data($where, 'datamk')->row();
        if (!$data['matakuliah']) {
            $this->session->set_flashdata('error', 'Data mata kuliah tidak ditemukan.');
            redirect('matakuliah');
        }
        $data['title'] = 'Edit Data Mata Kuliah';
        $this->_load_template('matakuliah/edit', $data); // Memuat view untuk form edit
    }
    // --- AKHIR PERUBAHAN ---

    function update()
    {
        $this->form_validation->set_rules('nama_mk', 'Nama Matakuliah', 'required');
        $this->form_validation->set_rules('kode_mk', 'Kode Matakuliah', 'required'); // Hapus parameter ID di sini, akan diambil otomatis oleh callback

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            // --- PERUBAHAN DI SINI ---
            $id = $this->input->post('id'); // Ambil ID dari POST untuk redirect kembali ke form edit
            $this->edit($id); // Kembali ke form edit jika validasi gagal
            // --- AKHIR PERUBAHAN ---
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nama_mk' => $this->input->post('nama_mk'),
                'kode_mk' => $this->input->post('kode_mk')
            );
            $where = array('id' => $id);
            if ($this->m_matakuliah->update_data($where, $data, 'datamk')) {
                $this->session->set_flashdata('success', 'Data matakuliah berhasil diupdate.');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengupdate data matakuliah.');
            }
            // --- PERUBAHAN DI SINI ---
            redirect('matakuliah'); // Redirect ke daftar matakuliah (method index)
            // --- AKHIR PERUBAHAN ---
        }
    }

    // Callback function untuk validasi keunikan kode_mk saat update
    // Parameter $id akan diambil dari $this->input->post('id') di dalam fungsi
    function check_kode_mk_update($kode_mk) // Hapus parameter $id dari definisi fungsi
    {
        $id = $this->input->post('id'); // Ambil ID dari POST di sini
        $this->db->where('kode_mk', $kode_mk);
        $this->db->where('id !=', $id);
        $query = $this->db->get('datamk');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_kode_mk_update', 'Kode Matakuliah sudah terdaftar.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}