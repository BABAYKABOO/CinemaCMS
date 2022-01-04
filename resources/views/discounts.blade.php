@extends('layout.app')
@section('title', 'Акции')
@section('content')
    <div style="margin-top: 50px; margin-bottom: 50px;">
        <img width="100%" height = "600" src="http://cinema.com/storage/img/discounts.png"/>
    </div>
    <div style="margin: 0 auto; text-align: center; width: 80%">
        <h1 style="text-align: center; margin-bottom: 80px">Наши Акции</h1>
        <div class="row" style="width: 90%; padding: 50px; margin: 0 auto; text-align: center;  background-color: #161f27;">
            @foreach($discounts as $discount)
                @if($discount->date <= date("Y-m-d") && $discount->status == 1)
                <div class="col-4" style="width: 200px; color: #99a0a7; text-align: left; margin-top: 10px; margin-bottom: 20px">
                    <img height="250" width="80%" src="{{$discount->image_url}}"/>
                    <div style="margin-top: 10px;padding-left: 7px; border-radius: 10px;background-color: black; color: white; height: 25px; width: 100px;">
                        <p>{{$discount->date}}</p>
                    </div>
                    <a href="{{route('discount_id', ['id' => $discount->discount_id])}}">
                        <h3 style="color: #40a2df;">{{$discount->name}}</h3>
                    </a>

                    <span style="margin-top: 20px">
                        {{$discount->desc}}
                    </span>
                </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
