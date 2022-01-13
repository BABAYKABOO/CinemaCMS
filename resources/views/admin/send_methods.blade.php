@extends('admin.admin')
@section('title', 'Рассылка')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="center" style="
    margin: 0 auto;
    margin-top: 30px;
    width: 40%;
">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $errors)
                        <li>{{$errors}}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(isset(session()->done))
            <div class="alert alert-success">
                <ul>
                        <li>{{session()->done}}</li>
                </ul>
            </div>
        @endif
        @dd(session())
    </div>
    <div class="mb-5" style="width: 80%; margin: 0 auto; padding: 30px; border: 2px solid black; border-radius: 15px">
        <form action="{{route('admin-send-sending')}}" enctype="multipart/form-data" method="post">
            @csrf
        <h1 style="text-align: center">Email</h1>
        <div style="height: 100px;">
            <label style="float:left;margin-right: 10px;" class="form-label">Выбрать кому отослать:</label>
            <p style="width:max-content;float:left;margin-right: 10px;"><input name="user_method" @if(!isset($users_count)) checked @endif  type="radio" value="all"> Всем пользователям</p>
            <p style="width:max-content;float:left;margin-right: 50px;"><input name="user_method" @if(isset($users_count)) checked @endif type="radio" value="choose"> Выборочно</p>
            <a href="{{route('admin-send-choose_users')}}" style="float:left;" class="btn btn-secondary">Выбрать пользователей</a>
            @if(isset($users_count))<p>Пользователей выбрано: {{$users_count}}</p>@endif
        </div>
        <div class="mb-3" style="height: 100px;">
            <label style="margin-right: 50px;" class="form-label">Загрузить HTML-письмо:</label>
            <input id="html_file" name="html_pattern" type="file" />
            <style>
                input[type='file'] {
                    color: transparent;
                }
            </style>
        </div>
        <div style="position: absolute; background-color: white; border: 2px solid black; width: 400px; border-radius: 15px; padding: 15px; margin: -140px 0px 0px 550px">
            <span>Список последних загруженных шаблонов</span>
            @foreach($files as $file)
                <p><input class="old_html" name="old_html[name]" accept="text/html" value="{{$file}}" type="checkbox" /> {{$file}}
                    <a style="color: red; text-decoration: underline; margin-left: 20px" href="{{route('admin-send-delete_html', $file)}}">Удалить</a>
                </p>
            @endforeach
        </div>
        <div class="mb-3" style="height: 100px;">
            <label style="margin-right: 50px;" class="form-label">Загруженное HTML-письмо:</label>
            <a id="html_name"></a>
        </div>
        <div class="mb-3" style="height: 100px;">
            <label style="margin-right: 50px;" class="form-label">Шаблон используемый в текущей рассылке:</label>
            <a id="html_use_name"></a>
        </div>
        <div class="mb-3" style="height: 60px;">
            <label style="margin-right: 30px;" class="form-label">Кол-во писем</label>
            <a  style="margin-right: 50px;" id="html_use_name">3</a>
            <label style="margin-right: 30px;" class="form-label">Рассылка выполнена на:</label>
            <a id="html_use_name">100%</a>
        </div>
        <button type="submit" class="btn btn-secondary">Начать рассылку</button>
        </form>
        <script>
            var filename = '';
            var use_html = $('#html_use_name');
            $('input[class="old_html"]').on('click', function() {
                var input = $(this);
                if (!input.prop('checked'))
                {
                    use_html.html(filename);
                }
                else
                {
                    var checkboxes = $('.old_html');
                    checkboxes.prop('checked', false);
                    input.prop('checked', true);
                    use_html.html(input.prop('value'));
                }


            });
            $('input[type="file"]').on('change', function() {
                var file = this;
                filename = file.files[0].name;
                var html_name = $('#html_name');
                html_name.html(filename);
                var checkboxes = $('.old_html');
                checkboxes.prop('checked', false);
                use_html.html(filename);

            });

        </script>
    </div>
@endsection
