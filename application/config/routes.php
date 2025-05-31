<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// Default Controller dan 404
$route['default_controller'] = 'auth/login'; // Alihkan ke login sebagai default
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; // Biarkan FALSE jika URL Anda tidak menggunakan dashes

// --- Autentikasi ---
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['auth/login_action'] = 'auth/login_action';
$route['auth/register_action'] = 'auth/register_action';
$route['auth/logout'] = 'auth/logout';

// --- Dashboard ---
// Mengarahkan URL 'dashboard' ke controller Page, method index
$route['dashboard'] = 'page/index'; // Atau 'page/dashboard' jika Anda punya method dashboard()

// --- Data Mahasiswa (Tampilan List) ---
// Mengarahkan URL 'page/mahasiswa' ke controller Page, method mahasiswa
$route['page/mahasiswa'] = 'page/mahasiswa'; // Untuk menampilkan daftar mahasiswa dari Page controller

// --- Data Mahasiswa (CRUD Aksi) ---
// Semua aksi CRUD mahasiswa diarahkan ke controller Mahasiswa
$route['mahasiswa'] = 'mahasiswa/index'; // Akses langsung ke daftar mahasiswa (opsional, jika Mahasiswa/index menampilkan daftar)
$route['mahasiswa/tambah'] = 'mahasiswa/tambah'; // Menampilkan form tambah
$route['mahasiswa/tambah_aksi'] = 'mahasiswa/tambah_aksi'; // Memproses tambah
$route['mahasiswa/hapus/(:num)'] = 'mahasiswa/hapus/$1';
$route['mahasiswa/edit/(:num)'] = 'mahasiswa/edit/$1'; // Menampilkan form edit
$route['mahasiswa/update'] = 'mahasiswa/update'; // Memproses update

// --- Data Kelas ---
$route['kelas'] = 'kelas/index';
$route['kelas/tambah'] = 'kelas/tambah';
$route['kelas/tambah_aksi'] = 'kelas/tambah_aksi';
$route['kelas/hapus/(:num)'] = 'kelas/hapus/$1';
$route['kelas/edit/(:num)'] = 'kelas/edit/$1';
$route['kelas/update'] = 'kelas/update';

// --- Data Mata Kuliah ---
$route['matakuliah'] = 'matakuliah/index';
$route['matakuliah/tambah'] = 'matakuliah/tambah';
$route['matakuliah/tambah_aksi'] = 'matakuliah/tambah_aksi';
$route['matakuliah/hapus/(:num)'] = 'matakuliah/hapus/$1';
$route['matakuliah/edit/(:num)'] = 'matakuliah/edit/$1';
$route['matakuliah/update'] = 'matakuliah/update';

// --- Data Dosen ---
$route['dosen'] = 'dosen/index';
$route['dosen/tambah'] = 'dosen/tambah';
$route['dosen/tambah_aksi'] = 'dosen/tambah_aksi';
$route['dosen/hapus/(:num)'] = 'dosen/hapus/$1';
$route['dosen/edit/(:num)'] = 'dosen/edit/$1';
$route['dosen/update'] = 'dosen/update';