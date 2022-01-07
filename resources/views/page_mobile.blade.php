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
        <div style="margin: 0 auto; ">
            <a href="https://googleplay.com"><img src="http://cinema.com/storage/img/googleplay.png"/></a>
            <a href="https://appstore.com"><img src="http://cinema.com/storage/img/appstore.png"/></a>
        </div>
        </div>
    </div>
@endsection
