<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">
            <?= $title ?? 'Data Kunjungan' ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="<?= site_url('kunjungan/tambah') ?>" class="btn btn-primary">
                Tambah Kunjungan
              </a>
            </div>

            <div class="card-body">
              <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <i class="icon fas fa-check"></i> <?= $this->session->flashdata('success'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="icon fas fa-ban"></i> <?= $this->session->flashdata('error'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pasien</th>
                      <th>Nama Dokter</th>
                      <th>Keluhan</th>
                      <th>Tanggal Kunjungan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($datakunjungan)): ?>
                      <?php foreach($datakunjungan as $row): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= htmlspecialchars($row->nama_pasien ?? '-') ?></td>
                          <td><?= htmlspecialchars($row->nama_dokter ?? '-') ?></td>
                          <td><?= htmlspecialchars($row->keluhan ?? '-') ?></td>
                          <td><?= htmlspecialchars($row->tanggal_kunjungan ?? '-') ?></td>
                          <td><?= htmlspecialchars($row->status ?? '-') ?></td>
                          <td>
                            <a href="<?= site_url('kunjungan/edit/' . $row->id_kunjungan) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('kunjungan/hapus/' . $row->id_kunjungan) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr><td colspan="7" class="text-center">Tidak ada data kunjungan.</td></tr>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    if ($.fn.DataTable) {
      const table = $('#example1').DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
      });
      table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }

    setTimeout(() => {
      document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
    }, 5000);
  });
</script>