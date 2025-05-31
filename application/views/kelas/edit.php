<main  class="app-main">
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
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Data Kelas</h3>
                    </div>
                    <?= form_open('kelas/update'); ?>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <input type="hidden" name="id" value="<?= htmlspecialchars($kelas->id ?? ''); ?>">

                        <div class="form-group mb-3">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan Nama Kelas (contoh: A1, B2)" value="<?= htmlspecialchars($kelas->nama_kelas ?? ''); ?>">
                            <?= form_error('nama_kelas', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kode_kelas">Kode Kelas</label>
                            <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" placeholder="Masukkan Kode Kelas (contoh: KLS001)" value="<?= htmlspecialchars($kelas->kode_kelas ?? ''); ?>">
                            <?= form_error('kode_kelas', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="<?= base_url('kelas') ?>" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                    <?= form_close(); ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>