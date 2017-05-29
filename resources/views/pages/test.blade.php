@extends('layouts.standard')

@section('title')
    Test Title
@stop

@section('content')
    <div class="row">
        <div class="col s12 m12 l6 offset-l3">
            <div class="card">
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

@push('body_scripts)
    <script>
        $(document).ready(function(){
            $('.slider').slider();
        });
    </script>
@endpush