<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('addpage', 'AdminController@ShowAll');
Route::post('downloadimg', 'AdminController@DownloadImg');
Route::post('changest', 'AdminController@ChangeSt');
Route::post('message', 'AdminController@SendMessage');
Route::post('delrowbd', 'AdminController@Dellrowbd');
Route::post('subscrube', 'Controller@Subscrube');
Route::post('sitesearch', 'Controller@SiteSearch');

Route::get('/parsing_news', 'Parsing@Parsing_news');


Route::get('/message', function () {
    return view('message');
});

Route::get('/news', function () {
    return view('news');
});
Route::get('/search_result', function () {
    return view('search_result');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/blpage/{cpulink?}', function($cpulink) {
    return view('blpage' , array('cpulink'=>$cpulink));
});
Route::get('/blpage_news/{link?}', function($link) {
    return view('blpage_news' , array('link'=>$link));
});
Route::get('/addpage', function () {
    return view('addpage');
});
Route::get('/uploade', function () {
    return view('uploade');
});
Route::get('/login', function () {
    return view('login');
});

