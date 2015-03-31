<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

//    protected $table = 'my_users'; // можно явно указать таблицу

    // обязательно добавить или метод add не будет работать - незащищенное введение данных
    //public static $unguarded = true; // laravel не нравится что мы напрямую добавляем данные.



    public static function getAll() {

        //$orders = DB::select('select o.*, b.name as b_name from orders o INNER JOIN buyers b ON o.id_buyer = b.id');

        $orders = Order::all();

        return json_encode($orders);
    }


//    // добавление новых данных
//    public static function add($data) {
//        try {
//            $post = Order::create([
//                'created' => $data['created'],
//                'id_buyer' => $data['id_buyer'],
//                'desc' => $data['desc'],
//                'cash' => $data['cash'],
//                'price' => $data['price'],
//                'paid' => $data['paid'],
//                'completed' => $data['completed'],
//                'finished' => $data['finished']
//            ]);
//            return $post;
//        }
//        catch(Exeption $ex) {
//            return $ex;
//        }
//    }

}
