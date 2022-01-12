@extends('layout.app')
@section('title', 'О кинотеатре')
@section('content')
    <div style="margin-top: 50px; margin-bottom: 100px;">
        <img width="100%" height = "600" src="{{$page->image_url}}"/>
    </div>
    <div style="margin: 0 auto; width: 80%;">
        <h1 style="text-align: center;">{{$page->name}}</h1><br/>
        <div style="width: 90%; margin: 0 auto">
            <span>
                {{$page->desc}}
            </span>
        </div>
        <div class="row" style="margin-top: 40px; margin-bottom: 40px">
            <div class="col-4">
                <img style="width: 400px" src="{{$sub_gallery[0]->image_url}}"/>
            </div>
            <div class="col-4">
                <img style="width: 400px" src="{{$sub_gallery[1]->image_url}}"/>
            </div>
            <div class="col-4">
                <img style="width: 400px" src="{{$sub_gallery[2]->image_url}}"/>
            </div>
        </div>
        <div class="row" style="text-align: left;">
            <div class="col-4" style="height: 40px; border: 1px solid black;background-color: #cbcbcb">
                Head 1
            </div>
            <div class="col-4" style="border: 1px solid black;background-color: #cbcbcb">
                Head 2
            </div>
            <div class="col-4" style="border: 1px solid black;background-color: #cbcbcb">
                Head 3
            </div>
        </div>
        <div class="row" style="text-align: left;">
            @for($i = 1; $i <= 12; $i+=3)
                <div class="col-4" style="height: 40px; border: 1px solid black; background-color: white">
                    Cell {{$i}}
                </div>
                <div class="col-4" style="border: 1px solid black; background-color: white">
                    Cell {{$i+1}}
                </div>
                <div class="col-3" style="border: 1px solid black; background-color: white">
                    Cell {{$i+2}}
                </div>
                <div class="col-1" style="border: 1px solid black; background-color: white">
                    <input type="checkbox" />
                </div>
            @endfor
        </div>
    </div>
@endsection
