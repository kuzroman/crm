<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model {
    protected $fillable = ['dateCreated', 'dateCompleted', 'id_buyer', 'id_place',
        'desc', 'price', 'cash', 'paid', 'finished'];

    //    protected $table = 'my_users'; // можно явно указать таблицу
    // обязательно добавить или метод add не будет работать - незащищенное введение данных

    public static $unguarded = true;

    public static function getAll() {
        //$orders = Order::all();

        $model = DB::select('
          SELECT o.*, b.name AS buyerName, p.name AS placeName
          FROM orders o
          INNER JOIN buyers b ON o.id_buyer = b.id
          INNER JOIN places p ON o.id_place = p.id
          ORDER BY id');

        return json_encode($model);
    }
}
