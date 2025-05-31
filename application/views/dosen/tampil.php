<main class="app-main">
<div class="app-content-header pt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Data Dosen' ?></h3>
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
                        <a href="<?= base_url('dosen/tambah') ?>" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                                <?php echo $this->session->flashdata('success'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dosen</th>
                                        <th>NIDN</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // Pastikan variabel $datadosen sudah diisi dari controller
                                    if (isset($datadosen) && (is_array($datadosen) || is_object($datadosen))) {
                                        foreach($datadosen as $dsn){
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($dsn->nama_dsn ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($dsn->nidn ?? ''); ?></td>
                                                <td>
                                                    <a href="<?= base_url('dosen/edit/' . ($dsn->id ?? '')) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="<?= base_url('dosen/hapus/' . ($dsn->id ?? '')) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>Tidak ada data dosen.</td></tr>"; // Sesuaikan colspan jika ada kolom tambahan
                                    }
                                    ?>
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
        // Pastikan jQuery dan DataTables sudah dimuat sebelum menjalankan ini
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