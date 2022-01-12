@extends('admin.admin')
@section('title', 'Страницы')
@section('content')
    <div style="text-align: left">
        <a class="btn btn-secondary" style="color: white" href="{{route('admin-page-new')}}">Добавить страницу</a>
    </div>
    <div style="text-align: center; width: 90%; margin: 0 auto">
        <h2 >Список Страниц</h2>
        <div class="row" style="text-align: center;">
            <div class="col-4" style="height: 40px; border: 1px solid black;background-color: #cbcbcb">
                Название
            </div>
            <div class="col-4" style="border: 1px solid black;background-color: #cbcbcb">
                Дата создания
            </div>
            <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb">
                Статус
            </div>
            <div class="col-2" style="">
            </div>
        </div>
        <div class="row" style="text-align: center;">
            <div class="col-4" style="height: 40px; border: 1px solid black; background-color: white">
                Главная
            </div>
            <div class="col-4" style="border: 1px solid black; background-color: white">
                2022-01-05 14:59:44
            </div>
            <div class="col-2" style="border: 1px solid black; background-color: white">
                ВКЛ
            </div>
            <div class="col-2" style="">
                <a href="{{route('admin-page_main-edit')}}"><img width="20" height="20" src="http://cinema.com/storage/img/editicon.png"/></a>
            </div>
            <div class="col-4" style="height: 40px; border: 1px solid black; background-color: white">
                Контакты
            </div>
            <div class="col-4" style="border: 1px solid black; background-color: white">
                2022-01-05 14:59:44
            </div>
            <div class="col-2" style="border: 1px solid black; background-color: white">
                ВКЛ
            </div>
            <div class="col-2" style="">
                <a href="{{route('admin-contacts-edit')}}"><img width="20" height="20" src="http://cinema.com/storage/img/editicon.png"/></a>
            </div>
            @foreach($pages as $page)
                <div class="col-4" style="height: 40px; border: 1px solid black; background-color: white">
                    {{$page->name}}
                </div>
                <div class="col-4" style="border: 1px solid black; background-color: white">
                    {{$page->date}}
                </div>
                <div class="col-2" style="border: 1px solid black; background-color: white">
                    {{$page->status == 1 ? 'ВКЛ' : 'ВЫКЛ'}}
                </div>
                <div class="col-2" style="">
                    <a href="{{route('admin-page_id-edit', $page->page_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/editicon.png"/></a>
                    @if($page->page_id > 7)
                        <a href="{{route('admin-page_id-delete', $page->page_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/deleteicon.png"/></a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
