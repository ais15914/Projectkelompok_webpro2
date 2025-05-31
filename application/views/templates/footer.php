
      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <strong>
          Copyright &copy; 2023-2024&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">Shindy Lianti Dwi Utami</a>.
        </strong>
        All rights reserved.
      </footer>

  </div>
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
    <script src="<?= base_url('assets/js/adminlte.js') ?>"></script>
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.2/dist/umd/simple-datatables.min.js"></script>
    <script>
      // Inisialisasi simple-datatables untuk tabel dengan ID 'example1'
      document.addEventListener("DOMContentLoaded", function() {
          const dataTableElement = document.querySelector("#example1");
          if (dataTableElement) { // Cek apakah elemen ada sebelum menginisialisasi
              const dataTable = new simpleDatatables.DataTable(dataTableElement, {
                  paging: true,
                  lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                  perPage: 10,
                  searchable: true,
                  sortable: true
              });
          }
      });
    </script>

  </body>
</html>