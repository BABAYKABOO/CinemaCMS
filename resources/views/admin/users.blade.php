@extends('admin.admin')
@section('title', 'Пользователи')
@section('content')
    <div class="row" style="text-align: right">
        <div class="col">
            <h2>Пользователи</h2>
        </div>
        <div class="col" style="margin-right: 20px; text-align: right">
            <form action="{{route('admin-users')}}" method="get">
                <button style="float: right" class="btn btn-secondary" type="submit">Поиск</button>
                <input class="form-control item" @if(isset($_GET['user_search'])) value="{{$_GET['user_search']}}" @endif  style="width: 50%; float: right" type="text" name="user_search" >
            </form>
        </div>
        </div>
    <div style="text-align: center; font-size: 13px; width: 100%; margin: 0 auto; margin-left: 10px; margin-top: 50px">
        <div class="row">
            <div class="col-sm-1" style="height: 40px; border: 1px solid black;background-color: #cbcbcb">
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
            <div class="col-1" style="">

            </div>
        </div>
        <div class="row">
            @foreach($users as $user)
                <div class="col-sm-1" style="height: 40px; border: 1px solid black; background-color: white">
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
                <div class="col-1" style="text-align: left">
                    <a href="{{route('admin-user-edit', $user->user_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/editicon.png"/></a>
                    <a href="{{route('admin-user-edit', $user->user_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/deleteicon.png"/></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
