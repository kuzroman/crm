<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MutualCalc extends Model {

    protected $fillable = ['date', 'id_order', 'id_buyer', 'id_employee',
        'id_kindcost', 'sum', 'desc'];
    public static $unguarded = true;

}
