@extends('layouts.standard')

@section('title')
    Dive Log Repeat - Home
@stop

@section('content')
    @if ($image_hero)
        <div class="row hero_image_block">
            <img class="hero_image" alt="{{ $image_hero->description }}" src="images/{{ $image_hero->image_folder->name }}/{{ $image_hero->filename }}.jpg?size"></div>
            <h2 class="hero_text">{{ $page->hero_title ? $page->hero_title : "Dive - Log -Repeat" }}</h2>
        </div>
    @endif
    <div class="row">
        <div class="col s12">
            <div class="row card">
                @if (!Agent::isMobile() && $images_carousel)
                    <div class="col s12 m12 l6 push-l6">
                        <div class="card blue darken-4 white-text">
                            <div class="card-image">
                                <div class="slider">
                                    <ul class="slides">
                                        @foreach ($images_carousel as $image)
                                            <li>
                                                <a href="/fullimage/{{ $image->image_folder->name }}/{{ $image->filename }}.jpg"><img alt="{{ $image->description }}" src="/images/{{ $image->image_folder->name }}/{{ $image->filename }}.jpg?size=900"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <p>{{ $page->carousel_title ? $page->carousel_title : "Get out and dive, there is so much to see." }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col s12 m12 l6 pull-l6">
                    <div class="card-content">
                        <div class="flow-text home_page_text">
                            <h4>{{ $page->title }}</h4>
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($images_single))
        <div class="row">
            @foreach ($images_single as $image)
                <div class="col s12 l4">
                    <div class="card">
                        <div class="card-image">
                            <img class="materialboxed" alt="{{ $image->description }}" src="/images/{{ $image->image_folder->name }}/{{ $image->filename }}.jpg">
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
    @endif
    @if (count($posts))
        @foreach ($posts as $key => $post)
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                @if (!Agent::isMobile())
                                    <div class="col l2">
                                        <img class="responsive-img" src="{{ count($posts_images[$key]) ? 'images/' . $posts_images[$key][0]->image_folder->name . '/' . $posts_images[$key][0]->filename . '.jpg?size=300' : 'images/dive_flag.jpg'}}">
                                    </div>
                                @endif
                                <div class="col s12 l10">
                                    <span class="card-title blue-text text-darken-4"><a href="/blog/{{ $post->href }}">{{ $post->title }}</a></span>
                                    <div>
                                        {!! $post->short_description !!}
                                    </div>
                                    <div>
                                        <a href="{{ route('blog_edit', ['href' => $post->href]) }}" class="btn blue darken-4">Read Post</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@stop

@push('body_scripts')
    <script>
        $(document).ready(function () {
            $('.slider').slider({
                height: 500
            });
        });
    </script>
@endpush