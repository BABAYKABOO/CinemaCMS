@extends('layout.app')
@section('title', 'Фильмы')
@section('style', '/movie.css')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="margin-top: 50px; margin-bottom: 50px">
        <iframe width="100%" height="600"
                src="{{$movie->trailer}}"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
        </iframe>
    </div>
    @if($timetables[0]->data > date('Y-m-d', strtotime($timetables[0]->data . '+ 7 days')))
    <div style="width: 80%; margin: 0 auto">
        <form action="{{route('movie', $movie->movie_id)}}" method="get">
        <span style="font-size: 40px"> Расписание сеансов кинотеатра:</span>
        <select name="cinema_id" style="margin-left: 100px; font-size: 20px; height: 40px; width: 250px">
            @foreach($cinemas as $cinema)
                <option value="{{$cinema->cinema_id}}" @if(isset($_GET['cinema_id'])) @if($_GET['cinema_id'] == $cinema->cinema_id) selected @endif @endif>
                    {{$cinema->name}}
                </option>
            @endforeach
        </select>
            <div class="row" style="margin-top: 30px">
                @foreach($dates as $key => $date)
                <div target-id="{{$date}}" class="col-1" style="@if(isset($_GET['data']))
                                                                @if($_GET['data'] == $date)
                                                                background-color: rgb(192, 192, 192);
                                                                @else background-color: white;
                                                                @endif @endif border:1px solid black;margin-left: 30px;">
                    <h2>{{$key}}</h2>
                    <input class="day-week" type="radio" id="{{$date}}" name="data" value="{{$date}}" @if(isset($_GET['data']))  @if($_GET['data'] == $date) checked @endif @endif style="display: none;"/>
                    <h5>{{\App\Models\Timetable::translateMonth(explode('-',$date)[1]-1)}}</h5>
                </div>
                @endforeach
            </div>
            <div style="margin-top: 20px; text-align:right">
            <button type="submit" class="btn btn-primary ml-5" style="font-size: 25px;">Поиск расписания</button>
            </div>
            <script>
                $('div[target-id]').on('click', function() {
                    var div = $(this);
                    var target = $('#' + div.attr('target-id'));
                    if(div.css('background-color') === 'rgb(255, 255, 255)') {
                        var input = $('.day-week');
                        input.prop('checked', false);
                        input.parent().css('background-color', 'rgb(255, 255, 255)');
                        div.css('background-color', 'rgb(192, 192, 192)');
                        target.prop('checked', true);
                    }
                    else {
                        div.css('background-color', 'rgb(255, 255, 255)');
                        target.prop('checked', false);
                    }
                })
            </script>
        </form>
        <div class="row mt-5">
            @if(isset($_GET['data']))
            @if(isset($timetables[0]->timetable_id))
                @foreach($timetables as $timetable)
                    <div class="col-2" style="background-color: white; border:1px solid black; border-left: 2px solid black;margin-left: 30px;">
                        <a href="{{route('book', $timetable->timetable_id)}}" style="color: black;">
                        <div class="row">
                            <div class="col" style="border:1px solid black; border-left: none;"><span style="font-weight: 700; font-size: 30px; margin-right: 10px">{{$timetable->time}}</span></div>
                            <div class="col" style="border:1px solid black; border-left: none;"><span style="font-size: 30px">{{$timetable->name}}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-sm" style="border:1px solid black; border-left: none;"><span style="font-size: 30px;">Зал</span></div>
                            <div class="col-sm" style="border:1px solid black; border-left: none;"><span style="font-size: 30px">{{$timetable->number}}</span></div>
                        </div>
                        </a>
                    </div>
                @endforeach
            @else
                    <div><h1 style="text-align: center">На эту дату нет сеансов</h1></div>
            @endif
            @endif
        </div>
    </div>
    @else
        <div>
            <h1 style="text-align:center">Фильм еще не в показе</h1>
        </div>
    @endif
    <div style="margin-top: 50px;">
        <div class="row" style="margin: 0 auto; width: 90%;" align="center">
            <div class="col">
                <img src="{{$movie->image_url}}"/>
            </div>
            <div class="col">
                <button class="btn btn-success" style="font-size: 30px; width: 300px; height: 60px; margin-bottom: 20px">Купить билет</button>
                <h3>{{$movie->name}}</h3>
                <div style="margin-top: 70px; font-size: 15px" align="left">
                    {{$movie->desc}}
                </div>
            </div>
        </div>
        <div class="row" style="margin: 0 auto; width: 90%;" align="center">
            <div class="col">

            </div>
            <div class="col">
                <div style="width: 80%; margin-top: 50px">
                    <h3>Кадры и постеры</h3>
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
                        @foreach($gallery as $image)
                            <div class="news-item">
                                <img src="{{$image->image_url}}" alt="слайд">
                            </div>
                        @endforeach
                            <div class="news-item">
                                <img src="{{$movie->image_url}}" style="width: 200px; height: 300px" alt="слайд">
                            </div>
                        <a class="prev" onclick="minusNewsSlide()">&#10094;</a>
                        <a class="next" onclick="plusNewsSlide()">&#10095;</a>
                    </div>
                    <div class="slider-news-dots">
                        @for($i = 1; $i <= count($gallery)+1; $i++)
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
    </div>
@endsection
