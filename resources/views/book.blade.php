@extends('layout.app')
@section('title', 'Бронирование')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="margin-top: 50px; margin-bottom: 100px;">
        <img width="100%" height = "600" src="http://cinema.com/storage/img/book.jpg"/>
    </div>
    <div class="row" style="width: 90%; margin: 0 auto">
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
                            БИЛЕТОВ: <span id='count_' style="color: #b75b46">0</span>
                        </div>
                        <div class="col">
                            СУММА: <span id='sum_' style="color: #b75b46">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin: 0 auto; height: 800px;">
                    <hr class="rounded_underline"/>
                    <h5 style="text-align: center; margin-top: -80px; margin-bottom: 80px;">ЭКРАН</h5>
                    <form action="{{route('timetable-book', $timetable->timetable_id)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @foreach($places as $number => $row)
                            <div style="float: left; width: 60px; margin-right: 50px;">
                                РЯД {{$number+1}}
                            </div>
                            <div style="width: max-content; margin: 0 auto;">
                            @foreach($row as $num => $place)
                                @if($place == false)
                                    <div class="inavailable_place">

                                    </div>
                                @else
                                    <div class="place" target-id="{{$number+1}}_checkbox_{{$num + 1}}">
                                        <input type="checkbox" name="{{$number+1}}[{{$num + 1}}]" id="{{$number+1}}_checkbox_{{$num + 1}}" style="display: none;"/>
                                        {{$num+1}}
                                    </div>
                                @endif
                            @endforeach
                            </div>
                            <div style="height: 50px;"></div>
                        @endforeach
                        <button type="submit" id="button_book" style="display: none; margin: 0 auto; margin-top: 50px;" class="btn btn-secondary">Забронировать</button>
                    </form>
                <script>
                    $('div[class="place"][target-id]').on('click', function() {
                        var div = $(this);
                        var target = $('#' + div.attr('target-id'));
                        if(div.css('background-color') === 'rgb(238, 128, 51)')
                        {
                            div.css('background-image', 'url(http://cinema.com/storage/img/book_place.jpg)');
                            div.css('color', 'transparent');
                            div.css('background-color', 'rgb(218, 218, 218)');
                            document.getElementById('count_').innerHTML = Count_Mest();
                            document.getElementById('sum_').innerHTML = Count_Mest() * {{$timetable->price}};
                            target.prop('checked', true);
                        }
                        else {
                            div.css('background-color', 'rgb(238, 128, 51)');
                            div.css('color', 'white');
                            div.css('background-image', '');
                            document.getElementById('count_').innerHTML = Count_Mest();
                            document.getElementById('sum_').innerHTML = Count_Mest() * {{$timetable->price}};
                            target.prop('checked', false);
                        }
                    })
                    function Count_Mest (){
                        var l = document.getElementsByClassName('place');
                        let z_mest = 0;
                        for(let i=0;i<l.length;i++){
                            if(window.getComputedStyle(l[i]).backgroundColor === 'rgb(218, 218, 218)'){
                                z_mest++;
                            }
                        }
                        if (z_mest !== 0)
                        {
                            $('#button_book').css('display', 'block');
                        }
                        else
                        {
                            $('#button_book').css('display', 'none');
                        }

                        return z_mest;
                    }



                </script>
                <style>
                    .rounded_underline{
                        width: 80%;
                        height: 70px;
                        border-top: 5px solid gray;
                        border-radius: 50%;
                    }
                    .inavailable_place{
                        float: left;
                        width: 36px;
                        height: 36px;
                        color: transparent;
                        background-image: url(http://cinema.com/storage/img/place_inavailable.jpg);
                        margin: 1px;
                        cursor: pointer;
                    }
                    .place{
                        float: left;
                        width: 36px;
                        height: 36px;
                        padding: 10px 0px 0px 10px;
                        color: white;
                        background-color: #ee8033;
                        margin: 1px;
                        text-align: center;
                        cursor: pointer;
                    }

                </style>
            </div>
            <div>
                <span>Стоимость услуги бронирования - 3 грн. за каждое место.  <br/><br/>

ЗАБРОНИРОВАННЫЕ БИЛЕТЫ НУЖНО ВЫКУПИТЬ В КАССЕ КИНОТЕАТРА НЕ ПОЗДНЕЕ ЧЕМ ЗА ПОЛЧАСА ДО НАЧАЛА СЕАНСА.</span>

            </div>
        </div>
    </div>
@endsection
