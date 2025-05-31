<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta charset="utf-8" />
    <title>AdminLTE 4 | Register Page</title>

    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Register Page" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, admin dashboard, charts, calendar, datepicker, datatable"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugins-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugins-->

    <!--begin::AdminLTE CSS-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.css" />
    <!--end::AdminLTE CSS-->
  </head>
  <!--end::Head-->

  <!--begin::Body-->
  <body class="register-page bg-body-secondary">
    <div class="register-box">
      <div class="register-logo">
        <a href="<?= base_url() ?>"><b>Buat</b> Akun</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="register-box-msg">Daftar akun baru</p>

          <form action="<?= base_url('auth/register_action') ?>" method="post">
              <div class="input-group mb-3">
                  <input type="text" name="fullname" class="form-control" placeholder="Full Name" required />
                  <div class="input-group-text"><span class="bi bi-person"></span></div>
              </div>

              <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control" placeholder="Username" required />
                  <div class="input-group-text"><span class="bi bi-person-circle"></span></div>
              </div>
              <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Email" required />
                  <div class="input-group-text"><span class="bi bi-envelope-fill"></span></div>
              </div>
              <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" required />
                  <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
              </div>

              <div class="col-4">
                  <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary">Register</button>
                  </div>
              </div>
          </form>
          <p class="mb-0 mt-3 text-center">
            <a href="<?= base_url('auth/login') ?>">Saya sudah punya akun</a>
          </p>
        </div>
      </div>
    </div>

    <!--begin::Scripts-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>

    <script src="<?= base_url() ?>/assets/js/adminlte.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.querySelector('.sidebar-wrapper');
        if (wrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(wrapper, {
            scrollbars: {
              theme: 'os-theme-light',
              autoHide: 'leave',
              clickScroll: true,
            },
          });
        }
      });
    </script>
    <!--end::Scripts-->
  </body>
  <!--end::Body-->
</html>