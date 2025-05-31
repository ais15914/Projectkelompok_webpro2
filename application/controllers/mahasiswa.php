<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('m_crud');
        $this->load->helper('url');
        $this->load->library('form_validation');
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

    // Method ini bisa menampilkan daftar mahasiswa juga, opsional
    public function index()
    {
        $data['datamhs'] = $this->m_crud->tampil_data()->result();
        $data['title'] = 'Data Mahasiswa';
        $this->_load_template('mahasiswa/tampil', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Mahasiswa';
        $this->_load_template('mahasiswa/tambah', $data); // Pastikan Anda memiliki view mahasiswa/tambah.php
    }

    public function tambah_aksi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('npm', 'NPM', 'required');
        $this->form_validation->set_rules('prodi', 'Prodi', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->tambah(); // Kembali ke form tambah jika validasi gagal
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'npm' => $this->input->post('npm'),
                'prodi' => $this->input->post('prodi'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email')
            );
            $this->m_crud->input_data($data, 'datamhs');
            $this->session->set_flashdata('success', 'Data mahasiswa berhasil ditambahkan.');
            redirect('page/mahasiswa'); // Redirect ke daftar mahasiswa setelah berhasil
        }
    }

    public function hapus($id)
    {
        $where = array('id' => $id);
        $this->m_crud->hapus_data($where, 'datamhs');
        $this->session->set_flashdata('success', 'Data mahasiswa berhasil dihapus.');
        redirect('page/mahasiswa'); // Redirect ke daftar mahasiswa setelah berhasil
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data['mahasiswa'] = $this->m_crud->edit_data($where, 'datamhs')->row(); // Data diambil di sini
        if (!$data['mahasiswa']) { // Cek jika data tidak ditemukan
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('page/mahasiswa');
    }
        $data['title'] = 'Edit Data Mahasiswa';
        $this->_load_template('mahasiswa/edit', $data); // Data dikirim ke view mahasiswa/edit.php
    }

    public function update()
    {
        $id = $this->input->post('id');
        $npm = $this->input->post('npm'); // Get new NPM

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // Custom validation for NPM uniqueness during update
        $this->form_validation->set_rules('npm', 'NPM', 'required');
        $this->form_validation->set_rules('prodi', 'Prodi', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->edit($id); // Kembali ke form edit jika validasi gagal
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'npm' => $npm, // Use the new NPM
                'prodi' => $this->input->post('prodi'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email')
            );
            $where = array('id' => $id);
            $this->m_crud->update_data($where, $data, 'datamhs');
            $this->session->set_flashdata('success', 'Data mahasiswa berhasil diperbarui.');
            redirect('page/mahasiswa'); // Redirect ke daftar mahasiswa setelah berhasil
        }
    }

    // Callback function for NPM uniqueness during update
    public function check_npm_update($npm)
    {
        $id = $this->input->post('id');
        $this->db->where('npm', $npm);
        $this->db->where('id !=', $id);
        $query = $this->db->get('datamhs');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_npm_update', 'NPM ini sudah terdaftar.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}