@extends('layout.app')
@section('title', 'Cinemas')
@section('content')
    <div style="margin-top: 50px; margin-bottom: 50px;">
        <img width="100%" height = "600" src="http://cinema.com/storage/img/cinemas.jpg"/>
    </div>
    <div style="margin: 0 auto; text-align: center; width: 80%">
        <h1>Наши кинотеатры</h1>
        @foreach($cinemas as $cinema)
            <div class="col-5">
                <img width="500" src="{{$cinema->image_url}}"/>
                <a style="color: black" href="{{route('cinema-id', $cinema->cinema_id)}}"><h3>{{$cinema->name}}</h3></a>
            </div>
        @endforeach
    </div>
@endsection
