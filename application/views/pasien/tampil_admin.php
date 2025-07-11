<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<main class="app-main">
  <div class="app-content-header pt-3">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="mb-0">Data Pasien</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- Bagian ini dihapus:
            <div class="card-header">
              <a href="<?= site_url('pasien/tambah') ?>" class="btn btn-primary">Tambah Pasien</a>
            </div>
            -->

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tablePasien">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pasien</th>
                      <th>NIK</th>
                      <th>Alamat</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($datapasien as $p): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($p->nama_pasien) ?></td>
                      <td><?= htmlspecialchars($p->nik) ?></td>
                      <td><?= htmlspecialchars($p->alamat) ?></td>
                      <td><?= htmlspecialchars($p->tanggal_lahir) ?></td>
                      <td><?= htmlspecialchars($p->jenis_kelamin) ?></td>
                      <td>
                        <a href="<?= site_url('pasien/edit/'.$p->id_pasien) ?>" class="btn btn-warning btn-sm">Edit</a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($datapasien)): ?>
                    <tr><td colspan="7" class="text-center">Belum ada data pasien.</td></tr>
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
  $(function () {
    $('#tablePasien').DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    }).buttons().container().appendTo('#tablePasien_wrapper .col-md-6:eq(0)');
  });
</script>
