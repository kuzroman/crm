<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Buyer extends Model {

    // Указание доступных к заполнению атрибутов
    // так как изначально все модели Eloquent защищены от массового заполнения.
    protected $fillable = ['name', 'id_kind', 'about', 'contact', 'cell_1', 'cell_2', 'email'];

    public static $unguarded = true; // laravel не нравится что мы напрямую добавляем данные.


    public static function getAll() {

        $model = DB::select('
          SELECT b.*, kb.name AS kindName FROM buyers b
          INNER JOIN kind_buyers kb ON b.id_kind = kb.id
          ORDER BY id');

        // выборка из 3х таблиц
//        $orders = DB::select('
//          SELECT b.*,
//          kb.name AS kindName,
//          c.name AS contName, c.cell_1 AS contCell_1, c.cell_2 AS contCell_2, c.email AS contEmail
//          FROM buyers b
//          INNER JOIN contacts c ON b.id_contact = c.id
//          INNER JOIN kind_buyers kb ON b.id_kind = kb.id
//          ORDER BY id');

        //var_dump( json_encode($order) );
        return json_encode($model);
    }

}
