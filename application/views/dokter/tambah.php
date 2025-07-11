<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">

  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Tambah Data Dokter</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-body">

              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= $this->session->flashdata('error') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <form action="<?= base_url('dokter/tambah_aksi') ?>" method="post">
                <div class="mb-3">
                  <label for="nama_dokter" class="form-label">Nama Dokter</label>
                  <input type="text" name="nama_dokter" class="form-control" value="<?= set_value('nama_dokter') ?>" required>
                  <?= form_error('nama_dokter', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="mb-3">
                  <label for="spesialis" class="form-label">Spesialis</label>
                  <input type="text" name="spesialis" class="form-control" value="<?= set_value('spesialis') ?>" required>
                  <?= form_error('spesialis', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="mb-3">
                  <label for="jadwal_praktek" class="form-label">Jadwal Praktek</label>
                  <input type="text" name="jadwal_praktek" class="form-control" placeholder="Contoh: Senin - Rabu, 08:00 - 12:00" value="<?= set_value('jadwal_praktek') ?>" required>
                  <?= form_error('jadwal_praktek', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="mt-4">
                  <a href="<?= base_url('dokter') ?>" class="btn btn-secondary">Batal</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>