@extends('layout.app')
@section('title', 'Cinema')
@section('content')
        <div style="margin-top:50px; margin-bottom: 50px">
            <img width="100%" height="500" src="{{$img['topbanner']}}"/>
        </div>
        <div class="row" style="margin: 0 auto; width:98%;">
            <div class="col-2" style="margin-right: 70px">
                <div style="height: 200px;">
                    <h3>Количество залов: {{count($halls)}}</h3>
                    <div style="border: 2px solid black">
                        @foreach($halls as $hall)
                            <a href="{{route('cinema-hall', [
                                 'cinema_id' => $cinema->cinema_id,
                                 'hall_id' => $hall->hall_id
                            ])}}">
                            <div style="height: 50px; width: 101%; margin-left: -1px; border: 2px solid black">
                                <p style="margin-top: 7px; margin-left: 10px; font-size: 20px;">{{$hall->number}}</p>
                            </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-9" style="width:1000px">
                <div class="row">
                    <div class="col-3">
                        <img width="150" height="100" src="{{$img['logo']}}"/>
                    </div>

                    <div class="col-8">
                        <button class="btn btn-success" style="border: 2px solid black; font-size: 30px; width: 300px; height: 60px; margin-bottom: 20px">
                            Купить билет
                        </button>
                        <div class="row" style="width: 300px; border-radius: 30px; height: 50px;text-align: center; background-color: #161f27;">
                            @foreach($types as $type)
                                <div class="col-2" style="border-radius: 15px; height: 30px; margin-left: 15px; margin-top: 10px; background-color: #0000FF; color: white;">
                                    {{$type->name}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div style="margin-top: 50px; margin-bottom: 50px">
                    {{$cinema->desc}}
                </div>
                <h1 style="text-align: center; margin-bottom: 80px">Условия</h1>
                <div class="row" style="width: 90%; padding: 10px; margin: 0 auto; text-align: center;  background-color: #161f27;">
                    @foreach($conditions as $condition)
                        <div class="col-6" style="width: 200px; color: #99a0a7; text-align: left">
                            <h3 style="color: #40a2df;">{{$condition->condition_name}}</h3>
                            <span style="margin-top: 20px">
                                {{$condition->desc}}
                            </span>
                        </div>
                    @endforeach
                </div>
                <div style="margin: 0 auto; width: 60%; margin-top: 50px">
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
                    <div class="slider">
                        @foreach($img['gallery'] as $image)
                            <div class="news-item">
                                <img src="{{$image->image_url}}" alt="слайд">
                            </div>
                        @endforeach
                        <a class="prev" onclick="minusNewsSlide()">&#10094;</a>
                        <a class="next" onclick="plusNewsSlide()">&#10095;</a>
                    </div>
                    <div class="slider-news-dots">
                        @for($i = 1; $i <= count($img['gallery']); $i++)
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
        </div>
@endsection
