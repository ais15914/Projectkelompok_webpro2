<main class="app-main">
<div class="app-content-header pt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Edit Data Dosen' ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Data Dosen</h3>
                    </div>
                    <?= form_open('dosen/update'); ?>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <input type="hidden" name="id" value="<?= htmlspecialchars($dosen->id ?? ''); ?>">

                        <div class="form-group mb-3">
                            <label for="nama_dsn">Nama Dosen</label>
                            <input type="text" class="form-control" id="nama_dsn" name="nama_dsn" placeholder="Masukkan Nama Dosen" value="<?= htmlspecialchars(set_value('nama_dsn', $dosen->nama_dsn ?? '')); ?>">
                            <?= form_error('nama_dsn', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" placeholder="Masukkan NIDN" value="<?= htmlspecialchars(set_value('nidn', $dosen->nidn ?? '')); ?>">
                            <?= form_error('nidn', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="<?= base_url('dosen') ?>" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</main>