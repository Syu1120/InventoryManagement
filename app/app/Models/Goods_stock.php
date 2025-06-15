<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods_stock extends Model
{
    use SoftDeletes;

    protected $table = 'goods_stock';

    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }
    public function goods() {
        return $this->belongsTo('App\Models\Goods', 'goods_id', 'id');
    }
}
