<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model {

    // Указание доступных к заполнению атрибутов
    // так как изначально все модели Eloquent защищены от массового заполнения.
    protected $fillable = ['name', 'cell_1', 'cell_2', 'email'];

    public static $unguarded = true; // laravel не нравится что мы напрямую добавляем данные.



    public static function getAll() {
//        $orders = Order::all();
        //$orders = DB::select('select b.*, kb.kind as kindName from buyers b INNER JOIN kind_buyers kb ON b.id_kind = kb.id ORDER BY id');
        //return json_encode($orders);
    }

}
