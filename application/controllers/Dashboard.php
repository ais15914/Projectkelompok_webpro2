<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Pastikan pengguna sudah login, jika tidak, arahkan ke halaman login
        if (!$this->session->userdata('user')) {
            redirect('auth/login');
        }
        // Load model atau library lain yang dibutuhkan di dashboard
        $this->load->model('m_crud'); // Asumsi ini adalah model untuk data mahasiswa
        $this->load->model('m_kelas');
        $this->load->model('m_matakuliah');
        $this->load->model('m_dosen');
    }

    /**
     * Helper function untuk memuat template utama.
     * Menggabungkan header, sidebar, konten spesifik, dan footer.
     *
     * @param string $content_view Nama file view yang akan dimuat sebagai konten utama.
     * @param array $data Data yang akan diteruskan ke content_view.
     */
    private function _load_template($content_view, $data = array()) {
        // Memuat header dari folder templates
        $this->load->view('templates/header');
        // Memuat sidebar dari folder templates
        $this->load->view('templates/sidebar');

        // Memuat konten spesifik halaman (misalnya dashboard.php)
        // Semua data dari controller ($data) akan tersedia di view ini
        $this->load->view($content_view, $data);

        // Memuat footer dari folder templates
        $this->load->view('templates/footer');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        // Mengambil jumlah total data dari masing-masing model
        $data['jml_mhs'] = $this->m_crud->get_total_mahasiswa();
        $data['jml_kelas'] = $this->m_kelas->get_total_kelas();
        $data['jml_mk'] = $this->m_matakuliah->get_total_matakuliah();
        $data['jml_dsn'] = $this->m_dosen->get_total_dosen();

        // Memanggil helper function _load_template untuk merender halaman dashboard
        // 'dashboard' adalah nama file view yang berisi konten spesifik dashboard Anda
        $this->_load_template('page/dashboard', $data);
    }
}