@extends('layout.app')
@section('title', 'Расписание')
@section('content')
    <form action="{{route('timetables')}}" method="get" style="margin: 0 auto; width: 80%; margin-top: 80px;">
        <div class="row">
            <div class="col" style="background-color: #19212a; padding: 10px; color: white;">
                    <p style="margin-bottom: 0px;width: max-content;">
                        <span>Показывать только: </span>
                    </p>
                    @foreach($types as $type)
                        <p style="margin-right: 10px;  width: max-content; display: inline">
                            <input name="language" type="radio" value="{{$type->type_id}}"
                                  @if(isset($_GET['type_id'])) @if($_GET['type_id'] == $type->type_id) checked @endif @endif>
                            {{$type->name}}
                        </p>
                    @endforeach
            </div>
            <div class="col">
                <select class="form-control item" style="border: 1px solid black" name="cinema_id" style="">
                    <option value="all">Выберите кинотеатр</option>
                    @foreach($cinemas as $cinema)
                        <option value="{{$cinema->cinema_id}}" @if(isset($_GET['cinema_id'])) @if($_GET['cinema_id'] == $cinema->cinema_id) selected @endif @endif>
                            {{$cinema->name}}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="col">
                <select class="form-control item" style="border: 1px solid black" name="data" style="">
                    <option value="all">Выберите дату</option>
                    @foreach($dates as $date)
                        <option value="{{$date->data}}" @if(isset($_GET['data'])) @if($_GET['data'] == $date->data) selected @endif @endif>
                            {{$date->data}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select class="form-control item" style="border: 1px solid black" name="movie_id" style="">
                    <option value="all">Фильмы: все</option>
                    @foreach($movies as $movie)
                        <option value="{{$movie->movie_id}}" @if(isset($_GET['movie_id'])) @if($_GET['movie_id'] == $movie->movie_id) selected @endif @endif>
                            {{$movie->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select class="form-control item" style="border: 1px solid black" name="hall_id" style="">
                    <option value="all">Зал: все</option>
                    @foreach($halls as $hall)
                        <option value="{{$hall->hall_id}}" @if(isset($_GET['hall_id'])) @if($_GET['hall_id'] == $hall->hall_id) selected @endif @endif>
                            {{$hall->number}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div style="margin-top: 20px; text-align:right">
            <button type="submit" class="btn btn-primary ml-5" style="font-size: 25px;">Поиск расписания</button>
        </div>
    </form>
    @foreach($timetables as $date => $movies)
    <h5 style="text-align: left;margin: 0 auto; margin-bottom: 5px; margin-top: 50px; width: 55%;">{{$date}}</h5>
    <div class="row" style="margin: 0 auto; width: 80%; font-size: 14px">
        <div class="col-7" style="margin-left: 150px; border: 5px solid yellow">
                <div class="row" style="padding: 5px;">
                    <div class="col-2" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        ВРЕМЯ
                    </div>
                    <div class="col-4" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        ФИЛЬМ
                    </div>
                    <div class="col-1" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        ЗАЛ
                    </div>
                    <div class="col-2" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        ЦЕНА В ГРН.
                    </div>
                    <div class="col-3" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        БРОНИРОВАТЬ
                    </div>
                </div>

                @foreach($movies as $timetable)
                <div class="row" style="padding: 5px;">
                    <div class="col-2" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        {{$timetable->time}}
                    </div>
                    <div class="col-4" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        {{$timetable->name}}
                    </div>
                    <div class="col-1" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        {{$timetable->number}}
                    </div>
                    <div class="col-2" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        {{$timetable->price}}
                    </div>
                    <div class="col-3" style="border-bottom: 0.5px solid #9f9f9f; margin-bottom: 5px;">
                        <a href="{{route('book', $timetable->timetable_id)}}">БРОНЬ</a>
                    </div>
                </div>
                @endforeach
        </div>
        <div class="col-3">
        </div>
    </div>
    @endforeach
@endsection
