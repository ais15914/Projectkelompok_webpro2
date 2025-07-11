<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kunjungan');
        $this->load->model('m_pasien');
        $this->load->model('m_dokter');
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
    }

    private function _load_template($content_view, $data = [])
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        echo '<div class="app-content-wrapper">';
        $this->load->view($content_view, $data);
        echo '</div>';
        $this->load->view('templates/footer', $data);
    }

    public function index()
    {
        $data['title'] = 'Data Kunjungan';
        $data['datakunjungan'] = $this->m_kunjungan->tampil_data()->result();
        $this->_load_template('kunjungan/tampil', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Kunjungan';
        $data['datapasien'] = $this->m_pasien->tampil_data()->result();
        $data['datadokter'] = $this->m_dokter->tampil_data()->result();
        $this->_load_template('kunjungan/tambah', $data);
    }

    public function tambah_aksi()
    {
        $this->form_validation->set_rules('id_pasien', 'Pasien', 'required');
        $this->form_validation->set_rules('id_dokter', 'Dokter', 'required');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
        $this->form_validation->set_rules('tanggal_kunjungan', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Selesai,Belum]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->tambah();
        } else {
            $data = [
                'id_pasien'         => $this->input->post('id_pasien'),
                'id_dokter'         => $this->input->post('id_dokter'),
                'keluhan'           => $this->input->post('keluhan'),
                'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
                'status'            => $this->input->post('status')
            ];
            $this->m_kunjungan->input_data($data);
            $this->session->set_flashdata('success', 'Kunjungan berhasil ditambahkan.');
            redirect('kunjungan');
        }
    }

    public function hapus($id)
    {
        if ($this->m_kunjungan->hapus_data($id)) {
            $this->session->set_flashdata('success', 'Data kunjungan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('kunjungan');
    }

    public function edit($id)
    {
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak: hanya admin yang boleh mengedit.');
            redirect('kunjungan');
        }

        $data['title'] = 'Edit Kunjungan';
        $data['kunjungan'] = $this->m_kunjungan->get_by_id($id);
        $data['datapasien'] = $this->m_pasien->tampil_data()->result();
        $data['datadokter'] = $this->m_dokter->tampil_data()->result();

        if (!$data['kunjungan']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('kunjungan');
        }

        $this->_load_template('kunjungan/edit', $data);
    }

    public function update()
    {
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak: hanya admin yang boleh mengupdate.');
            redirect('kunjungan');
        }

        $this->form_validation->set_rules('id_pasien', 'Pasien', 'required');
        $this->form_validation->set_rules('id_dokter', 'Dokter', 'required');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
        $this->form_validation->set_rules('tanggal_kunjungan', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Selesai,Belum]');

        $id = $this->input->post('id_kunjungan');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->edit($id);
        } else {
            $data = [
                'id_pasien'         => $this->input->post('id_pasien'),
                'id_dokter'         => $this->input->post('id_dokter'),
                'keluhan'           => $this->input->post('keluhan'),
                'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
                'status'            => $this->input->post('status')
            ];
            $this->m_kunjungan->update_data($id, $data);
            $this->session->set_flashdata('success', 'Data kunjungan berhasil diperbarui.');
            redirect('kunjungan');
        }
    }
        public function status($id) {
        if ($this->session->userdata('role') !== 'dokter') {
            show_error('Hanya dokter yang dapat mengubah status kunjungan.');
        }

        $id_dokter = $this->session->userdata('id_dokter');
        $kunjungan = $this->m_kunjungan->get_by_id($id);

        // Cek apakah kunjungan milik dokter ini
        if (!$kunjungan || $kunjungan->id_dokter != $id_dokter) {
            show_error('Kunjungan tidak ditemukan atau bukan milik Anda.');
        }

        // Update status jadi Selesai
        $this->m_kunjungan->update_data($id, ['status' => 'Selesai']);
        $this->session->set_flashdata('success', 'Status kunjungan berhasil diperbarui.');
        redirect('dashboard');
    }
    public function tambah_pasien(){
        if ($this->session->userdata('role') !== 'pasien') {
        show_error('Akses hanya untuk pasien');
        }

        $data['dokter'] = $this->m_dokter->tampil_data()->result();
        $data['title'] = 'Daftar Kunjungan Baru';
        $this->_load_template('kunjungan/form_tambah', $data);
    }
    public function tambah_aksi_pasien()
    {
        $id_pasien = $this->session->userdata('id_pasien');

        $data = [
            'id_pasien'         => $id_pasien,
            'id_dokter'         => $this->input->post('id_dokter'),
            'keluhan'           => $this->input->post('keluhan'),
            'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
            'status'            => 'Belum'
        ];

        $this->m_kunjungan->input_data($data);
        $this->session->set_flashdata('success', 'Kunjungan berhasil didaftarkan.');
        redirect('dashboard');
    }
    public function riwayat()
    {
        $this->load->model('m_kunjungan');
        $id_dokter = $this->session->userdata('id_dokter');

        $data['title'] = 'Riwayat Kunjungan Selesai';
        $data['riwayat'] = $this->m_kunjungan->get_by_dokter($id_dokter, true);

        $this->_load_template('dashboard/dokter_riwayat', $data);
    }
    public function selesai($id_kunjungan)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'dokter') {
            show_error('Akses ditolak.');
        }

        $this->load->model('m_kunjungan');

        $updated = $this->m_kunjungan->update_data($id_kunjungan, ['status' => 'Selesai']);

        if ($updated) {
            $this->session->set_flashdata('success', 'Kunjungan ditandai selesai.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui kunjungan.');
        }

        redirect('page'); // kembali ke dashboard dokter
    }
}