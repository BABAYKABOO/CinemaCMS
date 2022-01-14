@extends('admin.admin')
@section('title', 'Статистика')
@section('content')
    <style>
        .circle {
            display: block;
            float: left;
        }
        circle {
            fill: rgba(0,0,0,0);
            stroke-width: 15;
            stroke-dasharray: 408px 408px;
        }
        circle:nth-child(2n) {
            fill: rgba(0,0,0,0);
            stroke: #30bae7;
            stroke-width: 15;
        }
        .gistogram{
            width: 600px;
            height: 400px;
            float:right;
        }
        .gistosgram-col{
            float:left;
            text-align: center;
            width: 100px;
            margin-left: 10px;
            color: white;
            background-color: #1f309f;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="margin-left: 10px;">
        <h1 >Статистика</h1>
        <div class="row" style="width: 99%; height:350px;">
            <div class="col-4">
                <div class="row">
                    <div class="col">
                        <div class="circle" style="color: pink">{{100 * count($users->where('sex', 0)->get()) / count($users->get())}}%</div>
                        <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                            <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #30bae7;"></div></div>
                            <div class="col" style="height: 30px;">Мужчины</div>
                        </div>
                        <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                            <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: pink;"></div></div>
                            <div class="col" style="height: 30px;">Женщины</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="circle" style="color: green">{{100 * count($users->where('ua_ru', 1)->get()) / count($users->get())}}%%</div>
                        <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                            <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #30bae7;"></div></div>
                            <div class="col" style="height: 30px;">Русский</div>
                        </div>
                        <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                            <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: green;"></div></div>
                            <div class="col" style="height: 30px;">Украинский</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="row" style="width: 500px; float:right; height: 200px; color:white; background-color: #f5c81c">
                    <div class="col">
                        <span style="font-size: 50px; margin-left: 30px; margin-top: 60px;">{{count($users->get())}}</span>
                        <p style="font-size: 20px;">Зарегистрированных</p>
                        <p style="font-size: 20px;">пользователей</p>
                    </div>
                    <div class="col">
                        <img style="width: 125px;float: right; margin-top: 30px" src="http://cinema.com/storage/img/user_icon.png"/>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('admin-statistic')}}" method="get">
            <div class="row" style="width: 99%; height:500px;">
                <div class="col-5" style="padding-right: 20px;">
                    <div style="padding: 10px; border-radius: 15px;">
                        <h1>Куплено билетов за</h1>
                        <label>От:</label>
                        <input class="form-control item" @if(isset($_GET['tickets_from_when'])) value="{{$_GET['tickets_from_when']}}" @endif style="width: 190px; display: inline;" type="date" name="tickets_from_when"/>
                        <label>До:</label>
                        <input class="form-control item" @if(isset($_GET['tickets_to_when'])) value="{{$_GET['tickets_to_when']}}" @endif style="width: 190px; display: inline;" type="date" name="tickets_to_when"/>
                        <button class="btn btn-secondary" type="submit" style="margin-top: 10px; margin-left: 28px;">Обновить</button>

                    <div style="background-color: #f5c81c; height: 200px; width: 90%; margin: 0 auto; color: white; margin-top: 30px; text-align:center; padding-top: 35px;  border-radius: 15px;">
                        <h2>Билетов: {{$tickets['count']}}</h2><br/>
                        <h2>Прибыль: {{$tickets['price']}} грн</h2>
                    </div>
                    </div>
                </div>
                <div class="col-7" style="padding: 10px;border: 1px solid black; border-radius: 15px;">
                    <h1>Самые популярные фильмы за</h1>
                    <label>От:</label>
                    <input class="form-control item" @if(isset($_GET['book_from_when'])) value="{{$_GET['book_from_when']}}" @endif style="width: 200px; display: inline;" type="date" name="book_from_when"/>
                    <label>До:</label>
                    <input class="form-control item" @if(isset($_GET['book_to_when'])) value="{{$_GET['book_to_when']}}" @endif style="width: 200px; display: inline;" type="date" name="book_to_when"/>
                    <br/><button class="btn btn-secondary" type="submit" style="margin-top: 10px; margin-left: 28px;">Обновить</button>

                    @if(isset($books_movie[0]))
                        <div>
                            <canvas id="chart_movies_popular"></canvas>
                        </div>
                    @else
                        <h3 style="margin-top: 200px; margin-left: 50px">За этот промежуток не было куплено билетов</h3>
                    @endif
                </div>
            </div>
            <div class="row" style="height: 600px; margin-top: 50px; width: 99%;">
            <div class="col">
                <div style="border: 1px solid black; padding: 10px; border-radius: 15px; width: 600px;">
                    <h1>Количество сеансов</h1>
                    <label>От:</label>
                    <input class="form-control item" @if(isset($_GET['timetables_from_when'])) value="{{$_GET['timetables_from_when']}}" @endif style="width: 190px; display: inline;" type="date" name="timetables_from_when"/>
                    <label>До:</label>
                    <input class="form-control item" @if(isset($_GET['timetables_to_when'])) value="{{$_GET['timetables_to_when']}}" @endif style="width: 190px; display: inline;" type="date" name="timetables_to_when"/>
                    <br/><button class="btn btn-secondary" type="submit" style="margin-top: 10px; margin-left: 28px;">Обновить</button>
                    <div>
                        <canvas id="chart_timetables"></canvas>
                    </div>
                </div>
            </div>
            <div class="col" style="padding: 10px;">
                <h1>Типы устройств пользователей</h1>
                <div style="margin: 50px 0px 0px 250px ">
                <div class="circle" style="color: #c40900">{{100 * count($users->where('sex', 0)->get()) / count($users->get())}}%</div>
                <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                    <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #30bae7;"></div></div>
                    <div class="col" style="height: 30px;">ПК</div>
                </div>
                <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                    <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #c40900;"></div></div>
                    <div class="col" style="height: 30px;">Телефоны</div>
                </div>
                </div>
            </div>
            </div>
        </form>
    </div>
    @if(isset($books_movie[0]))
    <script>
        var ctx = document.getElementById("chart_movies_popular");
        var data = {
            labels: [
                @foreach($books_movie as $key => $book_movie)
                    @if($key <= 5)
                     '{{$book_movie->name}}',
                    @else
                        @break
                    @endif
                @endforeach
                   ],
            datasets: [
                {
                    label:  "Количество билетов: ",
                    data: [
                        @foreach($books_movie as $key => $book_movie)
                            @if($key <= 5)
                                '{{$book_movie->count}}',
                            @else
                                @break
                            @endif
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ]
                }]
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            beginAtZero: true,
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: false,
                    text: 'Chart.js bar Chart'
                },
                animation: {
                    animateScale: true
                },
                scales: {

                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) { if (Number.isInteger(value)) { return value; } },
                            stepSize: Math.round(({{$books_movie[0]->count}} / 10 ) / {{$books_movie[0]->count}})
                        }
                    }]
                }
            }
        });
    </script>
    @endif
    <script>
        var ctx = document.getElementById("chart_timetables");
        var data = {
            labels: [
                    @foreach($timetables as $timetable)
                        '{{$timetable->date}}',
                    @endforeach
                    ],
            datasets: [
                {
                    @php($max = 1)
                    label:  "Количество сеансов: ",
                    data: [
                        @foreach($timetables as $timetable)
                            {{$timetable->count}},
                            @php($timetable->count > $max ? $max = $timetable->count : '')
                        @endforeach
                        ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ]
                }]
        };

        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            beginAtZero: true,
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: false,
                    text: 'Chart.js bar Chart'
                },
                animation: {
                    animateScale: true
                },
                scales: {

                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) { if (Number.isInteger(value)) { return value; } },
                            stepSize: Math.round(({{$max}} / 10 ) / {{$max}})
                        }
                    }]
                }
            }
        });
    </script>
{{--    <script>--}}
{{--        new Chartist.Line('.chart1', {--}}
{{--            labels: [--}}
{{--                    @foreach($timetables as $timetable)--}}
{{--                        '{{$timetable->date}}',--}}
{{--                    @endforeach--}}
{{--                    ],--}}
{{--            series: [--}}
{{--                [--}}
{{--                    @foreach($timetables as $timetable)--}}
{{--                        {{$timetable->count}},--}}
{{--                    @endforeach--}}
{{--                ],--}}
{{--            ]--}}
{{--        }, {--}}
{{--            fullWidth: true,--}}
{{--            fullHeight: true,--}}
{{--            chartPadding: {--}}
{{--                right: 50--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        var Circle = function(sel){
            var circles = document.querySelectorAll(sel);
            [].forEach.call(circles,function(el){
                var valEl = parseFloat(el.innerHTML);
                var color = $(el).css('color');
                valEl = valEl*408/100;
                el.innerHTML = '<svg width="160" height="160"><circle style="stroke: ' + color +';" transform="rotate(-90)" r="65" cx="-80" cy="80" /><circle transform="rotate(-90)" style="stroke-dasharray:'+valEl+'px 408px;" r="65" cx="-80" cy="80" /></svg>';

            });
        };
        Circle('.circle');
    </script>
@endsection
