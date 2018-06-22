<?php
use App\Blogitem;
?>
@extends('layouts.regular_t')
@section('content')
<?php if(empty($email)){ ?>
    <div class="contact_items">
        <h1 style="margin: 20px 0;" class="h1_blog_page">Контакты блога</h1>
        <p>Если у Вас есть желание сотрудничать с нашим проектом в качестве автора или информационного партнера, то обращайтесь.</p>
        <p>E-mail:</p>
        <br/>
        <h2>Cвязаться с администратором</h2>
        <form action="http://nprussia.su/message2222" method="post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <div class="admin_title">
                <p>Имя</p>
                <input type="text" name="name" value="" />
            </div>
            <div class="admin_title">
                <p>Email </p>
                <input type="text" name="email" value="" />
            </div>
            <div class="admin_title">
                <p>Text</p>
                <textarea style="height: 200px; width:750px;" name="text" ></textarea>
            </div>
            <input type="submit" name="bsubmit" value="Отправить" />
        </form>
    </div>
<?php }else{ ?>
    <div class="news_items">
        <p>Ваше сообщение отрпавленно.</p>
    </div>
<?php } ?>


@endsection