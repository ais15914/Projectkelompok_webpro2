<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Data Saya</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Informasi Pribadi</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <tr>
                  <th>Nama Lengkap</th>
                  <td><?= htmlspecialchars($dokter->nama_dokter ?? '-') ?></td>
                </tr>
                <tr>
                  <th>Spesialis</th>
                  <td><?= htmlspecialchars($dokter->spesialis ?? '-') ?></td>
                </tr>
                <tr>
                  <th>Jadwal Praktek</th>
                  <td><?= htmlspecialchars($dokter->jadwal_praktek ?? '-') ?></td>
                </tr>
              </table>

              <!-- Tombol untuk munculkan form edit -->
              <button class="btn btn-warning mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formEdit">
                Ubah Data
              </button>
            </div>
          </div>

          <!-- Form Edit (collapse) -->
          <div class="card collapse mt-3" id="formEdit">
            <div class="card-header"><strong>Edit Data Diri</strong></div>
            <div class="card-body">
              <form action="<?= base_url('dokter/update') ?>" method="post">
                <input type="hidden" name="id_dokter" value="<?= $dokter->id_dokter ?>">

                <div class="mb-3">
                  <label for="nama_dokter" class="form-label">Nama Lengkap</label>
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

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>