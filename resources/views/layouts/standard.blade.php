@extends('shell.shell')

@section('layout')
    @include('header.header')
    <main>
        @yield('content')
    </main>
    @include('footer.footer')
@stop

@push('body_scripts')
    <script src="/js/master.js"></script>
@endpush

