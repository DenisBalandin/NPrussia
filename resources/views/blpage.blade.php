<?php
use App\Blogitem;
$blogitems= Blogitem::where('cpulink','=',$cpulink)->first();
?>
@extends('layouts.page')

@section('content')
    <div id="page_blog">
        <div class="page_date"><?php echo $blogitems->date; ?></div>
        <h1 class="h1_blog_page"><?php echo $blogitems->title; ?></h1>

            <img align="left" style="width: 500px !important;" class="page_img" src="<?php echo $blogitems->img; ?>"  />

        <div class="page_text">
            <?php echo $blogitems->text; ?>
        </div>

        <div class="perelinkovka">
            <?php
            $countbd = Blogitem::where('active',1)->orderBy('id','desc')->first();
            $endleftlink = 0;
            $leftcount = $blogitems->id;
            while ($endleftlink == 0 ){
            $leftcount--;
            $blogitemslinks = Blogitem::where('id','=',$leftcount)->where('active','=',1)->first();
            if($leftcount == 1){
                $endleftlink = 1;
            }
            if(isset($blogitemslinks->id)){
                $endleftlink = 1;
                ?>
                <div class="perlinkleft">
                    <p>Предыдущая статься</p>
                    <a href="<?php echo $blogitemslinks->cpulink; ?>"><?php echo $blogitemslinks->title; ?></a>
                </div>
                <?php
                }
            }
            $endrightlink = 0;
            $rightcount = $blogitems->id;
            while ($endrightlink == 0 ){
            $rightcount++;
            $blogitemslinks= Blogitem::where('id','=',$rightcount)->where('active','=',1)->first();
            if($blogitems->id == $countbd->id){
                $endrightlink = 1;
            }
            if(isset($blogitemslinks->id)){
                $endrightlink = 1;
                ?>
                <div class="perlinkright">
                    <p>Следующая статья</p>
                    <a href="<?php echo $blogitemslinks->cpulink; ?>"><?php echo $blogitemslinks->title; ?></a>
                </div>
                <?php
                }
            }
            ?>
        </div>
        <div class="social_button">

            {{--<script type="text/javascript">(function() {--}}
                {{--if (window.pluso)if (typeof window.pluso.start == "function") return;--}}
                {{--if (window.ifpluso==undefined) { window.ifpluso = 1;--}}
                    {{--var d = document, s = d.createElement('script'), g = 'getElementsByTagName';--}}
                    {{--s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;--}}
                    {{--s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';--}}
                    {{--var h=d[g]('body')[0];--}}
                    {{--h.appendChild(s);--}}
                {{--}})();</script>--}}
            {{--<div class="pluso" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=02" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>--}}
        </div>
    </div>

@endsection

