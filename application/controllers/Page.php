<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Load Models yang dibutuhkan
        $this->load->model('m_crud'); // Untuk jumlah mahasiswa di dashboard
        $this->load->model('m_kelas');
        $this->load->model('m_matakuliah');
        $this->load->model('m_dosen');
        $this->load->helper('url');
        $this->load->library('session'); // Pastikan session dimuat jika Anda menggunakannya untuk flashdata
    }

    private function _load_template($content_view, $data = array()) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // Membungkus konten di dalam elemen AdminLTE v4 yang benar
        echo '<div class="app-content-wrapper">'; // Awal pembungkus konten
        $this->load->view($content_view, $data);
        echo '</div>'; // Akhir pembungkus konten
        $this->load->view('templates/footer', $data);
    }

    public function index() // Ini akan menjadi dashboard default
    {
        $data['jml_mhs'] = $this->m_crud->get_jumlah();
        $data['jml_mk'] = $this->m_matakuliah->get_jumlah();
        $data['jml_kelas'] = $this->m_kelas->get_jumlah();
        $data['jml_dsn'] = $this->m_dosen->get_jumlah();
        $data['title'] = 'Dashboard';
        $this->_load_template('dashboard', $data);
    }

    public function dashboard() // Jika Anda ingin method dashboard yang terpisah dari index
    {
        $data['jml_mhs'] = $this->m_crud->get_jumlah();
        $data['jml_mk'] = $this->m_matakuliah->get_jumlah();
        $data['jml_kelas'] = $this->m_kelas->get_jumlah();
        $data['jml_dsn'] = $this->m_dosen->get_jumlah();
        $data['title'] = 'Dashboard';
        $this->_load_template('dashboard', $data);
    }

    // Ini adalah metode untuk menampilkan daftar mahasiswa
    // Yang akan dipanggil dari navigasi (sidebar)
    public function mahasiswa()
    {
        $data['datamhs'] = $this->m_crud->tampil_data()->result(); // Mengambil data mahasiswa
        $data['title'] = 'Data Mahasiswa'; // Judul halaman
        // Memuat view daftar mahasiswa
        $this->_load_template('mahasiswa/tampil', $data); // Pastikan path view sudah benar (mahasiswa/tampil)
    }

    public function kelas()
    {
        $data['datakelas'] = $this->m_kelas->tampil_data()->result();
        $data['title'] = 'Data Kelas';
        $this->_load_template('m_tampilkls', $data); // Pastikan 'm_tampilkls' adalah nama view Anda
    }

    public function matakuliah()
    {
        $data['datamk'] = $this->m_matakuliah->tampil_data()->result();
        $data['title'] = 'Data Mata Kuliah';
        $this->_load_template('m_tampilmk', $data); // Pastikan 'm_tampilmk' adalah nama view Anda
    }

    public function dosen()
    {
        $data['dosen'] = $this->m_dosen->tampil_data()->result();
        $data['title'] = 'Data Dosen';
        $this->_load_template('m_tampildsn', $data); // Pastikan 'm_tampildsn' adalah nama view Anda
    }
}