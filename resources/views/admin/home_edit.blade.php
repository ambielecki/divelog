@extends('layouts.admin_layout')

@section('title')
    Home Page - Edit
@stop

@push('head_scripts')
    <link rel="stylesheet" href="/css/image-picker.css">
@endpush

@section('content')
    <div class="container image_page">
        <div class="row">
            <div class="col s12 m12 l8 offset-l2 card-panel">
                <h2 class="header blue-text text-darken-4">Edit Home Page</h2>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('home_edit') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('title') ? ' has-error' : '' }}">
                            <input id="title" type="text" class="form-control" name="heading" value="{{ old('title') }}">
                            <label for="heading">Heading</label>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="form_label" for="content">Content </label>
                            <textarea id="content" name="content"></textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label class="form_label" for="image_carousel">Select Carousel Images (Max 5)</label>
                            <select multiple name="image_carousel[]" id="image_carousel" class="image-picker">
                                @foreach ($images->images as $image)
                                    <option data-img-src="/images/{{ $images->name }}/{{ $image->filename }}.jpg?size=150" value={{ $image->id }}></option>
                                @endforeach
                            </select>
                            @if ($errors->has('image_carousel'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('image_carousel') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label class="form_label" for="image_single">Select Single Images (Max 3)</label>
                            <select multiple name="image_single[]" id="image_single" class="image-picker">
                                @foreach ($images->images as $image)
                                    <option data-img-src="/images/{{ $images->name }}/{{ $image->filename }}.jpg?size=150" value={{ $image->id }}></option>
                                @endforeach
                            </select>
                            @if ($errors->has('image_single'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('image_single') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label class="form_label" for="image_hero">Hero Image</label>
                            <select name="image_hero" id="image_hero" class="image-picker">
                                @foreach ($heroImages->images as $image)
                                    <option data-img-src="/images/{{ $heroImages->name }}/{{ $image->filename }}.jpg?size=150" value={{ $image->id }}></option>
                                @endforeach
                            </select>
                            @if ($errors->has('image_hero'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('image_hero') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <input type="checkbox" name="active" id="active" checked>
                            <label class="form_label" for="active">Active</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('body_scripts')
    <script src="//cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>
    <script src="/js/image-picker.min.js"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('content');
            $("#image_carousel").imagepicker({
                limit: 5
            });
            $("#image_single").imagepicker({
                limit: 3
            });
            $("#image_hero").imagepicker();
        });
    </script>
@endpush