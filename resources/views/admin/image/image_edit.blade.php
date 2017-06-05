@extends('layouts.admin_layout')

@section('title')
    Edit Image
@stop

@section('content')
    <div class="container image_page">
        <div class="row">
            <div class="col s12 m12 l8 offset-l2 card">
                <span class="card-title blue-text text-darken-4">Edit Image</span>
                <div class="card-image">
                    <img class="materialboxed" alt="{{ $image->description }}" src="/images/{{ $image->image_folder->name }}/{{ $image->filename }}.jpg">
                </div>
                <form class="form-horizontal" role="form" method="POST" action="/admin/image/edit">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="folder" id="folder">
                                <option value="" disabled selected>Folder</option>
                                @foreach ($folders as $folder)
                                    <option value={{ $folder->id }} {{ $folder->id === $image->image_folder_id ? 'selected' : '' }}>{{ ucfirst($folder->name) }}</option>
                                @endforeach
                            </select>
                            <label for="folder">Select Folder</label>
                            @if ($errors->has('folder'))
                                <span class="red-text text-darken-2">
                                <strong class="red-text">{{ $errors->first('folder') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('heading') ? ' has-error' : '' }}">
                            <input id="heading" type="text" class="form-control" name="heading" value="{{ old('heading') ? old('heading') : $image->header }}">
                            <label for="heading">Heading</label>
                            @if ($errors->has('heading'))
                                <span class="red-text text-darken-2">
                                    <strong class="red-text">{{ $errors->first('heading') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('subheading') ? ' has-error' : '' }}">
                            <input id="subheading" type="text" name="subheading" value="{{ old('subheading') ? old('subheading') : $image->subheader }}">
                            <label for="subheading">Subheading</label>
                            @if ($errors->has('subheading'))
                                <span class="red-text text-darken-2">
                                    <strong class="red-text">{{ $errors->first('subheading') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('description') ? ' has-error' : '' }}">
                            <input id="description" type="text" name="description" value="{{ old('description') ? old('description') : $image->description }}">
                            <label for="description">Description (Max 140 Characters) *</label>
                            @if ($errors->has('description'))
                                <span class="red-text text-darken-2">
                                    <strong class="red-text">{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <input type="checkbox" name="active" id="active" {{ $image->active ? 'checked' : '' }}>
                            <label for="active">Set Active</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Submit Edit</button>
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