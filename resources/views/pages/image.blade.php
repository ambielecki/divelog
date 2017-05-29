@extends('layouts.standard')

@section('title')
    Full Size Image
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <img class="responsive-img center-align" src="/images/{{ $folder }}/{{ $fileName }}">
            </div>
        </div>
    </div>
@stop