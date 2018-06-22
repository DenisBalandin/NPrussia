<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="политика в России, новости, политичесский блог, блог о политике, Россия сейчас, проблемы в России" />
    <title>Непутевая Россия</title>
    <link href="/public/style.css?6" rel="stylesheet" type="text/css">
    <script src="/public/js/sf.js"></script>
    <script src="/public/js/ckeditor.js"></script>
    <script src="/public/js/sample.js"></script>

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
</div>
<!-- Yandex.Metrika counter -->
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
</body>

</html>