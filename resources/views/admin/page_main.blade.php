@extends('admin.admin')
@section('title', 'Главная')
@section('content')
<div style="text-align: left">
    <form action="{{route('admin-page_main-save')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Телефон</label>
            <input style="width: 200px;" type="text" class="form-control" id="phone_1" name="phone_1" value="{{$page->phone_1}}">
            <input style="width: 200px;" type="text" class="form-control" id="phone_2" name="phone_2" value="{{$page->phone_2}}">
        </div>
        <div class="mb-3">
            <label class="form-label">SEO текст</label>
            <textarea class="form-control" aria-label="With textarea" name="seo_text" id="seo_text">{{$page->seo_text}}</textarea>
        </div>
        <label for="exampleInputPassword1" class="form-label">SEO:</label>
        <div class="mb-3" style="width: 70%; margin-left: 50px">
            <div class="mb-3" style="">
                <label class="form-label">URL</label>
                <input type="text" class="form-control" id="seo_url" name="Seo[url]" value="{{$seo->seo_url}}">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" id="seo_title" name="Seo[title]" value="{{$seo->title}}">
                <label class="form-label">Keywords</label>
                <input type="text" class="form-control" id="seo_keywords" name="Seo[keywords]" value="{{$seo->keywords}}">
                <label class="form-label">Desc</label>
                <textarea class="form-control" aria-label="With textarea" name="Seo[desc]" id="seo_desc">{{$seo->desc}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
        <a class="btn btn-secondary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-page_main-edit')}}">
            Вернуть базовую версию
        </a>
    </form>
</div>
@endsection
