@extends('admin.admin')
@section('title', 'Редактировать сеанс')
@section('content')
    <div style="text-align: left;">
        <form action="{{route('admin-timetable-save', $timetable->timetable_id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div style="width: 40%">
                <div class="mb-3">
                    <label class="form-label">Дата сеанса</label>
                    <input required type="date" class="form-control" name="date" value="{{$timetable->data}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Время сеанса</label>
                    <input required type="time" class="form-control" name="time" value="{{$timetable->time}}">
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Кинотеатр</label>
                    <select class="form-control item" style="width: 250px; height: 50px;" name="cinema_id">
                        @foreach($cinemas as $cinema)
                            <option @if($cinema->cinema_id == $timetable->cinema_id) selected @endif value="{{$cinema->cinema_id}}">
                                {{$cinema->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Фильм</label>
                    <select class="form-control item" style="width: 250px; height: 50px;" name="movie_id" >
                        @foreach($movies as $movie)
                            <option @if($movie->movie_id == $timetable->movie_id) selected @endif value="{{$movie->movie_id}}">
                                {{$movie->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="filter_hall">
                    <label style="width: 100px" class="form-label">Зал</label>
                    <select class="form-control item" style="width: 250px; height: 50px;" name="hall_id" id="halls">
                        @foreach($halls[$timetable->cinema_id] as $hall)
                            <option @if($hall->hall_id == $timetable->hall_id) selected @endif value="{{$hall->hall_id}}">
                                {{$hall->number}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Тип кино</label>
                    <select class="form-control item" style="width: 250px; height: 50px;" name="type_id">
                        @foreach($types as $type)
                            <option @if($type->type_id == $timetable->type_id) selected @endif value="{{$type->type_id}}">
                                {{$type->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="form-label">Цена</label>
                    <input required type="text" class="form-control" name="price" value="{{$timetable->price}}">
                </div>
            </div>
            @if(isset($tickets[0]))
            <div class="mb-3">
                <h2 style="text-align: center;">Список забронированных мест</h2>
                <div style="text-align: center; height: max-content;padding-left: 30%;">

                    <div class="row" style="">
                        <div class="col-3" style="height: 40px; border: 1px solid black;background-color: #cbcbcb;">
                            Имя покупателя
                        </div>
                        <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb;">
                            Ряд
                        </div>
                        <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb;">
                            Номер
                        </div>
                    </div>
                        @foreach($tickets as $ticket)
                        <div class="row" style="">
                            <div class="col-3" style="height: 40px; border: 1px solid black; background-color: white;">
                                {{$ticket->name}} {{$ticket->surname}}
                            </div>
                            <div class="col-2" style="border: 1px solid black; background-color: white;">
                                {{$ticket->row}}
                            </div>
                            <div class="col-2" style="border: 1px solid black; background-color: white;">
                                {{$ticket->place}}
                            </div>
                        </div>
                        @endforeach

                </div>
            </div>
            @endif
            <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>

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
                        var str = '<select class="form-control item" style="width: 250px; height: 50px;" name="hall_id" id="halls" required>' +
                            '@foreach($halls_cinema as $hall)' +
                            '<option @if($hall->hall_id == $timetable->hall_id) selected @endif value="{{$hall->hall_id}}">' +
                            '{{$hall->number}}' +
                            '</option>' +
                            '@endforeach' +
                            '</select>';
                        $(filter).append(str);
                        break;
                    @endforeach
                    default:
                        var str_disabled = '<select class="form-control item" name="hall_id" id="halls" disabled required>' +
                            '<option value="all">Зал: все</option>' +
                            '</select>';
                        $(filter).append(str_disabled);
                }
            })
        </script>
    </div>
@endsection
