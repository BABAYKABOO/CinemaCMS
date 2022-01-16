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

    <div style="width: 80%; margin: 0 auto">
        <form action="{{route('movie', $movie->movie_id)}}" method="get">
            <div class="row" >
                <div class="col">
                    <span style="font-size: 30px"> Расписание сеансов кинотеатра:</span>
                </div>
                <div class="col-3">
                    <select name="cinema_id" style="font-size: 20px; height: 40px; width: 250px">
                        @foreach($cinemas as $cinema)
                            <option value="{{$cinema->cinema_id}}" @if(isset($_GET['cinema_id'])) @if($_GET['cinema_id'] == $cinema->cinema_id) selected @endif @endif>
                                {{$cinema->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div target-id="type_all" class="col-1" style="@if(isset($_GET['type_id']))
                @if($_GET['type_id'] == 'all')
                    background-color: rgb(192, 192, 192);
                @else background-color: white;
                @endif @endif cursor: pointer; text-align:center; border:1px solid black;">
                    <h2>Все</h2>
                    <input class="types" type="radio" id="type_all" name="type_id" value="all" @if(isset($_GET['type_id']))  @if($_GET['type_id'] == 'all') checked @endif @endif style="display: none;"/>
                </div>
                @foreach($types as $type)
                    <div target-id="type_{{$type->type_id}}" class="col-1" style="@if(isset($_GET['type_id']))
                    @if($_GET['type_id'] == $type->type_id)
                        background-color: rgb(192, 192, 192);
                    @else background-color: white;
                    @endif @endif cursor: pointer; text-align:center; border:1px solid black;margin-left: 20px;">
                        <h2>{{$type->name}}</h2>
                        <input class="types" type="radio" id="type_{{$type->type_id}}" name="type_id" value="{{$type->type_id}}" @if(isset($_GET['type_id']))  @if($_GET['type_id'] == $type->type_id) checked @endif @endif style="display: none;"/>
                    </div>
                @endforeach
            </div>
            <div class="row" style=" margin-top: 30px">
                @foreach($dates as $key => $date)
                <div target-id="{{$date}}" class="col-1" style="@if(isset($_GET['data']))
                                                                @if($_GET['data'] == $date)
                                                                background-color: rgb(192, 192, 192);
                                                                @else background-color: white;
                                                                @endif @endif cursor: pointer; border:1px solid black;margin-left: 30px;">
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
                        var input = $('.' + target.attr('class'));
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
        @if(isset($timetables[0]) && $timetables[0]->data <= date('Y-m-d', strtotime($timetables[0]->data . '+ 7 days')))
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
            <h1 style="text-align:center">Фильм не в показе</h1>
        </div>
        @endif
    <div style="margin-top: 50px;">
        <div class="row" style="margin: 0 auto; width: 90%;" align="center">
            <div class="col">
                <img src="{{$movie->image_url}}" style="margin-bottom: 10px;height: 375px;width: 250px;background: url({{$movie->image_url}});background-size: 100%;"/>
            </div>
            <div class="col">
                <button class="btn btn-success" style="font-size: 30px; width: 300px; height: 60px; margin-bottom: 20px">Купить билет</button>
                <h3>{{$movie->name}}</h3>
                <div style="margin-top: 70px; font-size: 15px" align="left">
                    {{$movie->desc}}
                </div>
            </div>
        </div>
        <div class="row" style="margin: 0 auto; margin-top: 50px; width: 90%;" align="center">
            <div class="col">
                <div style="width: 90%; border: 1px solid black; background-color: #252f3a; color: white; text-align: left; padding: 20px;">
                    <div class="row" style="margin:0 auto;width: 100%;background-color: #181f28;">
                        <div class="col" style="height: 35px; padding: 5px">
                            <h5>Год</h5>
                        </div>
                        <div class="col" style="height: 35px; padding: 5px; color: #99a1aa">
                            <span class="valuespan">{{$movie->year}}</span>
                        </div>
                    </div>
                    <div class="row" style="margin:0 auto;width: 100%;">
                        <div class="col" style="height: 35px; padding: 5px">
                            <h5>Страна</h5>
                        </div>
                        <div class="col" style="height: 35px; padding: 5px; color: #99a1aa">
                            <span class="valuespan">{{$movie->country}}</span>
                        </div>
                    </div>
                    @php($i = true)
                    @foreach($people as $person)
                        <div class="row" style="margin:0 auto;width: 100%;@if($i == true) background-color: #181f28; @endif">
                            <div class="col" style="height: 35px; padding: 5px">
                                <h5>{{$person->position_name}}</h5>
                            </div>
                            <div class="col" style="height: 35px; padding: 5px; color: #99a1aa">
                                <span class="valuespan">{{$person->name}}</span>
                            </div>
                        </div>
                        @php($i = $i == true ? false : true)
                    @endforeach
                    <div class="row" style="margin:0 auto;width: 100%;@if($i == true) background-color: #181f28; @endif">
                        <div class="col" style="height: 35px; padding: 5px">
                            <h5>Жанр</h5>
                        </div>
                        <div class="col" style="height: min-content; padding: 5px; color: #99a1aa">
                            <span class="valuespan">@foreach($genres as $genre){{$genre->name . ' | '}}@endforeach</span>
                        </div>
                        @php($i = $i == true ? false : true)
                    </div>
                    <div class="row" style="margin:0 auto;width: 100%;@if($i == true) background-color: #181f28; @endif">
                        <div class="col" style="height: 35px; padding: 5px">
                            <h5>Бюджет</h5>
                        </div>
                        <div class="col" style="height: 35px; padding: 5px; color: #99a1aa">
                            <span class="valuespan">{{$movie->budget}}</span>
                        </div>
                        @php($i = $i == true ? false : true)
                    </div>
                    <div class="row" style="margin:0 auto;width: 100%;@if($i == true) background-color: #181f28; @endif">
                        <div class="col" style="height: 35px; padding: 5px">
                            <h5>Возраст</h5>
                        </div>
                        <div class="col" style="height: 35px; padding: 5px; color: #99a1aa">
                            <span class="valuespan">{{$movie->age}}</span>
                        </div>
                        @php($i = $i == true ? false : true)
                    </div>
                    <div class="row" style="margin:0 auto;width: 100%;@if($i == true) background-color: #181f28; @endif">
                        <div class="col" style="height: 35px; padding: 5px">
                            <h5>Время</h5>
                        </div>
                        <div class="col" style="height: 35px; padding: 5px; color: #99a1aa">
                            <span class="valuespan">{{$movie->movie_time}}</span>
                        </div>
                        @php($i = $i == true ? false : true)
                    </div>
                </div>
            </div>
            <div class="col">
                <div style="width: 80%;">
                    <h3>Кадры и постеры</h3>
                    <style>
                        .valuespan{
                            font-size: 15px;
                            font-weight: 600;
                        }
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
