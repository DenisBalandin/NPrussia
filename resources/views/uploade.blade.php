<?php
use App\Blogitem;
use Symfony\Component\HttpFoundation\Session;
?>
{{--<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">--}}
    {{--//<![CDATA[--}}
    {{--bkLib.onDomLoaded(function() {--}}
        {{--new nicEditor().panelInstance('area1');--}}
        {{--new nicEditor({fullPanel : true}).panelInstance('area2');--}}
        {{--new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');--}}
        {{--new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');--}}
        {{--new nicEditor({maxHeight : 100}).panelInstance('area5');--}}
    {{--});--}}
    {{--//]]>--}}
{{--</script>--}}
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

@extends('layouts.admin')
@section('content')
    <div class="news_items">
        <?php
       // session()->flush();
           $loginful = 0;
           if(isset($_GET['login']) || session('login') != ''){
               if(((isset($_GET['login']) && $_GET['login']=='temhbin') && (isset( $_GET['password']) && $_GET['password']=='2295825')) || (session('login') =='temhbin' && session('password')=='2295825')){
                   session(['login' => 'temhbin','password' => '2295825']);
                   $loginful = 1;
               }
           }
           if($loginful != 0){
               echo '<div class="addstmenu">
                    <a href="http://nprussia.su/addpage?addpage=newst">Добавить новую статью</a>
                    <a href="http://nprussia.su/addpage?addpage=changallst">Выбрать статью для изменения</a>
                    <a href="http://nprussia.su/uploade?uploade=uplodae">Добавить картинку</a>
               </div>';
               if(isset($_GET['addpage']) && $_GET['addpage']=='uplodae'){
               ?>
               <h2 class="adminh2">Закачать файл</h2>
                <form action="http://nprussia.su/downloadimg" method="post" enctype="multipart/form-data">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token()?>">
                    <input type="file" name="filename"><br>
                    <input type="submit" value="Загрузить"><br>
                </form>
               <?php } ?>
           <?php
           }else{
              echo 'Не верный пароль или логин';
           }
        ?>
    </div>
    <script>
        $('#summernote').summernote({ placeholder: 'Hello bootstrap 4',  tabsize: 2, height: 200, width: 950 });
        $('#summernote1').summernote({ placeholder: 'Hello bootstrap 4', tabsize: 2, height: 500, width: 950 });
        $('#summernote2').summernote({ placeholder: 'Hello bootstrap 4', tabsize: 2, height: 200, width: 950 });
        $('#summernote3').summernote({ placeholder: 'Hello bootstrap 4', tabsize: 2, height: 500, width: 950 });
    </script>
@endsection