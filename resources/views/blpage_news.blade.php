<?php
use App\News;
$news = News::where('link','=',$link)->first();
?>
@extends('layouts.page_news')
@section('head')
    <meta name="description" content="<?php echo $news->title; ?>"/>
    <title><?php echo $news->title; ?></title>
@endsection
@section('content')
    <div id="page_blog">
        <div class="page_date_news"><?php echo $news->date; ?></div>

        <h1 class="h1_blog_news"><?php echo $news->title; ?></h1>

        <?php

        $img = $news->img;
            if(strpos($news->img ,'w66')){ $img = str_replace('w66','w750',$news->img);}
            if(strpos($news->img, 'w250' )){$img = str_replace('w250','w750',$news->img);}

        ?>

            <img  style="width: 900px !important;" class="page_img" src="<?php echo $img; ?>"  />

        <div class="page_text_news">
           <p> <?php echo $news->text; ?></p>
        </div>

        <div class="perelinkovka">
            <?php
            $countbd = News::where('active',1)->orderBy('id','desc')->first();
            $endleftlink = 0;
            $leftcount = $news->id;
            while ($endleftlink == 0 ){
            $leftcount--;
            $blogitemslinks = News::where('id','=',$leftcount)->where('active','=',1)->first();
            if($leftcount == 1){
                $endleftlink = 1;
            }
            if(isset($blogitemslinks->id)){
                $endleftlink = 1;
                ?>
                <div class="perlinkleft">
                    <p>Прошлая новость</p>
                    <a href="<?php echo $blogitemslinks->link; ?>"><?php echo $blogitemslinks->title; ?></a>
                </div>
                <?php
                }
            }

            $endrightlink = 0;
            $rightcount = $news->id;
            while ($endrightlink == 0 ){
            $rightcount++;
            $blogitemslinks= News::where('id','=',$rightcount)->where('active','=',1)->first();
            if($news->id == $countbd->id){
                $endrightlink = 1;
            }
            if(isset($blogitemslinks->id)){
                $endrightlink = 1;
                ?>
                <div class="perlinkright">
                    <p>Следующая новость</p>
                    <a href="<?php echo $blogitemslinks->link; ?>"><?php echo $blogitemslinks->title; ?></a>
                </div>
                <?php
                }
            }
            ?>
        </div>
        <div class="social_button">
        </div>
    </div>

@endsection

