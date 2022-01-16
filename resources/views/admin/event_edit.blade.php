@extends('admin.admin')
@section('title', 'Новая акция')
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
    <div style="text-align: left; margin-left: 20px">
        <form action="{{route('admin-event-save', $event->event_id )}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8" style="text-align: right;">
                    <label class="switch">
                        <input type="checkbox" name="status" {{$event->status == 1 ? 'checked' : ''}}>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-3" style="text-align: right;">
                    <label class="form-label">Дата публикации</label>
                    <input type="date"  class="form-control" id="data" name="date" value="{{$event->date}}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Название новости</label>
                <input type="text" class="form-control" id="name" placeholder="Название" name="name" value="{{$event->name}}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" placeholder="Описание" id="desc" required>{{$event->desc}}</textarea>
            </div>
            <div class="mb-3" style="width: 200px;">
                <label for="icon_upload">Главная:<br>
                    <div class="icon_wrapper" style="height: 150px; width: 200px;">
                        <div id="main-preview_11" style="background: url({{$event->image_url}}); height: 150px; width: 200px; background-size: 100%">

                        </div>
                    </div>
                </label>
                <input type="file" name="mainimg" preview-target-id="main-preview_11" title="1">
            </div>
            <label for="label" class="form-label">SEO:</label>
            <div class="mb-3" style="width: 70%; margin-left: 50px">
                <div class="mb-3" style="">
                    <label class="form-label">URL</label>
                    <input type="text" class="form-control" id="seo_url" name="Seo[url]" placeholder="URL" value="{{$seo->seo_url}}" required>
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" id="seo_title" name="Seo[title]" placeholder="Title"  value="{{$seo->title}}" required>
                    <label class="form-label">Keywords</label>
                    <input type="text" class="form-control" id="seo_keywords" name="Seo[keywords]" placeholder="Word"  value="{{$seo->keywords}}" required>
                    <label class="form-label">Desc</label>
                    <textarea class="form-control" aria-label="With textarea" name="Seo[desc]" placeholder="Description"  id="seo_desc" required>{{$seo->desc}}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
            <a class="btn btn-secondary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="">
                Вернуть базовую версию
            </a>
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
    </div>
@endsection
