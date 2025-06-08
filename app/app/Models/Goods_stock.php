<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_stock extends Model
{
    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }
    public function goods() {
        return $this->belongsTo('App\Models\Goods', 'goods_id', 'id');
    }
}
