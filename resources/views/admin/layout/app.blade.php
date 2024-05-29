<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{ asset('/sb_admin_2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/sb_admin_2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>

    @yield('content')

    <script src="{{ asset('/sb_admin_2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        let wrapperMinHeight = $(window).height() - ($('.navbar').height() + $('footer').height())

        $('.container-fluid').css({
            'min-height': wrapperMinHeight
        })
    </script>
    @yield('script')
</body>
</html>