@extends('admin.admin')
@section('title', 'Новый зал')
@section('content')
    <div style="text-align: left; margin-left: 20px">
        <form action="{{route('admin-cinema_hall-create', $cinema_id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Название зала</label>
                <input type="text" class="form-control" id="name" name="number" placeholder="Название зала" value="" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea class="form-control" aria-label="With textarea" name="desc" placeholder="Описание" id="desc" required></textarea>
            </div>
            <div class="mb-3" style="width: 200px;">
                <label for="icon_upload">Фото верхнего баннера:<br>
                    <div class="icon_wrapper"><div id="topbanner-preview_1" style="background-size: 100%"></div></div>
                </label>
                <input type="file" name="topbanner" preview-target-id="topbanner-preview_1" title="1" required>
            </div>
            <div class="mb-3">
                <label>Галерея</label>
                <div class="row">
                    <div class="col-sm" style="width: 200px;">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_1" style="background-size: 100%"></div></div>
                        </label><br/>
                        <input type="file" name="Gallery[0]" preview-target-id="gallery-preview_1" title="1" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_2" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[1]" preview-target-id="gallery-preview_2" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_3" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[2]" preview-target-id="gallery-preview_3" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_4" style="background-size: 100%"></div></div>
                        </label>
                        <input type="file" name="Gallery[3]" preview-target-id="gallery-preview_4" required>
                    </div>
                    <div class="col-sm" style="width: 200px">
                        <label for="icon_upload">Image:<br>
                            <div class="icon_wrapper"><div id="gallery-preview_5" style="background-size: 100%"></div></div>
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
            <label for="exampleInputPassword1" class="form-label">SEO:</label>
            <div class="mb-3" style="width: 70%; margin-left: 50px">
                <div class="mb-3" style="">
                    <label class="form-label">URL</label>
                    <input type="text" class="form-control" id="seo_url" name="Seo[url]" placeholder="URL" value="" required>
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" id="seo_title" name="Seo[title]" placeholder="Title" value="" required>
                    <label class="form-label">Keywords</label>
                    <input type="text" class="form-control" id="seo_keywords" name="Seo[keywords]" placeholder="Word" value="" required>
                    <label class="form-label">Desc</label>
                    <textarea class="form-control" aria-label="With textarea" name="Seo[desc]" placeholder="Desc" id="seo_desc" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="display: inline-block; margin: 10px 0px 50px 30px">Сохранить</button>
            <a class="btn btn-secondary" style="display: inline-block;  margin: 10px 0px 50px 30px" href="{{route('admin-cinema_hall-new', $cinema_id)}}">
                Вернуть базовую версию
            </a>

        </form>
    </div>
@endsection
