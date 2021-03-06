@extends('admin.admin')
@section('title', 'Редактирование страницы')
@section('content')
    <style>
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="text-align: left">
        <form action="{{route('admin-page_id-save', $page->page_id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div style="text-align: right; margin-right: 100px">
                <label class="switch">
                    <input type="checkbox" name="status" {{$page->status == 1 ? 'checked' : ''}}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">Название страницы</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$page->name}}">
            </div>
            <div class="mb-3" style="width: 200px;">
                <label for="icon_upload">Верхний баннер:<br>
                    <div class="icon_wrapper" style="height: 80px; width: 200px;">
                        <div id="topbanner-preview_1" style="background: url({{$page->image_url}}); background-repeat: no-repeat; height: 80px; width: 200px; background-size: 100%">

                        </div>
                    </div>
                </label>
                <input type="file" name="topbanner" preview-target-id="topbanner-preview_1" title="1">
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" id="desc">{{$page->desc}}</textarea>
            </div>
            <div class="mb-3">
                <label>Галерея</label>
                <div class="row">
                    <div class="col-sm" style="width: 200px;">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="sub_preview_1" style="background: url({{$sub_gallery[0]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Sub_Gallery[0]" preview-target-id="sub_preview_1" title="1">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="sub_preview_2" style="background: url({{$sub_gallery[1]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Sub_Gallery[1]" preview-target-id="sub_preview_2">
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="sub_preview_3" style="background: url({{$sub_gallery[2]->image_url}}); background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Sub_Gallery[2]" preview-target-id="sub_preview_3">
                    </div>
                </div>
            </div>
                <div class="mb-3">
                    <label class="form-label">Описание</label>
                    <textarea class="form-control" aria-label="With textarea" name="sub_desc" id="desc">{{isset($page->sub_desc) ? $page->sub_desc : ''}}</textarea>
                </div>
                <div class="mb-3">
                    <label>Галерея</label>
                    <div class="row">
                        <div class="col-sm" style="width: 200px;">
                            <label for="icon_upload">Image:<br>
                                <div class="icon_wrapper"><div id="preview_1" style="background: url({{isset($gallery[0]->image_url) ? $gallery[0]->image_url : ''}}); background-size: 100%"></div></div>
                            </label>
                            <input type="file" name="Gallery[0]" preview-target-id="preview_1" title="1">
                        </div>
                        <div class="col-sm" style="width: 200px">
                            <label for="icon_upload">Image:<br>
                                <div class="icon_wrapper"><div id="preview_2" style="background: url({{isset($gallery[1]->image_url) ? $gallery[1]->image_url : ''}}); background-size: 100%"></div></div>
                            </label>
                            <input type="file" name="Gallery[1]" preview-target-id="preview_2">
                        </div>
                        <div class="col-sm" style="width: 200px">
                            <label for="icon_upload">Image:<br>
                                <div class="icon_wrapper"><div id="preview_3" style="background: url({{isset($gallery[2]->image_url) ? $gallery[2]->image_url : ''}}); background-size: 100%"></div></div>
                            </label>
                            <input type="file" name="Gallery[2]" preview-target-id="preview_3">
                        </div>
                        <div class="col-sm" style="width: 200px">
                            <label for="icon_upload">Image:<br>
                                <div class="icon_wrapper"><div id="preview_4" style="background: url({{isset($gallery[3]->image_url) ? $gallery[3]->image_url : ''}}); background-size: 100%"></div></div>
                            </label>
                            <input type="file" name="Gallery[3]" preview-target-id="preview_4">
                        </div>
                        <div class="col-sm" style="width: 200px">
                            <label for="icon_upload">Image:<br>
                                <div class="icon_wrapper"><div id="preview_5" style="background: url({{isset($gallery[4]->image_url) ? $gallery[4]->image_url : ''}}); background-size: 100%"></div></div>
                            </label>
                            <input type="file" name="Gallery[4]" preview-target-id="preview_5">
                        </div>
                    </div>
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
                    <a class="btn btn-secondary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-page_id-edit', $page->page_id)}}">
                        Вернуть базовую версию
                    </a>
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

        </form>
    </div>
@endsection
