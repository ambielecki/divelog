@extends('layouts.admin_layout')

@section('title')
    Blog Post - Edit
@stop

@push('head_scripts')
<link rel="stylesheet" href="/css/image-picker.css">
@endpush

@section('content')
    <div class="container image_page">
        <div class="row">
            <div class="col s12 m12 l8 offset-l2 card">
                <span class="card-title blue-text text-darken-4">Create New Blog Post</span>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('blog_edit', ['href' => $href]) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('title') ? ' has-error' : '' }}">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $post->title }}">
                            <label for="title">Title</label>
                            @if ($errors->has('title'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                            @if (session('href_error'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ session('href_error') }}</strong>
                                </span>
                            @endif
                            <span class="red-text text-darken-2" id="href_api_error" style="display:none">
                                <strong>A similar title already exists, please try again</strong>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('title') ? ' has-error' : '' }}">
                            <input disabled id="href" type="text" class="form-control" name="href" value="{{ old('href') ? old('href') : $post->href }}">
                            <label for="href"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12{{ $errors->has('short_description') ? ' has-error' : '' }}">
                            <label class="form_label" for="short_description">Short Description </label>
                            <textarea id="short_description" name="short_description">{{ old('short_description') ? old('short_description') : $post->short_description }}</textarea>
                            @if ($errors->has('short_description'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('short_description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="form_label" for="content">Content </label>
                            <textarea id="content" name="content">{{ old('content') ? old('content') : $post->content }}</textarea>
                            @if ($errors->has('content'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @if (count($images))
                        <div class="input-field col s12">
                            <select name="folder" id="folder" disabled>
                                @foreach ($image_folders as $folder)
                                    @if ($folder->id == $images[0]->image_folder->id)
                                        <option value="{{ $folder->id }}" selected>{{ ucfirst($folder->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="folder">Selected Folder</label>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label class="form_label" for="images">Select Images (Max 3)</label>
                                <select multiple name="images[]" id="images" class="image-picker">
                                    @foreach ($image_folders as $folder)
                                        @if ($folder->id == $images[0]->image_folder->id)
                                            @foreach ($folder->images as $image)
                                                <option data-img-src="/images/{{ $folder->name }}/{{ $image->filename }}.jpg?size=150" value={{ $image->id }} {{ in_array($image->id, $post->images) ? "selected" : "" }}></option>

                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="input-field col s12">
                                <select name="folder" id="folder">
                                    <option value="" disabled selected>Choose a Folder</option>
                                    @foreach ($image_folders as $folder)
                                        <option value={{ $folder->id }}>{{ ucfirst($folder->name) }}</option>
                                    @endforeach
                                </select>
                                <label for="folder">Select Folder</label>
                            </div>
                        </div>
                        <div id="target">
                            <div class="row">
                                <div class="col s12">
                                    <label class="form_label" for="images">Select Images (Max 3)</label>
                                    <image-select :select_images="images"></image-select>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Edit Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('body_scripts')
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="//cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>
<script src="/js/image-picker.min.js"></script>
<script src="/js/blog/blog_edit.js"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('content');
        CKEDITOR.replace('short_description');
    });
</script>
@endpush