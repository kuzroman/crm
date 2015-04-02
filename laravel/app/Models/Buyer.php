<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Buyer extends Model {

    // Указание доступных к заполнению атрибутов
    // так как изначально все модели Eloquent защищены от массового заполнения.
    protected $fillable = ['name', 'id_kind', 'about'];

    public static $unguarded = true; // laravel не нравится что мы напрямую добавляем данные.


    public static function getAll() {
//        $orders = Order::all();

//            con.name as contName, con.cell_1 as cell_1, con.cell_2 as cell_2, con.emails as email1

        $orders = DB::select('select b.*, kb.kind as kindName
            from buyers b INNER JOIN kind_buyers kb ON b.id_kind = kb.id ORDER BY id');
//        $orders = DB::select('select * from buyers ');
        //print_r($orders);

//        foreach ($buyers as $buyer) {
//            foreach ($buyer as $k=>$v) {
//
//                print_r($v);
//            }
//        }

//        foreach ($orders as $id => $all_order) {
//            $all_order = json_decode($all_order);
//            foreach ($all_order as $param => $value) {
//                if ($param == 'updated_at' || $param == 'created_at') continue;
//                $order[$id][$param] = $value;
//            }
//        }
        //var_dump( json_encode($order) );
        return json_encode($orders);
    }

}
