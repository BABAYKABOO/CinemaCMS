<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link href="{{ asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/app.css')}}" rel="stylesheet">

</head>
<style>
    .form-group {
        width: 80%;
    }
    .small-form{
        width: 400px;
        text-align: center;
    }
    .center{
        width:400px;
        position: absolute;
        top: 30%;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
    }
</style>
<body>
<div class="auth-form">
    <div class="center">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $errors)
                    <li>{{$errors}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="small-form" action="{{route('auth')}}" method="post">
        @csrf
        <h3 class="text-center" style="width: 80%">Вход в CMS</h3>
        <div class="form-group">
            <input class="form-control item" type="text" name="admin_email" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input class="form-control item" type="password" name="password" id="password" placeholder="Пароль">
        </div>
        <div class="form-group mb-5">
            <button class="btn btn-primary btn-block create-account" type="submit">Вход в аккаунт</button>
        </div>
    </form>
    </div>
</div>
