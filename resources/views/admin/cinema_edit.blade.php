@extends('admin.admin')
@section('title', 'Редактировать кинотеатр')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="text-align: left; margin-left: 20px">
        <form action="{{route('admin-cinema_save', $cinema->cinema_id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-5">
                <label class="form-label">Название кинотеатра</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$cinema->name}}">
            </div>
            <div class="mb-5">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" id="desc">{{$cinema->desc}}</textarea>
            </div>
            <div class="mb-5">
                <div class="row" style="width: 80%">
                    <div class="col-2">
                        <label class="form-label">Условия</label>
                    </div>
                    <div class="col-5" id="conditions_active">
                        @foreach($conditions_active as $cond)
                            <div class="cond_active" id="cond_{{$cond->condition_id}}">
                                {{$cond->condition_name}}
                                <input type="checkbox" name="conditions_active[{{$cond->condition_id}}]" style="display: none;" checked>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-1">
                        <img id="add_or_subtract" style="cursor: pointer;" width="20" height="20" src="http://cinema.com/storage/img/icon_added.png"/>
                    </div>
                    <div class="col-3" id="div_tags" style="position: absolute; margin-left: 650px; width: max-content; display: none;background-color: #ffffff;padding: 0px 20px 10px 20px; border-radius: 20px; border: 1px solid black">
                        @foreach($conditions_all as $cond)
                            @php($isAdd = true)
                            @foreach($conditions_active as $cond_temp)
                                @if($cond_temp->condition_id == $cond->condition_id)
                                    <div class="cond_all" preview-id="cond_{{$cond->condition_id}}" id="cond_{{$cond->condition_id}}_all" style="color: white; background-color: #3FE111;">
                                        {{$cond->condition_name}}
                                    </div>
                                    @php($isAdd = false)
                                    @break
                                @endif
                            @endforeach
                            @if($isAdd)
                                <div class="cond_all" preview-id="cond_{{$cond->condition_id}}" id="cond_{{$cond->condition_id}}_all" style="background-color: #D2D3C2;">
                                    {{$cond->condition_name}}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <style>
                    .cond_all{
                        padding: 5px 10px 5px 10px;
                        border-radius: 20px;
                        width: max-content;
                        cursor: pointer;
                        margin-top: 10px;
                    }
                    .cond_active{
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
                    $("body").on("click", '.cond_active', function () {
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

                    $("body").on("click", '.cond_all', function () {
                        var div = $(this);
                        if (div.css('background-color') === 'rgb(63, 225, 17)')
                        {
                            $('#' + div.attr('preview-id')).click();
                        }
                        else
                        {
                            var condition = '<div class="cond_active" id="'+ div.attr('preview-id') +'">' +
                                 div.text() +
                                '<input type="checkbox" name="conditions_active['+ parseInt(div.attr('preview-id').match(/\d+/)) +']" style="display: none;" checked>' +
                                '</div>';
                            $('#conditions_active').append(condition);
                            div.css('background-color', '#3FE111').css('color', 'white');
                        }
                    });
                </script>
            </div>
            <div class="mb-5" style="width: 200px;">
                <label for="icon_upload">Главная:<br>
                    <div class="icon_wrapper" style="height: 150px; width: 200px;"><div id="main-preview_1" style="height: 150px; width: 200px; background: url({{$cinema->image_url}}); background-size: 100%"></div></div>
                </label>
                <input type="file" name="mainimg" preview-target-id="main-preview_1" title="1">
            </div>

            <div class="mb-5" style="width: 200px;">
                <label for="icon_upload">Logo:<br>
                    <div class="icon_wrapper"><div id="logo-preview_1" style="background: url({{$img['logo']}}); background-size: 100%"></div></div>
                </label>
                <input type="file" name="logo" preview-target-id="logo-preview_1" title="1">
            </div>

            <div class="mb-5" style="width: 200px;">
                <label for="icon_upload">Фото верхнего баннера:<br>
                    <div class="icon_wrapper"><div id="topbanner-preview_1" style="background: url({{$img['topbanner']}}); background-size: 100%"></div></div>
                </label>
                <input type="file" name="topbanner" preview-target-id="topbanner-preview_1" title="1">
            </div>
            <div class="mb-5" style="margin-bottom: 30px">
                <label>Галерея</label>
                <div class="row">
                    <div class="col-sm" style="width: 200px;">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_1" style="background: url({{$img['gallery'][0]->image_url}}); background-size: 100%"></div></div>
                        </label><br/>
                        <input type="file" name="Gallery[0]" preview-target-id="gallery-preview_1" title="1">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_2" style="background: url({{$img['gallery'][1]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[1]" preview-target-id="gallery-preview_2">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_3" style="background: url({{$img['gallery'][2]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[2]" preview-target-id="gallery-preview_3">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_4" style="background: url({{$img['gallery'][3]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[3]" preview-target-id="gallery-preview_4">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_5" style="background: url({{$img['gallery'][4]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[4]" preview-target-id="gallery-preview_5">
                    </div>
                </div>
            </div>
            <div style="text-align: center; width: 80%; margin: 0 auto">
                <h2 >Список залов</h2>
                <div class="row" style="text-align: center;">
                    <div class="col-5" style="height: 40px; border: 1px solid black;background-color: #cbcbcb">
                        Название
                    </div>
                    <div class="col-5" style="border: 1px solid black;background-color: #cbcbcb">
                        Дата создания
                    </div>
                    <div class="col-2" style="border: 1px solid black;background-color: #cbcbcb">
                        Дата создания
                    </div>
                    @foreach($halls as $hall)
                        <div class="col-5" style="height: 40px; border: 1px solid black; background-color: white">
                            {{$hall->number}}
                        </div>
                        <div class="col-5" style="border: 1px solid black; background-color: white">
                            {{$hall->created_at}}
                        </div>
                        <div class="col-2" style="border: 1px solid black; background-color: white">
                            <a href="{{route('admin-cinema_hall-edit', [
             'cinema_id' => $cinema->cinema_id,
             'hall_id' => $hall->hall_id
          ])}}"><img width="20" height="20" src="http://cinema.com/storage/img/editicon.png"/></a>

                            <a href="{{route('admin-cinema_hall-delete', [
             'cinema_id' => $cinema->cinema_id,
             'hall_id' => $hall->hall_id
          ])}}"><img width="20" height="20" src="http://cinema.com/storage/img/deleteicon.png"/></a>
                        </div>
                    @endforeach
                </div>
                <a href="{{route('admin-cinema_hall-new', $cinema->cinema_id)}}"><button type="button" class="btn btn-success" style="margin-top: 30px">Добавить зал</button></a>
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
                <a class="btn btn-secondary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-cinema_id', $cinema->cinema_id)}}">
                    Вернуть базовую версию
                </a>
                <a class="btn btn-danger" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-cinema-delete', $cinema->cinema_id)}}">
                    Удалить кинотеатр
                </a>

        </form>
    </div>
@endsection
