<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
      <img
        src="<?= base_url('assets/assets/img/si.png') ?>"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <span class="brand-text fw-light">Data Klinik</span>
    </a>
  </div>

  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

        <?php $role = $this->session->userdata('role'); ?>

        <?php if ($role === 'admin' || $role === 'operator'): ?>
          <!-- Sidebar untuk admin / operator -->
          <li class="nav-item menu-open">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-table"></i>
              <p>
                Data Master
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('page/pasien') ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Data Pasien</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('page/dokter') ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Data Dokter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('page/kunjungan') ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Data Kunjungan</p>
                </a>
              </li>
            </ul>
          </li>

        <?php elseif ($role === 'pasien'): ?>
          <!-- Sidebar untuk pasien -->
          <li class="nav-item menu-open">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-notes-medical"></i>
              <p>Riwayat Kunjungan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('pasien/edit/' . $this->session->userdata('id_pasien')) ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Data Saya</p>
            </a>
          </li>
        <?php endif; ?>

        <?php if ($this->session->userdata('role') == 'dokter'): ?>
          <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-notes-medical"></i>
              <p>Kunjungan Aktif</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kunjungan/riwayat') ?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>Riwayat Selesai</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dokter/edit/' . $this->session->userdata('id_dokter')) ?>" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Data Saya</p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</aside>