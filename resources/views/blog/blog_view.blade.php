@extends('layouts.standard')

@section('title')
    Update - {{ $page->title }}
@stop

@section('content')
    <div class="container">
        <div class="col s12">
            <div class="row card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">{{ $page->title }}</span>
                    <div class="col s12 m6 l4">
                        @foreach ($images as $image)
                            <div class="row">
                                <div class="card">
                                    <div class="card-image">
                                        <img class="materialboxed" alt="{{ $image->description }}" src="/images/{{ $image->image_folder->name }}/{{ $image->filename }}.jpg?size=900">
                                    </div>
                                    @if($image->header)
                                        <div class="card-content">
                                            <p>{{ $image->header }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col s12 m8">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
