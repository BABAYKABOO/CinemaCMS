@extends('admin.admin')
@section('title', 'Акции')
@section('content')
    <div style="text-align: left">
        <a class="btn btn-secondary" style="color: white" href="{{route('admin-discount-new')}}">Добавить акцию</a>
    </div>
    <div style="text-align: center; width: 90%; margin: 0 auto">
        <h2 >Список Акций</h2>
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
            @foreach($discounts as $discount)
                <div class="col-4" style="height: 40px; border: 1px solid black; background-color: white">
                    {{$discount->name}}
                </div>
                <div class="col-4" style="border: 1px solid black; background-color: white">
                    {{$discount->date}}
                </div>
                <div class="col-2" style="border: 1px solid black; background-color: white">
                    {{$discount->status}}
                </div>
                <div class="col-2" style="">
                    <a href="{{route('admin-discount-edit', $discount->discount_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/editicon.png"/></a>

                    <a href="{{route('admin-discount-delete', $discount->discount_id)}}"><img width="20" height="20" src="http://cinema.com/storage/img/deleteicon.png"/></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
