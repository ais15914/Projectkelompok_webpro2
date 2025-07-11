<form action="<?= base_url('kunjungan/tambah_aksi_pasien') ?>" method="post">
  <div class="mb-3">
    <label for="dokter">Pilih Dokter</label>
    <select name="id_dokter" class="form-select" required>
      <option value="">-- Pilih Dokter --</option>
      <?php foreach ($dokter as $d): ?>
        <option value="<?= $d->id_dokter ?>"><?= $d->nama_dokter ?> (<?= $d->spesialis ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label>Keluhan</label>
    <textarea name="keluhan" class="form-control" required></textarea>
  </div>

  <div class="mb-3">
    <label>Tanggal Kunjungan</label>
    <input type="date" name="tanggal_kunjungan" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-primary">Daftar Kunjungan</button>
</form>