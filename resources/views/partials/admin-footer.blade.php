 <!-- jQuery 2.2.0 -->
        <script src="{{ asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
		@yield('customJs')
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('external/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin/dist/js/app.min.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
		
		
