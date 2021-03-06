@extends('layouts.standard')

@section('title')
    Login
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2 card">
                <span class="card-title blue-text text-darken-4">Log In</span>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
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
                        <div class="input-field col s12">
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
                        <div class="col s12">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Login</button>
                            <a class="btn blue darken-4" href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('body_scripts')
<script>
    $(document).ready(function () {
        Materialize.updateTextFields();
    });
</script>
@endpush
