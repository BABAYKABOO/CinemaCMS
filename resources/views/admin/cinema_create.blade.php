@extends('admin.admin')
@section('title', 'Новый кинотеатр')
@section('content')
    <div style="text-align: left; margin-left: 20px">
        <form action="{{route('admin-cinema_create')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Название кинотеатр</label>
                <input type="text" class="form-control" id="name" placeholder="Название" name="name" value="" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" placeholder="Описание" id="desc" required></textarea>
            </div>
            <div class="mb-3">
                <div class="row" style="width: 80%">
                    <div class="col-2">
                        <label class="form-label">Условия</label>
                    </div>
                    <div class="col-5" id="conditions_active" style="display: none;">
                    </div>
                    <div class="col-1">
                        <img id="add_or_subtract" style="cursor: pointer;" width="20" height="20" src="http://cinema.com/storage/img/icon_added.png"/>
                    </div>
                    <div class="col-3" id="div_tags" style="position: absolute; margin-left: 250px; width: max-content; display: none;background-color: #ffffff;padding: 0px 20px 10px 20px; border-radius: 20px; border: 1px solid black">
                        @foreach($conditions_all as $cond)
                            <div class="cond_all" preview-id="cond_{{$cond->condition_id}}" id="cond_{{$cond->condition_id}}_all" style="background-color: #D2D3C2;">
                                {{$cond->condition_name}}
                            </div>
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
                        var div_cond = $('#conditions_active');
                        if(div_cond.css('display') === 'none')
                        {
                            div_cond.css('display', '');
                            $('#div_tags').css('margin-left', '650px');

                        }
                        var div = $(this);
                        if (div.css('background-color') === 'rgb(63, 225, 17)')
                        {
                            $('#' + div.attr('preview-id')).click();
                        }
                        else
                        {
                            var condition = '<div class="cond_active" id="'+ div.attr('preview-id') +'">' +
                                div.text() +
                                '<input type="checkbox" name="conditions_active['+ parseInt(div.attr('preview-id').match(/\d+/)) +']" style="display: none;"checked>' +
                                '</div>';
                            div_cond.append(condition);
                            div.css('background-color', '#3FE111').css('color', 'white');
                        }
                    });
                </script>
            </div>
            <div class="mb-3" style="width: 200px;">
                <label for="icon_upload">Главная:<br>
                    <div class="icon_wrapper" style="height: 150px; width: 200px;"><div id="main-preview_1" style="height: 150px; width: 200px; background-size: 100%"></div></div>
                </label>
                <input type="file" name="mainimg" preview-target-id="main-preview_1" title="1" required>
            </div>

            <div class="mb-3" style="width: 200px;">
                <label for="icon_upload">Logo:<br>
                    <div class="icon_wrapper"><div id="logo-preview_1" style=" background-size: 100%"></div></div>
                </label>
                <input type="file" name="logo" preview-target-id="logo-preview_1" title="1" required>
            </div>

            <div class="mb-3" style="width: 200px;">
                <label for="icon_upload">Фото верхнего баннера:<br>
                    <div class="icon_wrapper"><div id="topbanner-preview_1" style=" background-size: 100%"></div></div>
                </label>
                <input type="file" name="topbanner" preview-target-id="topbanner-preview_1" title="1" required>
            </div>
            <div class="mb-3">
                <label>Галерея</label>
                <div class="row">
                    <div class="col-sm" style="width: 200px;">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_1" style=" background-size: 100%"></div></div>
                        </label><br/>
                        <input type="file" name="Gallery[0]" preview-target-id="gallery-preview_1" title="1" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_2" style=" background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[1]" preview-target-id="gallery-preview_2" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_3" style=" background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[2]" preview-target-id="gallery-preview_3" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_4" style=" background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[3]" preview-target-id="gallery-preview_4" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_5" style=" background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[4]" preview-target-id="gallery-preview_5" required>
                    </div>
                </div>
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
            <label for="label" class="form-label">SEO:</label>
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
            <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
            <a class="btn btn-secondary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="">
                Вернуть базовую версию
            </a>
        </form>
    </div>
@endsection
