@extends('admin.admin')
@section('title', 'Рассылка')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="mb-5" style="width: 80%; margin: 0 auto; padding: 30px; border: 2px solid black; border-radius: 15px">
        <h1 style="text-align: center">SMS</h1>
        <div style="height: 100px;">
            <label style="float:left;margin-right: 10px;" class="form-label">Выбрать кому отослать:</label>
            <p style="width:max-content;float:left;margin-right: 10px;"><input checked  name="user_method" type="radio" value="all"> Всем пользователям</p>
            <p style="width:max-content;float:left;margin-right: 50px;"><input name="user_method" type="radio" value="choose"> Выборочно</p>
            <button style="float:left;" class="btn btn-secondary">Выбрать пользователей</button>
        </div>
        <div class="mb-3" style="height: 100px;">
            <label style="margin-right: 50px;" class="form-label">Загрузить HTML-письмо:</label>
            <input preview-target-id="html_name" name="html_pattern" type="file" />
        </div>
        <div style="position: absolute; background-color: white; border: 2px solid black; border-radius: 15px; padding: 15px; margin: -140px 0px 0px 600px">
            <span>Список последних загруженных шаблонов</span>
            <p><input name="old_html_name" type="checkbox" />HTML</p>
            <p><input name="old_html_name" type="checkbox" />HTML</p>
            <p><input name="old_html_name" type="checkbox" />HTML</p>
            <p><input name="old_html_name" type="checkbox" />HTML</p>
            <p><input name="old_html_name" type="checkbox" />HTML</p>
        </div>
        <div class="mb-3" style="height: 100px;">
            <label style="margin-right: 50px;" class="form-label">Загруженное HTML-письмо:</label>
            <a id="html_name">Рассылка новостей.html</a>
        </div>
        <div class="mb-3" style="height: 100px;">
            <label style="margin-right: 50px;" class="form-label">Шаблон используемый в текущей рассылке:</label>
            <a id="html_use_name">Рассылка новостей.html</a>
        </div>
        <div class="mb-3" style="height: 60px;">
            <label style="margin-right: 30px;" class="form-label">Кол-во писем</label>
            <a  style="margin-right: 50px;" id="html_use_name">173</a>
            <label style="margin-right: 30px;" class="form-label">Рассылка выполнена на:</label>
            <a id="html_use_name">45%</a>
        </div>
        <button type="submit" class="btn btn-secondary">Начать рассылку</button>
    </div>
@endsection
