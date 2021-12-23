@extends('admin.admin')
@section('content')

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
                    <div class="row" style="width: 90%; margin: 0 auto;">

                        @foreach($position[0] as $banner)
                        <div class="col-sm" style="width: 200px;">
                            <label for="icon_upload"><br/>
                                <div class="icon_wrapper">
                                    <div id="preview_{{$banner->banner_id}}" style="background: url({{$banner->image_url}}); background-size: 100%"></div>
                                </div>
                            </label><br/>
                            <input type="file" name="{{$banner->banner_id}}[img]" preview-target-id="preview_{{$banner->banner_id}}"><br/>
                            <label>Url:</label>
                            <input type="text" name="{{$banner->banner_id}}[url]"><br/>
                            <label>Текст:</label>
                            <input type="text" name="{{$banner->banner_id}}[text]">
                        </div>
                        @endforeach

                    </div>
                    <div class="row" style="width: 90%; margin: 0 auto;" id="rowDiv">
                            <div class="col-sm" id="divHidden6" style="width: 200px; display: none;">
                                <label for="icon_upload"><br/>
                                    <div class="icon_wrapper">
                                        <div id="preview_6" style="background-size: 100%"></div>
                                    </div>
                                </label><br/>
                                <input type="file" name="6[img]" preview-target-id="preview_6"><br/>
                                <label>Url:</label>
                                <input type="text" name="6[url]"><br/>
                                <label>Текст:</label>
                                <input type="text" name="6[text]">
                            </div>

                        <div class="col-sm" id="divHidden7" style="width: 200px; display: none;">
                            <label for="icon_upload"><br/>
                                <div class="icon_wrapper">
                                    <div id="preview_7" style="background-size: 100%"></div>
                                </div>
                            </label><br/>
                            <input type="file" name="7[img]" preview-target-id="preview_7"><br/>
                            <label>Url:</label>
                            <input type="text" name="7[url]"><br/>
                            <label>Текст:</label>
                            <input type="text" name="7[text]">
                        </div>

                        <div class="col-sm" id="divHidden8" style="width: 200px; display: none;">
                            <label for="icon_upload"><br/>
                                <div class="icon_wrapper">
                                    <div id="preview_8" style="background-size: 100%"></div>
                                </div>
                            </label><br/>
                            <input type="file" name="8[img]" preview-target-id="preview_8"><br/>
                            <label>Url:</label>
                            <input type="text" name="8[url]"><br/>
                            <label>Текст:</label>
                            <input type="text" name="8[text]">
                        </div>

                        <div class="col-sm" id="divHidden9" style="width: 200px; display: none;">
                            <label for="icon_upload"><br/>
                                <div class="icon_wrapper">
                                    <div id="preview_9" style="background-size: 100%"></div>
                                </div>
                            </label><br/>
                            <input type="file" name="9[img]" preview-target-id="preview_9"><br/>
                            <label>Url:</label>
                            <input type="text" name="9[url]"><br/>
                            <label>Текст:</label>
                            <input type="text" name="9[text]">
                        </div>
                    </div>
                    <div onclick="addDiv()" style="margin: 30px 0px 0px 70px; color: white;"><a class="btn btn-secondary">Добавить баннер</a></div>
                    <script>
                        var x = 6;
                        function addDiv() {
                            if (x < 10) {
                                var DivHidden = document.getElementById ( 'divHidden' + x);
                                DivHidden.style = 'width: 200px;';
                                x++;
                            } else
                            {
                                alert('Невозможно добавить больше баннеров!');
                            }
                        }
                    </script>
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
{{--        <h1>Сквозной банер на заднем фоне</h1>--}}
{{--        <div class="div-banner">--}}
{{--            <form action="{{route('admin-banner-save', $status[1]->position_id)}}" enctype="multipart/form-data" method="post">--}}
{{--                @csrf--}}
{{--                <div class="row" style="width: 90%; margin: 50px 0px 0px 0px;">--}}
{{--                    <div class="col-2">--}}
{{--                        <label style="margin: 10px 0px 0px 10px">Размер:  2000х3000</label>--}}
{{--                    </div>--}}
{{--                    <div class="col-10" style="text-align: right;">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                    @foreach($position[1] as $banner)--}}
{{--                        <div class="row" style="width: 90%; margin: 50px 0px 30px 50px;">--}}
{{--                            <div class="col-3">--}}
{{--                                <label for="icon_upload"><br>--}}
{{--                                    <div class="icon_wrapper"><div id="preview_1" style="background: url({{$banner->image_url}}); background-size: 100%"></div></div>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="col-6" style="padding: 50px">--}}
{{--                                <input type="file" name="{{$banner->banner_id}}[img]" preview-target-id="preview_1" title="1">--}}
{{--                                <button type="submit" class="btn btn-primary">Сохранить</button>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

{{--            </form>--}}
{{--        </div>--}}
{{--        <h1>На главной Новости Акции </h1>--}}
{{--        <div class="div-banner">--}}
{{--            <form action="{{route('admin-banner-save', $status[0]->position_id)}}" enctype="multipart/form-data" method="post">--}}
{{--                @csrf--}}
{{--                <div class="row" style="width: 90%; margin: 50px 0px 30px 30px;">--}}
{{--                    <div class="col-2">--}}
{{--                        <label style="margin: 10px 0px 0px 10px">Размер:  1000х190</label>--}}
{{--                    </div>--}}
{{--                    <div class="col-10" style="text-align: right;">--}}
{{--                        <label class="switch">--}}
{{--                            <input type="checkbox" checked>--}}
{{--                            <span class="slider round"></span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row" style="width: 90%; margin: 0 auto;">--}}
{{--                    @foreach($position[0] as $banner)--}}
{{--                        <div class="col-sm" style="width: 200px;">--}}
{{--                            <label for="icon_upload"><br>--}}
{{--                                <div class="icon_wrapper"><div id="preview_1" style="background: url({{$banner->image_url}}); background-size: 100%"></div></div>--}}
{{--                            </label><br/>--}}
{{--                            <input type="file" name="{{$banner->banner_id}}[img]" preview-target-id="preview_1" title="1"><br/>--}}
{{--                            <label>Url:</label>--}}
{{--                            <input type="text" name="{{$banner->banner_id}}[url]"><br/>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="row" style="width: 90%; margin: 50px 0px 30px 150px;">--}}
{{--                    <div class="col-2">--}}
{{--                        <select style="height: 30px; width: 60px">--}}
{{--                            <option>5c</option>--}}
{{--                            <option>3с</option>--}}
{{--                            <option>10с</option>--}}
{{--                            <option>60с</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-8" style="text-align: right;">--}}
{{--                        <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
    </div>
@endsection
