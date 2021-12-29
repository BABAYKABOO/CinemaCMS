@extends('admin.admin')
@section('title', 'Кинотеатры')
@section('content')
    <style>
        .cinema-div{
            width: 250px;
            margin: 10px 0px 20px 15px;
            display:inline-block;
        }
        .main-movieimg {
            margin-bottom: 10px;
            height: 180px;
            width:100%;
            background-repeat: no-repeat;
        }
    </style>
    <a class="btn btn-secondary" style="color: white" href="{{route('admin-cinema_new')}}">Добавить кинотеатр</a>
    <div style="text-align: center">
        <h1>Список кинотеатров</h1>
        <div style="width: 70%; margin: 0 auto; margin-bottom: 50px; text-align: left;">
            @foreach($cinemas as $cinema)
                <div class="cinema-div">
                    <div class="main-movieimg" style="background: url({{$cinema->image_url}}); background-size: 100%;">
                    </div>
                    <div style="height: 70px; text-align: center">
                        <a class="main-moviea" href="{{route('admin-cinema_id', $cinema->cinema_id)}}">
                            {{$cinema->name}}
                        </a>
                    </div>
                </div>
            @endforeach`
        </div>
    </div>
@endsection
