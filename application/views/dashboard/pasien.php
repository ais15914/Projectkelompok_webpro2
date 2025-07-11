<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Riwayat Kunjungan Saya</h3>
        </div>
        <div class="col-sm-6 text-end">
          <a href="<?= base_url('kunjungan/tambah_pasien') ?>" class="btn btn-primary">Daftar Kunjungan Baru</a>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?= $this->session->flashdata('success') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Dokter</th>
                      <th>Keluhan</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($riwayat)): ?>
                      <?php foreach ($riwayat as $r): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= htmlspecialchars($r->nama_dokter ?? '-') ?></td>
                          <td><?= htmlspecialchars($r->keluhan ?? '-') ?></td>
                          <td><?= htmlspecialchars($r->tanggal_kunjungan ?? '-') ?></td>
                          <td><?= htmlspecialchars($r->status ?? '-') ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr><td colspan="5" class="text-center">Belum ada kunjungan.</td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
