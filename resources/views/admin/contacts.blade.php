@extends('admin.admin')
@section('title', 'Контакты')
@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        .icon_wrapper {
            height: 90px; width: 200px;
            background-color: #fefefe;
            background-repeat: no-repeat;
            border: dashed 1px #ccc;
        }
        .icon_wrapper div {
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            height: 90px; width: 200px;
        }
        input[type='file'] {
            color: transparent;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <form action="{{route('admin-contacts-save')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div style="width: 90%;" id="contacts">
            @foreach($contacts as $contact)
            <div class="mb-5" style="width: 80%; margin: 0 auto; padding: 30px; border: 2px solid black; border-radius: 15px" id="divCurrent_{{$contact->contact_id}}">
                <div class="col-10" style="text-align: right;">
                    <label class="switch">
                        <input type="checkbox" name="Contact[{{$contact->contact_id}}][status]" {{$contact->status == 1 ? 'checked' : ''}}>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Название кинотеатра</label>
                    <input type="text" class="form-control" name="Contact[{{$contact->contact_id}}][name_cinema]" value="{{$contact->name_cinema}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Адресс</label>
                    <textarea class="form-control" aria-label="With textarea" name="Contact[{{$contact->contact_id}}][address]">{{$contact->address}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Координаты для карты</label>
                    <input type="text" class="form-control"  name="Contact[{{$contact->contact_id}}][coordinates]" value="{{$contact->coordinates}}">
                </div>
                <div class="mb-3" style="width: 200px;">
                    <label for="icon_upload">Logo:<br>
                        <div class="icon_wrapper" style="height: 80px; width: 200px;">
                            <div id="logo-preview_{{$contact->contact_id}}" style="background: url({{$contact->image_url}}); background-repeat: no-repeat; height: 80px; width: 200px; background-size: 100%">

                            </div>
                        </div>
                    </label>
                    <input type="file" name="Contact_{{$contact->contact_id}}_logo" preview-target-id="logo-preview_{{$contact->contact_id}}" title="1">
                </div>
                <div class="mb-3" style="width: 200px;">
                    <label for="icon_upload">Главная картинка:<br>
                        <div class="icon_wrapper" style="height: 130px; width: 200px;">
                            <div id="mainimg-preview_{{$contact->contact_id}}" style="background: url({{$mainimg[$contact->contact_id]}}); background-repeat: no-repeat; height: 130px; width: 200px; background-size: 100%">

                            </div>
                        </div>
                    </label>
                    <input type="file" name="Contact_{{$contact->contact_id}}_mainimg" preview-target-id="mainimg-preview_{{$contact->contact_id}}" title="1">
                </div>
                <div onclick="deleteDiv('divCurrent_{{$contact->contact_id}}')" style="margin: 30px 0px 0px 70px; color: white;">
                    <a class="btn btn-danger">Удалить</a>
                </div>
            </div>
            @endforeach
        </div>
        <div onclick="addDiv()" style="margin: 0 auto; margin-top: 30px; width: 300px; color: white;">
            <a class="btn btn-secondary">Добавить кинотеатр</a>
        </div>
        <script>
            var countDiv = {{count($contacts)}};
            function addDiv() {
                    countDiv++;
                    var DivContacts = document.getElementById ('contacts');
                    var str =   '<div class="mb-5" style="width: 80%; margin: 0 auto; padding: 30px; border: 2px solid black; border-radius: 15px" id="divNewContact_'+ countDiv +'">'+
                                '<div class="col-10" style="text-align: right;">'+
                                '<label class="switch">'+
                                '<input type="checkbox" name="newContact['+ countDiv +'][status]">'+
                                '<span class="slider round"></span>'+
                                '</label>'+
                                '</div>'+
                                '<div class="mb-3">'+
                                '<label class="form-label">Название кинотеатра</label>'+
                                '<input type="text" class="form-control" name="newContact['+ countDiv +'][name_cinema]">'+
                                '</div>'+
                                '<div class="mb-3">'+
                                '    <label class="form-label">Адресс</label>'+
                                '    <textarea class="form-control" aria-label="With textarea" name="newContact['+ countDiv +'][address]"></textarea>'+
                                '</div>'+
                                '<div class="mb-3">'+
                                '    <label class="form-label">Координаты для карты</label>'+
                                '    <input type="text" class="form-control"  name="newContact['+ countDiv +'][coordinates]">'+
                                '</div>'+
                                '<div class="mb-3" style="width: 200px;">'+
                                '    <label for="icon_upload">Logo:<br>'+
                                '        <div class="icon_wrapper" style="height: 80px; width: 200px;">'+
                                '            <div id="logo-preview_'+ countDiv +'" style="background-repeat: no-repeat; height: 80px; width: 200px; background-size: 100%">'+
                                '            </div>'+
                                '        </div>'+
                                '    </label>'+
                                '    <input type="file" id="file_'+ countDiv +'" name="newContact_'+ countDiv +'_logo" preview-target-id="logo-preview_'+ countDiv +'" title="1">'+
                                '</div>'+
                                '<div class="mb-3" style="width: 200px;">'+
                                '<label for="icon_upload">Главная картинка:<br>'+
                                '<div class="icon_wrapper" style="height: 130px; width: 200px;">'+
                                '<div id="mainimg-preview_'+ countDiv +'" style=" background-repeat: no-repeat; height: 130px; width: 200px; background-size: 100%">'+
                                '</div>'+
                                '</div>'+
                                '</label>'+
                                '<input type="file" name="Contact_'+ countDiv +'_mainimg" preview-target-id="mainimg-preview_'+ countDiv +'" title="1">'+
                                '</div>'+
                                '<div onclick="deleteDiv(\'divNewContact_'+ countDiv +'\')" style="margin: 30px 0px 0px 70px; color: white;">'+
                                '    <a class="btn btn-danger">Удалить</a>'+
                                '</div>'+
                                '</div>';
                    $(DivContacts).append(str);
            }
            function deleteDiv(id) {
                var DivHidden = document.getElementById (id);
                DivHidden.remove();
            }
        </script>

        <div style="width: 70%; margin: 0 auto; margin-top: 80px;">
        <label for="exampleInputPassword1" class="form-label">SEO:</label>
        <div class="mb-3" style="width: 70%; margin-left: 50px">
            <div class="mb-3" style="">
                <label class="form-label">URL</label>
                <input type="text" class="form-control" id="seo_url" name="Seo[url]" value="{{$seo->seo_url}}">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" id="seo_title" name="Seo[title]" value="{{$seo->title}}">
                <label class="form-label">Keywords</label>
                <input type="text" class="form-control" id="seo_keywords" name="Seo[keywords]" value="{{$seo->keywords}}">
                <label class="form-label">Desc</label>
                <textarea class="form-control" aria-label="With textarea" name="Seo[desc]" id="seo_desc">{{$seo->desc}}</textarea>
            </div>
        </div>
        </div>

        <div style="margin: 0 auto; margin-top: 30px; width: 300px; color: white;">
            <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
        </div>
    </form>
    <script>
        $('input[type="file"][preview-target-id]').on('change', function() {
            var input = $(this)
            if (!window.FileReader) return false // check for browser support
            if (input[0].files && input[0].files[0]) {
                var reader = new FileReader()
                reader.onload = function (e) {
                    var target = $('#' + input.attr('preview-target-id'))
                    var background_image = 'url(' + e.target.result + ')'
                    target.css('background-image', background_image)
                    target.parent().show()
                }
                reader.readAsDataURL(input[0].files[0]);
            }
        })
    </script>
@endsection
