<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $table = 'stores';

    protected $fillable = [
        'name'
    ];

    public function user() {
        return $this->hasMany('App\Models\User'           , 'store_id', 'id');
    }
    public function goods() {
        return $this->hasMany('App\Models\Goods'          , 'store_id', 'id');
    }
    public function goods_stock() {
        return $this->hasMany('App\Models\Goods_stock'    , 'store_id', 'id');
    }
    public function goods_scheduled() {
        return $this->hasMany('App\Models\Goods_scheduled', 'store_id', 'id');
    }

    public $timestamps = false;
}
