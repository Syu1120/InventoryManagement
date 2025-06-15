<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods_scheduled extends Model
{
    use SoftDeletes;

    protected $table = 'goods_scheduled_arrival';

    protected $fillable = [
        'store_id', 'goods_id', 'date', 'quantity', 'weight'
    ];

    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }
    public function goods() {
        return $this->belongsTo('App\Models\Goods', 'goods_id', 'id');
    }
}
