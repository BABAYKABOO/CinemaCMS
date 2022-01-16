@extends('layout.app')
@section('title', 'Главная')
@section('img', 'img/body.jpg')
@section('content')
    <div style="text-align: center; margin-bottom: -155px;">
        <div class="main-div" style="background-color: #f7f6f6;">
            @if($positions->where('position_id', 1)->first()->status == 1)
            <div class="slider">
                @foreach($banner_main as $banner)
                    <div class="item">
                        <img src="{{$banner->image_url}}" alt="слайд">
                        <div class="slideText">{{$banner->text}}</div>
                    </div>
                @endforeach

                <a class="prev" onclick="minusSlide()">&#10094;</a>
                <a class="next" onclick="plusSlide()">&#10095;</a>
            </div>
            <div class="slider-dots">
                @for($i = 1; $i <= count($banner_main); $i++)
                    <span class="slider-dots_item" onclick="currentSlide({{$i}})"></span>
                @endfor
            </div>
            <script>
                /* Индекс слайда по умолчанию */
                var slideIndex = 1;
                showSlides(slideIndex);
                setInterval(plusSlide, {{$positions->where('position_id', 1)->first()->time * 1000}});

                /* Функция увеличивает индекс на 1, показывает следующй слайд*/
                function plusSlide() {
                    showSlides(slideIndex += 1);
                }

                /* Функция уменьшяет индекс на 1, показывает предыдущий слайд*/
                function minusSlide() {
                    showSlides(slideIndex -= 1);
                }

                /* Устанавливает текущий слайд */
                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                /* Основная функция слайдера */
                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("item");
                    var dots = document.getElementsByClassName("slider-dots_item");
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
            @endif
            <h2 style="margin-top: 50px;">Смотрите сегодня, {{$data[2]." ".$data[1]}}</h2>
            <div style="margin-bottom: 50px; width: 90%; margin: 0 auto; text-align: left;">
            @foreach($moviesToday as $movie)
                <div class="main-moviediv">
                    <div class="main-movieimg" style="background: url({{$movie->image_url}})">
                    </div>
                    <div style="height: 70px;">
                    <a class="main-moviea" href="http://cinema.com/posters/{{$movie->movie_id}}">
                        {{$movie->name}}
                    </a>
                    </div>
                        <button type="button" class="btn btn-success">Купить билет</button>
                </div>
            @endforeach
            </div>

            <h2>Смотрите скоро</h2>
            <div style="margin-bottom: 50px; width: 90%; text-align: left; margin: 0 auto;">
            @foreach($moviesSoon as $movie)
                <div class="main-moviediv">
                    <div class="main-movieimg" style="background: url({{$movie->image_url}})">
                    </div>
                    <div style="height: 70px;">
                        <a class="main-moviea" href="http://cinema.com/posters/{{$movie->movie_id}}">
                            {{$movie->name}}
                        </a>
                    </div>
                    <p class="main-psoon" >C {{ substr($movie->data, 5)}}</p>
                </div>
            @endforeach
            </div>
            @if($positions->where('position_id', 3)->first()->status == 1))
            <div style="margin-bottom: 50px">
                <h2>Новости и акции</h2>
                <div class="slider">
                    @foreach($banner_news as $banner)
                        <div class="news-item">
                            <img src="{{$banner->image_url}}" alt="слайд">
                            <div class="slideText">{{$banner->text}}</div>
                        </div>
                    @endforeach

                    <a class="prev" onclick="minusNewsSlide()">&#10094;</a>
                    <a class="next" onclick="plusNewsSlide()">&#10095;</a>
                </div>
                <div class="slider-news-dots">
                    @for($i = 1; $i <= count($banner_news); $i++)
                        <span class="slider-news-dots_item" onclick="currentNewsSlide({{$i}})"></span>
                    @endfor
                </div>
                <script>
                    /* Индекс слайда по умолчанию */
                    var slideNewsIndex = 1;
                    showNewsSlides(slideNewsIndex);
                    setInterval(plusNewsSlide, {{$positions->where('position_id', 3)->first()->time * 1000}});

                    /* Функция увеличивает индекс на 1, показывает следующй слайд*/
                    function plusNewsSlide() {
                        showNewsSlides(slideNewsIndex += 1)
                    }

                    /* Функция уменьшает индекс на 1, показывает предыдущий слайд*/
                    function minusNewsSlide() {
                        showNewsSlides(slideNewsIndex -= 1)
                    }

                    /* Устанавливает текущий слайд */
                    function currentNewsSlide(n) {
                        showNewsSlides(slideNewsIndex = n);
                    }

                    /* Основная функция слайдера */
                    function showNewsSlides(n) {
                        var i;
                        var slides = document.getElementsByClassName("news-item");
                        var dots = document.getElementsByClassName("slider-news-dots_item");
                        if (n > slides.length) {
                            slideNewsIndex = 1
                        }
                        if (n < 1) {
                            slideNewsIndex = slides.length
                        }
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideNewsIndex - 1].style.display = "block";
                        dots[slideNewsIndex - 1].className += " active";
                    }

                </script>
            </div>
            @endif
            <div style="text-align: center">
                <h4>SEO текст</h4>
                <span>{{$info_page->seo_text}}</span>
            </div>
        </div>
    </div>

@endsection
