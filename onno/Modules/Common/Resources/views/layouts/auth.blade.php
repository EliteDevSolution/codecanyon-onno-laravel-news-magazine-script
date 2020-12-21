<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta csrf={{ csrf_token() }}>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('images/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('images/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- END favicon -->
    <title>@yield('page_title',__('app_name'))</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{static_asset('vendor')}}/bootstrap/css/bootstrap.min.css">
    <link href="{{static_asset('vendor')}}/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{static_asset('css')}}/style.css">
    <link rel="stylesheet" href="{{static_asset('vendor')}}/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="{{static_asset('css/backend-auth.css') }}">
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        @yield('content')
    </div>
    <!-- jquery 3.3.1 -->
    <script src="{{static_asset('vendor')}}/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="{{static_asset('vendor')}}/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{asset('vendor/parsley/parsley.js')}}"></script>
    @yield('script')
</body>

</html>
