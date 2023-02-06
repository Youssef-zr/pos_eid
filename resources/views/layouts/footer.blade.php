<!-- jQuery -->
<script src="{{ url('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('assets/dashboard/dist/js/adminlte.min.js') }}"></script>
<script>
    $(() => {
        $('.show-password').click(function() {
            let inptPassword = $("#password");
            if (inptPassword.prop('type') == "password") {
                inptPassword.prop('type', "text");
            } else {
                inptPassword.prop('type', "password");
            }
            let iconEye = $(this).find('i');
            iconEye.toggleClass('fa-eye fa-eye-slash');
            if (iconEye.hasClass('fa-eye')) {
                iconEye.prop('title', "show password");
            } else {
                iconEye.prop('title', "hide password");
            }
        })
    })
</script>
</body>

</html>
