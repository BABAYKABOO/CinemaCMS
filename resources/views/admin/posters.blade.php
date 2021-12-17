@extends('admin.admin')
@section('title', 'Фильмы')
@section('content')
    <div style="text-align: center">
    <h1>Список фильмов текущих</h1>
    <div style="width: 70%; margin: 0 auto; margin-bottom: 50px; text-align: left;">
        @foreach($moviesToday as $movie)
            <div class="main-moviediv">
                <div class="main-movieimg" style="background: url({{$movie->image_url}})">
                </div>
                <div style="height: 70px;">
                    <a class="main-moviea" href="http://cinema.com/admin/poster/{{$movie->movie_id}}">
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
                        <a class="main-moviea" href="http://cinema.com/admin/poster/{{$movie->movie_id}}">
                            {{$movie->name}}
                        </a>
                    </div>
                </div>
            @endforeach`
        </div>
    </div>
@endsection
