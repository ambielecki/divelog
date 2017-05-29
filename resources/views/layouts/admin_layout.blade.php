@extends('shell.shell')

@push('head_scripts')
    <link rel="stylesheet" href="/css/admin.css">
@endpush

@section('layout')
    @include('header.admin_header')
    <main>
        @yield('content')
    </main>
    @include('footer.footer')
@stop

@push('body_scripts')
    <script src="/js/admin.js"></script>
@endpush

