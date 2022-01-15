@extends('admin.admin')
@section('title', 'Редактировать фильм')
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
                <div class="col-sm" style="width: 200px;">
                    <label for="icon_upload">Image:<br>
                        <div class="icon_wrapper" style="width: 125px; height:200px"><div id="main-preview_1" style="background: url({{$movie->image_url}}); background-size: 100%; width: 125px; height:200px"></div></div>
                    </label>
                    <input type="file" name="mainimg" preview-target-id="main-preview_1" title="1">
                </div>
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
                    <input type="text" style="width: 90%" class="form-control" name="movie_time" value="{{$movie->movie_time}}"  required>
                </div>
                <div class="mb-3">
                    <div class="row" style="width: 100%">
                        <div class="col-3">
                            <label class="form-label">Жанр</label>
                        </div>
                        <div class="col-5" id="genres_active">
                            @foreach($genres_active as $genre)
                                <div class="genre_active" id="genre_{{$genre->genre_id}}">
                                    {{$genre->name}}
                                    <input type="checkbox" name="genres_active[{{$genre->genre_id}}]" style="display: none;" checked>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-1">
                            <img id="add_or_subtract" style="cursor: pointer;" width="20" height="20" src="http://cinema.com/storage/img/icon_added.png"/>
                        </div>
                        <div class="col-3" id="div_tags" style="position: absolute; margin-left: 300px; width: max-content; display: none;background-color: #ffffff;padding: 0px 20px 10px 20px; border-radius: 20px; border: 1px solid black">
                            @foreach($genres_all as $genre)
                                @php
                                    $isAdd = true
                                @endphp
                                @foreach($genres_active as $genre_temp)
                                    @if($genre_temp->genre_id == $genre->genre_id)
                                        <div class="genre_all" preview-id="genre_{{$genre->genre_id}}" id="genre_{{$genre->genre_id}}_all" style="color: white; background-color: #3FE111;">
                                            {{$genre->name}}
                                        </div>
                                        @php
                                            $isAdd = false
                                        @endphp
                                        @break
                                    @endif
                                @endforeach

                                @if($isAdd)
                                <div class="genre_all" preview-id="genre_{{$genre->genre_id}}" id="genre_{{$genre->genre_id}}_all" style="background-color: #D2D3C2;">
                                    {{$genre->name}}
                                </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <style>
                        .genre_all{
                            padding: 5px 10px 5px 10px;
                            border-radius: 20px;
                            width: max-content;
                            cursor: pointer;
                            margin-top: 10px;
                        }
                        .genre_active{
                            float: left;
                            padding: 5px;
                            cursor: pointer;
                            margin: 5px;
                            color: white;
                            background-color: #3FE111;
                            border-radius: 15px;
                        }
                    </style>
                    <script>
                        $("body").on("click", '.genre_active', function () {
                            var div = $(this).remove();
                            $('#' + div.attr('id') + '_all').css('background-color', '#D2D3C2').css('color', '');
                        });

                        $("body").on("click", '#add_or_subtract', function () {
                            var img = $(this);
                            if(img.attr('src') === 'http://cinema.com/storage/img/icon_added.png') {
                                img.attr('src', 'http://cinema.com/storage/img/icon_minus.png');
                                $('#div_tags').css('display', '');
                            }
                            else{
                                img.attr('src', 'http://cinema.com/storage/img/icon_added.png');
                                $('#div_tags').css('display', 'none');
                            }
                        });

                        $("body").on("click", '.genre_all', function () {
                            var div = $(this);
                            if (div.css('background-color') === 'rgb(63, 225, 17)')
                            {
                                $('#' + div.attr('preview-id')).click();
                            }
                            else
                            {
                                var genre = '<div class="genre_active" id="'+ div.attr('preview-id') +'">' +
                                    div.text() +
                                    '<input type="checkbox" name="genres_active['+ parseInt(div.attr('preview-id').match(/\d+/)) +']" style="display: none;" checked>' +
                                    '</div>';
                                $('#genres_active').append(genre);
                                div.css('background-color', '#3FE111').css('color', 'white');
                            }
                        });
                    </script>
                </div>
                @foreach($people as $person)
                    <div class="peoples" id="person_{{$person->people_id}}" style="margin-top: 5px; border: 1px solid black; padding: 10px; border-radius: 20px">
                        <label class="form-label">Должность</label>
                        <select class="form-control" name="People[{{$person->people_id}}][position]">
                            @foreach($positions as $position)
                                <option @if($person->position_id == $position->position_id) selected @endif value="{{$position->position_id}}">{{$position->position_name}}</option>
                            @endforeach
                        </select>
                        <label class="form-label">Имя</label>
                        <input type="text" style="width: 90%" class="form-control" name="People[{{$person->people_id}}][name]" value="{{$person->name}}" placeholder="Имя"  required>
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
                        '<option value="{{$position->position_id}}">{{$position->position_name}}</option>' +
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
