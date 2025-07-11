<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Edit Data Pasien</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header"><strong>Form Edit Data Pasien</strong></div>
            <div class="card-body">
              <form action="<?= base_url('pasien/update') ?>" method="post">
                <input type="hidden" name="id_pasien" value="<?= $pasien->id_pasien ?>">

                <div class="mb-3">
                  <label for="nama_pasien" class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama_pasien" class="form-control" value="<?= $pasien->nama_pasien ?>" required>
                </div>

                <div class="mb-3">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="text" name="nik" class="form-control" value="<?= $pasien->nik ?>" required>
                </div>

                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" required><?= $pasien->alamat ?></textarea>
                </div>

                <div class="mb-3">
                  <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" value="<?= $pasien->tanggal_lahir ?>" required>
                </div>

                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" <?= $pasien->jenis_kelamin == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $pasien->jenis_kelamin == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= site_url('page/pasien') ?>" class="btn btn-secondary">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>