@extends('admin.admin')
@section('title', 'Новый кинотеатр')
@section('content')
    <div style="text-align: left; margin-left: 20px">
        <form action="{{route('admin-cinema_create')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Название фильма</label>
                <input type="text" class="form-control" id="name" placeholder="Название" name="name" value="" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" placeholder="Описание" id="desc" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Условия</label>
                <section class="container">
                    <div>
                        <select name="conditions_active[]" id="leftValues" size="8" multiple></select>
                    </div>
                    <div>
                        <input type="button" id="btnLeft" value="&lt;&lt;" />
                        <input type="button" id="btnRight" value="&gt;&gt;" />
                    </div>
                    <div>
                        <select id="rightValues" name="conditions_inactive[]" style="width: 300px" size="7" multiple>
                            @foreach($conditions as $condition)
                                <option value="{{$condition->condition_id}}">{{$condition->condition_name}}</option>
                            @endforeach
                        </select>
                        <div>
                            <input type="text" id="txtRight" />
                        </div>
                    </div>
                </section>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <style>
                    SELECT, INPUT[type="text"] {
                        width: 160px;
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
