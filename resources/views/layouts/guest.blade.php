<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Island Dreams Travel Services</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900%7CPT+Serif:400,400i,700,700i" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

  <!-- font-awesome -->
  <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

  <!-- carousel css -->
  <link href="{{ asset('js/owl-carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />

  <!--bootstrap select-->
  <link href="{{ asset('js/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('js/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />

  {{ $css }}

  <style>
    body {
      font-family: 'Montserrat';
    }
  </style>
</head>

<body class="header3">
  <!-- header start here-->
  <header>
    <div class="container">
      <div class="row">
        @include('layouts.partials.header')
      </div>
    </div>
  </header>
  <!-- header end here -->

  {{ $slot }}

  <!-- footer start here -->
  <footer class="footer3">
    <div class="container">
      @include('layouts.partials.footer')
    </div>
  </footer>
  <!-- footer end here -->

  <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
  {{ $script }}
</body>

</html>
