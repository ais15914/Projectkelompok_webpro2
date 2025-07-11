<main class="app-main">
<div class="app-content-header pt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Edit Data Kunjungan' ?></h3>
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
                        <h3 class="card-title">Form Edit Data Kunjungan</h3>
                    </div>
                    <?= form_open('kunjungan/update'); ?>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <input type="hidden" name="id_kunjungan" value="<?= htmlspecialchars($kunjungan->id_kunjungan ?? ''); ?>">

                        <!-- Pilihan Pasien -->
                        <div class="form-group mb-3">
                            <label for="id_pasien">Nama Pasien</label>
                            <select class="form-control" id="id_pasien" name="id_pasien">
                                <option value="">-- Pilih Pasien --</option>
                                <?php foreach ($datapasien as $pasien): ?>
                                    <option value="<?= $pasien->id_pasien; ?>" <?= ($pasien->id_pasien == $kunjungan->id_pasien) ? 'selected' : ''; ?>>
                                        <?= $pasien->nama_pasien; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_pasien', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Pilihan Dokter -->
                        <div class="form-group mb-3">
                            <label for="id_dokter">Nama Dokter</label>
                            <select class="form-control" id="id_dokter" name="id_dokter">
                                <option value="">-- Pilih Dokter --</option>
                                <?php foreach ($datadokter as $dokter): ?>
                                    <option value="<?= $dokter->id_dokter; ?>" <?= ($dokter->id_dokter == $kunjungan->id_dokter) ? 'selected' : ''; ?>>
                                        <?= $dokter->nama_dokter; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_dokter', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Input Keluhan -->
                        <div class="form-group mb-3">
                            <label for="keluhan">Keluhan</label>
                            <input type="text" class="form-control" id="keluhan" name="keluhan" value="<?= htmlspecialchars($kunjungan->keluhan ?? ''); ?>">
                            <?= form_error('keluhan', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Input Tanggal Kunjungan -->
                        <div class="form-group mb-3">
                            <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                            <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" value="<?= htmlspecialchars($kunjungan->tanggal_kunjungan ?? ''); ?>">
                            <?= form_error('tanggal_kunjungan', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Pilihan Status -->
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Belum" <?= ($kunjungan->status == 'Belum') ? 'selected' : ''; ?>>Belum</option>
                                <option value="Selesai" <?= ($kunjungan->status == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                            </select>
                            <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
