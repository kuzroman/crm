<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KindCost extends Model {

    protected $fillable = ['name'];
    public static $unguarded = true; // laravel не нравится что мы напрямую добавляем данные.

}
