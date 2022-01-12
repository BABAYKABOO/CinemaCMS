@extends('admin.admin')
@section('title', 'Выбор пользователей')
@section('content')
    <div class="row" style="text-align: right">
        <div class="col">
            <h2>Выбор пользователей</h2>
        </div>
        <div class="col" style="margin-right: 20px; text-align: right">
            <form action="{{route('admin-send-choose_users')}}" method="get">
                <button style="float: right" class="btn btn-secondary" type="submit">Поиск</button>
                <input class="form-control item" @if(isset($_GET['user_name'])) value="{{$_GET['user_name']}}" @endif  style="width: 50%; float: right" type="text" name="user_name" >
            </form>
        </div>
    </div>
    <div style="text-align: center; font-size: 13px; width: 100%; margin: 0 auto; margin-left: 10px; margin-top: 50px">
        <form action="{{route('admin-send-choose')}}" method="post">
            @csrf
            <div class="row">
                <div style="float: left;width: 50px;height: 40px; border: 1px solid black;background-color: #cbcbcb">

                </div>
                <div style="float: left;width: 50px;height: 40px; border: 1px solid black;background-color: #cbcbcb">
                    ID
                </div>
                <div class="col-2" style="height: 40px; border: 1px solid black;background-color: #cbcbcb">
                    Дата регистрации
                </div>
                <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb">
                    День рождения
                </div>
                <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb">
                    Email
                </div>
                <div class="col-1" style="border: 1px solid black;background-color: #cbcbcb">
                    Телефон
                </div>
                <div class="col-1" style="border: 1px solid black;background-color: #cbcbcb">
                    ФИО
                </div>
                <div class="col-1" style="border: 1px solid black;background-color: #cbcbcb">
                    Псевдоним
                </div>
                <div class="col-1" style="border: 1px solid black;background-color: #cbcbcb">
                    Город
                </div>
            </div>

                @foreach($users as $user)
                <div class="row">
                    <div style="float: left;width: 50px;height: 40px; border: 1px solid black;background-color: #cbcbcb">
                        <input class="custom-checkbox" type="checkbox" name="Users[user_id]" value="{{$user->user_id}}">
                    </div>
                    <div style="float: left;width: 50px;height: 40px; border: 1px solid black; background-color: white">
                        {{$user->user_id}}
                    </div>
                    <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                        {{$user->created_at}}
                    </div>
                    <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                        {{$user->birthday}}
                    </div>
                    <div class="col-2" style="height: 40px; border: 1px solid black; background-color: white">
                        {{$user->email}}
                    </div>
                    <div class="col-1" style="height: 40px; border: 1px solid black; background-color: white">
                        {{$user->phone}}
                    </div>
                    <div class="col-1" style="height: 40px; border: 1px solid black; background-color: white">
                        {{$user->name}} {{$user->surname}}
                    </div>
                    <div class="col-1" style="height: 40px; border: 1px solid black; background-color: white">
                        {{$user->nickname}}
                    </div>
                    <div class="col-1" style="height: 40px;border: 1px solid black; background-color: white">
                        {{$user->city}}
                    </div>
                </div>
                @endforeach

            <button type="submit" class="btn btn-secondary mt-5">Выбрать пользователей</button>
        </form>
    </div>
@endsection
