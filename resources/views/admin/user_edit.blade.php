@extends('admin.admin')
@section('title', 'Редактирование пользователя')
@section('content')
    <form action="{{route('admin-user-save', $user->user_id)}}" method="post">
        @csrf
        <div class="row" style="margin: 0 auto; margin-top: 50px;  width: 70%">
            <div class="col-2">
                <h5>Имя:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->name}}" type="text" name="name"/>
            </div>

            <div class="col-2">
                <h5>Язык:</h5>
            </div>
            <div class="col-4" >
                <p><input style="display: inline" @if($user->ua_ru == 0) checked @endif name="language" type="radio" value="ua"> Украинский</p>
                <p><input style="display: inline" @if($user->ua_ru == 1) checked @endif name="language" type="radio" value="ru"> Русский</p>
            </div>
        </div>
        <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
            <div class="col-2">
                <h5>Фамилия:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->surname}}" type="text" name="surname" />
            </div>

            <div class="col-2">
                <h5>Пол:</h5>
            </div>
            <div class="col-4" >
                <p><input style="display: inline" @if($user->sex == 0) checked @endif name="sex" type="radio" value="m"> Мужской</p>
                <p><input style="display: inline" @if($user->sex == 1) checked @endif name="sex" type="radio" value="w"> Женский</p>
            </div>
        </div>
        <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
            <div class="col-2">
                <h5>Псевдоним:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->nickname}}" type="text" name="nickname" />
            </div>

            <div class="col-2">
                <h5>Телефон:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->phone}}" type="text" name="phone"/>
            </div>
        </div>
        <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
            <div class="col-2">
                <h5>E-mail:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->email}}" type="text" name="email" />
            </div>

            <div class="col-2">
                <h5>Дата рождения:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" type="date" value="{{$user->birthday}}" name="birthday" />
            </div>
        </div>
        <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
            <div class="col-2">
                <h5>Адресс:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->address}}" type="text" name="address" />
            </div>

            <div class="col-2">
                <h5>Город:</h5>
            </div>
            <div class="col-4" >
                <select class="form-control item" name="city">
                    <option @if($user->city == 'Одесса') selected @endif>Одесса</option>
                    <option @if($user->city == 'Киев') selected @endif>Киев</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
            <div class="col-2">
                <h5>Пароль:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->password}}" type="password" name="password"/>
            </div>
        </div>
        <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
            <div class="col-2">
                <h5>Номер карты:</h5>
            </div>
            <div class="col-4" >
                <input required class="form-control item" value="{{$user->card}}" type="text" name="card" />
            </div>
        </div>
        <div  style="margin: 0 auto; margin-top: 50px; width: max-content">
            <button type="submit" class="btn btn-secondary">Регистрация</button>
        </div>
    </form>
@endsection
