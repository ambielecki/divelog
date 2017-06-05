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
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $page->title }}">
                            <label for="title">Title</label>
                            @if ($errors->has('title'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="form_label" for="content">Content </label>
                            <textarea id="content" name="content">{{ old('content') ? old('content') : $page->content }}</textarea>
                            @if ($errors->has('content'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('carousel_title') ? ' has-error' : '' }}">
                            <input id="carousel_title" type="text" class="form-control" name="carousel_title" value="{{ old('carousel_title') }}">
                            <label for="hero_title">Carousel Description</label>
                            @if ($errors->has('carousel_title'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('carousel_title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label class="form_label" for="image_carousel">Select Carousel Images (Max 5)</label>
                            <select multiple name="image_carousel[]" id="image_carousel" class="image-picker">
                                @foreach ($images->images as $image)
                                    <option data-img-src="/images/{{ $images->name }}/{{ $image->filename }}.jpg?size=150" value={{ $image->id }} {{ in_array($image->id, $page->images_carousel) ? "selected" : "" }}></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label class="form_label" for="image_single">Select Single Images (Max 3)</label>
                            <select multiple name="image_single[]" id="image_single" class="image-picker">
                                @foreach ($images->images as $image)
                                    <option data-img-src="/images/{{ $images->name }}/{{ $image->filename }}.jpg?size=150" value={{ $image->id }} {{ in_array($image->id, $page->images_single) ? "selected" : "" }}></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('hero_title') ? ' has-error' : '' }}">
                            <input id="hero_title" type="text" class="form-control" name="hero_title" value="{{ old('hero_title') ? old('hero_title') : $page->hero_title }}">
                            <label for="hero_title">Hero Image Title</label>
                            @if ($errors->has('hero_title'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('hero_title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label class="form_label" for="image_hero">Hero Image</label>
                            <select name="image_hero" id="image_hero" class="image-picker">
                                @foreach ($hero_images->images as $image)
                                    <option data-img-src="/images/{{ $hero_images->name }}/{{ $image->filename }}.jpg?size=150" value={{ $image->id }} {{ $image->id == $page->hero_image ? "selected" :"" }}></option>
                                @endforeach
                            </select>
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