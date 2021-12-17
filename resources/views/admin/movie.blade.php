@extends('admin.admin')
@section('title', 'Фильмы')
@section('content')
    <div style="text-align: left">
        <form action="{{route('admin-movie-save', $movie->movie_id)}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Название фильма</label>
                <input type="text" class="form-control" id="name" name="name" value="">
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" id="desc"></textarea>
            </div>
            <div class="mb-3">
                <label>Главная картинка</label>
                <input type="file" class="form-control-file" id="mainimg" name="mainimg">
            </div>
            <div class="mb-3">
                <label class="form-label">Ссылка на трейлер</label>
                <input type="text" class="form-control" id="trailer" name="trailer" value="">
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label mr-5" for="check">Тип кино</label>

                <label class="form-check-label" for="exampleCheck1">3D</label>
                <input type="checkbox" class="form-check-input mt-4" id="3D" name="3D">

                <label class="form-check-label" for="exampleCheck1">2D</label>
                <input type="checkbox" class="form-check-input mt-4" id="2D" name="2D">

                <label class="form-check-label" for="exampleCheck1">IMAX</label>
                <input type="checkbox" class="form-check-input mt-4" id="IMAX" name="IMAX">

            </div>
            <label for="exampleInputPassword1" class="form-label">SEO:</label>
            <div class="mb-3" style="width: 70%; margin-left: 50px">
                    <div class="mb-3" style="">
                    <label class="form-label">URL</label>
                    <input type="text" class="form-control" id="seo_url" name="seo_url" value="">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" id="seo_title" name="seo_title" value="">
                    <label class="form-label">Keywords</label>
                    <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" value="">
                    <label class="form-label">Desc</label>
                    <textarea class="form-control" aria-label="With textarea" name="seo_desc" id="seo_desc"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
            <a href="#">
                <button class="btn btn-primary" style="display: inline-block;  margin: 10px 0px 50px 30px">Вернуть базовую версию</button>
            </a>
        </form>
    </div>
@endsection
