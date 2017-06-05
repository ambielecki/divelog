@extends('layouts.standard')

@section('title')
    Register
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2 card">
                <span class="card-title blue-text text-darken-4">Register</span>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            <label for="name">Name</label>
                            @if ($errors->has('name'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            <label for="email">E-Mail Address</label>
                            @if ($errors->has('email'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" name="password" required>
                            <label for="password">Password</label>
                            @if ($errors->has('password'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input id="password_confirmation" type="password" name="password_confirmation" required>
                            <label for="password_confirmation">Confrim Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Register</button>
                            <a href="{{ route('login') }}"> Already Registered? Go to Log In Page.</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop