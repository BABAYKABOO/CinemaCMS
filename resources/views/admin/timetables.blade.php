@extends('admin.admin')
@section('title', 'Расписание')
@section('content')
    <div style="text-align: left">
        <a class="btn btn-secondary" style="color: white" href="{{route('admin-timetable-new')}}">Добавить Расписание</a>
    </div>
    <form action="{{route('admin-timetables')}}" method="get" style="margin: 0 auto; width: 80%; margin-top: 80px;">
        <div class="row">
            <div class="col">
                <select class="form-control item" name="type_id">
                    <option value="all">Выберите тип</option>
                    @foreach($types as $type)
                        <option value="{{$type->type_id}}" @if(isset($_GET['type_id'])) @if($_GET['type_id'] == $type->type_id) selected @endif @endif>
                            {{$type->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select class="form-control item" name="cinema_id">
                    <option value="all">Выберите кинотеатр</option>
                    @foreach($cinemas as $cinema)
                        <option value="{{$cinema->cinema_id}}" @if(isset($_GET['cinema_id'])) @if($_GET['cinema_id'] == $cinema->cinema_id) selected @endif @endif>
                            {{$cinema->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select class="form-control item" name="data" >
                    <option value="all">Выберите дату</option>
                    @foreach($dates as $date)
                        <option value="{{$date->data}}" @if(isset($_GET['data'])) @if($_GET['data'] == $date->data) selected @endif @endif>
                            {{$date->data}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select class="form-control item" name="movie_id" >
                    <option value="all">Фильмы: все</option>
                    @foreach($movies as $movie)
                        <option value="{{$movie->movie_id}}" @if(isset($_GET['movie_id'])) @if($_GET['movie_id'] == $movie->movie_id) selected @endif @endif>
                            {{$movie->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="filter_hall">
                <select class="form-control item" name="hall_id" id="halls"  disabled>
                    <option value="all">Зал: все</option>
                </select>
            </div>
        </div>
        <div style="margin-top: 20px; text-align:right">
            <button type="submit" class="btn btn-primary ml-5" style="font-size: 25px;">Поиск расписания</button>
        </div>
    </form>
    <script>
        $('select[name="cinema_id"]').on('change', function() {
            var select_cinema = $(this);
            var filter = document.getElementById ('filter_hall');
            document.getElementById('halls').remove();
            switch (select_cinema.val())
            {
                @foreach($halls as $cinema_id => $halls_cinema)
                case '{{$cinema_id}}':
                    var str = '<select class="form-control item" name="hall_id" id="halls">' +
                        '<option value="all">Зал: все</option>' +
                        ' @foreach($halls_cinema as $hall)' +
                        '<option value="{{$hall->hall_id}}" @if(isset($_GET['hall_id'])) @if($_GET['hall_id'] == $hall->hall_id) selected @endif @endif>' +
                        '{{$hall->number}}' +
                        '</option>' +
                        '@endforeach' +
                        '</select>';
                    $(filter).append(str);
                    break;
                @endforeach
                case 'all':
                    var str_disabled = '<select class="form-control item" name="hall_id" id="halls" disabled>' +
                        '<option value="all">Зал: все</option>' +
                        '</select>';
                    $(filter).append(str_disabled);
                    break;
            }
        })
    </script>
    <div style="text-align: center; width: 90%; height: 700px; margin: 0 auto; margin-left: 100px; margin-bottom: 50px;">
        <h2>Расписание сеансов</h2>
        <div class="row" style="text-align: center; margin-top: 50px">
            <div class="col-2" style="height: 40px; border: 1px solid black;background-color: #cbcbcb">
                Дата
            </div>
            <div class="col-2" style="height: 40px; border: 1px solid black;background-color: #cbcbcb">
                Время
            </div>
            <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb">
                Фильм
            </div>
            <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb">
                Зал
            </div>
            <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb">
                ЦЕНА В ГРН.
            </div>
            <div class="col-1" >
            </div>
        </div>
        <div class="row" style="text-align: center;">
            @foreach($timetables as $timetable)
                <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                    {{$timetable->data}}
                </div>
                <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                    {{$timetable->time}}
                </div>
                <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                    {{$timetable->name}}
                </div>
                <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                    {{$timetable->number}}
                </div>
                <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                    {{$timetable->price}}
                </div>
                <div class="col-1" style="text-align: left">
                    <a href="{{route('admin-timetable-edit', $timetable->timetable_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/editicon.png"/></a>
                    <a href="{{route('admin-timetable-delete', $timetable->timetable_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/deleteicon.png"/></a>
                </div>
            @endforeach
        </div>
        <div style="text-align: center; color: black; height: 100px; margin: 0px 0px 0px 50px">
            <p>{{ $timetables->links() }}</p>
        </div>
    </div>
@endsection
