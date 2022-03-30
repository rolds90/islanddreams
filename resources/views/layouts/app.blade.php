<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Island Dreams Travel Services') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        {{ $css }}
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    </head>
    <body class="dark-mode hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Navbar -->
            @include('layouts.admin.navigation')
            <!-- /.navbar -->
    
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        {{ $header }}
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
    
                <!-- Main content -->
                <section class="content">
                    {{ $slot }}
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
    
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- Default to the left -->
                <strong>Copyright &copy; 2022 <a href="{{ route('welcome') }}" target="_blank">Island Dreams Travel Services</a>.</strong> All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
    
        <!-- REQUIRED SCRIPTS -->
    
        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

        @include('sweetalert::alert')

        {{ $script }}
    </body>
</html>
