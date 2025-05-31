<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_dosen');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    /**
     * Helper function untuk memuat template utama.
     * Menggabungkan header, sidebar, konten spesifik, dan footer.
     *
     * @param string $content_view Nama file view yang akan dimuat sebagai konten utama.
     * @param array $data Data yang akan diteruskan ke content_view.
     */
    private function _load_template($content_view, $data = array()) {
        $this->load->view('templates/header', $data); // Tambahkan $data jika header butuh data
        $this->load->view('templates/sidebar', $data); // Tambahkan $data jika sidebar butuh data
        echo '<div class="app-content-wrapper">'; // <--- TAMBAHKAN INI UNTUK KONSISTENSI
        $this->load->view($content_view, $data);
        echo '</div>'; // <--- DAN INI UNTUK KONSISTENSI
        $this->load->view('templates/footer', $data); // Tambahkan $data jika footer butuh data
    }

    function index()
    {
        // --- PERUBAHAN DI SINI ---
        $data['datadosen'] = $this->m_dosen->tampil_data()->result(); // Ubah nama variabel menjadi datadosen
        $data['title'] = 'Data Dosen'; // Tambahkan ini agar title muncul di view
        $this->_load_template('dosen/tampil', $data); // Ubah 'm_tampildsn' ke 'dosen/tampil'
        // --- AKHIR PERUBAHAN ---
    }

    // --- PERUBAHAN DI SINI: Menambahkan method tambah() ---
    function tambah()
    {
        $data['title'] = 'Tambah Data Dosen';
        $this->_load_template('dosen/tambah', $data); // Memuat view untuk form tambah
    }
    // --- AKHIR PERUBAHAN ---

    function tambah_aksi()
    {
        $this->form_validation->set_rules('nama_dsn', 'Nama Dosen', 'required');
        $this->form_validation->set_rules('nidn', 'NIDN', 'required|is_unique[dosen.nidn]');
        // Anda bisa menambahkan validasi lain untuk kolom lain jika ada

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            // --- PERUBAHAN DI SINI ---
            $this->tambah(); // Kembali ke form tambah jika validasi gagal
            // --- AKHIR PERUBAHAN ---
        } else {
            $data_insert = array(
                'nama_dsn' => $this->input->post('nama_dsn'),
                'nidn'     => $this->input->post('nidn'),
                // Tambahkan data lain sesuai kebutuhan kolom di tabel dosen
            );

            $insert_result = $this->m_dosen->input_data($data_insert, 'dosen');

            if ($insert_result) {
                $this->session->set_flashdata('success', 'Data dosen berhasil ditambahkan.');
                // --- PERUBAHAN DI SINI ---
                redirect('dosen'); // Redirect ke daftar dosen (method index)
                // --- AKHIR PERUBAHAN ---
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan data dosen.');
                // --- PERUBAHAN DI SINI ---
                $this->tambah(); // Tetap di form tambah jika gagal insert
                // --- AKHIR PERUBAHAN ---
            }
        }
    }

    function hapus($id)
    {
        $where = array('id' => $id);
        if ($this->m_dosen->hapus_data($where, 'dosen')) {
            $this->session->set_flashdata('success', 'Data dosen berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus data dosen.');
        }
        // --- PERUBAHAN DI SINI ---
        redirect('dosen'); // Redirect ke daftar dosen (method index)
        // --- AKHIR PERUBAHAN ---
    }

    // --- PERUBAHAN DI SINI: Menambahkan method edit($id) ---
    function edit($id)
    {
        $where = array('id' => $id);
        $data['dosen'] = $this->m_dosen->edit_data($where, 'dosen')->row();
        if (!$data['dosen']) {
            $this->session->set_flashdata('error', 'Data dosen tidak ditemukan.');
            redirect('dosen');
        }
        $data['title'] = 'Edit Data Dosen';
        $this->_load_template('dosen/edit', $data); // Memuat view untuk form edit
    }
    // --- AKHIR PERUBAHAN ---

    function update()
    {
        $this->form_validation->set_rules('nama_dsn', 'Nama Dosen', 'required');
        $this->form_validation->set_rules('nidn', 'NIDN', 'required|callback_check_nidn_update'); // Hapus parameter ID di sini, akan diambil otomatis oleh callback

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            // --- PERUBAHAN DI SINI ---
            $id = $this->input->post('id'); // Ambil ID dari POST untuk redirect kembali ke form edit
            $this->edit($id); // Kembali ke form edit jika validasi gagal
            // --- AKHIR PERUBAHAN ---
        } else {
            $id = $this->input->post('id');
            $data_update = array(
                'nama_dsn' => $this->input->post('nama_dsn'),
                'nidn'     => $this->input->post('nidn'),
                // Tambahkan data lain sesuai kebutuhan kolom di tabel dosen
            );
            $where = array('id' => $id);
            if ($this->m_dosen->update_data($where, $data_update, 'dosen')) {
                $this->session->set_flashdata('success', 'Data dosen berhasil diupdate.');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengupdate data dosen.');
            }
            // --- PERUBAHAN DI SINI ---
            redirect('dosen'); // Redirect ke daftar dosen (method index)
            // --- AKHIR PERUBAHAN ---
        }
    }

    // Callback function untuk validasi keunikan NIDN saat update
    // Parameter $id akan diambil dari $this->input->post('id') di dalam fungsi
    function check_nidn_update($nidn) // Hapus parameter $id dari definisi fungsi
    {
        $id = $this->input->post('id'); // Ambil ID dari POST di sini
        $this->db->where('nidn', $nidn);
        $this->db->where('id !=', $id);
        $query = $this->db->get('dosen');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_nidn_update', 'NIDN sudah terdaftar.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}