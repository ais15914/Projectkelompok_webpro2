<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">

  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0"><?= $title ?></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">

          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('success') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('error') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <div class="table-responsive">
            <table id="tableKunjunganBelum" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Pasien</th>
                  <th>Dokter</th>
                  <th>Tanggal Kunjungan</th>
                  <th>Keluhan</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($datakunjungan as $k): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($k->nama_pasien ?? '-') ?></td>
                    <td><?= htmlspecialchars($k->nama_dokter ?? '-') ?></td>
                    <td><?= htmlspecialchars($k->tanggal_kunjungan ?? '-') ?></td>
                    <td><?= htmlspecialchars($k->keluhan ?? '-') ?></td>
                    <td><span class="badge bg-warning text-dark"><?= htmlspecialchars($k->status) ?></span></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    if ($.fn.DataTable) {
      $('#tableKunjunganBelum').DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#tableKunjunganBelum_wrapper .col-md-6:eq(0)');
    }

    setTimeout(() => {
      document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
    }, 5000);
  });
</script>
