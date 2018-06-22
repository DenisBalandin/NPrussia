<?php
    use App\Blogitem;
?>
@extends('layouts.main')
@section('content')
    <div class="news_items">
    <?php
        $page = 0;
        $pagepast = 0;
        $pagenext = 1;
         if(isset($_GET['page'])){
         $pagnow = $_GET['page'];
             $page = $pagnow * 6;
        }

        $blogitems = Blogitem::where('active',1)->orderBy('created_at','desc')->offset($page)->limit(12)->get();
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
            if($count == 1){ echo '<div class="news_item item_full item_left">';}
            else if($count == 2){ echo '<div class="news_item item_short item_right">';}
            else if($count == 3){ echo '<div class="news_item item_short item_left">';}
            else if($count == 4){ echo '<div class="news_item item_full item_right">';}
            else if($count > 4 && $count%2 == 0){
                echo '<div class="news_item item_full item_left">';
            }
            else if($count > 4 && $count%2 == 1){
                echo '<div class="news_item item_short item_right">';
            }
            $tegs = explode(";",$blogitem->tegs);
            $teg = '';
            foreach ($tegs as $t){
                $teg .= "<a href=''>".$t."</a> ";
            }
        echo '
                <div class="image">
                   <a href="/blpage/'.$blogitem->cpulink.'">
                     <img src="'.$blogitem->img.'" width="816"/>
                   </a>
                </div>
                <div class="date">
                    <a href="/blpage/'.$blogitem->cpulink.'">'.$blogitem->date.'</a>
                    </div>
                <h2 class="h2_items"><a href="/blpage/'.$blogitem->cpulink.'">'.$blogitem->title.'</a></h2>
                <div class="item_text">'.$blogitem->description	.'</div>
                <div class="item_meta_teg">'.$teg.'</div>

            </div>';
            if($count == 4){
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
                echo'<a href="/?&page='.$pagepast.'"><div class="pastpage">Следующие записи</div></a>';
            }
            $blogitemscount = Blogitem::where('active',1)->orderBy('created_at','desc')->count();

            if(($page +6 )< $blogitemscount){
                echo '<a href="/?&page='. $pagenext.'"><div class="nextpage">Предыдущие записи</div></a>';
            }
        ?>

    </div>
@endsection

