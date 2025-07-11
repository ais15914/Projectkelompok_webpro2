<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid py-3">
  <!-- Judul Halaman -->
  <div class="mb-3">
    <h1 class="h3">Dashboard Admin</h1>
  </div>

  <div class="row">
    <!-- Jumlah Dokter -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card text-white bg-primary shadow">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h3><?= $jml_dokter ?? 0 ?></h3>
            <p class="mb-0">Jumlah Dokter</p>
          </div>
          <i class="fas fa-user-md fa-3x opacity-75"></i>
        </div>
        <div class="card-footer text-white small">
          <a href="<?= base_url('page/dokter') ?>" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Jumlah Pasien -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card text-white bg-success shadow">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h3><?= $jml_pasien ?? 0 ?></h3>
            <p class="mb-0">Jumlah Pasien</p>
          </div>
          <i class="fas fa-user-injured fa-3x opacity-75"></i>
        </div>
        <div class="card-footer text-white small">
          <a href="<?= base_url('page/pasien') ?>" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Jumlah Kunjungan -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card text-white bg-warning shadow">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h3><?= $jml_kunjungan ?? 0 ?></h3>
            <p class="mb-0">Jumlah Kunjungan</p>
          </div>
          <i class="fas fa-notes-medical fa-3x opacity-75"></i>
        </div>
        <div class="card-footer text-white small">
          <a href="<?= base_url('page/kunjungan') ?>" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Kunjungan Belum Selesai -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card text-white bg-danger shadow">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h3><?= $jml_belum ?? 0 ?></h3>
            <p class="mb-0">Belum Ditangani</p>
          </div>
          <i class="fas fa-hourglass-half fa-3x opacity-75"></i>
        </div>
        <div class="card-footer text-white small">
          <a href="<?= base_url('page/kunjungan_belum') ?>" class="text-white">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>