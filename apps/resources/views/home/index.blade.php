@extends('layout')
@section('contents')
    <div class="dashboard">
        @if(logined())
            @include('home.contents')
        @else
            <h3 class="text-center text-white">Please login to use the service!</h3>
        @endif

        <div class="db-bottom">
            <div class="banner">
                <img src="{{ asset('assets/img/BANNER.jpg') }}" alt="">
            </div>

            <div class="slider">
                <div class="slider-button">

                </div>

                <div class="slider-button">

                </div>

                <div class="slider-button">

                </div>

                <div class="slider-button">

                </div>

            </div>
        </div>
    </div>
@endsection
