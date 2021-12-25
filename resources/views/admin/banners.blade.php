@extends('admin.admin')
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
        .div-banner{
            width: 90%;
            margin: 0 auto;
            margin-bottom: 100px;
            border: 2px solid black;
            border-radius: 15px;
            text-align: left;
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
    <div style="text-align: center">
        <h1>На главной верх</h1>
        <div class="div-banner">
            <form action="{{route('admin-banner-save', $status[0]->position_id)}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row" style="width: 90%; margin: 50px 0px 30px 30px;">
                    <div class="col-2">
                        <label style="margin: 10px 0px 0px 10px">Размер:  1000х190</label>
                    </div>
                    <div class="col-10" style="text-align: right;">
                        <label class="switch">
                            <input type="checkbox" name="status" {{$status[0]->status == 1 ? 'checked' : ''}}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                    <div class="row" id="rowDiv" style="width: 90%; margin: 0 auto;">

                        @foreach($position[0] as $banner)
                        <div class="col-sm" style="width: 200px;">
                            <label for="icon_upload"><br/>
                                <div class="icon_wrapper">
                                    <div id="preview_{{$banner->banner_id}}" style="background: url({{$banner->image_url}}); background-size: 100%"></div>
                                </div>
                            </label><br/>
                            <input type="file" name="Banner_{{$banner->banner_id}}_img" preview-target-id="preview_{{$banner->banner_id}}"><br/>
                            <label>Url:</label><br/>
                            <input type="text" name="Banner[{{$banner->banner_id}}][url]" value="{{$banner->url}}"><br/>
                            <label>Текст:</label><br/>
                            <input type="text" name="Banner[{{$banner->banner_id}}][text]" value="{{$banner->text}}"><br/>
                        </div>
                        @endforeach

                    </div>
                    <div onclick="addDiv()" style="margin: 30px 0px 0px 70px; color: white;"><a class="btn btn-secondary">Добавить баннер</a></div>
                    <script>
                        var countDiv = {{count($position[0])}} + 1;
                        function addDiv() {
                            if (countDiv < 11) {
                                var DivHidden = document.getElementById ('rowDiv');
                                var str = '<div class="col-sm" id="divHidden' + countDiv + '" style="width: 200px;">' +
                                    '<label for="icon_upload"><br/>' +
                                    '<div class="icon_wrapper">' +
                                    '<div id="add-preview_' + countDiv + '" style="background-size: 100%"></div>' +
                                    '</div>' +
                                    '</label><br/>' +
                                    '<input type="file" name="newBanner_' + countDiv + '_img" preview-target-id="add-preview_' + countDiv + '"><br/>' +
                                    '<label>Url:</label><br/>' +
                                    '<input type="text" name="newBanner[' + countDiv + '][url]"><br/>' +
                                    '<label>Текст:</label><br/>' +
                                    '<input type="text" name="newBanner[' + countDiv + '][text]"><br/>' +
                                    '<div onclick="deleteDiv(\''+ 'divHidden' + countDiv +'\')" style="margin: 30px 0px 0px 70px; color: white;"><a class="btn btn-danger">Удалить</a></div>' +
                                    '</div>';
                                $(DivHidden).append(str);
                                countDiv++;
                            } else
                            {
                                alert('Невозможно добавить больше баннеров!');
                            }
                        }
                    </script>
                    <div class="row" style="width: 90%; margin: 50px 0px 30px 150px;">
                        <div class="col-2">
                            <select name="time" style="height: 30px; width: 60px">
                                <option>5c</option>
                                <option>3с</option>
                                <option>10с</option>
                                <option>60с</option>
                            </select>
                        </div>
                        <div class="col-8" style="text-align: right;">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
            </form>
        </div>
        <h1>Сквозной банер на заднем фоне</h1>
        <div class="div-banner">
            <form action="{{route('admin-banner-save', $status[1]->position_id)}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row" style="width: 90%; margin: 50px 0px 0px 0px;">
                    <div class="col-2">
                        <label style="margin: 10px 0px 0px 10px">Размер:  2000х3000</label>
                    </div>
                    <div class="col-10" style="text-align: right;">
                    </div>
                </div>
                    @foreach($position[1] as $banner)
                        <div class="row" style="width: 90%; margin: 50px 0px 30px 50px;">
                            <div class="col-3">
                                <label for="icon_upload"><br>
                                    <div class="icon_wrapper"><div id="main-preview_1" style="background: url({{$banner->image_url}}); background-size: 100%"></div></div>
                                </label>
                            </div>
                            <div class="col-6" style="padding: 50px">
                                <input type="file" name="{{$banner->banner_id}}[img]" preview-target-id="main-preview_1" title="1">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    @endforeach

            </form>
        </div>
        <h1>На главной Новости Акции </h1>
        <div class="div-banner">
            <form action="{{route('admin-banner-save', $status[0]->position_id)}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row" style="width: 90%; margin: 50px 0px 30px 30px;">
                    <div class="col-2">
                        <label style="margin: 10px 0px 0px 10px">Размер:  1000х190</label>
                    </div>
                    <div class="col-10" style="text-align: right;">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="row" style="width: 90%; margin: 0 auto;">
                    @foreach($position[0] as $banner)
                        <div class="col-sm" style="width: 200px;">
                            <label for="icon_upload"><br>
                                <div class="icon_wrapper"><div id="news-preview_{{$banner->banner_id}}" style="background: url({{$banner->image_url}}); background-size: 100%"></div></div>
                            </label><br/>
                            <input type="file" name="{{$banner->banner_id}}[img]" preview-target-id="news-preview_{{$banner->banner_id}}" title="1"><br/>
                            <label>Url:</label>
                            <input type="text" name="{{$banner->banner_id}}[url]" value="{{$banner->url}}"><br/>
                        </div>
                    @endforeach
                </div>
                <div class="row" style="width: 90%; margin: 0 auto;" id="rowDiv">
                    @for($i = count($position[0]); $i < 5 + count($position[0]); $i++)
                    <div class="col-sm" id="news-divHidden{{$i}}" style="width: 200px; display: none;">
                        <label for="icon_upload"><br/>
                            <div class="icon_wrapper">
                                <div id="add-news-preview_{{$i}}" style="background-size: 100%"></div>
                            </div>
                        </label><br/>
                        <input type="file" name="new_{{$i}}[img]" preview-target-id="add-news-preview_{{$i}}"><br/>
                        <label>Url:</label>
                        <input type="text" name="new_{{$i}}[url]"><br/>
                        <div onclick="deleteDiv('news-divHidden{{$i}}')" style="margin: 30px 0px 0px 70px; color: white;"><a class="btn btn-danger">Удалить</a></div>
                    </div>
                    @endfor
                </div>

                <div onclick="addNewsDiv('news-divHidden')" style="margin: 30px 0px 0px 70px; color: white;"><a class="btn btn-secondary">Добавить баннер</a></div>
                <script>
                    var x = {{count($position[0])}};
                    function addNewsDiv(id) {
                        if (x < {{count($position[0]) + 5}}) {
                            var DivHidden = document.getElementById ( id + x);
                            DivHidden.style = 'width: 200px;';
                            x++;
                        } else
                        {
                            alert('Невозможно добавить больше баннеров!');
                        }
                    }
                    function deleteDiv(id) {
                            var DivHidden = document.getElementById (id);
                            DivHidden.remove();
                            x++;
                    }
                </script>
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
                <div class="row" style="width: 90%; margin: 50px 0px 30px 150px;">
                    <div class="col-2">
                        <select style="height: 30px; width: 60px">
                            <option>5c</option>
                            <option>3с</option>
                            <option>10с</option>
                            <option>60с</option>
                        </select>
                    </div>
                    <div class="col-8" style="text-align: right;">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
