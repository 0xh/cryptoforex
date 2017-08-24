<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <!-- SEO Meta -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/i.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Diamonds') }}</title>
</head>
<body>
    @include('layouts.navbar')
    <main class="main">
        <div class="container">
            <div class="content">
                @yield('content')

            </div>
        </div>
    </div>


    <div class="bgc"></div>
    <!-- Script-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/i.js"></script>
    <script src="js/d.js"></script>
</body>
</html>
