<main class="app-main">
<div class="app-content-header pt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Tambah Data Mata Kuliah' ?></h3>
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
                        <h3 class="card-title">Form Tambah Data Mata Kuliah</h3>
                    </div>
                    <?= form_open('matakuliah/tambah_aksi'); ?>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mb-3">
                            <label for="nama_mk">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama_mk" name="nama_mk" placeholder="Masukkan Nama Mata Kuliah" value="<?= set_value('nama_mk'); ?>">
                            <?= form_error('nama_mk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kode_mk">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="kode_mk" name="kode_mk" placeholder="Masukkan Kode Mata Kuliah (contoh: MK001)" value="<?= set_value('kode_mk'); ?>">
                            <?= form_error('kode_mk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="<?= base_url('matakuliah') ?>" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                    <?= form_close(); ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>