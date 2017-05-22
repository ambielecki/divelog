@extends('layouts.standard')

@section('title')
    Dive Log Repeat - Home
@stop

@section('head_2')

@stop

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="row card">
                <div class="col s12 m12 l6 push-l6">
                    <div class="card blue darken-4 white-text">
                        <div class="card-image">
                            <div class="slider">
                                <ul class="slides">
                                    <li>
                                        <a href="/fullimage/sports/pic1.jpg"><img src="/images/sports/pic1.jpg?size=900"></a>
                                    </li>
                                    <li>
                                        <img src="/images/sports/pic2.jpg?size=900">
                                    </li>
                                    <li>
                                        <img src="/images/sports/pic3.jpg?size=900">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <p>A sample of some of our images</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l6 pull-l6">
                    <div class="card-content">
                        <div class="flow-text">
                            <h4>The Title</h4>
                            <p>Cras ultricies ligula sed magna dictum porta. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Cras ultricies ligula sed magna dictum porta. Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s4">
            <div class="card">
                <div class="card-image">
                    <img class="materialboxed" src="/images/home/sleeping.jpg">
                </div>
                <div class="card-content">
                    <p>Here is a great picture of Nate sleeping during the SuperBowl.</p>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="card-image">
                    <a href="/fullimage/home/sleeping.jpg"><img src="/images/home/sleeping.jpg?size=600"></a>
                </div>
                <div class="card-content">
                    <p>Here is a resized picture</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('body_2')
    <script>
        $(document).ready(function(){
            $('.slider').slider();
        });
    </script>
@stop