<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model {

    protected $fillable = ['name'];

    public static $unguarded = true;

}
