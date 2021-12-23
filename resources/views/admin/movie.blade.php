@extends('admin.admin')
@section('title', 'Фильмы')
@section('content')
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
                            </td>{{$all_type = null}}
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
            <a  class="btn btn-primary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-movie_id', $movie->movie_id)}}">
                Вернуть базовую версию
            </a>
        </form>
    </div>
@endsection
