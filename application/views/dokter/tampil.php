<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">

  <!-- Header -->
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Data Dokter</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <!-- <div class="card-header">
              <a href="<?= base_url('dokter/tambah') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
              </a>
            </div> -->

            <div class="card-body">
              <!-- Flash Success -->
              <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <i class="icon fas fa-check-circle"></i> <?= $this->session->flashdata('success'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <!-- Flash Error -->
              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="icon fas fa-exclamation-triangle"></i> <?= $this->session->flashdata('error'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <!-- Tabel Data -->
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Dokter</th>
                      <th>Spesialis</th>
                      <th>Jadwal Praktek</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($datadokter)): ?>
                      <?php $no = 1; foreach ($datadokter as $dkt): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= htmlspecialchars($dkt->nama_dokter) ?></td>
                          <td><?= htmlspecialchars($dkt->spesialis) ?></td>
                          <td><?= htmlspecialchars($dkt->jadwal_praktek) ?></td>
                          <td>
                            <a href="<?= base_url('dokter/edit/' . $dkt->id_dokter) ?>" class="btn btn-warning btn-sm">
                              <i class="fas fa-edit"></i> Edit
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" class="text-center">Tidak ada data dokter.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div><!-- /.card -->

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

    // Auto close alert after 5 seconds
    setTimeout(() => {
      document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
    }, 5000);
  });
</script>
