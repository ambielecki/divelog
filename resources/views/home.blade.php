@extends('layouts.standard')

@section('title')
    Dive Log Repeat - Home
@stop

@section('head_2')

@stop

@section('content')
    @if($heroImage)
        <div class="row hero_image_block">
            <img class="hero_image" alt="{{ $heroImage->description }}" src="images/{{ $heroImage->image_folder->name }}/{{ $heroImage->filename }}.jpg?size"></div>
            <h2 class="hero_text">{{ $heroTitle ? $heroTitle : "Dive - Log -Repeat" }}</h2>
        </div>
    @endif
    <div class="row">
        <div class="col s12">
            <div class="row card">
                @if(!Agent::isMobile())
                    <div class="col s12 m12 l6 push-l6">
                        <div class="card blue darken-4 white-text">
                            <div class="card-image">
                                <div class="slider">
                                    <ul class="slides">
                                        @foreach($carouselImages as $image)
                                            <li>
                                                <a href="/fullimage/{{ $image->image_folder->name }}/{{ $image->filename }}.jpg"><img alt="{{ $image->description }}" src="/images/{{ $image->image_folder->name }}/{{ $image->filename }}.jpg?size=900"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <p>{{ $carouselTitle ? $carouselTitle : "Get out and dive, there is so much to see." }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col s12 m12 l6 pull-l6">
                    <div class="card-content">
                        <div class="flow-text home_page_text">
                            <h4>{{ $title }}</h4>
                            {!! $content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($singleImages))
        <div class="row">
            @foreach($singleImages as $image)
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
@stop

@push('body_scripts')
    <script>
        $(document).ready(function(){
            $('.slider').slider({
                height: 500
            });
        });
    </script>
@endpush