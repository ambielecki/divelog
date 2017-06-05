@extends('layouts.standard')

@section('title')
    Send Password Reset
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2 card">
                <span class="card-title blue-text text-darken-4">Forgot Password</span>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email">E-Mail Address</label>
                            @if ($errors->has('email'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Send Password Reset Link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop