@extends('layout.app')
@section('title', 'О кинотеатре')
@section('content')
    <div style="margin-top: 50px; margin-bottom: 100px;">
        <img width="100%" height = "600" src="{{$page->image_url}}"/>
    </div>
    <div style="margin: 0 auto; width: 80%;">
        <h1 style="text-align: center;">{{$page->name}}</h1><br/>
        <div style="width: 90%; margin: 0 auto">
            <span>
                {{$page->desc}}
            </span>
        </div>
        <div class="row" style="margin-top: 40px; margin-bottom: 40px">
            <div class="col-4">
                <img style="width: 400px" src="{{$sub_gallery[0]->image_url}}"/>
            </div>
            <div class="col-4">
                <img style="width: 400px" src="{{$sub_gallery[1]->image_url}}"/>
            </div>
            <div class="col-4">
                <img style="width: 400px" src="{{$sub_gallery[2]->image_url}}"/>
            </div>
        </div>
        <div style="width: 90%; margin: 0 auto">
            <span>
                {{$page->sub_desc}}
            </span>
        </div>
        <div style="width: 60%; margin: 0 auto; margin-top: 60px;">
            <style>
                .slider{
                    max-width: 100%;
                    position: relative;
                    margin: auto;
                    height: 300px;
                    margin-bottom: 15px;
                    background-color: #3d4852;
                }
                .slider .news-item img {
                    object-fit: cover;
                    width: 100%;
                    height: 300px;
                    border: none !important;
                    box-shadow: none !important;
                }
            </style>
            <h3 style="text-align: center;">ФОТОГАЛЕРЕЯ</h3>
            <div class="slider">
                @foreach($gallery as $image)
                    <div class="news-item">
                        <img src="{{$image->image_url}}" alt="слайд">
                    </div>
                @endforeach
                <a class="prev" onclick="minusNewsSlide()">&#10094;</a>
                <a class="next" onclick="plusNewsSlide()">&#10095;</a>
            </div>
            <div class="slider-news-dots">
                @for($i = 1; $i <= count($gallery); $i++)
                    <span class="slider-news-dots_item" onclick="currentNewsSlide({{$i}})"></span>
                @endfor
            </div>
            <script>
                /* Индекс слайда по умолчанию */
                var slideIndex = 1;
                showNewsSlides(slideIndex);

                /* Функция увеличивает индекс на 1, показывает следующй слайд*/
                function plusNewsSlide() {
                    setInterval(showNewsSlides(slideIndex += 1), 5000);

                }

                /* Функция уменьшает индекс на 1, показывает предыдущий слайд*/
                function minusNewsSlide() {
                    setInterval(showNewsSlides(slideIndex -= 1), 5000);
                }

                /* Устанавливает текущий слайд */
                function currentNewsSlide(n) {
                    showNewsSlides(slideIndex = n);
                }

                /* Основная функция слайдера */
                function showNewsSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("news-item");
                    var dots = document.getElementsByClassName("slider-news-dots_item");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                }

            </script>
        </div>
    </div>
@endsection
