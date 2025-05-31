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
                        <h3 class="card-title">Form Edit Data Mahasiswa</h3>
                    </div>
                    <?= form_open('mahasiswa/update'); ?>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <input type="hidden" name="id" value="<?= htmlspecialchars($mahasiswa->id ?? ''); ?>">

                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= htmlspecialchars($mahasiswa->nama ?? ''); ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="npm">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" placeholder="Masukkan NPM" value="<?= htmlspecialchars($mahasiswa->npm ?? ''); ?>">
                            <?= form_error('npm', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="prodi">Program Studi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" placeholder="Masukkan Program Studi" value="<?= htmlspecialchars($mahasiswa->prodi ?? ''); ?>">
                            <?= form_error('prodi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat"><?= htmlspecialchars($mahasiswa->alamat ?? ''); ?></textarea>
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="<?= htmlspecialchars($mahasiswa->email ?? ''); ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="<?= base_url('mahasiswa') ?>" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                    <?= form_close(); ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>