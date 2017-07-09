@extends('layouts.standard')

@section('title')
    Blog Posts
@stop

@section('content')
    <div class="container">
        @if ($posts)
            @foreach ($posts as $key => $post)
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text text-darken-4"><a href="/blog/{{ $post->href }}">{{ $post->title }}</a></span>
                        {!! $post->short_description !!}
                        <div class="row">
                            <div class="col s6 l2">
                                <a href="{{ route('updates_view', ['href' => $post->href]) }}" class="btn blue darken-4">View Post</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @include('pagination', ['route' => 'updates_list'])
        @else
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">No Posts Yet, Stay Tuned!</span>
                    <p>There are no updates posted yet, watch this space for more infor on the site or diving adventures!</p>
                </div>
            </div>
        @endif
    </div>
@stop