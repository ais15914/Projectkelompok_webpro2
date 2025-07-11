<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dokter');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form']);
    }

    private function _load_template($view, $data = [])
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        echo '<div class="content-wrapper">';
        $this->load->view($view, $data);
        echo '</div>';
        $this->load->view('templates/footer');
    }

    public function index()
    {
        $data['title'] = 'Data Dokter';
        $data['datadokter'] = $this->m_dokter->tampil_data()->result();
        $this->_load_template('dokter/tampil', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Dokter';
        $this->_load_template('dokter/tambah', $data);
    }

    public function tambah_aksi()
    {
        $this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required');
        $this->form_validation->set_rules('spesialis', 'Spesialis', 'required');
        $this->form_validation->set_rules('jadwal_praktek', 'Jadwal Praktek', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->tambah();
        } else {
            $data_dokter = [
                'nama_dokter'     => $this->input->post('nama_dokter'),
                'spesialis'       => $this->input->post('spesialis'),
                'jadwal_praktek'  => $this->input->post('jadwal_praktek')
            ];
            $this->db->insert('dokter', $data_dokter);
            $id_dokter = $this->db->insert_id();

            $user_id = $this->session->userdata('temp_user_id');
            $this->db->where('id', $user_id);
            $this->db->update('users', [
                'id_dokter' => $id_dokter,
                'fullname'  => $data_dokter['nama_dokter'],
                'nama'      => $data_dokter['nama_dokter']
            ]);

            $user = $this->db->get_where('users', ['id' => $user_id])->row();
            $session_data = [
                'user_id'   => $user->id,
                'username'  => $user->username,
                'role'      => $user->role,
                'id_dokter' => $user->id_dokter,
                'logged_in' => true
            ];
            $this->session->set_userdata($session_data);
            $this->session->unset_userdata('temp_user_id');

            $this->session->set_flashdata('success', 'Selamat datang, ' . $user->fullname . '!');
            redirect('dashboard');
        }
    }

    public function edit($id)
    {
        $dokter = $this->m_dokter->get_by_id($id);
        if (!$dokter) {
            $this->session->set_flashdata('error', 'Data dokter tidak ditemukan.');
            redirect('dokter');
        }

        $data['title'] = 'Edit Data Dokter';
        $data['dokter'] = $dokter;

        $role = $this->session->userdata('role');

        if ($role === 'dokter') {
            // Cek agar dokter tidak bisa akses data dokter lain
            if ($this->session->userdata('id_dokter') != $id) {
                $this->session->set_flashdata('error', 'Tidak boleh mengedit data dokter lain.');
                redirect('dashboard');
            }
            $this->_load_template('dokter/edit_dokter', $data); // tampilan untuk dokter
        } else {
            $this->_load_template('dokter/edit_admin', $data); // tampilan untuk admin
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required');
        $this->form_validation->set_rules('spesialis', 'Spesialis', 'required');
        $this->form_validation->set_rules('jadwal_praktek', 'Jadwal Praktek', 'required');

        $id = $this->input->post('id_dokter');
        $role = $this->session->userdata('role');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->edit($id);
        } else {
            $data = [
                'nama_dokter'    => $this->input->post('nama_dokter'),
                'spesialis'      => $this->input->post('spesialis'),
                'jadwal_praktek' => $this->input->post('jadwal_praktek')
            ];

            $where = ['id_dokter' => $id];
            $this->m_dokter->update_data($where, $data);
            $this->session->set_flashdata('success', 'Data dokter berhasil diperbarui.');

            // Redirect berdasarkan role
            if ($role === 'dokter') {
                redirect('page/data_saya'); // kembali ke form dokter
            } else {
                redirect('page/dokter'); // kembali ke daftar dokter untuk admin
            }
        }
    }

    public function hapus($id)
    {
        $where = ['id_dokter' => $id];
        if ($this->m_dokter->hapus_data($where)) {
            $this->session->set_flashdata('success', 'Data dokter berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data dokter.');
        }
        redirect('dokter');
    }
}