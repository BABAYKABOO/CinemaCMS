@extends('admin.admin')
@section('title', 'Фильмы')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="text-align: left">
        <form action="{{route('admin-movie-save', $movie->movie_id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Название фильма</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$movie->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" id="desc">{{$movie->desc}}</textarea>
            </div>
            <div class="mb-3">
                <div class="row ml-3" style="margin-bottom: 10px">
                    <span id="output">
                        <img class="thumb" height="200px" width="125px" src="{{$movie->image_url}}"/>
                    </span>
                </div>
                <div class="row ml-3">
                    <input type="button" id="loadFileXml" value="Добавить" onclick="document.getElementById('file').click();" />
                    <input type="file" style="display:none;" id="file" name="mainimg" />
                </div>
                <script>
                    function handleFileSelect(evt) {
                        var file = evt.target.files; // FileList object
                        var f = file[0];
                        // Only process image files.
                        if (!f.type.match('image.*')) {
                            alert("Image only please....");
                        }
                        var reader = new FileReader();
                        // Closure to capture the file information.
                        reader.onload = (function(theFile) {
                            return function(e) {
                                // Render thumbnail.
                                var span = document.createElement('span');
                                span.innerHTML = ['<img class="thumb" height="300px" width="200px" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
                                document.getElementById('output').innerHTML = "";
                                document.getElementById('output').insertBefore(span, null);
                            };
                        })(f);
                        // Read in the image file as a data URL.
                        reader.readAsDataURL(f);
                    }
                    document.getElementById('file').addEventListener('change', handleFileSelect, false);
                </script>
            </div>
            <div class="mb-3">
                <label>Галерея</label>
                <div class="row">
                    <div class="col-sm" style="width: 200px;">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_1" style="background: url({{$gallery[1]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[0]" preview-target-id="preview_1" title="1">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_2" style="background: url({{$gallery[1]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[1]" preview-target-id="preview_2">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_3" style="background: url({{$gallery[2]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[2]" preview-target-id="preview_3">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_4" style="background: url({{$gallery[3]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[3]" preview-target-id="preview_4">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_5" style="background: url({{$gallery[4]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[4]" preview-target-id="preview_5">
                    </div>
                    <style>
                        .icon_wrapper {
                            height: 90px; width: 200px;
                            background-color: #fefefe;
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
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Ссылка на трейлер</label>
                <input type="text" class="form-control" id="trailer" name="trailer" value="{{$movie->trailer}}">
            </div>
            <div style="width: 30%; margin-left: 50px;" id="divAppend">
                <div class="mb-3">
                    <label class="form-label">Год выпуска</label>
                    <input type="text" style="width: 90%" class="form-control" name="year" value="{{$movie->year}}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Страна</label>
                    <input type="text" style="width: 90%" class="form-control" name="country" value="{{$movie->country}}"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Бюджет</label>
                    <input type="text" style="width: 90%" class="form-control" name="budget" value="{{$movie->budget}}"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Минимальный возраст</label>
                    <input type="text" style="width: 90%" class="form-control" name="age" value="{{$movie->age}}"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Длительность</label>
                    <input type="text" style="width: 90%" class="form-control" name="time" value="{{$movie->time}}"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Жанр</label>
                    <section class="container">
                        <div>
                            <select name="genres_active[]" id="leftValues" size="8" multiple>
                                    @foreach($genres_active as $genre)
                                        <option selected value="{{$genre->genre_id}}">{{$genre->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="button" id="btnLeft" value="&lt;&lt;" />
                            <input type="button" id="btnRight" value="&gt;&gt;" />
                        </div>
                        <div>
                            <select id="rightValues" name="genres_inactive[]" style="width: 200px" size="7" multiple>
                                @foreach($genres as $genre)
                                    <option value="{{$genre->genre_id}}">{{$genre->name}}</option>
                                @endforeach
                            </select>
                            <div>
                                <input type="text" id="txtRight" />
                            </div>
                        </div>
                    </section>
                    <style>
                        SELECT, INPUT[type="text"] {
                            width: 100px;
                            box-sizing: border-box;
                        }
                        SECTION {
                            padding: 8px;
                            background-color: #f0f0f0;
                            overflow: auto;
                        }
                        SECTION > DIV {
                            float: left;
                            padding: 4px;
                        }
                        SECTION > DIV + DIV {
                            width: 40px;
                            text-align: center;
                        }
                    </style>
                    <script type="text/javascript">
                        $("#btnLeft").click(function () {
                            var selectedItem = $("#rightValues option:selected");
                            $("#leftValues").append(selectedItem);
                        });

                        $("#btnRight").click(function () {
                            var selectedItem = $("#leftValues option:selected");
                            $("#rightValues").append(selectedItem);
                        });

                        $("#rightValues").change(function () {
                            var selectedItem = $("#rightValues option:selected");
                            $("#txtRight").val(selectedItem.text());
                        });
                    </script>
                </div>
                @foreach($people as $person)
                    <div class="peoples" id="person_{{$person->people_id}}" style="margin-top: 5px; border: 1px solid black; padding: 10px; border-radius: 20px">
                        <label class="form-label">Должность</label>
                        <select class="form-control" name="People[{{$person->people_id}}][position]">
                            @foreach($positions as $position)
                                <option @if($person->position_id == $position->position_id) selected @endif value="{{$position->position_id}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                        <label class="form-label">Имя</label>
                        <input type="text" style="width: 90%" class="form-control" name="People[{{$person->people_id}}][name]" placeholder="Имя"  required>
                        <a class="btn btn-danger mt-4" style="color: white" onclick="deleteDiv('person_{{$person->people_id}}')">Удалить</a>
                    </div>
                @endforeach
            </div>
            <div style="width: 30%; margin-top: 20px; margin-left: 50px;">
                <a class="btn btn-success" style="color: white" onclick="addDiv()">Добавить нового человека</a>
            </div>
            <script>
                var countDiv = {{count($people) > 0 ? $people[count($people)-1]->people_id : 0}};
                function addDiv() {
                    countDiv++;
                    var DivHidden = $('#divAppend');
                    var str = '<div id="person_' + countDiv + '" class="peoples" style="margin-top: 5px; border: 1px solid black; padding: 10px; border-radius: 20px">' +
                        '<label class="form-label">Должность</label>' +
                        '<select class="form-control" name="People[' + countDiv + '][position]">' +
                        '@foreach($positions as $position)' +
                        '<option value="{{$position->position_id}}">{{$position->name}}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '<label class="form-label">Имя</label>' +
                        '<input type="text" class="form-control" name="People[' + countDiv + '][name]" placeholder="Длительность"  required>' +
                        '<a class="btn btn-danger mt-4" style="color: white" onclick="deleteDiv(\'person_' + countDiv + '\')">Удалить</a>';
                    $(DivHidden).append(str);
                }
                function deleteDiv(id) {
                    var DivHidden = document.getElementById (id);
                    var peoples = document.getElementsByClassName('peoples');
                    if (peoples-1 > 0)
                    {
                        DivHidden.remove();
                    }
                    else {
                        alert('Нужен хотя-бы один человек');
                    }
                }
            </script>
            <div class="mb-3 form-check">
                <label class="form-check-label mr-5" for="check">Тип кино</label>
                <tr>
                @foreach($all_types as $all_type)
                    @foreach($types as $type)
                        @if($type->name == $all_type->name)
                            <td>
                                <label class="form-check-label" for="exampleCheck1">{{$type->name}}</label>
                                <input type="checkbox" class="form-check-input mt-4" name="Types[{{$type->type_id}}]" checked>
                            </td>
                            @php
                              $all_type = null
                            @endphp
                            @break
                        @endif
                    @endforeach
                    @if($all_type != null)
                            <td>
                                <label class="form-check-label" for="exampleCheck1">{{$all_type->name}}</label>
                                <input type="checkbox" class="form-check-input mt-4" name="Types[{{$all_type->type_id}}]">
                            </td>
                    @endif
                @endforeach
                </tr>
            </div>
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
            <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
            <a class="btn btn-secondary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-movie_id', $movie->movie_id)}}">
                Вернуть базовую версию
            </a>
            <a class="btn btn-danger" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-movie_delete', $movie->movie_id)}}">
                Удалить фильм
            </a>

        </form>
    </div>
@endsection
