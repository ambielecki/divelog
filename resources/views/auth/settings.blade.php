@extends('layouts.standard')

@section('title')
    Settings
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2 card">
                <span class="card-title blue-text text-darken-4">Update Password</span>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('user_settings') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="current_password" type="password" name="current_password" required>
                            <label for="current_password">Current Password</label>
                            @if (\Session::has('password_error'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ \Session::get('password_error') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" name="password" required>
                            <label for="password">New Password</label>
                            @if ($errors->has('password'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password_confirmation" type="password" name="password_confirmation" required>
                            <label for="password_confirmation">Confrim New Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop