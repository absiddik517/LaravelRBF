<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('title')
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/sweet_alert/sweetalert.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('css/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('css/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('css/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('partials.topbar')
  @include('partials.sidebar')

  <div class="content-wrapper">
    @yield('body')
  </div>

  @include('partials.footer')
  @include('partials.rightSideBar')
  
  
  <div class="control-sidebar-bg"></div>
</div>


<script src="{{ asset('css/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('css/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('css/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('css/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('css/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('css/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('css/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('js/sweet_alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('css/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>

@yield('script')
</body>
</html>
