<?php
    use App\Blogitem;
    use App\News;
?>
@extends('layouts.main')
@section('content')
    <h1 class="search_h1">Результаты поиска</h1>

    <div class="search_site_page">
        <form action="http://nprussia.su/sitesearch" method="post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <div class="search_icon_search">
                <img src="/public/img/search_icon.jpg"/>
            </div>
            <input class="search_site_page_input" type="text" name="title" placeholder="Поиск по сайту">
            <input class="search_site_submit"  type="submit" value="Найти">
        </form>
    </div>
    <div style="margin: 0 -10px 0 0 !important;" class="news_items_news">
    <?php
        $page = 0;
        $pagepast = 0;
        $pagenext = 1;
         if(isset($_GET['page'])){
         $pagnow = $_GET['page'];
             $page = $pagnow * 21;
        }
        $url_arr = unserialize($_GET['arr_date']);
        $count = 0;
        foreach ($url_arr as $url_item){
            $blogitems = Blogitem::where('id',$url_item)->first();
            echo '
            <div class="search_result_item">
                <div class="date_news">
                    <a href="/blpage/'.$blogitems->cpulink.'">'.$blogitems->date.'</a>
                </div>
                <h2 class="h2_items_news"><a href="/blpage/'.$blogitems->cpulink.'">'.$blogitems->title.'</a></h2>
                <div class="item_text_news">'.strip_tags($blogitems->text,'strong').'</div>
                <div class="item_meta_teg"></div>
            </div>
            <div class="image_search">
                   <a href="/blpage/'.$blogitems->cpulink.'">
                     <img src="'.$blogitems->img.'" height="288"/>
                   </a>
            </div>';
            $count++;
        }
        if($count == 0){
            echo '<div class="no_result">
                        <p>ПО ВАШЕМУ ЗАПРОСУ НИЧЕГО НЕ НАЙДЕНО</p>
                  </div>';
        }
    ?>
    </div>
@endsection

