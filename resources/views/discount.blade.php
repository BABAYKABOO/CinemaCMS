@extends('layout.app')
@section('title', 'Акции')
@section('content')
    <div style="margin-top: 50px; margin-bottom: 50px;">
        <img width="100%" height = "600" src="{{$topbanner->image_url}}"/>
    </div>
        <div style="width: 70%; margin: 0 auto; padding: 50px; text-align: left;  background-color: #161f27;">
            <h3 style="color: white;">{{$discount->name}}</h3><br/>
            <div class="row">
                <div class="col-4">
                    <img height="250" width="300px" src="{{$discount->image_url}}"/>
                </div>
                <div class="col">
                    <span style="margin-top: 20px; color: #99a0a7;">
                        {{$discount->desc}}
                    </span>
                </div>
            </div>
        </div>
@endsection
