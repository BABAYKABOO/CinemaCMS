@extends('admin.admin')
@section('title', 'Новый сеанс')
@section('content')
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
                    <select class="form-control item" style="width: 250px; height: 50px;" name="cinema_id">
                        <option hidden>Выберите кинотеатр</option>
                        @foreach($cinemas as $cinema)
                            <option value="{{$cinema->cinema_id}}" @if(isset($_GET['cinema_id'])) @if($_GET['cinema_id'] == $cinema->cinema_id) selected @endif @endif>
                                {{$cinema->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Фильм</label>
                    <select class="form-control item" style="width: 250px; height: 50px;" name="movie_id" >
                        @foreach($movies as $movie)
                            <option value="{{$movie->movie_id}}" @if(isset($_GET['movie_id'])) @if($_GET['movie_id'] == $movie->movie_id) selected @endif @endif>
                                {{$movie->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="filter_hall">
                    <label style="width: 100px" class="form-label">Зал</label>
                    <select class="form-control item" style="width: 250px; height: 50px;" name="hall_id" id="halls"  disabled>
                        <option value="all">Выберите кинотеатр</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label style="width: 100px" class="form-label">Тип кино</label>
                    <select class="form-control item" style="width: 250px; height: 50px;" name="type_id">
                        @foreach($types as $type)
                            <option value="{{$type->type_id}}" @if(isset($_GET['type_id'])) @if($_GET['type_id'] == $type->type_id) selected @endif @endif>
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
                            '<option value="{{$hall->hall_id}}">' +
                            '{{$hall->number}}' +
                            '</option>' +
                            '@endforeach' +
                            '</select>';
                        $(filter).append(str);
                        break;
                    @endforeach
                    case 'all':
                        var str_disabled = '<select class="form-control item" name="hall_id" id="halls" disabled required>' +
                            '<option value="all">Зал: все</option>' +
                            '</select>';
                        $(filter).append(str_disabled);
                }
            })
        </script>
    </div>
@endsection
