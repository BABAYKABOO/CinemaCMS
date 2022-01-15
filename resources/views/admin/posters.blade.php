@extends('admin.admin')
@section('title', 'Фильмы')
@section('content')
    <a class="btn btn-secondary" style="color: white" href="{{route('admin-movie_new')}}">Добавить фильм</a>
    <div style="text-align: center">
        <h1>Список фильмов текущих</h1>
        <div style="width: 70%; margin: 0 auto; margin-bottom: 50px; text-align: left;">
            @foreach($moviesToday as $movie)
                <div class="main-moviediv">
                    <div class="main-movieimg" style="background: url({{$movie->image_url}})">
                    </div>
                    <div style="height: 70px;">
                        <a class="main-moviea" href="{{route('admin-movie_id', $movie->movie_id)}}">
                            {{$movie->name}}
                        </a>
                    </div>
                </div>
            @endforeach`
        </div>
        <h1>Список фильмов которые скоро покажут</h1>
        <div style="width: 70%; margin: 0 auto; text-align: left;">
            @foreach($moviesSoon as $movie)
                <div class="main-moviediv">
                    <div class="main-movieimg" style="background: url({{$movie->image_url}})">
                    </div>
                    <div style="height: 70px;">
                        <a class="main-moviea" href="{{route('admin-movie_id', $movie->movie_id)}}">
                            {{$movie->name}}
                        </a>
                    </div>
                </div>
            @endforeach`
        </div>
        @if(isset($movie_wt_tt[0]))
        <h1>Список фильмов которые без расписания<br/>
            или их расписание истекло</h1>
        <div style="width: 70%; margin: 0 auto; text-align: left;">
            @foreach($movie_wt_tt as $movie)
                <div class="main-moviediv">
                    <div class="main-movieimg" style="background: url({{$movie->image_url}})">
                    </div>
                    <div style="height: 70px;">
                        <a class="main-moviea" href="{{route('admin-movie_id', $movie->movie_id)}}">
                            {{$movie->name}}
                        </a>
                    </div>
                </div>
            @endforeach`
        </div>
        @endif
    </div>
@endsection
