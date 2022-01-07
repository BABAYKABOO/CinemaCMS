@extends('layout.app')
@section('title', 'Контакты')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyC0yhooQfpTpBlOr-ryFA5s1P4FWCRY6jo"></script>
    <div style="margin-top: 50px; margin-bottom: 100px;">
        <img width="100%" height = "600" src="http://cinema.com/storage/img/contacts.jpg"/>
    </div>
    <div style="width: 90%; margin: 0 auto;" id="contacts">
        <h1 style="text-align: center; padding-left: 20px; margin-top: 20px">Контакты</h1>
            @foreach($contacts as $contact)
                <div class="mb-5" style="width: 80%; margin: 0 auto; background-color: #dddddd; border-radius: 30px; padding: 30px;">
                    <div class="row">
                        <div class="col-3" style="">
                             <h2>{{$contact->name_cinema}}</h2>
                        </div>
                        <div class="col-3" style="">
                            <img width="80%" src="{{$contact->image_url}}"/>
                        </div>
                        <div class="col" style="">
                            <span>{{$contact->address}}</span>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-6" style="">
                            <img width="90%" src="{{$mainimg[$contact->contact_id]}}"/>
                        </div>
                        <div class="col" style=" padding-left: 5px;">
                            <div id="map-{{$contact->contact_id}}" style="width:100%;height:100%;">{{$contact->coordinates}}</div>
                        </div>
                    </div>
                </div>
           @endforeach
    </div>
    <script>
        [
                @foreach($contacts as $contact)
            {
                el: '#map-{{$contact->contact_id}}',
                center: [parseFloat("{{$contact->coordinates}}".split(',')[0]), parseFloat("{{$contact->coordinates}}".split(',')[1])],
                markers: [
                    [parseFloat("{{$contact->coordinates}}".split(',')[0]), parseFloat("{{$contact->coordinates}}".split(',')[1])],
                ],
            },
            @endforeach
        ].forEach(initMap);


        function initMap({ el, center, markers }) {
            el = document.querySelector(el);
            el.classList.add('map');

            const map = new google.maps.Map(el, {
                center: new google.maps.LatLng(...center),
                zoom: 17,
            });

            markers.forEach(([ lat, lng ]) => {
                new google.maps.Marker({
                    position: { lat, lng },
                    map,
                });
            });
        }

    </script>
@endsection
