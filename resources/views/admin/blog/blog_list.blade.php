@extends('layouts.admin_layout')

@section('title')
    Blog Posts
@stop

@section('content')
    <div class="container">
        @foreach ($posts as $key => $post)
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4"><a href="/blog/{{ $post->slug }}">{{ $post->data['title'] }}</a></span>
                    {!! $post->data['short_description'] ?? 'No Description Available' !!}
                    <div class="row">
                        <div class="col s6 l2">
                            <a href="{{ route('blog_edit', ['href' => $post->slug]) }}" class="btn blue darken-4">Edit Post</a>
                        </div>
                        <div class="col s6 l2">
                            <form class="form-horizontal" role="form" method="post" action="{{ route('blog_disable', ['href' => $post->slug]) }}">
                                {{ csrf_field() }}
                                <button class="btn blue darken-4 disable_btn">Disable Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($pages > 1)
            <ul class="pagination">
                @if ($current_page != 1)
                    <li class="disabled"><a href="{{ route('blog_admin_list', ['page' => ($current_page - 1), 'limit' => $limit]) }}"><i class="material-icons">chevron_left</i></a></li>
                @endif
                @for ($i = 1; $i <= $pages; $i++)
                    <li class="{{ $i == $current_page ? 'blue darken-2' : 'blue darken-4' }} white-text"><a class="white-text" href="{{ route('blog_admin_list', ['page' => $i]) }}">{{ $i }}</a></li>
                @endfor
                @if ($current_page != $pages)
                    <li class="waves-effect"><a href="{{ route('blog_admin_list', ['page' => ($current_page + 1)]) }}"><i class="material-icons">chevron_right</i></a></li>
                @endif
            </ul>
        @endif
    </div>
@stop

@push('body_scripts')
    <script src="/js/blog/blog_list.js"></script>
@endpush