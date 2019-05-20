<!DOCTYPE html>
<html>
<head>
    <?php
    use App\News;
    $news= News::where('link','=',$link)->first();
    ?>
    <meta charset="utf-8">
    <title><?php echo $news->title_head; ?></title>
    <meta name="title" content="<?php echo $news->title_head; ?>">
    <meta name="description" content="<?php echo $news->title_desc; ?>">
    <meta name="keywords" content="Непутевая Рссия / <?php echo $news->keywords; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/style.css?10" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
</head>
<body>
<!--Head-->
<div id="head_bg_page">
    <div id="head">
        <a href="/">
            <div class="blog_name">Непутевая Россия</div>
        </a>
        <div class="head_menu">
            <ul>
                <li><a href="/">Главное</a></li>
                <li><a href="/news">Новости</a></li>
                <li><a href="/message">Контакты</a></li>
                <li><a href="/about">О блоге</a></li>
            </ul>
        </div>
        <div class="search_site">
            <form action="http://nprussia.su/sitesearch" method="post">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                <div class="search_icon">
                    <img src="/public/img/search_icon.jpg"/>
                </div>
                <input type="text" name="title" placeholder="Поиск по сайту">
            </form>
        </div>
    </div>
</div>
<!--Head end-->
<div id="content_bg">
    <div id="content">
        <div id="content_news_page">
            @yield('content')
        </div>
    </div>
</div>
<div id="footer_bg">
    <div id="footer">
        <!-- Yandex.Metrika informer -->
        <a href="https://metrika.yandex.ru/stat/?id=45486123&amp;from=informer"
           target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/45486123/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                               style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="45486123" data-lang="ru" /></a>
        <!-- /Yandex.Metrika informer -->

        <!-- Yandex.Metrika counter
        <script type="text/javascript" >
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter45486123 = new Ya.Metrika({
                            id:45486123,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true
                        });
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/45486123" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </div>
</div>

</body>

</html>