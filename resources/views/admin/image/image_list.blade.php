@extends('layouts.admin_layout')

@section('title')
    List Images
@stop

@push('head_scripts')
    <link rel="stylesheet" href="/css/image-picker.css">
@endpush

@section('content')
    <div class="container image_page">
        <div class="row">
            <div class="col s12 m12 l12 card-panel">
                <h2 class="header blue-text text-darken-4">Select an Image Folder</h2>
                <form class="form-horizontal" role="form" method="POST" action="/api/image/list">
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="folder" id="folder">
                                <option value="" disabled selected>Choose a Folder</option>
                                @foreach ($folders as $folder)
                                    <option value={{ $folder->id }}>{{ ucfirst($folder->name) }}</option>
                                @endforeach
                            </select>
                            <label for="folder">Select Folder</label>
                        </div>
                    </div>
                    <div id="target">
                        <div class="row">
                            <div v-if="images" class="col s12">
                                <label class="form_label" for="display_images">Images</label>
                                <image-select :select_images="images"></image-select>
                            </div>
                        </div>
                        <div class="row">
                            <div v-if="image" class="col s12">
                                <image-display :display_image="image"></image-display>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('body_scripts')
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="/js/image-picker.min.js"></script>
    <script src="/js/image_list.js"></script>
@endpush