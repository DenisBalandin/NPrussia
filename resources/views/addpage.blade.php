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
                    <a href="http://nprussia.su/uploade?addpage=uplodae">Добавить картинку</a>
               </div>';
               if(isset($_GET['addpage']) && $_GET['addpage']=='newst'){
               ?>
               <h2 class="adminh2">Добавить статью</h2>
               <form action="http://nprussia.su/addpage" method="post" enctype="multipart/form-data">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                    <div class="admin_title">
                        <p>Title</p>
                        <input type="text" name="title" value="" />
                    </div>
                    <div class="admin_title">
                       <p>Link</p>
                       <input type="text" name="cpulink" value="" />
                    </div>
                    <div class="admin_title">
                       <p>Date</p>
                        <?php
                            $months = array( 1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' );
                        ?>
                       <input type="text" name="date" value="<?php echo date( 'd ' . $months[date( 'n' )] . ' Y' );?>" />
                    </div>
                    <div class="admin_title">
                       <p>Title head</p>
                       <input type="text" name="title_head" value="" />
                    </div>
                    <div class="admin_title">
                       <p>Title desc</p>
                       <input type="text" name="title_desc" value="" />
                    </div>
                    <div class="admin_title">
                       <p>Active</p>
                       <input type="text" name="active" value="1" />
                    </div>
                    <div class="admin_title">
                       <p>Img</p>
                       <input style="margin: 10px 0 -10px -10px;" type="file" name="filename"><br>
                    </div>
                    <div class="admin_title">
                       <p>Tegs</p>
                       <input type="text" name="tegs" value="" />
                    </div>
                   <div class="admin_title">
                       <p>Description</p>
                       {{--id="area1"--}}
                        <textarea style="height: 100px; width:950px;" name="description" cols="50" id="summernote"  >

                        </textarea>
                   </div>
                   <div class="admin_title">
                       <p>Text</p>
                       {{--id="area2"--}}
                        <textarea style="width:950px; height: 400px;" name="text" cols="60" id="summernote1" ></textarea>
                   </div>
                     <input  class="sdmin_button" type="submit" name="bsubmit" value="Отправить" />

               </form>
               <?php }
                if(isset($_GET['addpage']) && $_GET['addpage']=='changallst'){
                    $blogitems = Blogitem::orderBy('created_at','desc')->paginate(100);
                    foreach ($blogitems as $key){?>
                          <div class="chgst">
                               <a href="http://nprussia.su/addpage?stlink=<?php echo $key->cpulink; ?>"><?php echo $key->title; ?></a>
                              <div class="deletstrow">
                                  <form action="delrowbd" method="post" >
                                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                                      <input type="hidden" name="idname" value="<?php echo $key->cpulink; ?>">
                                      <input type="submit" name="upload"  value="Удалить статью">
                                  </form>
                              </div>
                          </div>
                          <?php

                    }
                }
                if(isset($_GET['stlink'])){
                $blogitems= Blogitem::where('cpulink','=',$_GET['stlink'])->first();
                ?>
                <h2 class="adminh2">Изменить статью</h2>
                <form action="http://nprussia.su/changest" method="post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                    <input type = "hidden" name = "linkold" value = "<?php echo $blogitems->cpulink;?>">
                    <div class="admin_title">
                        <p>Title</p>
                        <input type="text" name="title" value="<?php echo $blogitems->title;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Link</p>
                        <input type="text" name="cpulink" value="<?php echo $blogitems->cpulink;?>" />
                        <input type="hidden" name="cpulinkhidd" value="<?php echo $blogitems->cpulink;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Date</p>
                        <input type="text" name="date" value="<?php echo $blogitems->date;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Title head</p>
                        <input type="text" name="title_head" value="<?php echo $blogitems->title_head;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Title desc</p>
                        <input type="text" name="title_desc" value="<?php echo $blogitems->title_desc;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Img</p>
                        <div class="admin_title_img" ><img src="<?php echo $blogitems->img;?>" width="200xp"/></div>
                        <input type="text" name="img" value="<?php echo $blogitems->img;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Created_at</p>
                        <input type="text" name="created" value="<?php echo $blogitems->created_at;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Tegs</p>
                        <input type="text" name="tegs" value="<?php echo $blogitems->tegs;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Active</p>
                        <input type="text" name="active" value="<?php echo $blogitems->active;?>" />
                    </div>
                    <div class="admin_title">
                        <p>Description</p>
                        {{--id="area1"--}}
                        <textarea style="height: 100px; width:950px;" name="description" cols="50" id="summernote2">
                            <?php echo $blogitems->description;?>
                        </textarea>
                    </div>
                    <div class="admin_title">
                        <p>Text</p>
                        {{--id="area2"--}}
                        <textarea style="width:950px; height: 400px;" name="text" cols="60" id="summernote3" >
                            <?php echo $blogitems->text;?>
                        </textarea>
                    </div>
                    <input class="sdmin_button" type="submit" name="bsubmit" value="Отправить" />
                </form>
           <?php }
                if(isset($_GET['addpage']) && $_GET['addpage']=='addimg'){?>
                    Размер изображения не превышает 512 Кб, пиксели по ширине не более 500, по высоте не более 1500.
                    <form action="delrowbd" method="post" enctype="multipart/form-data">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                        Выберите файл для загрузки:
                        <input type="file" name="filen">
                        <input type="submit" name="upload" value="Загрузить">
                    </form>
               <?php }
           ?>
           <?php
           }else{
               echo 'Не верный пароль или логин';
           }
        ?>
    </div>
    <script>
        $('#summernote').summernote({ placeholder: 'Hello bootstrap 4', tabsize: 2, height: 200, width: 950 });
        $('#summernote1').summernote({ placeholder: 'Hello bootstrap 4', tabsize: 2, height: 500, width: 950 });
        $('#summernote2').summernote({ placeholder: 'Hello bootstrap 4', tabsize: 2, height: 200, width: 950 });
        $('#summernote3').summernote({ placeholder: 'Hello bootstrap 4', tabsize: 2, height: 500, width: 950 });
    </script>
@endsection