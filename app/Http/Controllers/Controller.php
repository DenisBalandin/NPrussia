<?php

namespace App\Http\Controllers;

use App\Blogitem;
use App\News;
use Illuminate\Support\Facades\DB;


use App\Subscribe;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function Welcome()
    {
        echo 'qw1ewq';
        //получаем все статьи из базы
        //$articles=Blogitem::all();
        //полученные данные передаем в вид
       // return view('welcome',['blogitem'=>$articles]);
    }
    
    function Subscrube(){
        $projects = new Subscribe();
        $projects->email = $_POST['subs'];
        $projects->updated_at = '';
        $projects->created_at = '';
        $projects->save();
        header('Location: http://nprussia.su?subs=1 ');
    }

    function SiteSearch(){
        $name = $_POST['title'];
        $search = DB::select("SELECT id FROM blogitem WHERE title LIKE '%$name%' ");
        $url_array = array();
        foreach ($search as $search_result){
            $url_array[]= $search_result->id;
        }
        header('Location: http://nprussia.su/search_result?arr_date='.serialize($url_array).'');
    }
}
