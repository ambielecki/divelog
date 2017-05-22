@extends('shell.shell')

@section('head')
    @yield('head_2')
@stop

@section('layout')
    @include('header.header')
    <main>
        @yield('content')
    </main>
    @include('footer.footer')
@stop

@section('body')
    <script src="/js/master.js"></script>
    @yield('body_2')
@stop

