@extends('layouts.admin_layout')

@section('title')
    Dive Log - Edit
@stop

@push('head_scripts')
<link rel="stylesheet" href="/css/image-picker.css">
@endpush

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">Edit Dive #{{ $dive_log->dive_number }}</span>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('divelog_edit', ['id' => $dive_log->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="dive_number" name="dive_number" value="{{ $dive_log->dive_number }}">
                        @include('divelog.divelog_form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('body_scripts')
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="//cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>
<script src="/js/image-picker.min.js"></script>
<script src="/js/divelog/divelog_create.js"></script>
<script></script>
@endpush