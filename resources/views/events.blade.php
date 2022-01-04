@extends('layout.app')
@section('title', 'Новости')
@section('content')
    <div style="margin-top: 50px; margin-bottom: 100px;">
        <img width="100%" height = "600" src="http://cinema.com/storage/img/news.png"/>
    </div>
    <div style="margin: 0 auto; text-align: center; width: 70%;background-color: #161f27; margin-bottom: 80px">
        <h1 style="text-align: left; color: white; padding-left: 20px; margin-top: 20px">Новости</h1>
        <div class="row" style="width: 100%; padding: 20px; margin: 0 auto; text-align: center; ">
            @foreach($events as $event)
                @if($event->date <= date("Y-m-d") && $event->status == 1)
                    <div class="col-4" style="width: 200px; color: #99a0a7; text-align: left; margin-top: 10px; margin-bottom: 20px">
                        <img height="250" width="100%" src="{{$event->image_url}}"/>
                        <div style="margin-top: 10px;padding-left: 7px; border-radius: 10px;background-color: black; color: white; height: 25px; width: 100px;">
                            <p>{{$event->date}}</p>
                        </div>
                            <h3 style="color: #40a2df;">{{$event->name}}</h3>

                        <span style="margin-top: 20px">
                        {{$event->desc}}
                    </span>
                    </div>
                @endif
            @endforeach
        </div>
        <div style="text-align: center; color: black; height: 100px; margin: 0px 0px 0px 50px">
            <p>{{ $events->links() }}</p>
        </div>
    </div>
@endsection
