<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Edit Data Dokter (Admin)</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('dokter/update') ?>" method="post">
            <input type="hidden" name="id_dokter" value="<?= $dokter->id_dokter ?>">

            <div class="mb-3">
              <label for="nama_dokter" class="form-label">Nama Dokter</label>
              <input type="text" name="nama_dokter" class="form-control" value="<?= htmlspecialchars($dokter->nama_dokter) ?>" required>
            </div>

            <div class="mb-3">
              <label for="spesialis" class="form-label">Spesialis</label>
              <input type="text" name="spesialis" class="form-control" value="<?= htmlspecialchars($dokter->spesialis) ?>" required>
            </div>

            <div class="mb-3">
              <label for="jadwal_praktek" class="form-label">Jadwal Praktek</label>
              <input type="text" name="jadwal_praktek" class="form-control" value="<?= htmlspecialchars($dokter->jadwal_praktek) ?>" required>
            </div>

            <div class="mt-4">
              <a href="<?= base_url('dokter') ?>" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>