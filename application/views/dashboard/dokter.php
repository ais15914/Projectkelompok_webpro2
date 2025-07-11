<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Kunjungan Aktif Pasien</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card border-primary">
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableKunjungan" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pasien</th>
                      <th>Keluhan</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($kunjungan as $row): ?>
                        <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row->nama_pasien ?? '-') ?></td>
                        <td><?= htmlspecialchars($row->keluhan ?? '-') ?></td>
                        <td><?= htmlspecialchars($row->tanggal_kunjungan ?? '-') ?></td>
                        <td><?= htmlspecialchars($row->status ?? '-') ?></td>
                        <td>
                            <a href="<?= site_url('kunjungan/selesai/' . $row->id_kunjungan) ?>" 
                            class="btn btn-sm btn-success"
                            onclick="return confirm('Tandai kunjungan ini sebagai selesai?')">
                            Selesai
                            </a>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($kunjungan)): ?>
                        <tr><td colspan="6" class="text-center">Tidak ada kunjungan aktif.</td></tr>
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
      $('#tableKunjungan').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        searching: true,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#tableKunjungan_wrapper .col-md-6:eq(0)');
    }
  });
</script>
