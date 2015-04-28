<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MutualCalc extends Model {

    protected $fillable = ['date', 'id_order', 'id_buyer', 'id_employee', 'id_kindcost', 'sum', 'desc'];
    public static $unguarded = true;

    public static function getAll() {
        //$orders = Order::all();
//        http://www.skillz.ru/dev/php/article-Obyasnenie_SQL_obedinenii_JOIN_INNER_OUTER.html

        $model = DB::select('
          SELECT mc.*
          ,o.dateCreated AS orderDateCreated
          FROM mutual_calcs mc
          INNER JOIN orders o ON mc.id_order = o.id
          ORDER BY id');

//        SELECT mc.*
//          ,o.dateCreated AS orderDateCreated
//          ,b.name AS buyerName
//          ,e.name AS employeeName
//          ,k.name AS kindCostName
//          FROM mutual_calcs mc
//          INNER JOIN orders o ON mc.id_order = o.id
//          LEFT JOIN buyers b ON mc.id_buyer = b.id
//          LEFT JOIN employees e ON mc.id_employee = e.id
//          INNER JOIN kind_costs k ON mc.id_kindcost = k.id
//          ORDER BY id');

        return json_encode($model);
    }

}
