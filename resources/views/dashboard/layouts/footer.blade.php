  <!-- Main Footer -->
  <footer class="main-footer">
      <strong>{!! trans('lang.copyright', ['project_name' => config('app.name') , 'current_year' => date('Y')]) !!}</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- scripts resources -->
  <script src="{{ url('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/dashboard/plugins/select2/js/select2.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ url('assets/dashboard/dist/js/adminlte.min.js') }}"></script>
  <!-- my custom script -->
  <script src="{{ url('assets/dist/js/dashboard.js') }}"></script>
  <script>
      var $currentLang = $('html').attr('lang');
      var $dir = $currentLang == "ar" ? "rtl" : "ltr";
  </script>
  @stack('js')

  <script>
      $(() => {
          setTimeout(() => {
              $('[data-toggle="tooltip"]').tooltip();
              $('select').select2({
                  dir: $dir
              });
              // open treeview in load of page
              $('.branch').find('ul li').css({
                  'display': 'block'
              })
          }, 500);
      })
  </script>

  </body>

  </html>
