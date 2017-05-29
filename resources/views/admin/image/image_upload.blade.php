@extends('layouts.admin_layout')

@section('title')
    Upload Images
@stop

@section('content')
    <div class="container image_page">
        <div class="row">
            <div class="col s12 m12 l8 offset-l2 card-panel">
                <h2 class="header blue-text text-darken-4">Upload an Image</h2>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('image_upload') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col s12">
                            <div class="file-field input-field">
                                <div class="btn  blue darken-4">
                                    <span>File</span>
                                    <input type="file" name="photo">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                            @if ($errors->has('photo'))
                                <span class="help-block">
                                <strong class="red-text">{{ $errors->first('photo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="folder" id="folder">
                                <option value="" disabled selected>Choose a Folder</option>
                                @foreach ($folders as $folder)
                                    <option value={{ $folder->id }}>{{ ucfirst($folder->name) }}</option>
                                @endforeach
                            </select>
                            <label for="folder">Select Folder *</label>
                            @if ($errors->has('folder'))
                                <span class="help-block">
                                <strong class="red-text">{{ $errors->first('folder') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('heading') ? ' has-error' : '' }}">
                            <input id="heading" type="text" class="form-control" name="heading" value="{{ old('heading') }}">
                            <label for="heading">Heading</label>
                            @if ($errors->has('heading'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('heading') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('subheading') ? ' has-error' : '' }}">
                            <input id="subheading" type="text" name="subheading">
                            <label for="subheading">Subheading</label>
                            @if ($errors->has('subheading'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('subheading') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('description') ? ' has-error' : '' }}">
                            <input id="description" type="text" name="description">
                            <label for="description">Description (Max 140 Characters) *</label>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <input type="checkbox" name="active" id="active" {{ old('active') ? 'checked' : '' }}>
                            <label for="active">Set Active</label>
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
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
@endpush