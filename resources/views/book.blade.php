@extends('layout.app')
@section('title', 'Новости')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="margin-top: 50px; margin-bottom: 100px;">
        <img width="100%" height = "600" src="http://cinema.com/storage/img/book.jpg"/>
    </div>
    <div class="row" style="width: 80%; margin: 0 auto">
        <div class="col-3" >
            <img width="90%" src="{{$movie->image_url}}"/>
        </div>
        <div class="col" >
            <div style="padding: 5px; color: white; width: max-content; background-color: #b63d26; border-radius: 10px;">
                <h5>{{$movie->name}}</h5>
            </div>
            <div style="margin-top: 10px;">
                <span style="color: #746f6e">{{$date}}</span>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-2" >
                    ЦЕНА В ГРН:
                </div>
                <div class="col-1" >
                    <div style="padding-left: 9px; padding-top: 5px; color: white; font-weight: bolder; background-color: #f9c835; width: 36px; height: 36px;">
                    {{$timetable->price}}
                    </div>
                </div>
                <div class="col-2" >
                    ЗАБРОНИРОВАНО:
                </div>
                <div class="col-2" >
                    <div style="padding: 10px; color: white; font-weight: bolder; background: url(http://cinema.com/storage/img/book_place.jpg); width: 36px; height: 36px;">
                    </div>
                </div>
                <div class="col-2" >
                    ВАШИ БИЛЕТЫ:
                </div>
                <div class="col-3" >
                    <div class="row" style="border: 5px solid yellow">
                        <div class="col">
                            БИЛЕТОВ: <span style="color: #b75b46">0</span>
                        </div>
                        <div class="col">
                            СУММА: <span style="color: #b75b46">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="height: 500px;">
                
            </div>
            <div>
                <span>Стоимость услуги бронирования - 3 грн. за каждое место.  <br/><br/>

ЗАБРОНИРОВАННЫЕ БИЛЕТЫ НУЖНО ВЫКУПИТЬ В КАССЕ КИНОТЕАТРА НЕ ПОЗДНЕЕ ЧЕМ ЗА ПОЛЧАСА ДО НАЧАЛА СЕАНСА.</span>

            </div>
        </div>
    </div>
@endsection
