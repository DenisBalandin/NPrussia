<?php
use App\Blogitem;
?>
@extends('layouts.main')
@section('content')
    <?php
        if(session('login') =='temhbin' && session('password')=='2295825'){
            header('Location: http://nprussia.su/addpage ');
        }
    ?>
    <div class="news_items">
        <h1>Login</h1>
        <form action="addpage" method="get">
            Логин:<br>
            <input type="text" name="login"><br>
            Пароль:<br>
            <input type="text" name="password"><br>
            <input type="submit" value="Submit">
        </form>
    </div>
@endsection

