@extends('layouts.admin_layout')

@section('title')
    Create Image Folder
@stop

@section('content')
    <div class="container image_page">
        <div class="row">
            <div class="col s12 m12 l8 offset-l2 card-panel">
                <h2 class="header blue-text text-darken-4">Create an Image Folder</h2>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('image_folder_create') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('heading') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            <label for="name">Name</label>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
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