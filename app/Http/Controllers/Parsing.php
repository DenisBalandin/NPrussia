<?php

namespace App\Http\Controllers;

use App\News;
use App\simple_html_dom;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\QueryException;

class Parsing extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function translit($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
        return str_replace($rus, $lat, $str);
    }


    function Parsing_news()
    {
        header("Content-type: text/html; charset=utf-8");

        $html = new simple_html_dom();

       // $html->load('<html><body><p>Hello World!</p><p>Were here</p></body></html>');
        $html->load_file('https://www.svoboda.org/news');
        $title = array();
        $k = 0;
//        foreach($html->find('.media-block__title') as $element) { //выборка всех тегов img на странице
//            //echo $element->innertext . '<br>'; // построчный вывод содержания всех найденных атрибутов src
//            $title[] = $element->innertext;
//
//        }
        foreach($html->find('.content a') as $element) { //выборка всех тегов img на странице
            //echo $element->innertext . '<br>'; // построчный вывод содержания всех найденных атрибутов src
            $title[] = $element->href;
        }

        echo $html->find('.media-block__title p', 0);
        foreach ($title as $item){
            $k++;
            $img = '';
            $textc = '';
            if($k > 3 && $k <= 40 ){
                $html->load_file('https://www.svoboda.org'.$item);
                $pos = strpos($item, 'a');
                if($pos == true){
                $h1 = $html->find('h1',0);
                echo $h1;
                foreach($html->find('.thumb img') as $element) {
                    if($element->src != ''){
                        $img = $element->src;
                        echo '<img src='.$element->src.'><br/>';
                    }
                }
                foreach($html->find('.wsw p') as $element) {
                    if($element->innertext != ''){
                        $text = $element->innertext;
                        $content = iconv('utf-8', 'windows-1251//IGNORE', $text);
                        $text = iconv('windows-1251', 'utf-8', $content);
                        $textc .= $text;
                    }
                }
                echo '<p>'.$textc.'</p>';
                $h1str = strip_tags($h1,'h1');

                $url = str_replace('/a/', '', $item);
                $url = str_replace('.html', '', $url);

                $months = array( 1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' );
                    //if(strpos('r1', $img)) {
                        try {
                            $projects = new News();
                            $projects->link = $url;
                            $projects->title = $h1str;
                            $projects->title_head = '';
                            $projects->title_desc = '';
                            $projects->keywords = '';
                            $projects->date = date('d ' . $months[date('n')] . ' Y');
                            $projects->img = $img;
                            $projects->text = $textc;
                            $projects->text = $textc;
                            $projects->updated_at = '';
                            $projects->created_at = '';
                            $projects->save();
                        } catch (QueryException $e) {

                        }
                  //  }
                }

            }
        }

       // $single = $html->find('.media-block__title');
//        $articles = array();
//        $items = $html->find('div[class=media-block__title]');
//        foreach($items as $names)
//        {
//            $articles[] = array($names->children(0)->plaintext);
//        }
//
//        foreach($articles as $item) {
//            echo "<div class='item'>";
//            echo $item[0];
//            echo "</div>";
//        }

//        echo '<pre>';
//        print_r($single);
//        echo '</pre>';

        //echo $single;
        //получаем все статьи из базы
        //$articles=Blogitem::all();
        //полученные данные передаем в вид
       // return view('welcome',['blogitem'=>$articles]);
    }
}
