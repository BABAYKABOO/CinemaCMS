@extends('layout.app')
@section('title', 'Main')
@section('img', 'img/body.jpg')
@section('content')
    <div style="text-align: center;">
        <div class="main-div" style="background-color: #f7f6f6">
            <div class="wrapper">
                <input type="radio" name="point" id="slide1" checked>
                <input type="radio" name="point" id="slide2">
                <input type="radio" name="point" id="slide3">
                <input type="radio" name="point" id="slide4">
                <input type="radio" name="point" id="slide5">
                <div class="slider">
                    <div class="slides slide1"
                         style="background-image: url(img/slider.jpg); background-size: 100%;">
                        <div class="slider-div">
                            <p class="slider-text">Тор повелитель молота и молнии</p>
                        </div>
                    </div>
                    <div class="slides slide2"
                         style="background-image: url(img/slider.jpg); background-size: 100%;">
                        <div class="slider-div">
                            <p class="slider-text">Тор повелитель молота и молнии</p>
                        </div>
                    </div>
                    <div class="slides slide3"
                         style="background-image: url(img/slider.jpg); background-size: 100%;">
                        <div class="slider-div">
                            <p class="slider-text">Тор повелитель молота и молнии</p>
                        </div>
                    </div>
                    <div class="slides slide4"
                         style="background-image: url(img/slider.jpg); background-size: 100%;">
                        <div class="slider-div">
                            <p class="slider-text">Тор повелитель молота и молнии</p>
                        </div>
                    </div>
                    <div class="slides slide5"
                         style="background-image: url(img/slider.jpg); background-size: 100%;">
                        <div class="slider-div">
                            <p class="slider-text">Тор повелитель молота и молнии</p>
                        </div>
                    </div>
                </div>
                <div class="controls">
                    <label for="slide1"></label>
                    <label for="slide2"></label>
                    <label for="slide3"></label>
                    <label for="slide4"></label>
                    <label for="slide5"></label>
                </div>
            </div>
            @foreach($movies as $movie)
                <div class="main-moviediv">
                    <div class="main-movieimg" style="background: url({{$movie->image_url}})">
                    </div>
                    <div style="height: 70px;">
                    <a class="main-moviea" href="{{$movie->seo_url}}">
                    Неоновый демон
                    </a>
                    </div>
                        <button type="button" class="btn btn-success">Купить билет</button>
                </div>
            @endforeach
        </div>
    </div>

@endsection
