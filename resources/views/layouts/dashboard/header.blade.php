<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{asset('dashboard/images/favicon.png')}}" type="image/png">

  <title>@yield('title')</title>

  <link href="{{asset('dashboard_files/css/style.default.css')}}" rel="stylesheet">
  @stack('head')
    @if (app()->getLocale() == 'ar')

         <link href="{{asset('dashboard_files/css/style.default-rtl.css')}}" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

         <style>
             body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo' ,sans-serif !important
             }
         </style>

    @endif



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class=@if(auth()->user() == null) signin @endif>
        {{-- @if(auth()->user() == null)
        <div style="color:brown">aadcexz</div>
        @endif --}}
    <!-- Preloader -->
        <!-- Preloader -->
        {{-- <div id="preloader">
            <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
        </div>    ------------------------------problem --}}

        <section>

