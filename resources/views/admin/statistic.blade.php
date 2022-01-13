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
            border: 1px solid #696d70;
            width: 700px;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <h1>Hello Admin</h1>
    <div class="row" style="width: 98%; height:400px; margin-left: 10px;">
        <div class="col-4">
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
    <div class="row" style="width: 98%; height:400px; margin-left: 10px;">
        <div class="col-4">
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
        <div class="col">
            @php($i = 400 / $books_movie[0]->count)
            <div id="graph" class="gistogram">
                <div class="gistosgram-col" style="height: {{$i * $books_movie[0]->count}}px;margin-top:{{400-$i * $books_movie[0]->count}}px"><p style="margin-top: -50px; color:black; font-weight: 600;">{{$books_movie[0]->name}}</p>{{$books_movie[0]->count}}</div>
                <div class="gistosgram-col" style="height: {{$i * $books_movie[1]->count}}px;margin-top:{{400-$i * $books_movie[1]->count}}px"><p style="margin-top: -50px; color:black; font-weight: 600;">{{$books_movie[1]->name}}</p>{{$books_movie[1]->count}}</div>
                <div class="gistosgram-col" style="height: {{$i * $books_movie[0]->count}}px;margin-top:{{400-$i * $books_movie[0]->count}}px"><p style="margin-top: -50px; color:black; font-weight: 600;">{{$books_movie[0]->name}}</p>{{$books_movie[0]->count}}</div>
                <div class="gistosgram-col" style="height: {{$i * $books_movie[1]->count}}px;margin-top:{{400-$i * $books_movie[1]->count}}px"><p style="margin-top: -50px; color:black; font-weight: 600;">{{$books_movie[1]->name}}</p>{{$books_movie[1]->count}}</div>
                <div class="gistosgram-col" style="height: {{$i * $books_movie[1]->count}}px;margin-top:{{400-$i * $books_movie[1]->count}}px"><p style="margin-top: -50px; color:black; font-weight: 600;">{{$books_movie[1]->name}}</p>{{$books_movie[1]->count}}</div>
            </div>
        </div>
    </div>
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
