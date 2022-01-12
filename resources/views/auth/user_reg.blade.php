@extends('layout.app')
@section('title', 'Регистрация')
@section('content')
    <div class="center" style="
    margin: 0 auto;
    margin-top: 30px;
    width: 40%;
">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $errors)
                        <li>{{$errors}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
        <form action="{{route('user-registr')}}" method="post">
            @csrf
            <div class="row" style="margin: 0 auto; margin-top: 80px;  width: 70%">
                <div class="col-2">
                    <h5>Имя:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="text" name="name"/>
                </div>

                <div class="col-2">
                    <h5>Язык:</h5>
                </div>
                <div class="col-4" >
                    <p><input style="display: inline" name="language" type="radio" value="ua"> Украинский</p>
                    <p><input checked style="display: inline" name="language" type="radio" value="ru"> Русский</p>
                </div>
            </div>
            <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
                <div class="col-2">
                    <h5>Фамилия:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="text" name="surname" />
                </div>

                <div class="col-2">
                    <h5>Пол:</h5>
                </div>
                <div class="col-4" >
                    <p><input style="display: inline" name="sex" type="radio" value="m"> Мужской</p>
                    <p><input checked style="display: inline" name="sex" type="radio" value="w"> Женский</p>
                </div>
            </div>
            <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
                <div class="col-2">
                    <h5>Псевдоним:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="text" name="nickname" />
                </div>

                <div class="col-2">
                    <h5>Телефон:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="text" name="phone"/>
                </div>
            </div>
            <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
                <div class="col-2">
                    <h5>E-mail:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="text" name="email" />
                </div>

                <div class="col-2">
                    <h5>Дата рождения:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="date" name="birthday" />
                </div>
            </div>
            <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
                <div class="col-2">
                    <h5>Адресс:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="text" name="address" />
                </div>

                <div class="col-2">
                    <h5>Город:</h5>
                </div>
                <div class="col-4" >
                    <select class="form-control item" name="city">
                        <option>Одесса</option>
                        <option>Киев</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
                <div class="col-2">
                    <h5>Пароль:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="password" name="password"/>
                </div>

                <div class="col-2">
                    <h5>Повторить пароль:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="password" name="confirm_password"  />
                </div>
            </div>
            <div class="row" style="margin: 0 auto; margin-top: 30px;  width: 70%">
                <div class="col-2">
                    <h5>Номер карты:</h5>
                </div>
                <div class="col-4" >
                    <input required class="form-control item" type="text" name="card" />
                </div>
            </div>
            <div  style="margin: 0 auto; margin-top: 50px; width: max-content">
                <button type="submit" class="btn btn-secondary">Регистрация</button>
            </div>
        </form>
@endsection
