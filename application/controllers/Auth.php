<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $this->load->view('auth/login');
    }

    public function login_action() {
        $username = $this->input->post('username', true);
        $password = md5($this->input->post('password', true));

        $user = $this->User_model->get_user($username, $password);

        if ($user) {
            $session_data = [
                'user_id'   => $user->id,
                'username'  => $user->username,
                'role'      => $user->role,
                'logged_in' => true
            ];

            if ($user->role == 'dokter' || $user->role == 'admin') {
                $session_data['id_dokter'] = $user->id_dokter;
            } elseif ($user->role == 'pasien') {
                $session_data['id_pasien'] = $user->id_pasien;
            }

            $this->session->set_userdata($session_data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth/login');
        }
    }

    public function register() {
        $this->load->view('auth/register');
    }

    public function register_action() {
        $username = $this->input->post('username', true);
        $email    = $this->input->post('email', true);
        $password = md5($this->input->post('password', true));
        $role     = $this->input->post('role', true);

        // Cek username unik
        $existing = $this->db->get_where('users', ['username' => $username])->row();
        if ($existing) {
            $this->session->set_flashdata('error', 'Username sudah digunakan.');
            redirect('auth/register');
            return;
        }

        $data_user = [
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'role'     => $role,
            'fullname' => '',
            'nama'     => ''
        ];

        // Simpan ke tabel users
        $this->db->insert('users', $data_user);
        $user_id = $this->db->insert_id();

        // Simpan ID user ke session agar bisa dipakai lanjut
        $this->session->set_userdata([
            'temp_user_id' => $user_id,
            'role'         => $role
        ]);

        // Redirect sesuai role
        if ($role == 'dokter') {
            redirect('dokter/tambah');
        } elseif ($role == 'pasien') {
            redirect('pasien/tambah');
        } else {
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect('auth/login');
        }
    }


    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}