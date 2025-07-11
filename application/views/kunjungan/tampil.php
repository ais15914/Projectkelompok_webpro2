<?php
// application/views/kunjungan/tampil.php
?>
<main class="app-main">
<div class="app-content-header pt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Data Kunjungan' ?></h3>
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
                        <?php if (in_array($this->session->userdata('role'), ['admin', 'operator'])): ?>
                            <a href="<?= base_url('kunjungan/tambah') ?>" class="btn btn-primary">Tambah Data</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                                <?= $this->session->flashdata('success'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?= $this->session->flashdata('error'); ?>
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
                                  <?php
                                  $no = 1;
                                  foreach ($datakunjungan as $kunjungan) :
                                  ?>
                                      <tr>
                                          <td><?= $no++ ?></td>
                                          <td><?= htmlspecialchars($kunjungan->nama_pasien) ?></td>
                                          <td><?= htmlspecialchars($kunjungan->nama_dokter) ?></td>
                                          <td><?= htmlspecialchars($kunjungan->keluhan) ?></td>
                                          <td><?= htmlspecialchars($kunjungan->tanggal_kunjungan) ?></td>
                                          <td><?= htmlspecialchars($kunjungan->status) ?></td>
                                          <td>
                                              <?php if ($this->session->userdata('role') == 'admin'): ?>
                                                  <a href="<?= base_url('kunjungan/edit/' . $kunjungan->id_kunjungan) ?>" class="btn btn-warning btn-sm">Edit</a>
                                              <?php endif; ?>
                                              <?php if (in_array($this->session->userdata('role'), ['admin', 'operator'])): ?>
                                                  <a href="<?= base_url('kunjungan/hapus/' . $kunjungan->id_kunjungan) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                              <?php endif; ?>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
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
    document.addEventListener('DOMContentLoaded', function() {
        if ($.fn.DataTable) {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    });
</script>
