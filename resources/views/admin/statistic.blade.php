@extends('admin.admin')
@section('title', 'Статистика')
@section('content')
    <style>
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="margin-left: 10px;">
        <h1 >Статистика</h1>
        <div class="row" style="width: 99%; height:350px;">
            <div class="col-3">
                <canvas id="women_men" width="300" height="200"></canvas>
            </div>
            <div class="col-3">
                <canvas id="ru_ua" width="300" height="200"></canvas>
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
                    <div>
                        <canvas id="chart_movies_popular"></canvas>
                    </div>
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
            <div class="col-5" style="padding: 10px;">
                <h1>Типы устройств пользователей</h1>
                <canvas id="pc_mobile" width="300" height="200"></canvas>
            </div>
            </div>
        </form>
    </div>
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
                            stepSize: Math.round(({{isset($books_movie[0]) ?  (($books_movie[0]->count / 10) / $books_movie[0]->count) : 1}}))
                        }
                    }]
                }
            }
        });
    </script>
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
    <script>
        var ru_ua_canvas = document.getElementById("ru_ua");

        var ru_ua_data = {
            labels: [
                "Русский",
                "Украинский"
            ],
            datasets: [
                {
                    data: [{{count($users->where('ua_ru', 1)->get())}},{{ count($users->where('ua_ru', 0)->get())}}],
                    backgroundColor: [
                        "#e18800",
                        "green",
                    ]
                }]
        };

        var pieChart = new Chart(ru_ua_canvas, {
            type: 'doughnut',
            data: ru_ua_data
        });
    </script>
    <script>
        var wmen_canvas = document.getElementById("women_men");

        var wmen_data = {
            labels: [
                "Мужчины",
                "Женщины"
            ],
            datasets: [
                {
                    data: [{{count($users->where('sex', 0)->get())}},{{count($users->where('sex', 1)->get())}}],
                    backgroundColor: [
                        "#30bae7",
                        "pink",
                    ]
                }]
        };

        var pieChart = new Chart(wmen_canvas, {
            type: 'doughnut',
            data: wmen_data
        });
    </script>
    <script>
        var mobile_canvas = document.getElementById("pc_mobile");

        var mobile_data = {
            labels: [
                "Компьютеры",
                "Мобильные устройства"
            ],
            datasets: [
                {
                    data: [{{count($visits->get()) - count($visits->where('is_mobile', 1)->get())}},{{count($visits->where('is_mobile', 1)->get())}}],
                    backgroundColor: [
                        "#0C8400",
                        "#a80000",
                    ]
                }]
        };

        var pieChart = new Chart(mobile_canvas, {
            type: 'pie',
            data: mobile_data
        });
    </script>
@endsection
