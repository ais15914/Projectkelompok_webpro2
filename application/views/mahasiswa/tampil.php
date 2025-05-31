<main  class="app-main">
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="mb-0">Data Mahasiswa</h3>
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
                        <a href="<?= base_url('mahasiswa/tambah') ?>" class="btn btn-primary">Tambah Data</a>
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

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Prodi</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (isset($datamhs) && (is_array($datamhs) || is_object($datamhs))) {
                                    foreach($datamhs as $mhs){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($mhs->nama ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($mhs->npm ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($mhs->prodi ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($mhs->alamat ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($mhs->email ?? ''); ?></td>
                                            <td>
                                                <a href="<?= base_url('mahasiswa/edit/' . ($mhs->id ?? '')) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= base_url('mahasiswa/hapus/' . ($mhs->id ?? '')) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data mahasiswa.</td></tr>";
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
</main>