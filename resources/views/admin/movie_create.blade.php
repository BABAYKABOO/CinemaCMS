@extends('admin.admin')
@section('title', 'Создать фильм')
@section('content')
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="text-align: left">
        <form action="{{route('admin-movie_create')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Название фильма</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Название фильма" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" id="desc" placeholder="текст" required></textarea>
            </div>
            <div class="mb-3">
                <div class="col-sm" style="width: 200px;">
                    <label for="icon_upload">Image:<br>
                        <div class="icon_wrapper" style="height: 180px; width: 125px"><div id="main-preview_1" style="height: 180px; width: 125px;background-size: 100%; background-position: 0px;">

                            </div>
                        </div>
                    </label>
                    <input type="file" name="mainimg" preview-target-id="main-preview_1" title="1" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Галерея</label>
                <div class="row">
                    <div class="col-sm" style="width: 200px;">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_1" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[0]" preview-target-id="preview_1" title="1" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_2" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[1]" preview-target-id="preview_2" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_3" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[2]" preview-target-id="preview_3" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_4" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[3]" preview-target-id="preview_4" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="preview_5" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[4]" preview-target-id="preview_5" required>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Ссылка на видео в youtube"  required>
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label mr-5" for="check">Тип кино</label>
                <tr>
                    @foreach($all_types as $all_type)
                            <td>
                                <label class="form-check-label" for="exampleCheck1">{{$all_type->name}}</label>
                                <input type="checkbox" id="checkbox{{$all_type->type_id}}" style="margin-top: 25px;" class="form-check-input" name="Types[{{$all_type->type_id}}]" onclick="ChangeCheckBox({{$all_type->type_id}})">
                            </td>
                    @endforeach
                </tr>
            </div>
            <div style="width: 30%; margin-left: 50px;" id="divAppend">
                <div class="mb-3">
                    <label class="form-label">Год выпуска</label>
                    <input type="text" class="form-control" name="year" placeholder="Год выпуска"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Страна</label>
                    <input type="text" class="form-control" name="country" placeholder="Страна"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Бюджет</label>
                    <input type="text" class="form-control" name="budget" placeholder="Бюджет"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Минимальный возраст</label>
                    <input type="text" class="form-control" name="age" placeholder="16"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Длительность</label>
                    <input type="text" class="form-control" name="movie_time" placeholder="Длительность"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Жанр</label>
                    <section class="container">
                        <div>
                            <select name="genres_active[]" id="leftValues" size="8" multiple></select>
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
                <div class="mb-5" id="person_1" style="border: 1px solid black; padding: 10px; border-radius: 20px">
                    <label class="form-label">Должность</label>
                    <select class="form-control" name="People[1][position]">
                        @foreach($positions as $position)
                            <option value="{{$position->position_id}}">{{$position->position_name}}</option>
                        @endforeach
                    </select>
                    <label class="form-label">Имя</label>
                    <input type="text" class="form-control" name="People[1][name]" placeholder="Имя"  required>
                </div>
            </div>
            <div style="width: 30%; margin-left: 50px;">
                <a class="btn btn-success" style="color: white" onclick="addDiv()">Добавить нового человека</a>
            </div>
            <script>
                    var countDiv = 1;
                    function addDiv() {
                        countDiv++;
                        var DivHidden = $('#divAppend');
                        var str = '<div id="person_' + countDiv + '" class="mb-3" style="border: 1px solid black; padding: 10px; border-radius: 20px">' +
                            '<label class="form-label">Должность</label>' +
                            '<select class="form-control" name="People["' + countDiv + '][position]">' +
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
                        DivHidden.remove();
                    }
            </script>
            <label for="exampleInputPassword1" class="form-label">SEO:</label>
            <div class="mb-3" style="width: 70%; margin-left: 50px">
                <div class="mb-3" style="">
                    <label class="form-label">URL</label>
                    <input type="text" class="form-control" id="seo_url" name="Seo[url]" placeholder="URL" value="" required>
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" id="seo_title" name="Seo[title]" placeholder="Title"  value="" required>
                    <label class="form-label">Keywords</label>
                    <input type="text" class="form-control" id="seo_keywords" name="Seo[keywords]" placeholder="Word"  value="" required>
                    <label class="form-label">Desc</label>
                    <textarea class="form-control" aria-label="With textarea" name="Seo[desc]" placeholder="Description"  id="seo_desc" required></textarea>
                </div>
            </div>
            <button type="submit" id="submit_button" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
            <a class="btn btn-primary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-movie_new')}}">
                Вернуть базовую версию
            </a>
                <script>
                    function ChangeCheckBox(id){
                        var checkboxes = document.getElementsByClassName('form-check-input');
                        var ischeckbox = document.getElementById('checkbox' + id);
                        if(ischeckbox.is(':checked'))
                        {
                            for(i = 0; i<checkboxes.length; i++)
                            {
                                checkboxes[i].required = "none";
                            }
                        }
                        else{
                            for(i = 0; i<checkboxes.length; i++)
                            {
                                checkboxes[i].required = "required";
                            }
                        }
                    }
                </script>
        </form>
    </div>
@endsection
