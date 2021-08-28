<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A'lli Turismo| @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/imagenes/icono.jpg') }}" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    @yield('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        @include('layouts.admin.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')

        </div>
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
               A'lli Turismo
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ now()->year }} <a href="{{ route('welcome') }}">Ir al inicio</a>.</strong> Derechos reservados
        </footer>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('.dropdown-toggle').dropdown();
    </script>
    @yield('js')
</body>
</html>
