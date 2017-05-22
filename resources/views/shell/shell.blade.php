<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Title')</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    {{--<link rel='icon' href='/images/favicon.ico'>--}}
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <script src="https://use.fontawesome.com/f3941c2d61.js"></script>
    <link rel="stylesheet" href="/css/main.css">
    {{-- For page specific css --}}
    @yield('head')
</head>
<body class="blue lighten-5">

@yield('layout')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
@yield('body')
</body>


</html>