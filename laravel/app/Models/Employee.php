<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

    protected $fillable = ['name', 'salary', 'isWork'];
    public static $unguarded = true;
}
