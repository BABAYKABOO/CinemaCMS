@extends('layout.app')
@section('title', 'Скоро')
@section('style', '/posters.css')
@section('content')
    <div class="row" style="margin-top: 50px;width: 102%;">
        <div class="col-2" style="left: 20px; ">
            <div style="height: 200px; width:100%;">
                <script type="text/javascript">
                    document.title === 'Афиша' ?
                        document.write('<a href="{{route('posters')}}" class="poster-a" style="color: black; margin-bottom: 50px"><div class="arrow-button-active" style="margin-right: -10px">Афиша</div><div class="arrow-left-active"></div></a>') :
                        document.write('<a href="{{route('posters')}}" class="poster-a" style="color: black; margin-bottom: 50px"><div class="arrow-button">Афиша</div></a>');
                </script>
                <script type="text/javascript">
                    document.title === 'Скоро' ?
                        document.write('<a href="{{route('soon')}}" class="poster-a" style="color: black; margin-bottom: 50px"><div class="arrow-button-active" style="margin-right: -10px">Скоро</div><div class="arrow-left-active"></div></a>') :
                        document.write('<a href="{{route('soon')}}" class="poster-a" style="color: black; margin-bottom: 50px"><div class="arrow-button">Скоро</div></a>');
                </script>
            </div>
        </div>
        <div class="col-9" style="margin-left: auto;">
            <div style=" width:100%; background-color: #161f27;">
                @foreach($movies as $movie)
                        <div class="poster-div">
                            <p style="color: white; font-size: 10px;">{{$movie->data}}</p>
                            <div class="poster-img" style="background: url({{$movie->image_url}});background-size: 100%;">
                            </div>
                            <div style="height: 70px;">
                                <a class="poster-a" href="{{route('soon_movie', $movie->movie_id)}}">
                                    {{$movie->name}}
                                </a>
                            </div>
                            <button type="button" class="btn btn-warning" style="border-radius: 10px;">Купить билет</button>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
