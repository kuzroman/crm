<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KindBuyer extends Model {
    // Указание доступных к заполнению атрибутов
    // так как изначально все модели Eloquent защищены от массового заполнения.
    protected $fillable = ['name'];

    public static $unguarded = true; // laravel не нравится что мы напрямую добавляем данные.
}