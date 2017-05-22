@extends('shell.shell')

@section('head')
    <link rel="stylesheet" href="/css/admin.css">
    @yield('head_2')
@stop

@section('layout')
    @include('header.admin_header')
    <main>
        @yield('content')
    </main>
    @include('footer.footer')
@stop

@section('body')
    <script src="/js/admin.js"></script>
    @yield('body_2')
@stop

