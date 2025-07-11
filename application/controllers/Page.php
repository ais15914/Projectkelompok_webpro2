<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('m_pasien');
        $this->load->model('m_dokter');
        $this->load->model('m_kunjungan');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    /**
     * Load tampilan dengan template AdminLTE
     */
    private function _load_template($content_view, $data = array()) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        echo '<div class="content-wrapper">';
        $this->load->view($content_view, $data);
        echo '</div>';
        $this->load->view('templates/footer', $data);
    }

    public function index() {
        $role = $this->session->userdata('role');
        $data['title'] = 'Dashboard';

        if ($role == 'admin') {
            $data['jml_dokter']    = $this->m_dokter->get_total();
            $data['jml_pasien']    = $this->m_pasien->get_total();
            $data['jml_kunjungan'] = $this->m_kunjungan->get_total();
            $data['jml_users']     = $this->User_model->get_total();
            $data['jml_belum']     = $this->m_kunjungan->get_belum_selesai();
            $data['kunjungan']     = $this->m_kunjungan->tampil_data()->result();

            $this->_load_template('dashboard/admin', $data);

        } elseif ($role == 'dokter') {
            $id_dokter = $this->session->userdata('id_dokter');

            $data['title'] = 'Dashboard Dokter';
            $data['jml_kunjungan'] = $this->m_kunjungan->count_by_dokter($id_dokter);
            $data['kunjungan'] = $this->m_kunjungan->get_by_dokter($id_dokter, false);

            $this->_load_template('dashboard/dokter', $data);

        } elseif ($role == 'pasien') {
            $id_pasien = $this->session->userdata('id_pasien');

            $data['title'] = 'Dashboard Pasien';
            $data['jml_kunjungan'] = $this->m_kunjungan->count_by_pasien($id_pasien);
            $data['riwayat']       = $this->m_kunjungan->get_by_pasien($id_pasien);

            $this->_load_template('dashboard/pasien', $data);

        } else {
            show_error('Role tidak dikenali');
        }
    }

    public function pasien() {
        $role = $this->session->userdata('role');
        $data['title'] = 'Data Pasien';

        if ($role == 'admin') {
            $data['datapasien'] = $this->m_pasien->tampil_data()->result();
            $this->_load_template('pasien/tampil_admin', $data);

        } elseif ($role == 'pasien') {
            $id_pasien = $this->session->userdata('id_pasien');
            $data['pasien'] = $this->m_pasien->get_by_id($id_pasien);
            $this->_load_template('pasien/tampil', $data);

        } else {
            show_error('Akses tidak diizinkan.');
        }
    }


    public function dokter() {
        if ($this->session->userdata('role') != 'admin') {
            show_error('Akses hanya untuk admin');
        }

        $data['title'] = 'Data Dokter';
        $data['datadokter'] = $this->m_dokter->tampil_data()->result();
        $this->_load_template('dokter/tampil', $data);
    }

    public function kunjungan() {
        $role = $this->session->userdata('role');
        $data['title'] = 'Data Kunjungan';

        if ($role == 'admin') {
            $data['datakunjungan'] = $this->m_kunjungan->tampil_data()->result();
        } elseif ($role == 'dokter') {
            $id_dokter = $this->session->userdata('id_dokter');
            $data['datakunjungan'] = $this->m_kunjungan->get_by_dokter($id_dokter);
        } elseif ($role == 'pasien') {
            $id_pasien = $this->session->userdata('id_pasien');
            $data['datakunjungan'] = $this->m_kunjungan->get_by_pasien($id_pasien);
        } else {
            show_error('Akses tidak dikenali');
        }

        $this->_load_template('kunjungan/tampil', $data);
    }
    public function riwayat_dokter() {
        if ($this->session->userdata('role') !== 'dokter') {
            show_error('Akses ditolak.');
        }

        $id_dokter = $this->session->userdata('id_dokter');
        $data['title'] = 'Riwayat Kunjungan';
        $data['riwayat'] = $this->m_kunjungan->get_by_dokter($id_dokter, true); // status selesai

        $this->_load_template('dashboard/riwayat_dokter', $data);
    }

    public function data_saya()
    {
        $role = $this->session->userdata('role');

        if ($role === 'pasien') {
            $id_pasien = $this->session->userdata('id_pasien');
            $data['title'] = 'Data Saya (Pasien)';
            $data['pasien'] = $this->m_pasien->get_by_id($id_pasien);

            $this->_load_template('pasien/edit_pasien', $data);

        } elseif ($role === 'dokter') {
            $id_dokter = $this->session->userdata('id_dokter');
            $data['title'] = 'Data Saya (Dokter)';
            $data['dokter'] = $this->m_dokter->get_by_id($id_dokter);

            $this->_load_template('dokter/edit_dokter', $data);

        } else {
            show_error('Akses tidak diizinkan.');
        }
    }

    public function kunjungan_belum()
    {
        $role = $this->session->userdata('role');
        $data['title'] = 'Kunjungan Belum Ditangani';

        if ($role === 'admin') {
            // Ambil data lengkap kunjungan status 'Belum'
            $data['datakunjungan'] = $this->m_kunjungan->list_belum_selesai();
        } elseif ($role === 'dokter') {
            $id_dokter = $this->session->userdata('id_dokter');
            $data['datakunjungan'] = $this->m_kunjungan->get_by_dokter($id_dokter, false); // status != 'Selesai'
        } else {
            show_error('Akses ditolak.');
        }

        $this->_load_template('kunjungan/belum', $data);
    }
}