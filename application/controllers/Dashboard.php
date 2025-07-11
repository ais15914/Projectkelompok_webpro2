<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('m_dokter');
        $this->load->model('m_pasien');
        $this->load->model('m_kunjungan');
        $this->load->model('m_users');
    }

    private function _load_template($content_view, $data = array()) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view($content_view, $data);
        $this->load->view('templates/footer', $data);
    }

    public function index() {
        $role = $this->session->userdata('role');
        $data['title'] = 'Dashboard';

        if ($role == 'admin') {
            // Statistik total untuk admin
            $data['jml_dokter']    = $this->m_dokter->get_total();
            $data['jml_pasien']    = $this->m_pasien->get_total();
            $data['jml_kunjungan'] = $this->m_kunjungan->get_total();
            $data['jml_users']     = $this->m_users->get_total();

            $data['kunjungan_terbaru'] = $this->m_kunjungan->tampil_data()->result(); // misalnya admin bisa lihat semua

            $this->_load_template('dashboard/admin', $data);

        } elseif ($role == 'dokter') {
            $id_dokter = $this->session->userdata('id_dokter');

            $data['title'] = 'Dashboard Dokter';
            $data['jml_kunjungan'] = $this->m_kunjungan->count_by_dokter($id_dokter);
            $data['kunjungan'] = $this->m_kunjungan->get_by_dokter($id_dokter, false); // tampilkan yang belum selesai

            $this->_load_template('dashboard/dokter', $data);
        }

        } elseif ($role == 'pasien') {
            $id_pasien = $this->session->userdata('id_pasien');

            $data['jml_kunjungan'] = $this->m_kunjungan->count_by_pasien($id_pasien);
            $data['riwayat']       = $this->m_kunjungan->get_by_pasien($id_pasien);

            $this->_load_template('dashboard/pasien', $data);

        } else {
            show_error('Role tidak dikenali');
        }
    }
}
