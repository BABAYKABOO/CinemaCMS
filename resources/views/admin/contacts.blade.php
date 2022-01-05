@extends('admin.admin')
@section('title', 'Контакты')
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div style="width: 90%;margin: 0 auto; border: 2px solid black; border-radius: 15px">
        <div class="mb-3">
            <label class="form-label">Название кинотеатра</label>
            <input type="text" class="form-control" id="name" name="name" value="">
        </div>
        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea class="form-control" aria-label="With textarea" name="desc" id="desc"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Координаты для карты</label>
            <input type="text" class="form-control" id="name" name="name" value="">
        </div>
        <div class="mb-3" style="width: 200px;">
            <label for="icon_upload">Logo:<br>
                <div class="icon_wrapper" style="height: 80px; width: 200px;">
                    <div id="topbanner-preview_1" style="background: url(); background-repeat: no-repeat; height: 80px; width: 200px; background-size: 100%">

                    </div>
                </div>
            </label>
            <input type="file" name="topbanner" preview-target-id="topbanner-preview_1" title="1">
        </div>
    </div>
@endsection
