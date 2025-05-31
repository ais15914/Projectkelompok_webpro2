<main class="app-main">
  <div class="container-fluid py-3">

    <!-- Header -->
    <div class="mb-3">
      <h1 class="h3">Dashboard</h1>
    </div>

    <div class="row">

      <!-- Jumlah Mahasiswa -->
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card text-white bg-info shadow">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h3><?= isset($jml_mhs) ? $jml_mhs : '0' ?></h3>
                <p class="mb-0">Jumlah Mahasiswa</p>
              </div>
              <i class="fas fa-users fa-3x opacity-75"></i>
            </div>
          </div>
          <div class="card-footer text-white text-decoration-none small">
            <a href="<?= base_url('mahasiswa') ?>" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!-- Jumlah Kelas -->
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card text-white bg-success shadow">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h3><?= isset($jml_kelas) ? $jml_kelas : '0' ?></h3>
                <p class="mb-0">Jumlah Kelas</p>
              </div>
              <i class="fas fa-building fa-3x opacity-75"></i>
            </div>
          </div>
          <div class="card-footer text-white text-decoration-none small">
            <a href="<?= base_url('kelas') ?>" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!-- Jumlah Mata Kuliah -->
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card text-dark bg-warning shadow">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h3><?= isset($jml_mk) ? $jml_mk : '0' ?></h3>
                <p class="mb-0">Jumlah Mata Kuliah</p>
              </div>
              <i class="fas fa-book fa-3x opacity-75"></i>
            </div>
          </div>
          <div class="card-footer text-dark text-decoration-none small">
            <a href="<?= base_url('matakuliah') ?>" class="text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!-- Jumlah Dosen -->
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card text-white bg-secondary shadow">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h3><?= isset($jml_dsn) ? $jml_dsn : '0' ?></h3>
                <p class="mb-0">Jumlah Dosen</p>
              </div>
              <i class="fas fa-user-tie fa-3x opacity-75"></i>
            </div>
          </div>
          <div class="card-footer text-white text-decoration-none small">
            <a href="<?= base_url('dosen') ?>" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

    </div> <!-- /row -->
  </div> <!-- /container -->
</main>
