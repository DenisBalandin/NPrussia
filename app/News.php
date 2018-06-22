<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //article - это название таблицы в базе данных.
    protected $table='news';
}