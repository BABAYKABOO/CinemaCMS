@extends('admin.admin')
@section('title', 'Новый сеанс')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="text-align: left;">
        <form action="{{route('admin-timetable-create')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div style="width: 40%">
                <div class="mb-3">
                    <label class="form-label">Дата сеанса</label>
                    <input required type="date" class="form-control" name="date" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Время сеанса</label>
                    <input required type="time" class="form-control" name="time" value="">
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Кинотеатр</label>
                    <select name="cinema_id" style="width: 200px; height: 50px">
                        @foreach($cinemas as $cinema)
                            <option value="{{$cinema->cinema_id}}">
                                {{$cinema->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Фильм</label>
                    <select name="movie_id" style="width: 200px; height: 50px">
                        @foreach($movies as $movie)
                            <option value="{{$movie->movie_id}}">
                                {{$movie->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Зал</label>
                    <select name="hall_id" style="width: 200px; height: 50px">
                        @foreach($halls as $hall)
                            <option value="{{$hall->hall_id}}">
                                {{$hall->number}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Тип кино</label>
                    <select name="type_id" style="width: 200px; height: 50px">
                        @foreach($types as $type)
                            <option value="{{$type->type_id}}">
                                {{$type->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Цена</label>
                    <input required type="text" class="form-control" name="price" value="">
                </div>
            </div>
                <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
        </form>
    </div>
@endsection