<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;

    protected $table = 'goods';

    protected $fillable = [
        'store_id', 'name', 'weight', 'image'
    ];

    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }
    public function goods_stock() {
        return $this->hasOne('App\Models\Goods_stock', 'goods_id', 'id');
    }
    public function goods_scheduled() {
        return $this->hasMany('App\Models\Goods_scheduled', 'goods_id', 'id');
    }
}
