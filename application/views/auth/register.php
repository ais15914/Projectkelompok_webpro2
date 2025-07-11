<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Register | Klinik</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.css') ?>">
</head>

<body class="register-page bg-body-secondary">
  <div class="register-box">
    <div class="register-logo mb-3">
      <a href="<?= base_url() ?>"><b>Registrasi</b> Klinik</a>
    </div>
    <div class="card">
      <div class="card-body register-card-body">
        <p class="register-box-msg">Daftar akun baru</p>

        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('auth/register_action') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <div class="input-group-text"><span class="bi bi-person-circle"></span></div>
          </div>

          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-text"><span class="bi bi-envelope-fill"></span></div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>

          <div class="input-group mb-3">
            <select name="role" class="form-select" required>
              <option value="">-- Pilih Role --</option>
              <option value="admin">Admin</option>
              <option value="dokter">Dokter</option>
              <option value="pasien">Pasien</option>
            </select>
          </div>

          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Daftar</button>
          </div>
        </form>

        <p class="mt-3 text-center">
          <a href="<?= base_url('auth/login') ?>">Sudah punya akun? Login</a>
        </p>
      </div>
    </div>
  </div>

</body>
</html>
