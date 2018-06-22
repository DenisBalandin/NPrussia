<?php
    use App\Blogitem;
        use App\News;
?>
@extends('layouts.main')
@section('content')
    <div style="margin: 0 -10px 0 0 !important;" class="news_items_news">
    <?php
        $page = 0;
        $pagepast = 0;
        $pagenext = 1;
         if(isset($_GET['page'])){
         $pagnow = $_GET['page'];
             $page = $pagnow * 21;
        }

        $blogitems = News::where('active',1)->orderBy('id','DESC')->offset($page)->limit(21)->get();
        if(isset($_GET['page'])){
            $pagnow = $_GET['page'];
            $pagenext = $pagnow+1;
            if($pagnow != 0){
                $pagepast = $pagnow-1;
            }
        }
        $count = 0;
        foreach ($blogitems as $blogitem){
            $count++;
            $tegs = explode(";",$blogitem->tegs);
            $teg = '';
            foreach ($tegs as $t){
                $teg .= "<a href=''>".$t."</a> ";
            }
            if($count >= 7){
                echo '<div class="news_item_short_dop">';
            }else{echo '<div class="news_item_short">';}
            $img = str_replace('w250','w450',$blogitem->img);

            if(strpos($img,'w66')){ $img = str_replace('w66','w750',$blogitem->img);}

                echo '
                <div class="image_news">
                   <a href="/blpage_news/'.$blogitem->link.'">
                     <img src="'.$img.'" width="816"/>
                   </a>
                </div>
                <div class="date_news">
                    <a href="/blpage_news/'.$blogitem->link.'">'.$blogitem->date.'</a>
                    </div>
                <h2 class="h2_items_news"><a href="/blpage_news/'.$blogitem->link.'">'.$blogitem->title.'</a></h2>
                <div class="item_text_news">'.strip_tags($blogitem->text,'strong').'</div>
                <div class="item_meta_teg">'.$teg.'</div>
            </div>';
            if($count == 6){
                if(isset($_GET['subs'] ) == 1){
                    echo "<div class='subscription'>
                      <img src='/public/img/icon_sabs.png' />
                      <div style='width: 500px;' class='subs'>Спасибо. Вы подписались на рассылку нвовстей.</div>
                  </div>";
                }else{
                    echo "<div class='subscription'>
                      <img src='/public/img/icon_sabs.png' />
                      <div class='subs'>НЕ ПРОПУСКАЙТЕ НОВЫЕ СТАТЬИ, ПОДПИСЫВАЙТЕСЬ НА РАССЫЛКУ</div>
                      <form action='http://nprussia.su/subscrube' method='post'>
                      <input type = 'hidden' name = '_token' value = '".csrf_token()."'>
                            <input class='subs_text' type='text' name='subs' value='@электронная почта'>
                            <input class='subs_button' type='submit' value='ПОДПИСАТЬСЯ'>
                      </form>
                </div>";
                }
            }
        }
    ?>
        <?php
            if ($page != 0){
                echo'<a href="/news?&page='.$pagepast.'"><div class="pastpage">Следующие записи</div></a>';
            }
            $blogitemscount = News::where('active',1)->orderBy('created_at','desc')->count();

            if(($page +6 )< $blogitemscount){
                echo '<a href="/news?&page='. $pagenext.'"><div class="nextpage">Предыдущие записи</div></a>';
            }
        ?>

    </div>
@endsection

