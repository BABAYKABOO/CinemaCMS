@extends('layout.app')
@section('title', 'Контакты')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="margin-top: 50px; margin-bottom: 100px;">
        <img width="100%" height = "600" src="http://cinema.com/storage/img/contacts.jpg"/>
    </div>
    <div style="width: 90%; margin: 0 auto;" id="contacts">
        <h1 style="text-align: center; padding-left: 20px; margin-top: 20px">Контакты</h1>
            @foreach($contacts as $contact)
                <div class="mb-5" style="width: 80%; margin: 0 auto; padding: 30px;">
                    <div class="row">
                        <div class="col-3" style="border: 1px solid red">
                             <h2>{{$contact->name_cinema}}</h2>
                        </div>
                        <div class="col-3" style="border: 1px solid red">
                            <img width="80%" src="{{$contact->image_url}}"/>
                        </div>
                        <div class="col" style="border: 1px solid red">
                            <span>{{$contact->address}}</span>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-6" style="border: 1px solid red">
                            <img width="90%" src="{{$mainimg[$contact->contact_id]}}"/>
                        </div>
                        <div class="col" style="border: 1px solid red; padding-left: 5px;">
                            <div id="map{{$contact->contact_id}}" style="width:100%;height:100%;">{{$contact->coordinates}}</div>
                        </div>
                    </div>
                </div>
            <script>
                function myMap() {
                    var mapCanvas = document.getElementById("map{{$contact->contact_id}}");
                    var coordinates = "{{$contact->coordinates}}";
                    var arrCoord = coordinates.split(',');
                    var mapOptions = {
                        center: new google.maps.LatLng(parseFloat(arrCoord[0]), parseFloat(arrCoord[1])),
                        zoom: 20
                    };
                    var map = new google.maps.Map(mapCanvas, mapOptions);
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(arrCoord[0]), parseFloat(arrCoord[1])),
                        map: map,
                    });
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0yhooQfpTpBlOr-ryFA5s1P4FWCRY6jo&callback=myMap"></script>
            @endforeach
    </div>

@endsection
