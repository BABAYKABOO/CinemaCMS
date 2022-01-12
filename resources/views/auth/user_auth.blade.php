@extends('layout.app')
@section('title', 'Авторизация')
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
    <div class="center" style="
    margin: 0 auto;
    margin-top: 100px;
    margin-bottom: 180px;
    width: 80%;
">
        <form action="{{route('user-auth')}}" style="width: 30%; margin: 0 auto;" method="post">
            @csrf
            <h3 style="text-align: center;">Авторизация</h3>
            <div class="mt-3">
                <input required class="form-control item" type="text" name="email" id="email" placeholder="Email">
            </div>
            <div class="mt-3">
                <input required class="form-control item" type="password" name="password" id="password" placeholder="Пароль">
            </div>
            <div class="mt-2">
                <a href="{{route('user-reg')}}">Регистрация</a>
            </div>
            <div class="mt-4" style="margin: 0 auto; width: max-content;">
                <button class="btn btn-secondary" type="submit">Вход в аккаунт</button>
            </div>
        </form>
    </div>
@endsection
