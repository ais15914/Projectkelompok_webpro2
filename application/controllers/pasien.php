<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_pasien');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    private function _load_template($content_view, $data = array()) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        echo '<div class="content-wrapper">';
        $this->load->view($content_view, $data);
        echo '</div>';
        $this->load->view('templates/footer', $data);
    }

    public function index()
    {
        $data['title'] = 'Data Pasien';
        $data['datapasien'] = $this->m_pasien->tampil_data()->result();
        $this->_load_template('pasien/tampil', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Pasien';
        $this->_load_template('pasien/tambah', $data);
    }

    public function tambah_aksi()
    {
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[pasien.nik]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->tambah();
        } else {
            // Simpan ke tabel pasien
            $data_pasien = array(
                'nama_pasien'    => $this->input->post('nama_pasien'),
                'nik'            => $this->input->post('nik'),
                'alamat'         => $this->input->post('alamat'),
                'tanggal_lahir'  => $this->input->post('tanggal_lahir'),
                'jenis_kelamin'  => $this->input->post('jenis_kelamin')
            );
            $this->db->insert('pasien', $data_pasien);
            $id_pasien = $this->db->insert_id();

            // Update tabel users berdasarkan session sementara dari register
            $user_id = $this->session->userdata('temp_user_id');
            $this->db->where('id', $user_id);
            $this->db->update('users', [
                'id_pasien' => $id_pasien,
                'fullname'  => $data_pasien['nama_pasien'],
                'nama'      => $data_pasien['nama_pasien']
            ]);

            // Auto login langsung ke dashboard
            $user = $this->db->get_where('users', ['id' => $user_id])->row();
            $session_data = [
                'user_id'   => $user->id,
                'username'  => $user->username,
                'role'      => $user->role,
                'id_pasien' => $user->id_pasien,
                'logged_in' => true
            ];
            $this->session->set_userdata($session_data);
            $this->session->unset_userdata('temp_user_id');

            $this->session->set_flashdata('success', 'Selamat datang, ' . $user->fullname . '!');
            redirect('dashboard');
        }
    }

    public function edit($id = null)
    {
        if (!$id) {
            $this->session->set_flashdata('error', 'ID pasien tidak ditemukan.');
            redirect('pasien');
            return;
        }

        $data['pasien'] = $this->m_pasien->edit_data(['id_pasien' => $id], 'pasien')->row();

        if (!$data['pasien']) {
            $this->session->set_flashdata('error', 'Data pasien tidak ditemukan.');
            redirect('pasien');
            return;
        }

        $data['title'] = 'Edit Data Pasien';

        if ($this->session->userdata('role') == 'pasien') {
            if ($this->session->userdata('id_pasien') != $id) {
                $this->session->set_flashdata('error', 'Kamu tidak diizinkan mengedit data orang lain.');
                redirect('dashboard');
                return;
            }
            $this->_load_template('pasien/edit_pasien', $data);
        } else {
            $this->_load_template('pasien/edit_admin', $data);
        }
    }


    public function update()
    {
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|callback_check_nik_update');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $id = $this->input->post('id_pasien');
            $this->edit($id);
        } else {
            $id = $this->input->post('id_pasien');
            $data = array(
                'nama_pasien'    => $this->input->post('nama_pasien'),
                'nik'            => $this->input->post('nik'),
                'alamat'         => $this->input->post('alamat'),
                'tanggal_lahir'  => $this->input->post('tanggal_lahir'),
                'jenis_kelamin'  => $this->input->post('jenis_kelamin')
            );

            $where = array('id_pasien' => $id);
            $update_pasien = $this->m_pasien->update_data($where, $data, 'pasien');

            // Sinkronkan ke tabel users jika ada relasi id_pasien
            $this->db->where('id_pasien', $id);
            $this->db->update('users', [
                'fullname' => $data['nama_pasien'],
                'nama'     => $data['nama_pasien']
            ]);

            if ($update_pasien) {
                $this->session->set_flashdata('success', 'Data pasien berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data pasien.');
            }

            // Redirect sesuai role login
            if ($this->session->userdata('role') == 'pasien') {
                redirect('page/data_saya'); // ke "Data Saya"
            } else {
                redirect('page/pasien'); // ke data semua pasien
            }
        }
    }

    public function hapus($id)
    {
        $where = array('id_pasien' => $id);
        if ($this->m_pasien->hapus_data($where, 'pasien')) {
            $this->session->set_flashdata('success', 'Data pasien berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pasien.');
        }
        redirect('page/pasien');
    }

    public function check_nik_update($nik)
    {
        $id = $this->input->post('id_pasien');
        $this->db->where('nik', $nik);
        $this->db->where('id_pasien !=', $id);
        $query = $this->db->get('pasien');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_nik_update', 'NIK sudah digunakan.');
            return FALSE;
        }
        return TRUE;
    }

}
