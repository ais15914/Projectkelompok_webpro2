<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Daftar Kunjungan Baru</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <form action="<?= base_url('kunjungan/tambah_aksi_pasien') ?>" method="post">
                <!-- Pilih Dokter -->
                <div class="mb-3">
                  <label for="id_dokter" class="form-label">Pilih Dokter</label>
                  <select name="id_dokter" class="form-select" required>
                    <option value="">-- Pilih Dokter --</option>
                    <?php foreach ($dokter as $d): ?>
                      <option value="<?= $d->id_dokter ?>">
                        <?= $d->nama_dokter ?> (<?= $d->spesialis ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <!-- Keluhan -->
                <div class="mb-3">
                  <label for="keluhan" class="form-label">Keluhan</label>
                  <textarea name="keluhan" class="form-control" rows="4" required></textarea>
                </div>

                <!-- Tanggal Kunjungan -->
                <div class="mb-3">
                  <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                  <input type="date" name="tanggal_kunjungan" class="form-control" required>
                </div>

                <!-- Tombol -->
                <div class="mt-4">
                  <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Batal</a>
                  <button type="submit" class="btn btn-primary">Daftar Kunjungan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
