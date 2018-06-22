<?php
use App\Blogitem;
?>
@extends('layouts.main')
@section('content')

    <form action="https://roboposting.ru/api/ver01" method="post" enctype="multipart/form-data">
        <p>Токен:<br />
            <input type="text" name="token" value="токен"></p>
        <p>Название сценария:<br />
            <input type="text" name="scenario_name" value="Тест"></p>
        <p>Текст поста:<br />
            <textarea name="text">Тестовый пост</textarea></p>
        <p>Прикрепить фото:<br />
            <input type="file" name="pictures[]" multiple=""></p>
        <p>Прикрепить ссылку:<br />
            <input type="text" name="link" value="https://roboposting.ru"></p>
        <p><input type="submit" value="Отправить"></p>
    </form>




@endsection